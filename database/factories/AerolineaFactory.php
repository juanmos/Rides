<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Aerolinea;
use Faker\Generator as Faker;

$factory->define(Aerolinea::class, function (Faker $faker) {
    return [
        'aerolinea'=>$faker->company
    ];
});
