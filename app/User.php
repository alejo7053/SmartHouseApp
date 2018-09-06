<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'role', 'parent_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function houses(){
        return $this->hasMany('App\House');
    }

    public function rooms(){
        return $this->hasMany('App\Room');
    }

    public function users(){
        return $this->hasMany('App\User', 'parent_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'parent_id');
    }
}
