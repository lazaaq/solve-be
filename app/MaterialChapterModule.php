<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialChapterModule extends Model
{
    use SoftDeletes;

    public function materialChapter() {
        return $this->belongsTo(MaterialChapter::class);
    }
}
