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
            $table->string('name', 100);
            $table->string('surname', 100)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('title', 50)->default('MR');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('username', 100);
            $table->string('address', 200);
            $table->string('password', 500);
            $table->unsignedBigInteger('permissions')->default(0);
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
