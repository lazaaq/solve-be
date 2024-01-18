<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizCategory extends Model
{
    use Sluggable;
    use SoftDeletes;
    //
    protected $table = 'quiz_categorys';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function quizType()
    {
        return $this->hasMany(QuizType::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    // public function getPicUrlAttribute($value)
    // {
    //     $categoryPath = "/img/categories/";
    //     return getApiHost() . $categoryPath . $value;
    // }
    
}
