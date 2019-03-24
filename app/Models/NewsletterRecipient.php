<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class NewsletterRecipient extends Pivot
{
    protected $fillable = [
        'user_id', 'newsletter_mail_id'
    ];
}