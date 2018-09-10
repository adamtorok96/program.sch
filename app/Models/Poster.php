<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Storage;

class Poster extends Model
{
    protected $fillable = [
        'program_id',
        'file'
    ];

    protected $appends = [
        'url'
    ];

    protected $hidden   = [
        'created_at', 'updated_at'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function getUrl()
    {
        return Storage::url($this->circle->id . '/' . $this->file);
    }

    public function getUrlAttribute()
    {
        return $this->getUrl();
    }

    public function delete()
    {
        $storage = Storage::disk('posters');

        $path = $this->circle->id . '/' . $this->file;

        if( $storage->exists($path) && !$storage->delete($path) )
            return false;

        return parent::delete();
    }
}