<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialChapter extends Model
{
    use SoftDeletes;

    public function modules() {
        return $this->hasMany(MaterialChapterModule::class);
    }

    public function medias() {
        return $this->hasMany(MaterialChapterMedia::class);
    }
}
