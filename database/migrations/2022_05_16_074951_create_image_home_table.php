<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_home', function (Blueprint $table) {
            $table->Increments('id');
            $table->text('img_banner');
            $table->text('name_banner');
            $table->text('title_banner');
            $table->text('des_banner');
            $table->text('img_bottom_banner_1');
            $table->text('name_bottom_banner_1');
            $table->text('title_bottom_banner_1');
            $table->text('img_bottom_banner_2');
            $table->text('name_bottom_banner_2');
            $table->text('title_bottom_banner_2');
            $table->text('img_bottom_banner_3');
            $table->text('name_bottom_banner_3');
            $table->text('title_bottom_banner_3');

            $table->text('img_footer_banner');
            $table->text('name_footer_banner');
            $table->text('title_footer_banner');
            $table->text('des_footer_banner');

            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_home');
    }
}
