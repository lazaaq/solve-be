<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use SoftDeletes;
    protected $table = 'classrooms';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
