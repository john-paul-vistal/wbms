<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/staff/create',[StaffController::class,'store']);


Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/customer/create', [CustomerController::class, 'store']);
Route::delete('/customer/delete/{customer}', [CustomerController::class, 'destroy']);
Route::get('/customer/show/{customer}', [CustomerController::class, 'show']);
Route::put('/customer/update/{customer}', [CustomerController::class, 'update']);

