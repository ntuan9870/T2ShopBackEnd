<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OderitemWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitemWarehouse', function (Blueprint $table) {
            $table->increments('id_item');
            $table->integer('product_id');
            $table->string('name_item');
            $table->string('unit_item');
            $table->integer('amount_item');
            $table->double('cost_item');
            $table->double('price_item');
            $table->integer('orderWh_id');
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
        Schema::dropIfExists('orderitemWarehouse');
    }
}
