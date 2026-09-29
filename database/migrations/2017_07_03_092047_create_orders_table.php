<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('order_id')->unique();
            $table->date('order_date');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('order_by')->unsigned();
            $table->integer('vendor')->unsigned();
            $table->string('status');
            $table->foreign('vendor')->references('id')->on('vendors');
            $table->foreign('order_by')->references('id')->on('users');
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
        Schema::drop('orders');
    }
}
