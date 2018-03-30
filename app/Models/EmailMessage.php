<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }
}