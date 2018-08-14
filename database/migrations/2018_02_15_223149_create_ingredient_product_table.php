<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_product', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('ingredient_id')->unsigned();
            $table->primary(['ingredient_id', 'product_id']);
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ingredient_id')->references('id')
                ->on('ingredients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_product');
    }
}
