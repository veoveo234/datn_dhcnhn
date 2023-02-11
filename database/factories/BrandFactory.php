<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name_brand' => $faker->name,
        'image_brand' => $faker->address,
    ];
});
