<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([__('Mano-vacia'), 'Kali', 'TaiJi', 'Sanda', 'Wu-shu', __('Cuchillo'), __('Medicina-China')]),
        'description' => $faker->sentence
    ];
});
