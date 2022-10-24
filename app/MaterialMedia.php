<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialMedia extends Model
{
    protected $table = "material_media";

    public function material() {
        return $this->belongsTo(Material::class);
    }
}
