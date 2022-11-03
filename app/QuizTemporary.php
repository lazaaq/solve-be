<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizTemporary extends Model
{
    protected $table = "quiz_temporary";
    protected $guarded = ['id'];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function collager() {
        return $this->belongsTo(Collager::class);
    }
}
