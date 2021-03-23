<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        "characteristicName" =>  "tracksuits",
        "capture"            =>  $faker->randomElement(["спорт костюмы","классические костюмы",
                                                        "штаны","юбки","шорты"]),
        "nameimg"            =>  'https://loremflickr.com/1080/1350/clothes'
    ];
});
