<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\FailedJob::class, function (Faker $faker) {
    return [
        'connection' => $faker->text,
        'queue' => $faker->text,
        'payload' => $faker->text,
        'exception' => $faker->text,
        'failed_at' => $faker->dateTime(),
    ];
});
