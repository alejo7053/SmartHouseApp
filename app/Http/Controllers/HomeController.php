<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\House;
use App\Room;
use App\Device;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if isAdmin, isUserHouse or isUserRoom, change the data for the view
        if($request->user()->role == "admin")
        {
            $usersIsAdmin = User::all()->sortBy('role');
            $housesIsAdmin = House::all();
            $roomsIsAdmin = Room::all();
            $devicesIsAdmin = Device::all();
            return view('home', ['users'=>$usersIsAdmin,
                                 'houses'=>$housesIsAdmin,
                                 'rooms'=>$roomsIsAdmin,
                                 'devices'=>$devicesIsAdmin]);
        }
        else if($request->user()->role == "userHouse")
        {
            $user = User::findOrFail($request->user()->id);
            $deviceIsUser = Device::all();

            return view('home', ['devices'=>$deviceIsUser,
                                  'user'=>$user]);
        }
        else if($request->user()->role == "userRoom")
        {
            $user = User::findOrFail($request->user()->id);

            // $collection = collect([
            //     ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
            //     ['name' => 'Chair', 'colors' => ['Black']],
            //     ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
            //     ['name' => 'Bocase', 'colors' => ['Black']],
            // ]);
            //
            // $sorted = $collection->sortBy(function ($product, $key) {
            //     return count($product['colors']).$product['name'];
            // });
            //
            // dd($sorted->values()->all());

            return view('home', ['user'=>$user]);
        }
    }
}
