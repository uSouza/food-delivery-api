<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_location', function (Blueprint $table) {
            $table->integer('company_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->primary(['company_id', 'location_id']);
            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')
                ->on('locations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_location');
    }
}
