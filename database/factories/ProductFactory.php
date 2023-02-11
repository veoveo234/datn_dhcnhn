<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => function(){
            return factory(App\Models\Admin\Product\Category::class)->create()->id;
        },
        'brand_id' => function(){
            return factory(App\Models\Admin\Product\Brand::class)->create()->id;
        },
        'name' => $faker->name,
        'main_image' => $faker->image('public/storage/images/product',640,480, null, false),
        'price' => $faker->numberBetween($min = 10000, $max = 10000000),
        'description' => $faker->text
    ];
});
