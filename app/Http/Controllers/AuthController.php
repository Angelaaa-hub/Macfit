<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register (Request $request){
    $validated = $request->validate([
    'name'=>'required|string|max:40' ,
    'email'=>'required|email|unique:users,email' ,
    'password'=>'required|string|min:4|max:15|confirmed'
    ]);

    $user = new User ();
    $user->name = $validated['name'];
    $user->email = $validated['email'];

    }
}
