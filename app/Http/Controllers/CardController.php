<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class CardController extends Controller
{
    //
    public function update($id, $token, $dataUp)
    {
        $rooms = Room::findOrFail($id);
        if($rooms->token == $token){
            $dataUp = json_decode($dataUp);
            foreach ($dataUp as $data) {
                $device = $rooms->devices()->findOrFail($data->id);
                $device->fill((array)$data)->save();
            }
            $dataDown = $rooms->devices()->whereIn('role',['load'])
            ->select('id','status','value','action','start','end')->get();
            foreach ($dataDown as $data) {
              $data->value = floatval($data->value);
            }
            return response()->json($dataDown);
        }
        else{
            return response('403 Forbidden', 403);
        }
    }
}
