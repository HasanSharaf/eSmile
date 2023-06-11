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

Route::prefix('financialAccounts')->group(function() {
    Route::post('createSession/{Userid}', 'FinancialAccountController@createSession');
    Route::get('getUserSessions/{Userid}', 'FinancialAccountController@getUserSessions');
    Route::delete('deleteFinancialAccount/{id}', 'FinancialAccountController@deleteFinancialAccount');
    Route::get('getAllFinancialAccounts', 'FinancialAccountController@listFinancialAccounts');


});