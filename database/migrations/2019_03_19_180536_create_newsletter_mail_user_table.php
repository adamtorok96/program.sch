<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterMailUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_mail_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('newsletter_mail_id');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
            ;

            $table
                ->foreign('newsletter_mail_id')
                ->references('id')
                ->on('newsletter_mails')
                ->onUpdate('cascade')
                ->onDelete('cascade')
            ;

            $table->primary(['user_id', 'newsletter_mail_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsletter_mail_user');
    }
}
