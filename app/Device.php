<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'role', 'type', 'value', 'status', 'action', 'start',
        'end', 'room_id',
    ];

    public function room(){
        return $this->belongsTo('App\Room');
    }

}
