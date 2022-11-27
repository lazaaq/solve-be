<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollagerClassroom extends Model
{
    use SoftDeletes;
    protected $table = 'collager_classrooms';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function collager()
    {
        return $this->belongsTo(Collager::class);
    }
}
