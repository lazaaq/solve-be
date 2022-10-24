<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialModule extends Model
{
    protected $table = "material_modules";

    public function material() {
        return $this->belongsTo(Material::class);
    }
}
