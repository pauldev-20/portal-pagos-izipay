<?php

namespace Database\Seeders;

use App\Models\Pago;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runDataDefault();
    }

    public function runDataDefault()
    {
        $user = User::all()->first();

        $pagos = [
            [
                'numero' => 1,
                'id_concepto' => 1,
                'concepto' => 'Agua',
                'periodo' => '2022',
                'item' => 'Enero',
                'fecha_vencimiento' => '2022-01-31',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 2,
                'id_concepto' => 1,
                'concepto' => 'Agua',
                'periodo' => '2022',
                'item' => 'Febrero',
                'fecha_vencimiento' => '2022-02-28',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 3,
                'id_concepto' => 1,
                'concepto' => 'Agua',
                'periodo' => '2022',
                'item' => 'Marzo',
                'fecha_vencimiento' => '2022-03-31',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 1,
                'id_concepto' => 2,
                'concepto' => 'Arbitrios',
                'periodo' => '2022',
                'item' => 'Enero',
                'fecha_vencimiento' => '2022-01-31',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 2,
                'id_concepto' => 2,
                'concepto' => 'Arbitrios',
                'periodo' => '2022',
                'item' => 'Febrero',
                'fecha_vencimiento' => '2022-02-28',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 3,
                'id_concepto' => 2,
                'concepto' => 'Arbitrios',
                'periodo' => '2022',
                'item' => 'Marzo',
                'fecha_vencimiento' => '2022-03-31',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 1,
                'id_concepto' => 3,
                'concepto' => 'Predios',
                'periodo' => '2022',
                'item' => 'Enero - Marzo',
                'fecha_vencimiento' => '2022-03-31',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 2,
                'id_concepto' => 3,
                'concepto' => 'Predios',
                'periodo' => '2022',
                'item' => 'Abril - Junio',
                'fecha_vencimiento' => '2022-06-30',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
            [
                'numero' => 3,
                'id_concepto' => 3,
                'concepto' => 'Predios',
                'periodo' => '2022',
                'item' => 'Julio - Setiembre',
                'fecha_vencimiento' => '2022-09-30',
                'emision' => 10.00,
                'importe' => 10.00,
                'estado' => 'Pendiente',
                'user_id' => $user->id,
            ],
        ];
        foreach ($pagos as $pago) {
            Pago::create($pago);
        }
    }
}