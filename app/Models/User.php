<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'filter'
    ];

    protected $hidden   = [
        'remember_token', 'created_at', 'updated_at'
    ];

    public function accounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function circles()
    {
        return $this
            ->belongsToMany(Circle::class)
            ->withPivot([
                'leader',
                'pr',
                'site_pr'
            ]);
    }

    public function filters()
    {
        return $this->belongsToMany(Circle::class, 'program_filters');
    }

    public function calendar()
    {
        return $this->hasOne(Calendar::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isPRManagerAt(Circle $circle)
    {
        return $this
            ->circles()
            ->where('id', $circle->id)
            ->where(function (Builder $query) {
                $query
                    ->where('site_pr', true)
                    ->orWhere('leader', true)
                    ->orWhere('site_pr', null)
                    ->where('pr', true)
                ;
            })
            ->exists()
        ;
    }

    public function isInCircle(Circle $circle)
    {
        return $this->circles()->where('id', $circle->id)->exists();
    }

    public function isInFilter(Circle $circle)
    {
        return $this->filters()->where('id', $circle->id)->exists();
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
