<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreightIdInOrders extends Migration
{

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('freight_id')->nullable();
            $table->foreign('freight_id')->references('id')
                ->on('freights')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
