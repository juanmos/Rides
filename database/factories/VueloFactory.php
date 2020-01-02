<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Aerolinea;
use App\Models\Vuelo;
use Faker\Generator as Faker;

$factory->define(Vuelo::class, function (Faker $faker) {
    return [
        'aerolinea_id'=>factory(Aerolinea::class),
        'vuelo'=>$faker->randomNumber(4),
        'origen'=>$faker->city,
        'destino'=>$faker->city,
        'hora_salida'=>$faker->time('H:i'),
        'hora_llegada'=>$faker->time('H:i'),
        'lunes'=>$faker->numberBetween(0, 1),
        'martes'=>$faker->numberBetween(0, 1),
        'miercoles'=>$faker->numberBetween(0, 1),
        'jueves'=>$faker->numberBetween(0, 1),
        'viernes'=>$faker->numberBetween(0, 1),
        'sabado'=>$faker->numberBetween(0, 1),
        'domingo'=>$faker->numberBetween(0, 1)
    ];
});
