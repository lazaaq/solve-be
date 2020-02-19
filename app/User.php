<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes, HasApiTokens;
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'school_id', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lecture()
    {
        return $this->hasOne('App\Lecture', 'user_id', 'id');
    }

    public function collager()
    {
        return $this->hasOne('App\Collager', 'user_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }
    public function classroom()
    {
        return $this->hasMany('App\Classroom', 'user_id', 'id');
    }
    public function quiz()
    {
        return $this->hasMany('App\Quiz', 'created_by', 'id');
    }
}
