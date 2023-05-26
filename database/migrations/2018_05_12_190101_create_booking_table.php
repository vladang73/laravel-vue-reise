<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('holiday_type_id')->nullable();
            $table->tinyInteger('receive_newsletter')->default(1);
            $table->integer('agency_id')->nullable();
            $table->string('last_name')->default('');
            $table->string('email')->default('');
            $table->string('passport')->default('');
            $table->string('address')->default('');
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
        Schema::dropIfExists('booking');
    }
}
