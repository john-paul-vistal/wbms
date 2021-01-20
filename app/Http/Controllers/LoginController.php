<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $username = $request['username'];
        $password= $request['password'];

        Auth::login($staff);
        // if (Auth::attempt(['username'=> $username, 'password'=> $password])){
        //     return response("yes");
        // }
    }
}
