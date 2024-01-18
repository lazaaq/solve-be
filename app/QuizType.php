<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizType extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $table = 'quiz_types';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }
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
    // public function getPicUrlAttribute($value)
    // {
    //     $typePath = "/img/types/";
    //     return env("APP_URL") . ":" . env("APP_PORT") . $typePath . $value;
    // }
}
