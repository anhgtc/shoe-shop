<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->bigIncrements('orderdetail_id');
            $table->unsignedBigInteger('order_id');
            $table->string('image');
            $table->string('product_type');
            $table->string('product');
            $table->string('productdetail');
            $table->unsignedBigInteger('productdetail_id')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('number');
            $table->timestamps();

            // khoa rang buoc
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
