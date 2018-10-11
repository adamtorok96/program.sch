<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resort extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden   = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function circles() : HasMany
    {
        return $this->hasMany(Circle::class);
    }
}