<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "materials";

    protected $fillable = [
        'name',
        'description',
        'quiz_type_id',
        'created_by'
    ];

    public function modules() {
        return $this->hasMany(MaterialModule::class);
    }

    public function media() {
        return $this->hasMany(MaterialMedia::class);
    }

      // Add relationship with QuizType
      public function quizType()
      {
          return $this->belongsTo(QuizType::class);
      }
      
  
      // Add method to get category name
      public function getCategoryNameAttribute()
      {
          return $this->quizType->quizCategory->name;
      }
   
}
