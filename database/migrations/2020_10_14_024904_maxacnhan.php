<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class Maxacnhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maxacnhan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_user');
            $table->string('code');
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });
        // Schema::table('maxacnhan', function($table) {
        //     $table->foreign('id_user')->references('user_id')->on('user')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maxacnhan');
    }
}
