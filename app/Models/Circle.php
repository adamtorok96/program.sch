<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * Class Circle
 * @package App\Models
 *
 * @method static Builder Active()
 * @method static Builder WherePRManager(User $user)
 */
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

    /**
     * @return BelongsTo
     */
    public function resort() : BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users() : BelongsToMany
    {
        return $this
            ->belongsToMany(User::class)
            ->withPivot([
                'leader',
                'pr',
                'site_pr'
            ]);
    }

    /**
     * @return BelongsToMany
     */
    public function filters() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'program_filters');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query) : Builder
    {
        return $query->whereActive(true);
    }

    /**
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopeWherePRManager(Builder $query, User $user) : Builder
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