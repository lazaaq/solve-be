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

    // relation
    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }

    public function quizCategory()
    {
        return $this->belongsTo(QuizCategory::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }

    // accessor
    public function getPicUrlAttribute($value)
    {
        $typePath = "/img/types/";
        return env("APP_URL") . ":" . env("APP_PORT") . $typePath . $value;
    }
}
