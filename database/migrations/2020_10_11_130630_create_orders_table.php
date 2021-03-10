<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->tinyInteger('user_id');
            $table->string('phone');
            $table->string('address');
            $table->string('total');
            $table->string('status');
            $table->string('ready');
            $table->timestamps();
        });
        // Schema::table('orders', function($table) {
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
        Schema::dropIfExists('orders');
    }
}
