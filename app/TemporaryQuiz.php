<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemporaryQuiz extends Model
{
    use SoftDeletes;

    protected $table = 'temporary_quiz';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    
    public function collager()
    {
        return $this->belongsTo(Collager::class);
    }
}
