<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizType extends Model
{
    use SoftDeletes;

    protected $table = 'quiz_types';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function quiz()
    {
        return $this->hasOne('App\Quiz', 'quiz_type_id', 'id');
    }

    public function quizCategory()
    {
        return $this->belongsTo('App\QuizCategory', 'quiz_category_id', 'id');
    }

    public function getPicUrlAttribute($value)
    {
        $typePath = "/img/types/";
        return env("APP_URL") . ":" . env("APP_PORT") . $typePath . $value;
    }
}
