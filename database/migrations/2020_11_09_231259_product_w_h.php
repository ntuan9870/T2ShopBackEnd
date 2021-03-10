<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductWH extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductWH', function (Blueprint $table) {
            $table->string('prod_id')->primary('prod_id');
            $table->string('prod_name');
            $table->string('unit');
            $table->integer('prod_amount');
            $table->double('price');
            $table->double('prod_price');
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
        Schema::dropIfExists('ProductWH');
    }
}
