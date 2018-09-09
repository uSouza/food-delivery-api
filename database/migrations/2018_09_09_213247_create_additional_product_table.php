<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalProductTable extends Migration
{
    public function up()
    {
        Schema::create('additional_product', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('additional_id')->unsigned();
            $table->timestamps();
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('additional_id')->references('id')
                ->on('additionals')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_product');
    }
}
