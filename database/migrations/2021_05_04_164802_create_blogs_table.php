<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title', 150);
            $table->string('main_image', 150);
            $table->text('description');
            $table->longText('content_blog');
            $table->double('views');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->collation = 'utf8mb4_unicode_ci';


            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cate_id')->references('id')->on('category_blogs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
