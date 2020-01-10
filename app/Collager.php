<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collager extends Model
{

    protected $table = 'collagers';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function answerSave()
    {
        return $this->hasOne('App\AnswerSave', 'collager_id', 'id');
    }

    public function quizCollager()
    {
        return $this->hasMany('App\QuizCollager', 'collager_id', 'id');
    }
    public function collagerClassroom()
    {
        return $this->hasMany('App\CollagerClassroom', 'collager_id', 'id');
    }

}
