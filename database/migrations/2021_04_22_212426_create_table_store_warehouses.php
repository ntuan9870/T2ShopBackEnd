<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStoreWarehouses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_warehouses', function (Blueprint $table) {
            $table->increments('store_wh_id');
            $table->string('store_id');
            // $table->string('product_id');
            // $table->string('product_amount');
            $table->integer('wh_capacity');
            $table->integer('wh_empty');
            $table->integer('wh_unit');
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
        Schema::dropIfExists('store_warehouses');
    }
}
