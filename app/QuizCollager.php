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
        return $this->belongsTo(Quiz::class);
    }

    public function collager()
    {
        return $this->belongsTo(Collager::class);
    }

    public function answerSave()
    {
        return $this->hasMany(AnswerSave::class);
    }
}
