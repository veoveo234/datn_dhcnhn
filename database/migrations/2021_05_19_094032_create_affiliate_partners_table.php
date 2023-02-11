<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_partners', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('avatar', 200)->nullable();
            $table->string('firstname', 30);
            $table->string('lastname', 20);
            $table->string('email', 150);
            $table->string('profession', 50);
            $table->string('address', 250);
            $table->string('phone', 11);
            $table->string('password', 150);
            $table->double('total_rose')->default(0);
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
        Schema::dropIfExists('affiliate_partners');
    }
}
