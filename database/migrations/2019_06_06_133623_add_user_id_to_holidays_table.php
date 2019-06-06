<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holidays', function (Blueprint $table) {
            $table->integer('userId')->unsigned();
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holidays', function (Blueprint $table) {
            $table->dropForeign('holidays_userId_foreign');
            $table->dropColumn('userId');
        });
    }
}
