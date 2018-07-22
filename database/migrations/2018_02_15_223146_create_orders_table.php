<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('form_payment_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->float('price');
            $table->string('observation')->nullable();
            $table->boolean('deliver');
            $table->time('receive_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_id')->references('id')
                ->on('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_id')->references('id')
                ->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->references('id')
                ->on('statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('form_payment_id')->references('id')
                ->on('form_payments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('location_id')->references('id')
                ->on('locations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_evaluations');
        Schema::dropIfExists('orders');
    }
}
