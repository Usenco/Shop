<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4,true),
        'description' => $faker->realText(),
        'price' => $faker->randomFloat(2,0,1000),
        'arrived_time' => $faker->date(),
        'left_time' => $faker->date(),
        'keywords' => $faker->randomElement(['product','good','costume','pants','perfect','classical']),
        'mark' => random_int(1,5),
        'reviews' => random_int(0,120),
        'idCategory' => random_int(0,15),
        'mainimg' => 'https://loremflickr.com/1080/1350/clothes'
    ];
});
