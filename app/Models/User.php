<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $fillable = ['name', 'email'];

    protected $hidden   = ['remember_token', 'created_at', 'updated_at'];

    public function accounts()
    {
        return $this->hasMany('App\Models\SocialAccount');
    }
}
