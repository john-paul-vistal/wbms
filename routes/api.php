<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Authentication;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Authentication
Route::post('/login', [Authentication::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::post('/logout', [Authentication::class, 'logout']);

    //Unguarded Rute for Staff
    Route::get('/staff/show/{staff}',[StaffController::class,'show']);
    Route::put('/staff/update/{staff}',[StaffController::class,'update']);

    //Customers Route
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/show/{customer}', [CustomerController::class, 'show']);
    Route::post('/customer/create', [CustomerController::class, 'store']);
    Route::delete('/customer/delete/{customer}', [CustomerController::class, 'destroy']);
    Route::put('/customer/update/{customer}', [CustomerController::class, 'update']);

    //Transaction
    Route::get('/transaction', [TransactionController::class, 'index']);
    
    Route::get('/transaction/show/{transaction}', [TransactionController::class, 'show']);
    Route::get('/transaction/pending-transaction', [TransactionController::class, 'getPending']);
    Route::get('/transaction/show-transactions/{id}', [TransactionController::class, 'showTransactions']);
    Route::post('/transaction/create/', [TransactionController::class, 'store']);
    Route::delete('/transaction/delete/{transaction}', [TransactionController::class, 'destroy']);
    Route::put('/transaction/update/{transaction}', [TransactionController::class, 'update']);
    Route::put('/transaction/pay/{transaction}', [TransactionController::class, 'pay']);
    


});

Route::group(['middleware' => ['auth:sanctum','isadmin']],function(){

    //Settings
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::get('/settings/show/{settings}', [SettingsController::class, 'show']);
    Route::post('/settings/create/', [SettingsController::class, 'store']);
    Route::delete('/settings/delete/{settings}', [SettingsController::class, 'destroy']);
    Route::put('/settings/update/{settings}', [SettingsController::class, 'update']);

    //Staff Route
    Route::get('/staff',[StaffController::class,'index']);
    Route::post('/staff/create',[StaffController::class,'store']);
    Route::delete('/staff/delete/{staff}',[StaffController::class,'destroy']);


});
















