<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Respuesta;
use Faker\Generator as Faker;

$factory->define(Respuesta::class, function (Faker $faker) {
    return [
        'respuesta' => $faker->randomElement(['N','NA','PC','S']),
        'clasificacion' => $faker->name(),
        'observacion' => $faker->sentence(),
        'tipo_observacion' => $faker->randomElement(['CA','CI']),
        'riesgo_adicional_id' => $faker->randomElement(['RA','CI']),
        'tipo_credito' => $faker->randomElement(['Individual','Comunitario']),
        'calidad' => $faker->randomElement(['PRELIMINAL','FINAL']),
    ];
});
