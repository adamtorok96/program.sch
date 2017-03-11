<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Program extends Model
{
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
        'display_site'
    ];

    protected $hidden   = ['created_at', 'updated_at'];

    protected $dates    = ['from', 'to'];

    public static function boot()
    {
        parent::boot();

        static::creating(function(Program $program) {
            $program->uuid = Uuid::generate();
        });

        static::updating(function(Program $program) {
            $program->sequence++;
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function circle()
    {
        return $this->belongsTo('App\Models\Circle');
    }

    public function poster()
    {
        return $this->hasOne('App\Models\Poster');
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
        return $query->whereDate('from', '<=', $carbon)->whereDate('to', '>=', $carbon);
    }
}