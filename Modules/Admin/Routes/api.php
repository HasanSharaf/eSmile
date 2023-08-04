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

Route::prefix('admins')->group(function() {
    //Login API's
    Route::post('createAdmin', 'AdminController@createAdmin');
    Route::post('loginAdmin', 'AdminController@loginAdmin');
    Route::post('/logoutAdmin/{adminId}', 'AdminController@logoutAdmin');
    
    Route::put('updateAdmin/{adminId}', 'AdminController@updateAdmin');
    Route::delete('deleteAdmin/{adminId}', 'AdminController@deleteAdmin');
    Route::get('getAdminById/{adminId}', 'AdminController@getAdminById');
    Route::get('getAllAdmins', 'AdminController@getAllAdmins');


});