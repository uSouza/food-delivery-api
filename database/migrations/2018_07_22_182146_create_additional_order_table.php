<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_order', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('additional_id')->unsigned();
            $table->timestamps();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('additional_order');
    }
}
