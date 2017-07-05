<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Storage;

class Poster extends Model
{
    protected $table    = 'posters';

    protected $fillable = ['program_id', 'file'];

    protected $hidden   = ['created_at', 'updated_at'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function getUrl()
    {
        return Storage::url('posters/' . $this->file);
    }

    public function delete()
    {
        /*
         * TODO: delete file!!
         */
        return parent::delete();
    }


}