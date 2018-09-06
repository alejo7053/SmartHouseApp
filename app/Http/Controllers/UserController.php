<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function create()
    {
        $users = User::whereIn('role', ['userHouse'])
        ->orderBy('name','asc')
        ->get();
        return view('user.create', ['users'=>$users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $usersOpt = User::whereIn('role', ['userHouse'])
        ->orderBy('name','asc')
        ->get();
        return view('user.edit', ['user'=>$user, 'usersOpt'=>$usersOpt]);
    }

    public function index()
    {
        return redirect('home');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', ['user'=>$user]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | string | max:66',
            'lastname' => 'required | string | max:66',
            'email' => 'required | email | unique:users',
            'password' => 'required | string | min:8 | max:64',
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        User::create($input);
        return redirect('home');
    }

    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required | string | max:66',
            'lastname' => 'required | string | max:66',
            'email' => 'required | email | unique:users',
            'password' => 'required | string | min:8 | max:64',
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user->fill($input)->save();
        return redirect('home');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('home');
    }
}
