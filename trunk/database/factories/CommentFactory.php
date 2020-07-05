<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Comment;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText($faker->numberBetween(10, 100)),
        'user_id'=>$faker->user_id,
    ];
});
