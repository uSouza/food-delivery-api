<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_location', function (Blueprint $table) {
            $table->integer('client_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->primary(['client_id', 'location_id']);
            $table->foreign('location_id')->references('id')
                ->on('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')
                ->on('clients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_location');
    }
}
