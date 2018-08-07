<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_price', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('price_id')->unsigned();
            $table->primary(['menu_id', 'price_id']);
            $table->foreign('menu_id')->references('id')
                ->on('menus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('price_menu');
    }
}
