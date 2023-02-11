<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\DetailSize;
use Faker\Generator as Faker;

$factory->define(DetailSize::class, function (Faker $faker) {
    return [
        'product_id' => function(){
            return factory(App\Models\Admin\Product\Product::class)->create()->id;
        },
        'name_size' => $faker->numberBetween($min = 1, $max = 6),
        'quantity' => $faker->numberBetween($min = 10, $max = 1000),
    ];
});
