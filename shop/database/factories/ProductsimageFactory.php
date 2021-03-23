<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Productsimage::class, function (Faker $faker) {
    return [
        'pathimg' => 'https://loremflickr.com/1080/1350/clothes',
        'idProduct' => random_int(0,80)
    ];
});
