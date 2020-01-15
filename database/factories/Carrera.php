<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Carrera;
use App\Models\Empresa;
use Faker\Generator as Faker;

$factory->define(Carrera::class, function (Faker $faker) {
    return [
        'empresa_id'=>factory(Empresa::class),
        'forma_pago_id'=>'1',
        'direccion'=>$faker->address,
        'referencia'=>'Cerca',
        'latitud'=>$faker->latitude,
        'longitud'=>$faker->longitude,
        'fecha'=>now()->toDateString(),
        'hora'=>now()->toTimeString()
    ];
});
