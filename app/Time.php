<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model 
{

    protected $table = 'times';
    public $timestamps = true;

    public function Quiz()
    {
        return $this->hasOne('App\Quiz', 'time_id', 'id');
    }

}