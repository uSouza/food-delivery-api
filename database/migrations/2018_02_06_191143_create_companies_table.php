<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('cnpj');
            $table->string('responsible_name');
            $table->string('responsible_phone');
            $table->string('social_name');
            $table->string('fantasy_name')->nullable();
            $table->string('phone');
            $table->string('cell_phone')->nullable();
            $table->integer('order_limit');
            $table->string('observation')->nullable();
            $table->time('opening_time');
            $table->double('delivery_value')->nullable();
            $table->string('url')->nullable();
            $table->text('image_base64')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices', 'companies');
    }
}
