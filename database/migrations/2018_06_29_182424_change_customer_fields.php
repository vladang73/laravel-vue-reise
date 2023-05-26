<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCustomerFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('passport');
            $table->dropColumn('receive_newsletter');
            $table->tinyInteger('gender_id')->nullable();
            $table->integer('location_id')->nullable();
        });

        Schema::create('genders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->string('address')->default('');
            $table->string('passport')->default('');
            $table->tinyInteger('receive_newsletter')->default('');
            $table->dropColumn('gender_id')->nullable();
            $table->dropColumn('location_id')->nullable();
        });

        Schema::dropIfExists('genders');

        Schema::dropIfExists('locations');
    }
}
