<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "materials";

    public function module() {
        return $this->hasOne(MaterialModule::class);
    }

    public function media() {
        return $this->hasOne(MaterialMedia::class);
    }

    public function quiztype() {
        return $this->belongsTo(QuizType::class);
    }
}
