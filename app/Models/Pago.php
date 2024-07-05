<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero',
        'id_concepto',
        'concepto',
        'periodo',
        'item',
        'fecha_vencimiento',
        'emision',
        'importe',
        'estado',
        'user_id',
    ];

    public function createModel($request)
    {
        $pago = $this;
        $pago->numero = $request->numero;
        $pago->id_concepto = $request->id_concepto;
        $pago->concepto = $request->concepto;
        $pago->periodo = $request->periodo;
        $pago->item = $request->item;
        $pago->fecha_vencimiento = $request->fecha_vencimiento;
        $pago->emision = $request->emision;
        $pago->importe = $request->importe;
        $pago->estado = $request->estado;
        $pago->user_id = $request->user_id;
        $pago->save();
    }

    public function updateModel($request)
    {
        $user = $this;
        $user->update($request->only(['estado']));
    }

    public function deleteModel()
    {
        $pago = $this;
        return $pago->delete();
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
