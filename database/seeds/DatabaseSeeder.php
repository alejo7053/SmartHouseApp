<?php

use Illuminate\Database\Seeder;
use App\User;
use App\House;
use App\Room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
          'name'=>'Admin',
          'lastname'=>'Admin',
          'email'=>'admin@smarthouse.com',
          'password'=>bcrypt('adminpass'),
          'role'=>'admin'
        ));
        User::create(array(
          'name'=>'User',
          'lastname'=>'House',
          'email'=>'userhouse@smarthouse.com',
          'password'=>bcrypt('housepass'),
          'role'=>'userHouse'
        ));
        $userHouse=User::where('role', 'userHouse')->first();
        User::create(array(
          'name'=>'User',
          'lastname'=>'Room1 H',
          'email'=>'userroom1h@smarthouse.com',
          'password'=>bcrypt('roompass'),
          'role'=>'userRoom',
          'parent_id'=>$userHouse->id,
        ));
        User::create(array(
          'name'=>'User',
          'lastname'=>'Room2 H',
          'email'=>'userroom2h@smarthouse.com',
          'password'=>bcrypt('roompass'),
          'role'=>'userRoom',
          'parent_id'=>$userHouse->id,
        ));
        User::create(array(
          'name'=>'User',
          'lastname'=>'Room',
          'email'=>'userroom@smarthouse.com',
          'password'=>bcrypt('roompass'),
          'role'=>'userRoom',
        ));
        House::create(array(
          'name'=>'House 1',
          'description'=>'House with two rooms, propety of User House',
          'address'=>'House 1 Street 0',
          'roomsNumber'=>'2',
          'user_id'=>$userHouse->id
        ));
        $userRoom1=User::where('lastname', 'Room1 H')->first();
        Room::create(array(
          'name'=>'Room 1 House 1',
          'description'=>'Room 1 House, property of User House and User Room1 H',
          'user_id'=>$userRoom1->id,
          'house_id'=>'1',
        ));
        // $this->call(UsersTableSeeder::class);
    }
}
