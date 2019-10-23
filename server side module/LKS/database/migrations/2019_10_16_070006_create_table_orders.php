<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bus_id');
            $table->integer('driver_id');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->date('start_rent_date');
            $table->integer('total_rent_days');
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
        Schema::dropIfExists('table_orders');
    }
}
