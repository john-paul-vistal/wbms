<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $transactions = Transaction::paginate(10);
    
            return $transactions;

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
                'customer_id'=>'required',
                'meterReading'=>'required',
                'reading_date'=>'required',
                'recordedBy'=>'required'
            ]);
    
            $transaction = new Transaction();
                
            $date = new \DateTime( $valid['reading_date']);
            

            $transaction->customer_id = $valid['customer_id'];
            $transaction->meterReading = $valid['meterReading'];
            $transaction->total_amount = $valid['meterReading']*0.56;
            $transaction->reading_date = $valid['reading_date'];
            $transaction->due_date = $date->modify('+1 month');
            $transaction->recordedBy = $valid['recordedBy'];
    
            $transaction->save();
    
            return response("Transaction Saved!");

        }catch(Exception $e){
            return $e;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
       try{
            return $transaction;
       }catch(Exception $e){
           return $e;
       }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        try{

            $valid = $request->validate([
                'meterReading'=>'required',
                'reading_date'=>'required',
                'recordedBy'=>'required'
            ]);

            $date = new \DateTime( $valid['reading_date']);

            $transaction->update([
                'meterReading' => $valid['meterReading'],
                'total_amount' => $valid['meterReading']*0.56,
                'reading_date' => $valid['reading_date'],
                'due_date' => $date->modify('+1 month'),
                'recordedBy' => $valid['recordedBy'],
            ]);

            return response("Updated Successfully!");
            
        }catch(Exception $e){
            return $e;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        try{

            $transaction->delete();

            return response("Deleted Successfully!");

        }catch(Exception $e){
            return $e;
        }
    }


    public function pay(Request $request,Transaction $transaction)
    {
        try{

            if($transaction->ispaid != 1){

                $valid = $request->validate([
                    'rendered_amount'=>'required',
                    'transactedBy'=>'required',
                ]);
    
                $transaction->update([
                    'rendered_amount' => $valid['rendered_amount'],
                    'change' => $valid['rendered_amount'] - $transaction->total_amount,
                    'transactedBy' => $valid['transactedBy'],
                    'ispaid'=>true
                ]);
    
                return response("Payed Successfully!");

            }
            
        }catch(Exception $e){
            return $e;
        }
    }
}