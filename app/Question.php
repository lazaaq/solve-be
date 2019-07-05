<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{

    protected $table = 'questions';
    public $timestamps = true;

    protected $fillable = ['quiz_id','question','pic_url','created_at','updated_at'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id', 'id');
    }

    public function answerSave()
    {
        return $this->hasOne('App\AnswerSave', 'question_id', 'id');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer', 'question_id', 'id');
    }

}
