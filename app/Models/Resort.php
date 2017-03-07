<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    protected $table    = 'resorts';

    protected $fillable = ['name'];

    protected $hidden   = ['created_at', 'updated_at'];

    public function circles()
    {
        return $this->hasMany('App\Models\Circle');
    }
}