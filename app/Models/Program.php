<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table    = 'programs';

    protected $fillable = ['user_id', 'name', 'from', 'to', 'location', 'website', 'summary', 'description'];

    protected $hidden   = ['created_at', 'updated_at'];

    protected $dates    = ['from', 'to'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeOnThisDay(Builder $query, Carbon $carbon) {
        return $query->whereDate('from', '<=', $carbon)->whereDate('to', '>=', $carbon);
    }
}