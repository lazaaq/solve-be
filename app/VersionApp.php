<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VersionApp extends Model
{
  protected $table = 'version_apps';
  public $timestamps = true;
  protected $guarded = ['created_at', 'updated_at'];
}
