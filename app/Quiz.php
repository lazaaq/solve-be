<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $table = 'quizs';
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
        return $this->hasOne('App\QuizCollager', 'quiz_id', 'id');
    }

}
