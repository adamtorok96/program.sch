<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ApiToken
 * @package App\Models
 *
 * @method static Builder whereToken(string $token)
 */
class ApiToken extends Model
{
    protected $fillable = [
        'user_id',
        'token'
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}