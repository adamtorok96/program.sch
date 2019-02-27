<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsletterMail extends Model
{
    protected $fillable = [
        'circle_id', 'user_id',
        'subject', 'message', 'message_html',
        'target_audience_count',
        'sent_at'
    ];

    protected $hidden  = [
        'created_at', 'updated_at', 'sent_at'
    ];

    protected $casts = [
        'target_audience_count' => 'int'
    ];

    /**
     * @return BelongsTo
     */
    public function circle() : BelongsTo
    {
        return $this->belongsTo(Circle::class);
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}