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
                ->references('id')->on('categories')->onDelete('set null');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('set null');
            $table->foreign('command_id')
                ->references('id')->on('commands')->onDelete('cascade');;
        });

        Schema::table('workers', function (Blueprint $table) {
            $table->foreign('post_id')
                ->references('id')->on('posts')->onDelete('cascade');;
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('department_id')
                ->references('id')->on('departments')->onDelete('set null');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['command_id']);
        });

        Schema::table('workers', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
}
