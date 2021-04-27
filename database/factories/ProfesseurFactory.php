<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Professeur::class, function (Faker $faker) {
    return [
        'idUtilisateur' => factory(App\User::class),
        'idDepartement' => factory(App\Departement::class),
    ];
});
