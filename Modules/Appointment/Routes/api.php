<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('appointments')->group(function() {
    Route::post('create', 'AppointmentController@createAppointment');
    
    // //CRUD API's
    // Route::put('/updateUser/{id}', 'UserController@updateUser');
    // Route::delete('/deleteUser/{id}', 'UserController@deleteUser');
    // Route::get('/getAllUsers', 'UserController@getAllUsers');

});