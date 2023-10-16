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
    Route::post('create/{userId}', 'AppointmentController@createAppointment');
    Route::post('createFromDoctor/{doctorId}', 'AppointmentController@createAppointmentFromDoctor');
    Route::get('getUserAppointments/{id}', 'AppointmentController@getUserAppointments');
    Route::get('getDoctorAppointments', 'AppointmentController@getDoctorAppointments');
    Route::delete('deleteAppointment/{id}', 'AppointmentController@deleteAppointment');
    Route::get('getAllAppointments', 'AppointmentController@listAppointments');


});