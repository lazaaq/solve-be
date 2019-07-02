<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collager extends Model 
{

    protected $table = 'collagers';
    public $timestamps = true;

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function AnswerSave()
    {
        return $this->hasOne('App\AnswerSave', 'collager_id', 'id');
    }

    public function QuizCollager()
    {
        return $this->hasOne('App\QuizCollager', 'collager_id', 'id');
    }

}