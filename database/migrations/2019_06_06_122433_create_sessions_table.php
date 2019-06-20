<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->nullable();  
            $table->longText('notes')->nullable();
            $table->string('approved')->nullable();
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
         Schema::dropIfExists('sessions');
    }
}
