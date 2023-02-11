<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_users', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('member_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('name', 150);
            $table->smallInteger('quantity');
            $table->double('price');
            $table->tinyInteger('sale')->default(0);
            $table->string('name_size', 5);
            $table->string('image', 150);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('member_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_users');
    }
}
