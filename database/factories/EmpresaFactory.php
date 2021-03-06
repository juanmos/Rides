<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Empresa;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->company,
        'ruc'=>$faker->randomNumber() ,
        'costo'=>'2.5',
        'direccion'=>$faker->address,
        'telefono'=>$faker->phoneNumber
    ];
});
