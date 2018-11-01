<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Room;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function create(Request $request)
    {
      if($request->user()->role == "admin")
      {
        $rooms = Room::all();
        return view('device.create', ['rooms' => $rooms]);
      }
      else {
        return redirect('home');
      }
    }

    public function edit(Request $request, $id)
    {
      if($request->user()->role == "admin")
      {
        $device = Device::findOrFail($id);
        $rooms = Room::all();
        return view('device.edit', ['rooms' => $rooms,
                                    'device' => $device ]);
      }
      else {
        return redirect('home');
      }
    }

    public function index()
    {
        return redirect('home');
    }

    public function show($id)
    {
        $device = Device::findOrFail($id);
        return view('device.show', ['device'=>$device]);
    }

    public function store(Request $request)
    {
      if($request->user()->role == "admin")
      {
        $input = $request->all();
        Device::create($input);
        return redirect('home');
      }
      else {
        return redirect('home');
      }
    }

    public function update(Request $request, $id)
    {
        $device=Device::findOrFail($id);
        // $this->validate($request, [
        //     'name' => 'required | string | max:66',
        //     'description' => 'required | string | max:66',
        //     'devicesNumber' => 'required | string | max:66',
        //     'user_id' => 'required | integer | min:1',
        // ]);
        $input = $request->all();
        $device->fill($input)->save();
        if($request->user()->role == "userRoom")
        {
          return redirect(route('home').'#t'.$id);
        }
        else
        {
          return redirect('home');
        }
    }

    public function destroy(Request $request, $id)
    {
      if($request->user()->role == "admin")
      {
        $device = Device::findOrFail($id);
        $device->delete();
        return redirect('home');
      }
      else {
        return redirect('home');
      }
    }
}
