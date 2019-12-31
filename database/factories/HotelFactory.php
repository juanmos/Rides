<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hotel;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    return [
        'nombre'=> $faker->company,
        'direccion'=> $faker->address,
        'email'=> $faker->email,
        'telefono'=> $faker->phoneNumber,
        'web'=> $faker->domainName
    ];
});
