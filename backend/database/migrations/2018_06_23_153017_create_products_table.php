<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('products', function(Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->float('price');
             $table->string('brand');
             $table->string('category');
             $table->text('description');
             $table->text('picture');
             $table->integer('stock');
             $table->integer('sold');
             $table->boolean('available');
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
        Schema::drop('products');
    }
}
