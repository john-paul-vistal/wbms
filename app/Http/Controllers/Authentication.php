<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Staff;

class Authentication extends Controller
{
    public function login(Request $request)
    {
        try{
            $username = $request->username;
            $password = $request->password;
    
            $staffLogged = Staff::where('username',$username)->first();

            if(!$staffLogged||$staffLogged->password != $password){
                return "Username or Password is incorrect";
            }

            $token = $staffLogged->createToken('access-token')->plainTextToken;

            $response = [
                'user' => $staffLogged,
                'token' => $token
            ];

            return $response;
            

        }catch(Exception $e){
            return $e;
        }
    }


    public function logout(Request $request)
    {
        try{
            
            $request->user()->currentAccessToken()->delete();


            $response = [
                'message' => "Logout Successfully!",
                'status' => 200
            ];

            return $response;
         

        }catch(Exception $e){
            return $e;
        }


        
    }
}
