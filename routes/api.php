<?php

use Illuminate\Http\Request;

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

Route::post('/register', 'Api\UserApiController@register');
Route::post('/login', 'Api\UserApiController@login');


Route::group(['middleware' => ['auth:sanctum'], 'namespace' => 'Api'], function (){
    Route::get('/me', 'UserApiController@me');
    Route::post('/logout', 'UserApiController@logout');

    Route::get('/expenses/getAll', 'ExpensesApiController@getAll');

    Route::apiResource('expenses', 'ExpensesApiController');
});
