<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\House;
use App\Room;


function generateRandomString($length = 10) {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}


class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function create(Request $request)
    {
        //if isAdmin
        if($request->user()->role == "admin")
        {
            $users = User::whereIn('role', ['userHouse','userRoom'])
            ->orderBy('role','asc')
            ->get();
            $houses = House::all();
            $token=generateRandomString();
            return view('room.create', ['users' => $users, 'houses' => $houses, 'token' => $token]);
        }
        else {
            return redirect('home');
        }
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $users = User::whereIn('role', ['userHouse','userRoom'])
        ->orderBy('role','asc')
        ->get();
        return view('room.edit', ['room'=>$room, 'users'=>$users]);
    }

    public function index()
    {
        return redirect('home');
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('room.show', ['room'=>$room]);
    }

    public function store(Request $request)
    {
      if($request->user()->role == "admin")
      {
        $input = $request->all();
        Room::create($input);
        return redirect('home');
      }
      else {
        return redirect('home');
      }
    }

    public function update(Request $request, $id)
    {
        $room=Room::findOrFail($id);
        // $this->validate($request, [
        //     'name' => 'required | string | max:66',
        //     'description' => 'required | string | max:66',
        //     'devicesNumber' => 'required | string | max:66',
        //     'user_id' => 'required | integer | min:1',
        // ]);
        $input = $request->all();
        $room->fill($input)->save();
        return redirect('home');
    }

    public function destroy(Request $request, $id)
    {
      if($request->user()->role == "admin")
      {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect('home');
      }
      else {
        return redirect('home');
      }
    }
}
