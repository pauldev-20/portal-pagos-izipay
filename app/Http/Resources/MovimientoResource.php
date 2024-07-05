<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MovimientoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identificador' => $this->pagos->first()->user->dni,
            'numero' => $this->order_id,
            'tipo' => strtoupper($this->pagos->first()->concepto),
            'fechaPago' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'importe' => $this->amount,
            'observaciones' => 'Pago Online',
            'descripcion' => 'Pago de recibos',
            'recibos' => $this->pagos->map(function($pago){
                return [
                    'idConcepto' => $pago->id_concepto,
                    'periodo' => $pago->periodo,
                    'item' => $pago->item,
                    'desPag' => "Pago de ". $pago->concepto . " - " . $pago->periodo . " -  " . ucfirst($pago->item),
                    'numero' => $pago->numero,
                    'fechaVen' => $pago->fecha_vencimiento,
                    'importe' => $pago->importe,
                    'emision' => $pago->emision
                ];
            })
        ];
    }
}
