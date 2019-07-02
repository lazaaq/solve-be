<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerSave extends Model 
{

    protected $table = 'answer_saves';
    public $timestamps = true;

    public function Collager()
    {
        return $this->belongsTo('App\Question', 'collager_id', 'id');
    }

    public function Question()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }

}