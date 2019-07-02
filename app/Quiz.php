<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model 
{

    protected $table = 'quizs';
    public $timestamps = true;

    public function QuizType()
    {
        return $this->belongsTo('App\QuizType', 'quiz_type_id', 'id');
    }

    public function Time()
    {
        return $this->belongsTo('App\Time', 'time_id', 'id');
    }

    public function Question()
    {
        return $this->hasOne('App\Question', 'quiz_id', 'id');
    }

    public function QuizCollager()
    {
        return $this->hasOne('App\QuizCollager', 'quiz_id', 'id');
    }

}