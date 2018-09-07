<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PublicController extends Controller
{
    public function index()
    {
      $nVar=count(User::all())-1;
      return view('view.public', ['nVar' => $nVar]);
    }

}
