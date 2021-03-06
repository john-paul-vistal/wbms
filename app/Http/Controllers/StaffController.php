<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $staff = Staff::where('deleted_at',null)->orderBy('created_at', 'DESC')->get();
            return $staff; 
        }catch(Exception $e){
            return $e;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $valid = $request->validate([
                'firstName'=>'required|min:2|max:30',
                'lastName'=>'required|min:2|max:30',
                'middleName'=>'required|max:30',
                'gender'=>'required',
                'usertype'=>'required',
                'email'=>'required',
                'contactNumber'=>'required|min:7|max:11',
                'address'=>'required|max:150',
            ]);

            $staff = new Staff();
            
            $username = strtolower($valid['firstName'][0].$valid['lastName'].substr($valid['contactNumber'],8));

            $staff->username = $username;
            $staff->password = "P@ssw0rd";
            $staff->firstName = $valid['firstName'];
            $staff->lastName = $valid['lastName'];
            $staff->middleName = $valid['middleName'];
            $staff->gender = $valid['gender'];
            $staff->usertype = $valid['usertype'];
            $staff->email = $valid['email'];
            $staff->contactNumber = $valid['contactNumber'];
            $staff->address = $valid['address'];

            $staff->save();

            $response = [
                'message' => "Staff Successfully Added!",
                'status' => 200
            ];

            return $response;
           

        }catch(Exception $e){
            return $e;
        }

    }

    public function superAdmin(Request $request)
    {
        try{
            $valid = $request->validate([
                'firstName'=>'required|min:2|max:30',
                'lastName'=>'required|min:2|max:30',
                'middleName'=>'required|min:0|max:30',
                'gender'=>'required',
                'usertype'=>'required',
                'email'=>'required',
                'contactNumber'=>'required|min:7|max:11',
                'address'=>'required|max:150',
            ]);

            $staff = new Staff();
            
            $username = strtolower($valid['firstName'][0].$valid['lastName'].substr($valid['contactNumber'],8));

            $staff->username = $username;
            $staff->password = "P@ssw0rd";
            $staff->firstName = $valid['firstName'];
            $staff->lastName = $valid['lastName'];
            $staff->middleName = $valid['middleName'];
            $staff->gender = $valid['gender'];
            $staff->usertype = strtoupper($valid['usertype']);
            $staff->email = $valid['email'];
            $staff->contactNumber = $valid['contactNumber'];
            $staff->address = $valid['address'];

            $staff->save();


            $response = [
                'message' => "Staff Successfully Added!",
                'status' => 200
            ];

            return $response;

        }catch(Exception $e){
            return $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        try{

            return $staff;

        }catch(Exception $e){
            return $e;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        try{

            $valid = $request->validate([
                'username'=>'required|min:6|max:30',
                'password'=>'required|min:6|max:30',
                'firstName'=>'required|min:2|max:30',
                'lastName'=>'required|min:2|max:30',
                'middleName'=>'required|min:0|max:30',
                'gender'=>'required',
                'usertype'=>'required',
                'email'=>'required',
                'contactNumber'=>'required|min:7|max:11',
                'address'=>'required|max:150',
            ]);

            $staff->update([
                'username' => $valid['username'],
                'password' => $valid['password'],
                'firstName' => $valid['firstName'],
                'lastName' => $valid['lastName'],
                'middleName' => $valid['middleName'],
                'gender' => $valid['gender'],
                'usertype' => $valid['usertype'],
                'email' => $valid['email'],
                'contactNumber' => $valid['contactNumber'],
                'address' => $valid['address'],
            ]);


            $response = [
                'message' => "Staff Successfully Updated!",
                'status' => 200
            ];

            return $response;

        }catch(Exception $e){
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        try{
            $date = Carbon::now();

            $staff->update([
                'deleted_at' => $date,
            ]);
            
            $response = [
                'message' => "Staff Successfully Deleted!",
                'status' => 200
            ];

            return $response;
            
        }catch(Exception $e){
            return $e;
        }
    }
}
