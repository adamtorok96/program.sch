<?php

namespace App\Models;


use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Webpatser\Uuid\Uuid;

class Program extends Model
{
    private static $google;

    protected $fillable = [
        'uuid',
        'circle_id',
        'user_id',
        'name',
        'from',
        'to',
        'location',
        'website',
        'summary',
        'description',
        'display_poster',
        'display_email',
        'display_site',
        'google_calendar_event_id',
        'facebook_event_id'
    ];

    protected $hidden   = [
        'uuid',
        'google_calendar_event_id',
        'sequence'
    ];

    protected $appends  = [
        'poster_url', 'full_date'
    ];

    protected $dates    = [
        'from', 'to'
    ];

    protected $casts    = [
        'display_poster'    => 'bool',
        'display_email'     => 'bool',
        'display_site'      => 'bool',
        'facebook_event_id' => 'int'
    ];

    public static function boot()
    {
        parent::boot();

        static::$google = app('App\Services\GoogleService');

        static::creating(function(Program $program) {
            $program->uuid = Uuid::generate();
        });

        static::created(function(Program $program) {
            if( app()->environment('production') === false )
                return;

            try {
                $event = app('App\Services\GoogleService')->newEvent($program);

                $program->update([
                    'google_calendar_event_id' => $event->id
                ]);
            } catch (Exception $exception) { }
        });

        static::updating(function(Program $program) {
            $program->sequence++;
        });

        static::updated(function(Program $program) {
            if( app()->environment('production') === false )
                return;

            try {
                static::$google->updateEvent($program);
            } catch (Exception $exception) { }
        });

        static::deleted(function(Program $program) {
            if( app()->environment('production') === false )
                return;

            try {
                static::$google->deleteEvent($program);
            } catch (Exception $exception) { }
        });
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function circle() : BelongsTo
    {
        return $this->belongsTo(Circle::class);
    }

    /**
     * @return HasOne
     */
    public function poster() : HasOne
    {
        return $this->hasOne(Poster::class);
    }

    /**
     * @return bool
     */
    public function hasPoster() : bool
    {
        return $this->poster()->exists();
    }

    /**
     * @return string
     */
    public function fullDate() : string
    {
        $format = 'Y. m. d. H:i';

        if( $this->from->isSameDay($this->to) )
            $format = 'H:i';
        else if( $this->from->isSameMonth($this->to) )
            $format = 'd. H:i';
        else if( $this->from->isSameYear($this->to) )
            $format = 'm. d. H:i';

        return $this->from->format('Y. m. d. H:i') . ' - '. $this->to->format($format);
    }

    /**
     * @param Builder $query
     * @param Carbon $carbon
     * @return Builder
     */
    public function scopeOnThisDay(Builder $query, Carbon $carbon) : Builder
    {
        return $query
            ->whereRaw('DATE(`from`) <= DATE("' . $carbon .'")')
            ->whereRaw('DATE(`to`) >= DATE("' . $carbon .'")')
        ;
    }

    /**
     * @param Builder $query
     * @param Carbon $carbon
     * @return Builder
     */
    public function scopeStartOnThisDay(Builder $query, Carbon $carbon) : Builder
    {
        return $query->whereRaw('DATE(`from`) = DATE("' . $carbon . '")');
    }

    /**
     * @param Builder $query
     * @param User $user
     * @return Builder
     */
    public function scopeFiltered(Builder $query, User $user) : Builder
    {
        return $query->whereHas('circle.filters', function(Builder $query) use($user) {
            $query->where('user_id', $user->id);
        });
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeInterTemporal(Builder $query) : Builder
    {
        return $query->whereRaw('date(`from`) != date(`to`)');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeOneTime(Builder $query) : Builder
    {
        return $query->whereRaw('date(`from`) = date(`to`)');
    }

    /**
     * @return string|null
     */
    public function getPosterUrlAttribute() : ?string
    {
        return $this->hasPoster() ? $this->poster->url : null;
    }

    /**
     * @return string
     */
    public function getFullDateAttribute() : string
    {
        return $this->fullDate();
    }

    /**
     * @return bool|null
     * @throws Exception
     */
    public function delete() : ?bool
    {
        if ($this->hasPoster())
            $this->poster->delete();

        return parent::delete();
    }
}