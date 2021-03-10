<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('price');
            $table->integer('amount');
            $table->integer('order_id')->unsigned()->index();
            $table->timestamps();
        });
        // Schema::table('order_items', function($table) {
        //     $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        //     $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
