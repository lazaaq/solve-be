<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{

    protected $table = 'lecturers';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function classroom()
    {
        return $this->hasMany('App\Classroom', 'lecturer_id', 'id');
    }

}
