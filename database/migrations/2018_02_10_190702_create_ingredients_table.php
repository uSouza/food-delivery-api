<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{

    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingredient_group_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('ingredient_group_id')->references('id')
                ->on('ingredient_groups')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredient_menu');
        Schema::dropIfExists('ingredients');
    }
}
