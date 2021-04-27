<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Filiere::class, function (Faker $faker) {
    return [
        'idDepartement' => factory(App\Departement::class),
    ];
});
