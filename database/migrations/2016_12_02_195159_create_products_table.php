<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('category');
            $table->string('category_url');
            $table->string('name');
            $table->string('version');
            $table->longText('description');
            $table->double('price');
            $table->string('url');
            $table->string('image');
            $table->string('vendor_code');
            $table->integer('count');
            $table->integer('activity');
            $table->string('title_seo');
            $table->string('keywords_seo');
            $table->string('description_seo');
            $table->double('old_price');
            $table->integer('recommended');
            $table->integer('new');
            $table->integer('sorting');
            $table->double('weight');
            $table->string('related_vendors');
            $table->string('related_categories');
            $table->string('link_to_product');
            $table->string('currency');
            $table->string('option');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
