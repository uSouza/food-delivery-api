<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_company', function (Blueprint $table) {
            $table->integer('company_id')->unsigned();
            $table->integer('additional_id')->unsigned();
            $table->double('value');
            $table->timestamps();
            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('additional_company');
    }
}
