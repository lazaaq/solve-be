<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizCollager extends Model
{

    protected $table = 'quiz_collagers';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }

    public function collager()
    {
        return $this->belongsTo('App\Collager', 'collager_id', 'id');
    }

    public function answerSave()
    {
        return $this->hasMany('App\AnswerSave', 'quiz_collager_id', 'id');
    }
}
