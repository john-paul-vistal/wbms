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
        try{

            $users = Customer::paginate(10) ;        
            return $users;
            
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
                'email'=>'max:80',
                'address'=>'required|max:150'
            ]);
            
            $customer = new Customer();
            

            $customer->firstName = $valid['firstName'];
            $customer->lastName = $valid['lastName'];
            $customer->email = $valid['email'];
            $customer->contactNumber= $request['contactNumber'];
            $customer->address= $valid['address'];

            $customer->save();

            return response("Customer Successfully Added");

        }catch(Exception $e){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer){
        try{

            return $customer;

        }catch(Exception $e){
            return $e;
        }
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
        try{

            $valid = $request->validate([
                'firstName'=> 'required|max:30|min:2',
                'lastName'=> 'required|max:30',
                'address'=> 'required|max:150',
                'email'=> 'max:80',
            ]);
                
            $customer->update([
                'firstName' => $valid['firstName'],
                'lastName' => $valid['lastName'],
                'email' => $valid['email'],
                'address' => $valid['address'],
                'contactNumber' => $request['contactNumber'],
            ]);
                
            return response("Customer Successfully Updated");

        }catch(Exception $e){
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try{

            $customer->delete();
            return response("Successfully Deleted!");

        }catch(Exception $e){
            return $e;
        }

    }
}
