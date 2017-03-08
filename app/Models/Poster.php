<?php

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $table    = 'posters';

    protected $fillable = ['program_id', 'file'];

    protected $hidden   = ['created_at', 'updated_at'];

    public function program()
    {
        return $this->belongsTo('App\Models\Program');
    }

    public function delete()
    {
        /*
         * TODO: delete file!!
         */
        return parent::delete();
    }


}