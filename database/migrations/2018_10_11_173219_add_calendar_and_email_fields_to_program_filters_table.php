<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCalendarAndEmailFieldsToProgramFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_filters', function (Blueprint $table) {
            $table->boolean('calendar')->default(true);
            $table->boolean('email')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_filters', function (Blueprint $table) {
            $table->dropColumn([
                'calendar',
                'email'
            ]);
        });
    }
}
