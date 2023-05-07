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

Route::prefix('users')->group(function() {
    //Login API's
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::post('/logout/{id}', 'UserController@logout');
    //CRUD API's
    Route::put('/updateUser/{id}', 'UserController@updateUser');
    Route::delete('/deleteUser/{id}', 'UserController@deleteUser');
    Route::get('/getAllUsers', 'UserController@getAllUsers');

});