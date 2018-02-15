<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_product', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('price_id')->unsigned();
            $table->primary(['product_id', 'price_id']);
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('price_id')->references('id')
                ->on('prices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_product');
    }
}
