<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToProgramFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_filters', function (Blueprint $table) {
            $table->boolean('program')->default(false);
            $table->boolean('newsletter')->default(false);
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
            $table->dropColumn('program');
            $table->dropColumn('newsletter');
        });
    }
}
