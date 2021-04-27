<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Absence::class, function (Faker $faker) {
    return [
        'idProf' => factory(App\Professeur::class),
        'idMatier' => factory(App\Matiere::class),
    ];
});
