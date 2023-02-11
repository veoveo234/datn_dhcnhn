<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->double('total_money');
            $table->text('note')->nullable();
            $table->string('vnp_response_code', 255)->nullable()->comment('mã phản hồi');
            $table->string('code_vnpay', 255)->nullable()->comment('mã giao dịch vnpay');
            $table->string('code_bank', 255)->nullable()->comment('mã ngân hàng');
            $table->string('card_type', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();
            
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
