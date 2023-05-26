<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToHolidayTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holiday_types', function (Blueprint $table) {
            $table->string('url')->default('');
            $table->text('explanation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holiday_types', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('explanation');
        });
    }
}
