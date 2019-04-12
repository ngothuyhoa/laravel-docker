<?php

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'view' => $faker->randomDigit,
        'vote' => $faker->randomDigit,
        'status' => '1',
        'category_id' => '1',
        'slug' => $faker->unique()->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
