<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Blog\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $blog = new Blog();
            $blog->cate_blog_id = 3;
            $blog->user_id = 1;
            $blog->title = 'title ' . $i;
            $blog->main_image = 'main_image ' . $i;
            $blog->description = 'description ' . $i;
            $blog->content_blog = 'content_blog ' . $i;
            $blog->views = $i;
            $blog->status = 1;
            $blog->save();
        }
    }
}
