<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referals', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('partner_id')->unsigned();
            $table->integer('program_id')->unsigned();
            $table->string('link_code', 250);
            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('affiliate_partners')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('program_sells')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referals');
    }
}
