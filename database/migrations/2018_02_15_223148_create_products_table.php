<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('price_id');
            $table->string('description');
            $table->string('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('menu_id')->references('id')
                ->on('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('price_id')->references('id')
                ->on('prices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
