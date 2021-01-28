<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Settings;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

            $transactions = Transaction::with('customer',"recordedBy","transactedBy")->get();
    
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
          
            $settings = Settings::where('settingName','waterRate')->first();

            $customer = Customer::where('id',$valid['customer_id'])->first();

            if($customer){

            $transaction->customer_id = $valid['customer_id'];
            $transaction->meterReading = $valid['meterReading'];
            $transaction->total_amount = $valid['meterReading']*$settings['value'];
            $transaction->reading_date = $valid['reading_date'];
            $transaction->due_date = $date->modify('+1 month');
            $transaction->recordedBy = $valid['recordedBy'];
          
            
            $transaction->save();
            
            $response = [
                'message' => "Transaction Saved!",
                'status' => 200
            ];

            return response($response);
            }

            $response = [
                'message' => "Customer Not Found",
                'status' => 300
            ];

            return response($response);
            
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
    public function show($id)
    {
       try{
            $transaction = Transaction::where('id', $id)->with('customer',"recordedBy","transactedBy")->get();
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
            $settings = Settings::where('settingName','waterRate')->first();

            $transaction->update([
                'meterReading' => $valid['meterReading'],
                'total_amount' => $valid['meterReading']*$settings['value'],
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
                $date = Carbon::now();
                $transaction->update([
                    'rendered_amount' => $valid['rendered_amount'],
                    'change' => $valid['rendered_amount'] - $transaction->total_amount,
                    'transactedBy' => $valid['transactedBy'],
                    'ispaid'=>true,
                    'transactedDate'=>  $date 
                ]);
                    
                $response = [
                    'message' => "Paid Successfully",
                    'status' => 200
                ];
    
                return $response;

            }
            
        }catch(Exception $e){
            return $e;
        }
    }

    public function showTransactions($id)
    {
       try{
            $transactions = Transaction::where('customer_id',$id)->with('customer')->with('recordedBy')->with('transactedBy')->get();
            return $transactions;
       }catch(Exceptin $e){
           return $e;
       }
    }

     public function getPending()
    {
        try{
            $transactions = Transaction::where('ispaid',false)->with('customer')->with('recordedBy')->with('transactedBy')->get();
            return $transactions;
       }catch(Exception $e){
           return $e;
       }
    }

    public function getPendingSpecific($id)
    {
        try{
            $transactions = Transaction::where('ispaid',false)->where('customer_id', $id)->with('customer')->with('recordedBy')->with('transactedBy')->get();
            return $transactions;
       }catch(Exception $e){
           return $e;
       }
    }

    public function getPaid()
    {
        try{
            $transactions = Transaction::where('ispaid',true)->with('customer')->with('recordedBy')->with('transactedBy')->get();
            return $transactions;
       }catch(Exceptin $e){
           return $e;
       }
    }

    public function getPaidSpecific($id)
    {
        try{
            $transactions = Transaction::where('ispaid',true)->where('customer_id', $id)->with('customer')->with('recordedBy')->with('transactedBy')->get();
            return $transactions;
       }catch(Exceptin $e){
           return $e;
       }
    }
   

    public function getDataMonthly(){
        try{

            $transaction = Transaction::where('ispaid', true)->get()
            ->groupBy(function($value){
                return $value['created_at']->format('Y');
            })->mapToGroups(function($value,$key){
                return [
                    $key => $value ->groupBy(function($value){
                        return $value['created_at']->format('m');
                    })->mapToGroups(function($value,$key){
                        return [$key => $value->sum('total_amount')];
                    })
                    ->map(function($transactions){
                        return $transactions->first();
                    })->sortDesc()
                ];
            })->map(function($transactions){
                return $transactions->first();
            })->sortDesc();
    
            return response()->json($transaction);

        }catch(Exception $e){
            return $e;
        }
    }

    public function getDataMonthlyByCustomer($id){
        try{
          
            $transaction = Transaction::where('customer_id', $id )->where('ispaid', true)->get()
            ->groupBy(function($value){
                return $value['created_at']->format('Y');
            })->mapToGroups(function($value,$key){
                return [
                    $key => $value ->groupBy(function($value){
                        return $value['created_at']->format('m');
                    })->mapToGroups(function($value,$key){
                        return [$key => $value->sum('total_amount')];
                    })
                    ->map(function($transactions){
                        return $transactions->first();
                    })->sortDesc()
                ];
            })->map(function($transactions){
                return $transactions->first();
            })->sortDesc();
    
            return response()->json($transaction);

        }catch(Exception $e){
            return $e;
        }
    }
}
