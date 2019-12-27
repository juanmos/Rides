<?php

use Illuminate\Database\Seeder;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tipo_vehiculo
         DB::table('tipo_vehiculos')->insert([
            'tipo_vehiculo' => "Auto",
        ]);
        DB::table('tipo_vehiculos')->insert([
            'tipo_vehiculo' => "SUV",
        ]);
    }
}
