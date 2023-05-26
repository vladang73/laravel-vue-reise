<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePrivacyTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('privacy_texts', function (Blueprint $table) {
            $table->dropColumn('before_checkboxes');
            $table->dropColumn('inside_checkboxes');
            $table->dropColumn('after_checkboxes');

            $table->tinyInteger('provider_id')->default(1);
            $table->string('first_title')->default('');
            $table->text('first_paragraph');
            $table->string('second_title')->default('');
            $table->text('second_paragraph');
            $table->string('third_title')->default('');
            $table->text('third_paragraph');
            $table->text('epilogue');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privacy_texts', function (Blueprint $table) {
            $table->text('before_checkboxes');
            $table->text('inside_checkboxes');
            $table->text('after_checkboxes');

            $table->dropColumn('provider_id')->default(1);
            $table->dropColumn('first_title')->default('');
            $table->dropColumn('first_paragraph');
            $table->dropColumn('second_title')->default('');
            $table->dropColumn('second_paragraph');
            $table->dropColumn('third_title')->default('');
            $table->dropColumn('third_paragraph');
            $table->dropColumn('epilogue');
        });
    }
}
