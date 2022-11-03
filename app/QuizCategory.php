<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizCategory extends Model
{
    use SoftDeletes;
    //
    protected $table = 'quiz_categorys';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function quizType()
    {
        return $this->hasMany('App\QuizType', 'quiz_category_id', 'id');
    }

    public function getPicUrlAttribute($value)
    {
        $categoryPath = "/img/categories/";
        return getApiHost() . $categoryPath . $value;
    }
    
}
