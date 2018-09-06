<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'address', 'roomsNumber', 'user_id',
    ];

    public function rooms(){
        return $this->hasMany('App\Room');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function devices(){
        return $this->hasManyThrough('App\Device', 'App\Room');
    }
}
