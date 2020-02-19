<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDueForeignKeyNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         Schema::table('due', function (Blueprint $table) {
            $table->dropForeign(['flow_id']);
            $table->unsignedBigInteger('flow_id')->nullable()->change();
            $table->foreign('flow_id')
                ->references('id')->on('flows')->onDelete('set null');
        });
 */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
