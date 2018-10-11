<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailMessage extends Model
{
    protected $fillable = [
        'user_id', 'circle_id',
        'subject', 'message', 'message_html',
        'send_at'
    ];

    protected $dates = [
        'send_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function circle() : BelongsTo
    {
        return $this->belongsTo(Circle::class);
    }
}