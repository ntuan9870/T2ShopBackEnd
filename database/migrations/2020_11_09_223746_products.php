<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id')->primary('prod_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_img')->default('0');
            $table->string('product_warranty');
            $table->string('product_accessories');
            $table->string('product_condition');
            $table->string('product_promotion');
            $table->string('product_description');
            $table->string('product_featured');
            $table->string('product_amount');
            $table->integer('product_cate')->unsigned();
            // $table->foreign('product_cate')
            // ->references('category_id')
            // ->on('categories')
            // ->onDelete('cascade');
            $table->timestamps();
        });
        // Schema::table('products', function($table) {
        //     $table->foreign('product_cate')->references('category_id')->on('categories')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
