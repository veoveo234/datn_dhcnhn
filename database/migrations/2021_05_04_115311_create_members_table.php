<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('avatar', 150);
            $table->string('name', 150);
            $table->string('phone', 11);
            $table->string('address', 250);
            $table->string('email', 150);
            $table->string('password', 150);
            $table->double('point')->default(0);
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
        Schema::dropIfExists('members');
    }
}
