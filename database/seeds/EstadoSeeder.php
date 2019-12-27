<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'estado' => "Creado",
        ]);
        DB::table('estados')->insert([
            'estado' => "Aceptado, buscando personas",
        ]);
        DB::table('estados')->insert([
            'estado' => "Aceptado, personas completas",
        ]);
        DB::table('estados')->insert([
            'estado' => "Esperando en punto de encuentro",
        ]);
        DB::table('estados')->insert([
            'estado' => "Terminada",
        ]);
        DB::table('estados')->insert([
            'estado' => "Cancelada",
        ]);
    }
}
