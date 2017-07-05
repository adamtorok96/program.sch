<?php

namespace App\Models;


use Carbon\Carbon;
use DB;
use DomainException;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Program extends Model
{
    private static $google;

    protected $table    = 'programs';

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

    protected $hidden   = ['created_at', 'updated_at'];

    protected $dates    = ['from', 'to'];

    public static function boot()
    {
        parent::boot();

        static::$google = resolve('App\Services\GoogleService');

        static::creating(function(Program $program) {
            $program->uuid = Uuid::generate();
        });

        static::created(function(Program $program) {
            try {
                //$event = static::$google->newEvent($program);
                $event = resolve('App\Services\GoogleService')->newEvent($program);

                $program->update([
                    'google_calendar_event_id' => $event->id
                ]);
            } catch (ConnectException $exception) {

            } //catch (DomainException $exception) {
                //dd($exception, static::$google, base_path('google.json'));
           // }
           /* catch (Exception $exception) {

            } */
        });

        static::updating(function(Program $program) {
            $program->sequence++;
        });

        static::updated(function(Program $program) {
           try {
               static::$google->updateEvent($program);
           } catch (ConnectException $exception) {

           } catch (Exception $exception) {

           }
        });

        static::deleted(function(Program $program) {
            try {
                static::$google->deleteEvent($program);
            } catch (ConnectException $exception) {

            } catch (Exception $exception) {

            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function poster()
    {
        return $this->hasOne(Poster::class);
    }

    public function hasPoster()
    {
        return $this->poster()->exists();
    }

    public function fullDate()
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

    public function scopeOnThisDay(Builder $query, Carbon $carbon) {
        return $query
            ->whereDate('from', '<=', $carbon)
            ->whereDate('to', '>=', $carbon)
            ;
    }

    public function scopeStartOnThisDay(Builder $query, Carbon $carbon)
    {
        return $query->whereDate('from', $carbon);
    }

    public function scopeFiltered(Builder $query, User $user)
    {
        return $query->whereHas('circle.filters', function(Builder $query) use($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function scopeIntertemporal(Builder $query)
    {
        return $query->whereRaw('date(`from`) != date(`to`)');
    }

    public function scopeOneTime(Builder $query)
    {
        return $query->whereRaw('date(`from`) = date(`to`)');
    }

    public function delete()
    {
        if ($this->hasPoster())
            $this->poster->delete();

        return parent::delete();
    }
}