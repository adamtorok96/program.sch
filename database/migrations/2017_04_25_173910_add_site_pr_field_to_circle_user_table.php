<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSitePrFieldToCircleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('circle_user', function(Blueprint $table) {
            $table
                ->boolean('site_pr')
                ->nullable()
                ->default(null)
                ->after('pr')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('circle_user', function (Blueprint $table) {
           $table->dropColumn('site_pr');
        });
    }
}
