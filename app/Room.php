<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'token', 'user_id', 'house_id',
    ];

    public function devices(){
        return $this->hasMany('App\Device');
    }

    public function house(){
        return $this->belongsTo('App\House');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
