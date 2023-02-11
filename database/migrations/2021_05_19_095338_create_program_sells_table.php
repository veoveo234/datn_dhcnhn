<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_sells', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('commission_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('image', 200);
            $table->string('title', 150);
            $table->float('rose_old', 8, 2);
            $table->float('rose_new', 8, 2);
            $table->longText('description');
            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();

            $table->foreign('commission_id')->references('id')->on('commission_rates')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('program_sells');
    }
}
