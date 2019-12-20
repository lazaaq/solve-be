<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
  use SoftDeletes;
  protected $table = 'answers';
  public $timestamps = true;
  protected $guarded = ['created_at', 'updated_at'];
  protected $dates = ['deleted_at'];

  public function question()
  {
      return $this->belongsTo('App\Question', 'question_id', 'id');
  }
}
