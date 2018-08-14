<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyIngredientGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_ingredient_group', function (Blueprint $table) {
            $table->integer('company_id')->unsigned();
            $table->integer('ingredient_group_id')->unsigned();
            $table->double('additional_value');
            $table->timestamps();
            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ingredient_group_id')->references('id')
                ->on('ingredient_groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_ingredient_group');
    }
}
