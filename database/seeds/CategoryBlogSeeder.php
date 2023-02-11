<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Blog\CategoryBlog;
use Faker\Generator as Faker;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 1; $i <= 20; $i++) {
            $cateBlog = new CategoryBlog;
            $cateBlog->name_cate = 'category blog '.$i;
            $cateBlog->status = '1';
            $cateBlog->image = $faker->image('public/storage/images/cate_blogs',350,214, null, false);
            $cateBlog->save();
        }
    }
}
