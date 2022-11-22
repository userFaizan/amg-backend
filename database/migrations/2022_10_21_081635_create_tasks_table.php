<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id')->unsigned();
            $table->string('shipment_id');
            $table->string('refrence_id');
            $table->string('pickup_location');
            $table->string('drop_off_location');
            $table->integer('dilivary_date');
            $table->string('time');
            $table->integer('contact_number');
            $table->integer('total_distance');
            $table->integer('total_weight');
            $table->integer('vehicle_id');
            $table->string('vehicle_type');
            $table->string('driver_name');
            $table->string('dispatcher');
            $table->string('shipper');
            $table->string('total_cost');
            $table->string('payment_status');
            $table->double('pickup_lat');
            $table->double('pickup_lng');
            $table->double('drop_lat');
            $table->double('drop_lng');
            $table->integer('shipment_status')->default('1');
            $table->integer('change_task_status')->default('0');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tasks');
    }
};
