<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Evenemnt::class, function (Faker $faker) {
    return [
        'ID_chef' => factory(App\Chefdep::class),
    ];
});
