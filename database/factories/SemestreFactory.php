<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Semestre::class, function (Faker $faker) {
    return [
        'idFiliere' => factory(App\Filiere::class),
        'idAnnee' => factory(App\Anneescolaire::class),
        'idModule' => factory(App\Module::class),
    ];
});
