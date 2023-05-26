<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToBookingAgencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_agencies', function (Blueprint $table) {
            $table->integer('booking_id')->unsigned()->change();
            $table->integer('agency_id')->unsigned()->change();
            $table->foreign('booking_id')->references('id')->on('booking')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('travel_agencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Forgotten indexes. They must be in this table creation migration, so I does'n delete them on rollback
    }
}
