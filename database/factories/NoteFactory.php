<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'idEtudiant' => factory(App\Etudiant::class),
        'idMatier' => factory(App\Matiere::class),
    ];
});
