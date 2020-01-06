<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
}
