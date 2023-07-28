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

Route::prefix('sessions')->group(function() {
    Route::post('createSession/{userId}', 'SessionController@createSession');
    Route::put('updateSession/{sessionId}', 'SessionController@updateSession');
    Route::delete('deleteSession/{sessionId}', 'SessionController@deleteSession');
    Route::get('getUserSessions/{userId}', 'SessionController@getUserSessions');
    Route::get('getAllSessions', 'SessionController@listSessions');


});