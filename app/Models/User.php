<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 * @package App\Models
 *
 * @method Builder whereFilter(bool $filter)
 */
class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'filter'
    ];

    protected $hidden   = [
        'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function accounts() : HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return BelongsToMany
     */
    public function circles() : BelongsToMany
    {
        return $this
            ->belongsToMany(Circle::class)
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
            ->belongsToMany(Circle::class, 'program_filters')
            ->withPivot([
                'program',
                'newsletter'
            ])
        ;
    }

    /**
     * @return HasOne
     */
    public function calendar() : HasOne
    {
        return $this->hasOne(Calendar::class);
    }

    /**
     * @return BelongsToMany
     */
    public function newsletters() : BelongsToMany
    {
        return $this
            ->belongsToMany(NewsletterMail::class)
            ->using(NewsletterRecipient::class)
        ;
    }

    /**
     * @return bool
     */
    public function isAdmin() : bool
    {
        return $this->hasRole('admin');
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function isPRManagerAt(Circle $circle) : bool
    {
        return $this
            ->circles()
            ->where('id', $circle->id)
            ->where(function (Builder $query) {
                $query
                    ->where('site_pr', true)
                    ->orWhere('leader', true)
                    ->orWhere('site_pr', null)
                    ->where('pr', true)
                ;
            })
            ->exists()
        ;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function isInCircle(Circle $circle) : bool
    {
        return $this
            ->circles()
            ->where('id', $circle->id)
            ->exists()
        ;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function hasFilterAt(Circle $circle) : bool
    {
        return $this
            ->filters()
            ->where('id', $circle->id)
            ->exists()
        ;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function isProgramFilteredAt(Circle $circle) : bool
    {
        return $this
            ->filters()
            ->wherePivot('program', true)
            ->where('id', $circle->id)
            ->exists()
        ;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function isNewsletterFilteredAt(Circle $circle) : bool
    {
        return $this
            ->filters()
            ->wherePivot('newsletter', true)
            ->where('id', $circle->id)
            ->exists()
        ;
    }

    /**
     * @return bool
     */
    public function hasCalendar() : bool
    {
        return $this->calendar()->exists();
    }

    /**
     *
     */
    public function detachCircles() : void
    {
        foreach ($this->circles as $circle) {
            $this->circles()->detach($circle);
        }
    }
}
