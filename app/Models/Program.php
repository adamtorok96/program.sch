<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table    = 'programs';

    protected $fillable = ['user_id', 'pr', 'date', 'location', 'description', 'display'];

    protected $hidden   = ['created_at', 'updated_at'];

    protected $dates    = ['date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}