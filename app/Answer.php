<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $table = 'answers';
  public $timestamps = true;
  protected $guarded = ['created_at', 'updated_at'];

  public function question()
  {
      return $this->belongsTo('App\Question', 'question_id', 'id');
  }
}
