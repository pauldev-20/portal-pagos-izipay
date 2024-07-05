<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'amount',
        'currency',
        'description',
        'estado',
    ];

    public function createModel($request)
    {
        $transaction = $this;
        $transaction->order_id = $request->order_id;
        $transaction->amount = $request->amount;
        $transaction->currency = $request->currency;
        $transaction->estado = $request->estado;
        $transaction->description = $request->description;
        $transaction->save();
    }

    public function updateModel($request)
    {
        $transaction = $this;
        $transaction->update($request->only(['order_id','estado']));
    }

    public function deleteModel()
    {
        $transaction = $this;
        return $transaction->delete();
    }

    public function pagos()
    {
        return $this->belongsToMany(Pago::class);
    }
}
