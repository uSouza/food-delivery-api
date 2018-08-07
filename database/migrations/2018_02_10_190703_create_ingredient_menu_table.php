<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_menu', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('ingredient_id')->unsigned();
            $table->primary(['ingredient_id', 'menu_id']);
            $table->foreign('menu_id')->references('id')
                ->on('menus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ingredient_menu');
    }
}
