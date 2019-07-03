<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizType extends Model
{

    protected $table = 'quiz_types';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];

    public function quiz()
    {
        return $this->hasOne('App\Quiz', 'quiz_type_id', 'id');
    }

}
