<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plantilla;
use App\Revision;
use App\User;
use Faker\Generator as Faker;

$factory->define(Revision::class, function (Faker $faker) {
    return [
        'plantilla_id' => factory(Plantilla::class),
        'elaborador_id' => factory(User::class),
        'revisor_id' => factory(User::class),
        'sucursal' => $faker->name(),
        'tipo_inf' => $faker->name(),
        'visita' => $faker->streetAddress(),
        'fecha_muestra' => $faker->date(),
    ];
});
