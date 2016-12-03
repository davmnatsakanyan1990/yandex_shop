<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('name');
            $table->string('url');
            $table->integer('parentId');
            $table->string('parentUrl');
            $table->string('description');
            $table->string('image');
            $table->string('title_seo');
            $table->string('keywords_seo');
            $table->string('description_seo');
            $table->string('seo_description');
            $table->integer('mark_up');
            $table->enum('hide_from_menu', [0,1]);
            $table->integer('activity');
            $table->enum('donot_uplod_yml', [0,1]);
            $table->string('sorting');
            $table->string('identifier');
            $table->increments('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
