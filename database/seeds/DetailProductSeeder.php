<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Product\DetailSize;
use App\Models\Admin\Product\DetailImage;
use App\Models\Admin\Product\Product;

class DetailProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(DetailSize::class, 25)->create();
        factory(DetailImage::class, 50)->create();
        // factory(Product::class, 200)->create();
    }
}
