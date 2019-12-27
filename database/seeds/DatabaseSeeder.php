<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AerolineasSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(FormaPagoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(TipoVehiculoSeeder::class);
    }
}
