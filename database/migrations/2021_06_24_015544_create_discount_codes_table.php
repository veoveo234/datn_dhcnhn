<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('affiliate_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('code', 150);
            $table->tinyInteger('type_code');
            $table->double('price');
            $table->smallInteger('quantity');
            $table->string('time', 150);
            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('affiliate_id')->references('id')->on('affiliate_partners')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_codes');
    }
}
