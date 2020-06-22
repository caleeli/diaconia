<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plantilla;
use Faker\Generator as Faker;

$factory->define(Plantilla::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
    ];
});
