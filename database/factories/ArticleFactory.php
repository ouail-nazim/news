<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'body' => $faker->text(200),
    ];
});