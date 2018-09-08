<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PublicController extends Controller
{
    public function index()
    {
      $nVar=count(User::all())-1;
      if($nVar==NULL){
          $nVar=0;
          return view('view.public', ['nVar' => $nVar]);
      }
      return view('view.public', ['nVar' => $nVar]);
    }

}
