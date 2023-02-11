<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'gender_product' => $faker->biasedNumberBetween(1, 2),
        'items' => $faker->biasedNumberBetween(1, 8),
        'name_cate' => $faker->company,
        'status' => $faker->biasedNumberBetween(1, 2)
    ];
});
