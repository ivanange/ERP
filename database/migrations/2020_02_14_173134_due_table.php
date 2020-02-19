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
            $table->unsignedBigInteger('flow_id')->nullable();
            $table->timestamps();
        });

        Schema::table('due', function (Blueprint $table) {
            $table->foreign('flow_id')
                ->references('id')->on('flows')->onDelete('set null');
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
