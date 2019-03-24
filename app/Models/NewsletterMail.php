<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsletterMail extends Model
{
    protected $fillable = [
        'circle_id', 'user_id',
        'subject', 'message',
        'sent_at'
    ];

    protected $hidden  = [
        'created_at', 'updated_at', 'sent_at'
    ];

    protected $dates = [
        'sent_at'
    ];

    protected $casts = [
        'public' => 'bool'
    ];

    /**
     * @return BelongsTo
     */
    public function circle() : BelongsTo
    {
        return $this->belongsTo(Circle::class);
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function recipients() : BelongsToMany
    {
        return $this
            ->belongsToMany(User::class)
            ->using(NewsletterRecipient::class)
        ;
    }

    /**
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopeSentTo(Builder $query, User $user) : Builder
    {
        return $query->whereHas('deliveredUsers', function (Builder $query) use($user) {
           $query->whereUserId($user->id);
        });
    }

    /**
     * @return Collection
     */
    public function getParticipants() : Collection
    {
        $users = User::whereFilter(false)->get();

        $users->merge($this->circle->filters);

        return $users;
    }

    /**
     * @return bool
     */
    public function isSent() : bool
    {
        return isset($this->sent_at);
    }
}