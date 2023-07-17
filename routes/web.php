<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth'], 'namespace' => 'Web'], function (){
    Route::get('/me', 'UserController@me');

    Route::get('/expenses/create', 'ExpensesController@create')->name('expenses.create');
    Route::get('/expenses/{id}/edit', 'ExpensesController@edit')->name('expenses.edit');
    Route::get('/expenses', 'ExpensesController@index')->name('expenses.index');
    Route::apiResource('expenses', 'ExpensesController');
});







