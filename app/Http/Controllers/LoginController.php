<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)){
            return response("yes");
        }
    }
}
