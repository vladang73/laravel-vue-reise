<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySchedulingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_scheduling', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::table('scheduling', function (Blueprint $table) {
            $table->tinyInteger('count_scheduling_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scheduling', function (Blueprint $table) {
            $table->dropColumn('count_scheduling_id');
        });
        Schema::dropIfExists('count_scheduling');
    }
}
