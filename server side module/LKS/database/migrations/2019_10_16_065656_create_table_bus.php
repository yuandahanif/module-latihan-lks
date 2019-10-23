<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_bus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plat_number');
            $table->enum('brand', ['merchedes', 'fuso','scania']);
            $table->integer('seat');
            $table->integer('price_per_day');
            $table->string('bus_img')->default('img/high-way-bus/bus.svg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_bus');
    }
}
