<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * @return BelongsTo
     */
    public function program() : BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return Storage::disk('posters')->url($this->file);
    }

    /**
     * @return string
     */
    public function getUrlAttribute() : string
    {
        return $this->getUrl();
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete() : ?bool
    {
        $storage = Storage::disk('posters');

        if( $storage->exists($this->file) && $storage->delete($storage) === false )
            return false;

        return parent::delete();
    }
}