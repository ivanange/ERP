<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowcategory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom', 500);
            $table->longText('desc')->nullable();
        });

        Schema::table('flows', function (Blueprint $table) {
            $table->foreign('category_id')
            ->references('id')->on('flowcategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flows', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('flowcategory');
    }
}
