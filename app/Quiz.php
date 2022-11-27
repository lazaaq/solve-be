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
        return $this->belongsTo(QuizType::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function quizCollager()
    {
        return $this->hasMany(QuizCollager::class);
    }

}
