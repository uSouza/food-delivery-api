<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->enum('type', ['marmita', 'bebida']);
            $table->string('description')->nullable();
            $table->enum('measure', ['UN', 'M', 'CM', 'L', 'ML']);
            $table->char('size')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
