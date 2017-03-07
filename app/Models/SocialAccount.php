<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $table    = 'social_accounts';

    protected $fillable = ['user_id', 'provider', 'provider_id', 'access_token', 'refresh_token'];

    protected $hidden   = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}