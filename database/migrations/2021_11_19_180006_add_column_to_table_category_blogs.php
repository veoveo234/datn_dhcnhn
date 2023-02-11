<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTableCategoryBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_blogs', function (Blueprint $table) {
            $table->string('image', 150)->after('name_cate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('category_blogs')) {
            return;
        }
        Schema::table('category_blogs', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
