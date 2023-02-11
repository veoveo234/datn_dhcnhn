<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Product\DetailImage;
use Faker\Generator as Faker;

$factory->define(DetailImage::class, function (Faker $faker) {
    return [
        'product_id' => function(){
            return factory(App\Models\Admin\Product\Product::class)->create()->id;
        },
        'sub_image' => $faker->image('public/storage/images/product',640,480, null, false),
    ];
});
