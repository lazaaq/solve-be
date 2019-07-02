<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model 
{

    protected $table = 'lecturers';
    public $timestamps = true;

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}