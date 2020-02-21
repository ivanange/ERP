<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedDecimal('amount', 20, 4);
            $table->unsignedBigInteger('dueable_id')->nullable();
            $table->string('dueable_type')->nullable();
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
        Schema::table('due', function (Blueprint $table) {
            $table->dropForeign(['flow_id']);
        });
        Schema::dropIfExists('due');
    }
}
