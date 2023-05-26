<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUnnecessaryFieldsFromTravelAgencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_agencies', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('phone');
            $table->dropColumn('site');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_agencies', function (Blueprint $table) {
            $table->string('city')->default('');
            $table->string('phone')->default('');
            $table->string('site')->default('');
        });
    }
}
