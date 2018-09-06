<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\User;

class HouseController extends Controller
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
            $usersHouse = User::where('role', 'userHouse')->get();
            return view('house.create', ['users' => $usersHouse]);
        }
        else {
            return redirect('home');
        }
    }

    public function edit($id)
    {
        $house = House::findOrFail($id);
        $usersHouse = User::where('role', 'userHouse')->get();
        return view('house.edit', ['house'=>$house, 'users'=>$usersHouse]);
    }

    public function index()
    {
        return redirect('home');
    }

    public function show($id)
    {
        $house = House::findOrFail($id);
        return view('house.show', ['house'=>$house]);
    }

    public function store(Request $request)
    {
        if($request->user()->role == "admin")
        {
            $input = $request->all();
            House::create($input);
            return redirect('home');
        }
        else {
            return redirect('home');
        }
    }

    public function update(Request $request, $id)
    {
        $house=House::findOrFail($id);
        // $this->validate($request, [
        //     'name' => 'required | string | max:66',
        //     'description' => 'required | string | max:66',
        //     'address' => 'required | string | max:66',
        //     'roomsNumber' => 'required | integer | min:1',
        // ]);
        $input = $request->all();
        $house->fill($input)->save();
        return redirect('home');
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->role == "admin")
        {
            $house = House::findOrFail($id);
            $house->delete();
            return redirect('home');
        }
        else {
            return redirect('home');
        }
    }
}
