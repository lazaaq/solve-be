<?php

namespace App;

use App\Http\Controllers\QuizController;
use Illuminate\Database\Eloquent\Model;

class Collager extends Model
{

    protected $table = 'collagers';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answerSave()
    {
        return $this->hasOne('App\AnswerSave', 'collager_id', 'id');
    }

    public function quizCollager()
    {
        return $this->hasMany(QuizController::class);
    }
    public function collagerClassroom()
    {
        return $this->hasMany(CollagerClassroom::class);
    }

}
