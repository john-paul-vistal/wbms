<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $staff = Staff::paginate(10);
       return $staff; 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $valid = $request->validate([
            'firstName'=>'required|min:2|max:30',
            'lastName'=>'required|min:2|max:30',
            'gender'=>'required',
            'usertype'=>'required',
            'email'=>'required',
            'contactNumber'=>'required',
            'address'=>'required|max:150',
        ]);

        $staff = new Staff();
        
        $username = strtolower($valid['firstName'][0].$valid['lastName'].substr($valid['contactNumber'],8));

        $staff->username = $username;
        $staff->password = "P@ssw0rd";
        $staff->firstName = $valid['firstName'];
        $staff->lastName = $valid['lastName'];
        $staff->gender = $valid['gender'];
        $staff->usertype = $valid['usertype'];
        $staff->email = $valid['email'];
        $staff->contactNumber = $valid['contactNumber'];
        $staff->address = $valid['address'];

        $staff->save();

        return response("Staff Successfully Added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return $staff;
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
        $valid = $request->validate([
            'username'=>'required|min:6|max:30',
            'password'=>'required|min:6|max:30',
            'firstName'=>'required|min:2|max:30',
            'lastName'=>'required|min:2|max:30',
            'gender'=>'required',
            'usertype'=>'required',
            'email'=>'required',
            'contactNumber'=>'required',
            'address'=>'required|max:150',
        ]);

        $staff->update([
            'username' => $valid['username'],
            'password' => $valid['password'],
            'firstName' => $valid['firstName'],
            'lastName' => $valid['lastName'],
            'gender' => $valid['gender'],
            'usertype' => $valid['usertype'],
            'email' => $valid['email'],
            'contactNumber' => $valid['contactNumber'],
            'address' => $valid['address'],
        ]);
  
        return response("Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return response("Successfully Deleted!");
    }
}
