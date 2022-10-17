<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporaryQuiz extends Model
{
    use SoftDeletes;

    protected $table = 'temporary_quiz';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function quizType()
    {
        return $this->belongsTo('App\QuizType', 'quiz_type_id', 'id');
    }

    public function question()
    {
        return $this->hasMany('App\Question', 'quiz_id', 'id');
    }

    public function quizCollager()
    {
        return $this->hasMany('App\QuizCollager', 'quiz_id', 'id');
    }
}
