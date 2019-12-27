<?php

use Illuminate\Database\Seeder;

class AerolineasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aerolineas')->insert([
            'aerolinea' => "Latam",
        ]);
        DB::table('aerolineas')->insert([
            'aerolinea' => "Tame EP",
        ]);
        DB::table('aerolineas')->insert([
            'aerolinea' => "Avianca",
        ]);
        DB::table('aerolineas')->insert([
            'aerolinea' => "KLM",
        ]);
        DB::table('aerolineas')->insert([
            'aerolinea' => "AeroMexico",
        ]);
        DB::table('aerolineas')->insert([
            'aerolinea' => "Copa",
        ]);
        DB::table('aerolineas')->insert([
            'aerolinea' => "American Airlines",
        ]);
    }
}
