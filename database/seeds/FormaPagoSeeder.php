<?php

use Illuminate\Database\Seeder;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forma_pagos')->insert([
            'forma_pago' => "Efectivo",
        ]);
        DB::table('forma_pagos')->insert([
            'forma_pago' => "Tarjeta de credito",
        ]);
        DB::table('forma_pagos')->insert([
            'forma_pago' => "Cooperativo",
        ]);
    }
}
