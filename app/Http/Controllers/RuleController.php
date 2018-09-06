<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class RuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function create($id)
    {
        $device = Device::findOrFail($id);
        return view('device.rules', ['device'=>$device]);
    }

    public function update(Request $request, $id)
    {
        $device=Device::findOrFail($id);
        $input = $request->all();
        $device->fill($input)->save();
        return redirect('home');
    }
}
