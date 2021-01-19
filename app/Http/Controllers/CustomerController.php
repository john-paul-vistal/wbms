<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Customer::paginate(10) ;        
        return $users;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $valid = $request->validate([
            'firstName'=>'required|min:2|max:30',
            'lastName'=>'required|min:2|max:30',
            'email'=>'max:80'
        ]);
        
        $customer = new Customer();
        

        $customer->firstName = $valid['firstName'];
        $customer->lastName = $valid['lastName'];
        $customer->email = $valid['email'];
        $customer->contactNumber= $request['contactNumber'];

        $customer->save();

        return response("Customer Successfully Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer){
         return $customer;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $valid = $request->validate([
            'firstName'=> 'required|max:30|min:2',
            'lastName'=> 'required|max:30',
            'email'=> 'max:80',
        ]);
            
        $customer->update([
            'firstName' => $valid['firstName'],
            'lastName' => $valid['lastName'],
            'email' => $valid['email'],
            'contactNumber' => $request['contactNumber'],
        ]);
            

        return response("Customer Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

      return response("Successfully Deleted!");

    }
}
