<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Circle extends Model
{
    protected $fillable = [
        'resort_id',
        'name',
        'active'
    ];

    protected $hidden   = [
        'active',
        'created_at', 'updated_at'
    ];

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class)
            ->withPivot([
                'leader',
                'pr',
                'site_pr'
            ]);
    }

    public function filters()
    {
        return $this->belongsToMany(User::class, 'program_filters');
    }

    public function scopeActive(Builder $query)
    {
        return $query->whereActive(true);
    }

    public function scopeWherePRManager(Builder $query, User $user)
    {
        return $query->whereHas('users', function (Builder $query) use($user) {
            $query
                ->where('user_id', $user->id)
                ->where(function(Builder $query) {
                    $query
                        ->where('leader', true)
                        ->orWhere('site_pr', null)
                        ->where('pr', true)
                    ;
                })
                ->orWhere('site_pr', true);
            ;
        });
    }
}