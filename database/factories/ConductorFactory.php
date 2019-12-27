<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Conductor;
use Faker\Generator as Faker;

$factory->define(Conductor::class, function (Faker $faker) {
    return [
        'marca'=>'Chevrolet',
        'modelo'=>'Aveo',
        'placa'=>'PBC-3422',
        'color'=>'Rojo',
        'tipo_vehiculo_id'=>1
    ];
});
