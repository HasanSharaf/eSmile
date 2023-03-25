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
    Route::get('/', 'UserController@index');
    Route::post('/', 'UserController@create');
    Route::get('list/agencies', 'UserController@listAgencies');
    Route::get('/list/clients', 'UserController@listClients');
    Route::get('/list/contactsCrm', 'UserController@listContactsCrm');
    Route::get('/list/agents', 'UserController@listAgents');
    Route::get('/get/creatorInfo', 'UserController@getCreatorInfo');
});