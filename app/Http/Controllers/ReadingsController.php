<?php

namespace App\Http\Controllers;

use App\Models\Readings;
use Illuminate\Http\Request;

class ReadingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readings = Readings::paginate(10);
        return $readings;
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
                'customer_id'=>'required',
                'cubic'=>'required',
                'recordedBy'=>'required',
            ]);
    
            $reading = new Readings();
            
            $date = new \DateTime();
            $date->modify('+1 month');
    
            $reading->customer_id = $valid['customer_id'];
            $reading->cubic = $valid['cubic'];
            $reading->amount = $valid['cubic'] * 0.75;
            $reading->due_date = $date->format('Y-m-d');
            $reading->recordedBy = $valid['recordedBy'];

            $reading->save();

            return response("Saved Successfully!");
        }catch(Exception $e){
            return $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Readings  $readings
     * @return \Illuminate\Http\Response
     */
    public function show(Readings $readings)
    {
        return $readings;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Readings  $readings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Readings $readings)
    {
        $valid = $request->validate([
            'customer_id'=>'required',
            'cubic'=>'required',
            'recordedBy'=>'required',
        ]);

        $readings->update([
            'customer_id' => $valid['customer_id'],
            'cubic' => $valid['cubic'],
            // 'amount' => //to be calculated
            'recordedBy' => $valid['recordedBy'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Readings  $readings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Readings $readings)
    {
        $readings->delete();
    }
}
