<?php

namespace App\Http\Controllers;

use App\Helpers\AuthenticableOdoo;
use App\Http\Requests\Transaction\CreateRequest;
use App\Http\Resources\MovimientoResource;
use App\Models\Pago;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    private $url;
    private $username;
    private $password;
    private $public_key;
    private $hash_key;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['getTransactionValidates']);
        $this->url = Config::get('services.izipay.url');
        $this->username = Config::get('services.izipay.username');
        $this->password = Config::get('services.izipay.password');
        $this->public_key = Config::get('services.izipay.public_key');
        $this->hash_key = Config::get('services.izipay.hash_key');
    }

    public function getTransactionValidates(Request $request)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }

        if (!AuthenticableOdoo::authorizedPeticion($request->header('Authorization'))) {
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }
        $transactions = Transaction::where('estado', Config::get('constants.ESTADO_MOVIMIENTO.VALIDADO'))->whereDate('created_at', Carbon::today())->get();
        return response()->json(MovimientoResource::collection($transactions), 200);
    }

    public function requestAuthentication()
    {
        try {
            $header = [
                'Authorization' => 'Basic ' . $this->converteBaseEnconde64(),
                'Content-Type' => 'application/json',
            ];
            $response = Http::withHeaders($header)->post($this->url . '/api-payment/V4/Charge/SDKTest', [
                'value' => 'My test value',
            ]);
            return $response->json();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar la solicitud',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function requestPayment(CreateRequest $request)
    {
        try {
            $pagos = Pago::whereIn('id', $request->pago_id)->get();
            $amount = 0;
            $emision = 0;
            foreach ($pagos as $pago) {
                $amount += $pago->importe;
                $emision += $pago->emision;
            }
            $transaction = Transaction::orderBy('id', 'desc')->first();
            if (!$transaction) {
                $order_id = 1;
            } else {
                $order_id = $transaction->id + 1;
            }
            $zeros = "";
            for ($i = 0; $i < 6 - strlen($order_id); $i++) {
                $zeros = $zeros . "0";
            }

            $request_tran = Request::create('/api/izipay/paid', 'POST', [
                'order_id' => 'Order-' . $zeros . $order_id,
                'amount' => $amount + $emision,
                'currency' => 'PEN',
                'estado' => Config::get('constants.ESTADO_MOVIMIENTO.GENERADO'),
                'description' => 'Pago de recibos',
            ]);

            $transaction = $this->createTransaction($request_tran);

            $transaction->pagos()->attach($request->pago_id);

            $request = $request->merge([
                'order_id' => $transaction->order_id,
                'amount' => ($transaction->amount) * 100,
                'currency' => $transaction->currency,
            ]);

            $header = [
                'Authorization' => 'Basic ' . $this->converteBaseEnconde64(),
                'Content-Type' => 'application/json',
            ];
            $response = Http::withHeaders($header)->post($this->url . '/api-payment/V4/Charge/CreatePayment', [
                'amount' => $request->amount,
                'currency' => $request->currency,
                'orderId' => $request->order_id,
                'metadata' => [
                    'orderInfo ' => $request->pago_id,
                ],
            ]);

            if ($response->json()['status'] != 'SUCCESS') {
                return back()->with('error', 'Error al procesar la solicitud');
            }
            $formToken = $response->json()['answer']['formToken'];
            if ($formToken) {
                return view('payment', compact('formToken'));
            }
            return back()->with('error', 'Error al procesar la solicitud');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar la solicitud');
        }
    }

    public function confirmPayment()
    {
        if (!$this->checkHash($_POST)) {
            return redirect()->route('pago')->with('error', 'No se pudo procesar el pago');
        }

        $iziAnswer = json_decode($_POST['kr-answer'], true);

        if ($iziAnswer['orderStatus'] == 'PAID' && $iziAnswer['orderCycle'] == 'CLOSED') {
            $transactionOrderId = $iziAnswer['orderDetails']['orderId'];

            $transaction = Transaction::where('order_id', $transactionOrderId)->first();
            $transaction->estado = Config::get('constants.ESTADO_MOVIMIENTO.VALIDADO');
            $transaction->save();

            $pagos = $transaction->pagos;

            foreach ($pagos as $pago) {
                $pago->estado = Config::get('constants.ESTADO_PAGO.CANCELADO');
                $pago->save();
            }

            return redirect()->route('pagos')->with('success', 'Pago realizado correctamente');
        }

        return redirect()->route('pagos')->with('error', 'No se confirmo el pago');
    }

    public function createTransaction(Request $request): Transaction
    {
        $transaction = new Transaction;
        $transaction->createModel($request);
        return $transaction;
    }

    function converteBaseEnconde64()
    {
        $data = $this->username . ':' . $this->password;
        $data = base64_encode($data);
        return $data;
    }

    function checkHash($data): bool
    {
        $supported_sign_algos = array('sha256_hmac');
        if (!in_array($data['kr-hash-algorithm'], $supported_sign_algos)) {
            return false;
        }
        $kr_answer = str_replace('\/', '/', $data['kr-answer']);
        $hash = hash_hmac('sha256', $kr_answer, $this->hash_key);
        return ($hash == $data['kr-hash']);
    }
}
