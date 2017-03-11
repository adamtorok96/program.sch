<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
           $table->increments('id');
           $table->uuid('uuid')->unique();
           $table->unsignedInteger('user_id');
           $table->unsignedInteger('circle_id');
           $table->string('name');
           $table->dateTime('from');
           $table->dateTime('to');
           $table->string('location');
           $table->string('summary');
           $table->text('description')->nullable();
           $table->string('facebook_event_id')->nullable();
           $table->string('website')->nullable();
           $table->boolean('display_poster')->default(false);
           $table->boolean('display_site')->default(false);
           $table->unsignedInteger('sequence')->default(0);
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
        Schema::dropIfExists('programs');
    }
}
