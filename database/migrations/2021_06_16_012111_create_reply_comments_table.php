<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_comments', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('comment_id')->unsigned();
            $table->integer('member_id')->unsigned()->nullable();
            $table->longText('reply_comment');

            $table->tinyInteger('status')->default(1);
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();

            $table->foreign('comment_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('reply_comments');
    }
}
