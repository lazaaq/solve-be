<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizType extends Model
{

    protected $table = 'quiz_types';
    public $timestamps = true;

    public function quiz()
    {
        return $this->hasOne('App\Quiz', 'quiz_type_id', 'id');
    }

}
