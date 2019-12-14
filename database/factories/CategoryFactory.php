<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Mano-vacia', 'Kali', 'TaiJi', 'Sanda', 'Wu-shu', 'Cuchillo', 'Medicina-China']),
        'description' => $faker->sentence
    ];
});
