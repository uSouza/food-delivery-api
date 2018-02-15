<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->primary(['order_id', 'status_id']);
            $table->timestamps();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')
                ->on('orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
