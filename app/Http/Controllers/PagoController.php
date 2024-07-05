<?php

namespace App\Http\Controllers;

use App\Helpers\AuthenticableOdoo;
use App\Http\Requests\Pago\registerPagosPendientes;
use App\Http\Requests\Pago\validateServiciosRequest;
use App\Http\Requests\Pago\validatePredioRequest;
use App\Http\Resources\PagoResource;
use App\Models\Pago;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['registrarPagosPendientes', 'validateServicios', 'validatePredio']);
    }

    public function showAgua(Request $request)
    {
        $pagos = Pago::where('user_id', Auth::user()->id)->where('concepto', Config::get('constants.CONCEPTOS.AGUA'));
        $periodos = $pagos->orderBy('periodo', 'asc')->distinct()->get(['periodo']);

        if ($periodos->count() > 0) {
            $selected = $periodos[0]->periodo;
        }

        if ($request->has('periodo')) {
            $pagos = $pagos->where('periodo', $request->periodo)->orderBy('numero', 'asc')->get();
            $selected = $request->periodo;
        } else {
            if ($periodos->count() > 0) {
                $selected = $periodos[0]->periodo;
                $pagos = $pagos->where('periodo', $selected);
            } else {
                $selected = null;
            }
            $pagos = $pagos->orderBy('numero', 'asc')->get();
        }
        $pagos = PagoResource::collection($pagos);
        return view('agua', compact('pagos', 'periodos', 'selected'));
    }

    public function showArbitrio(Request $request)
    {
        $pagos = Pago::where('user_id', Auth::user()->id)->where('concepto', Config::get('constants.CONCEPTOS.ARBITRIOS'));
        $periodos = $pagos->orderBy('periodo', 'asc')->distinct()->get(['periodo']);

        if ($periodos->count() > 0) {
            $selected = $periodos[0]->periodo;
        }

        if ($request->has('periodo')) {
            $pagos = $pagos->where('periodo', $request->periodo)->orderBy('numero', 'asc')->get();
            $selected = $request->periodo;
        } else {
            if ($periodos->count() > 0) {
                $selected = $periodos[0]->periodo;
                $pagos = $pagos->where('periodo', $selected);
            } else {
                $selected = null;
            }
            $pagos = $pagos->orderBy('numero', 'asc')->get();
        }
        $pagos = PagoResource::collection($pagos);
        return view('arbitrios', compact('pagos', 'periodos', 'selected'));
    }

    public function showPredio(Request $request)
    {
        $pagos = Pago::where('user_id', Auth::user()->id)->where('concepto', Config::get('constants.CONCEPTOS.PREDIOS'));
        $periodos = $pagos->orderBy('periodo', 'asc')->distinct()->get(['periodo']);

        if ($periodos->count() > 0) {
            $selected = $periodos[0]->periodo;
        }

        if ($request->has('periodo')) {
            $pagos = $pagos->where('periodo', $request->periodo)->orderBy('numero', 'asc')->get();
            $selected = $request->periodo;
        } else {
            if ($periodos->count() > 0) {
                $selected = $periodos[0]->periodo;
                $pagos = $pagos->where('periodo', $selected);
            } else {
                $selected = null;
            }
            $pagos = $pagos->orderBy('numero', 'asc')->get();
        }
        $pagos = PagoResource::collection($pagos);
        return view('predios', compact('pagos', 'periodos', 'selected'));
    }

    public function showResumenPagos(Request $request)
    {
        $deudaTotal = Pago::where('user_id', Auth::user()->id)->where('estado', Config::get('constants.ESTADO_PAGO.PENDIENTE'))->groupBy('concepto')->selectRaw('count(id) as cantidad, concepto, sum(emision) as derecho_tramite, sum(importe) as deuda_total')->get();
        $conceptos = ['Agua', 'Arbitrios', 'Predios'];
        $conceptosContain = [];
        foreach ($deudaTotal as $pago) {
            $conceptosContain[] = $pago->concepto;
        }
        $conceptosContain = array_diff($conceptos, $conceptosContain);
        return view('pagos', compact('deudaTotal', 'conceptosContain'));
    }

    public function registrarPagosPendientes(RegisterPagosPendientes $request)
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

        try {
            $data = $request->input('pagos');

            $validate = [];
            foreach ($data as $value) {
                $user = User::where('dni', $value['user_id'])->first();
                if ($user && !Pago::where('numero', $value['numero'])->where('fecha_vencimiento', $value['fecha_vencimiento'])->exists()) {
                    $value['user_id'] = $user->id;
                    $validate[] = $value;
                }
            }

            $Pagos = new Pago();
            if (!empty($validate)) {
                DB::beginTransaction();
                $Pagos->insert($validate);
                DB::commit();
            }

            return response()->json([
                'message' => 'Pagos registrados correctamente',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al registrar los pagos',
            ], 500);
        }
    }

    public function validateServicios(validateServiciosRequest $request)
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

        try {
            $data = $request->input('pagos');
            $numeroPago = [];
            if (sizeof($data) > 0) {
                foreach ($data as $pago) {
                    $numeroPago[] = $pago['numero'];
                }
                DB::beginTransaction();
                Pago::whereIn('numero', $numeroPago)->update(['estado' => Config::get('constants.ESTADO_PAGO.CANCELADO')]);
                DB::commit();
            }
            return response()->json([
                'message' => 'Pagos actualizados correctamente',
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al actualizar los pagos',
            ], 500);
        }
    }

    public function validatePredio(validatePredioRequest $request)
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

        try {
            $data = $request->input('pagos');
            if (sizeof($data) > 0) {
                DB::beginTransaction();
                foreach ($data as $pago) {
                    $pago = Pago::where('numero', $pago['numero'])->where('fecha_vencimiento', $pago['fechaVen'])->first();
                    if ($pago) {
                        $pago->estado = Config::get('constants.ESTADO_PAGO.CANCELADO');
                        $pago->save();
                    }
                }
                DB::commit();
            }
            return response()->json([
                'message' => 'Pagos actualizados correctamente',
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al actualizar los pagos',
            ], 500);
        }
    }
}
