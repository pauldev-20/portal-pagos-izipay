<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PagoResource extends JsonResource
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
            'id' => $this->id,
            'numero' => $this->numero,
            'concepto' => $this->concepto,
            'periodo' => $this->periodo,
            'item' => $this->item,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'estado' => $this->estado,
            'emision' => $this->emision,
            'importe' => $this->importe,
        ];
    }
}
