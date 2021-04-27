<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Etudiant::class, function (Faker $faker) {
    return [
        'idPersonne' => factory(App\Personne::class),
        'idFiliere' => factory(App\Filiere::class),
    ];
});
