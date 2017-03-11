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

    public function circles()
    {
        return $this->belongsToMany('App\Models\Circle');
    }

    public function calendar()
    {
        return $this->hasOne('App\Models\Calendar');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isInCircle(Circle $circle)
    {
        foreach($this->circles as $user_circle) {

            if( $user_circle == $circle )
                return true;

        }

        return false;
    }

    public function hasCalendar()
    {
        return $this->calendar()->exists();
    }

    public function detachCircles()
    {
        foreach ($this->circles as $circle) {
            $this->circles()->detach($circle);
        }
    }
}
