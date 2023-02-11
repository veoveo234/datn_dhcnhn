<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('member_id')->unsigned();
            $table->text('note')->nullable();
            $table->double('total_money');
            $table->tinyInteger('ship_method');
            $table->tinyInteger('payment_method');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('member_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
