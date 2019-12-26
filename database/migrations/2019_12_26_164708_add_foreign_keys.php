<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')
            ->references('id')->on('categories');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('product_id')
            ->references('id')->on('products');
            $table->foreign('command_id')
            ->references('id')->on('commands');
        });

        Schema::table('workers', function (Blueprint $table) {
            $table->foreign('department_id')
            ->references('id')->on('departments');
            $table->foreign('post_id')
            ->references('id')->on('posts');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('department_id')
            ->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {








    }
}
