<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $table    = 'circles';

    protected $fillable = ['resort_id', 'name', 'active'];

    protected $hidden   = ['created_at', 'updated_at'];

    public function resort()
    {
        return $this->belongsTo('App\Models\Resort');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function scopeWherePRManager(Builder $query, User $user)
    {
        return $query->whereHas('users', function (Builder $query) use($user) {
            $query
                ->where('user_id', $user->id)
                ->where('leader', true)
                ->orWhere('pr', true)
            ;
        });
    }
}