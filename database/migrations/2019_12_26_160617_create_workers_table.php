<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500);
            $table->string('surname', 500)->nullable();
            $table->string('username', 1000);
            $table->string('title', 100)->default('MR');
            $table->string('address', 500);
            $table->string('password', 1000);
            $table->unsignedBigInteger('permissions')->default(0);
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->rememberToken();
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
        Schema::dropIfExists('workers');
    }
}
