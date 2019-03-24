<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('circle_id');
            $table->unsignedInteger('user_id');
            $table->string('subject');
            $table->text('message');
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();

            $table
                ->foreign('circle_id')
                ->references('id')
                ->on('circles')
                ->onUpdate('cascade')
                ->onDelete('cascade')
            ;

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
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
        Schema::dropIfExists('newsletter_mails');
    }
}
