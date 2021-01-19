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
       $staff = Staff::all();
       return $staff; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        

        $staff->username = "jvistal";
        $staff->password = "P@ssw0rd";
        $staff->firstName = $valid['firstName'];
        $staff->lastName = $valid['lastName'];
        $staff->gender = $valid['gender'];
        $staff->usertype = $valid['usertype'];
        $staff->email = $valid['email'];
        $staff->contactNumber = $valid['contactNumber'];
        $staff->address = $valid['address'];

        $staff->save();

        return response("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
