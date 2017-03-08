<?php

namespace App\Models;


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
}