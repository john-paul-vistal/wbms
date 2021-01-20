<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReadingsController;
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


Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::post('/logout', [Authentication::class, 'logout']);
});

//Staff Route
Route::get('/staff',[StaffController::class,'index']);
Route::get('/staff/show/{staff}',[StaffController::class,'show']);
Route::post('/staff/create',[StaffController::class,'store']);
Route::delete('/staff/delete/{staff}',[StaffController::class,'destroy']);
Route::put('/staff/update/{staff}',[StaffController::class,'update']);

//Customers Route
Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/customer/show/{customer}', [CustomerController::class, 'show']);
Route::post('/customer/create', [CustomerController::class, 'store']);
Route::delete('/customer/delete/{customer}', [CustomerController::class, 'destroy']);
Route::put('/customer/update/{customer}', [CustomerController::class, 'update']);

//Readings
Route::get('/readings', [ReadingsController::class, 'index']);
Route::get('/readings/show/{readings}', [ReadingsController::class, 'show']);
Route::post('/readings/create', [ReadingsController::class, 'store']);
Route::delete('/readings/delete/{readings}', [ReadingsController::class, 'destroy']);
Route::put('/readings/update/{readings}', [ReadingsController::class, 'update']);
Route::get('/readings/show-pending/{id}', [ReadingsController::class, 'showpendings']); 




