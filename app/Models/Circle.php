<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Circle
 * @package App\Models
 *
 * @method Builder active()
 * @method Builder resortless()
 * @method Builder hasNewsletterMail()
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

    protected $appends = [
        'leader'
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
        return $this
            ->belongsToMany(User::class, 'program_filters')
            ->withPivot([
                'program',
                'newsletter'
            ])
        ;
    }

    /**
     * @return HasMany
     */
    public function programs() : HasMany
    {
        return $this->hasMany(Program::class);
    }

    /**
     * @return HasMany
     */
    public function newsletterMails() : HasMany
    {
        return $this->hasMany(NewsletterMail::class);
    }

    /**
     * @return Builder
     */
    public function newsletterRecipients() : Builder
    {
        return User::whereFilter(false)
            ->orWhereHas('filters', function (Builder $query) {
                return $query->where('circle_id', $this->id);
            })
        ;
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
     * @return Builder
     */
    public function scopeResortless(Builder $query) : Builder
    {
        return $query->whereNull('resort_id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeHasNewsletterMail(Builder $query) : Builder
    {
        return $query->whereHas('newsletterMails');
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
                    $query->where(function (Builder $query) {
                        $query
                            ->where('leader', true)
                            ->orWhere('site_pr', null)
                            ->where('pr', true)
                        ;
                    })->orWhere('site_pr', true);
                })
            ;
        });
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeFiltered(Builder $query) : Builder
    {
        return $query->whereHas('filters');
    }

    /**
     * @return bool
     */
    public function hasResort() : bool
    {
        return $this->resort()->exists();
    }

    /**
     * @return bool
     */
    public function hasLeader() : bool
    {
        return $this->users()->wherePivot('leader', true)->exists();
    }

    /**
     * @return User|null
     */
    public function getLeaderAttribute() : ?User
    {
        return $this->users()->wherePivot('leader', true)->first();
    }
}