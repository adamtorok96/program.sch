<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table    = 'calendars';

    protected $fillable = ['user_id', 'uuid'];

    protected $hidden   = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}