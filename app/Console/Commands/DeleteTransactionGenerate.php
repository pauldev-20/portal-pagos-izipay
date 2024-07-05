<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class DeleteTransactionGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:delete-transaction-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para borrar las transacciones de estado generado que no se confirmaron en 24 horas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transactions = Transaction::where('estado', Config::get('constants.ESTADO_MOVIMIENTO.GENERADO'))->where('created_at', '<', now()->subDay())->get();
        foreach ($transactions as $transaction) {
            $transaction->pagos()->detach();
            $transaction->delete();
        }
    }
}
