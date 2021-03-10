<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OderWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderWarehouse', function (Blueprint $table) {
            $table->increments('orderWh_id');
            $table->string('user');
            $table->string('warehouse_id');
            $table->string('status');
            $table->double('cost');
            $table->double('money');
            $table->double('debt');
            $table->date('time')->nullable();
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
        Schema::dropIfExists('orderWarehouse');
    }
}
