<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name', 500);
            $table->string('manufacturer', 500);
            $table->string('image', 500)->nullable();
            $table->unsignedDecimal('weight', 10, 2)->nullable(); // in grams
            $table->unsignedDecimal('price', 10, 2);
            $table->integer('qte')->unsigned();
            $table->dateTime('expireDate')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
