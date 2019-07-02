<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizCollager extends Model 
{

    protected $table = 'quiz_collagers';
    public $timestamps = true;

    public function Quiz()
    {
        return $this->belongsTo('App\Question', 'quiz_id', 'id');
    }

    public function Collager()
    {
        return $this->belongsTo('App\Collager', 'collager_id', 'id');
    }

}