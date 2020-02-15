<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('type'); // 1 = entrer, 2 = sortie
            $table->string('name', 200);
            $table->longText('desc')->nullable();
            $table->unsignedDecimal('amount', 20, 4)->nullable();
            $table->string('frequency', 200)->nullable(); // null means once
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flows');
    }
}
