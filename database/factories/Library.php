<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Library::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'author' => $faker->text(50)
    ];
});
