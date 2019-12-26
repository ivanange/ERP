<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Query\Expression;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('issueDate')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->dateTime('deliveryDate')->nullable();
            $table->unsignedTinyInteger('status')->default(1);  // 1 = encours, 2 = livré, 3 = annuler
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
        Schema::dropIfExists('commands');
    }
}
