<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class CardController extends Controller
{
    //
    public function update($token, $dataUp)
    {
        $dataUp = json_decode($dataUp);
        $rooms= Room::whereIn('token', [$token])->first();
        foreach ($dataUp as $data) {
            $device = $rooms->devices()->whereIn('name',[$data->name])->first();
            $device->fill((array)$data)->save();
        }
        $dataDown = $rooms->devices()->whereIn('role',['load'])
        ->select('name','status','value','action','start','end')->get();
        return response()->json($dataDown);
    }
}
