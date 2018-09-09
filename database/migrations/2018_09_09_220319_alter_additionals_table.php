<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdditionalsTable extends Migration
{
    public function up()
    {
        Schema::table('additionals', function (Blueprint $table) {
            $table->float('value');
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('additionals');
    }
}
