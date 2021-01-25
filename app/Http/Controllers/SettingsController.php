<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $settings = Settings::all() ;        
            return $settings;
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
                'settingName'=>'required',
                'value'=>'required'
            ]);

            $settings = new Settings;
            $settings->settingName = $valid['settingName'];
            $settings->value = $valid['value'];
            $settings->save();

            $response = [
                'message' => "$settings->settingName is set",
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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        try{

            return $settings;

        }catch(Exception $e){
            return $e;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        try{
            $valid = $request->validate([

                'settingName'=>'required',
                'value'=>'required'

            ]);

            $settings->update([
                'settingName'=> $valid['settingName'],
                'value'=> $valid['value']
            ]);

            $response = [
                'message' => "$settings->settingName updated successfully!",
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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        try{

            $settings->delete();
            
            $response = [
                'message' => "Successfully Deleted!",
                'status' => 200
            ];

            return $response;
            
        }catch(Exception $e){
            return $e;
        }
    }
}
