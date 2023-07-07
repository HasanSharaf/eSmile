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

Route::prefix('doctors')->group(function() {
    //Login API's
    Route::post('/registerDoctor', 'DoctorController@registerDoctor');
    Route::post('/loginDoctor', 'DoctorController@loginDoctor');
    Route::post('/logoutDoctor/{id}', 'DoctorController@logoutDoctor');
    //CRUD API's
    Route::put('/updateDoctor/{id}', 'DoctorController@updateDoctor');
    Route::delete('/deleteDoctor/{id}', 'DoctorController@deleteDoctor');
    Route::get('/getAllDoctors', 'DoctorController@getAllDoctors');
    Route::get('/getDoctorById/{id}', 'DoctorController@getDoctorById');
    // Route::get('getEnableFinancialDoctor', 'DoctorController@getEnableFinancialDoctor');


});