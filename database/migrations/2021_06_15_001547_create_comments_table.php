<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('member_id')->unsigned()->nullable();
            $table->string('email', 150)->nullable();
            $table->string('name', 50)->nullable();
            $table->longText('comment');

            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();

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
        Schema::dropIfExists('comments');
    }
}
