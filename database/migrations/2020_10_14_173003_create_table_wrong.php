<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWrong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wrong', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('times');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
        });
        // Schema::table('wrong', function($table) {
        //     $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wrong');
    }
}
