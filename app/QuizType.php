<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizType extends Model 
{

    protected $table = 'quiz_types';
    public $timestamps = true;

    public function Quiz()
    {
        return $this->hasOne('App\Quiz', 'quiz_type_id', 'id');
    }

}