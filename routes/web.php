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
Route::middleware(['auth:api'])->group(function(){
    Route::resource('business', 'BusinessController');
    Route::post('business/{business}','BusinessController@update');
    Route::post('user/{user}', 'AuthController@update');
    Route::get('user/','AuthController@info');
    Route::resource('manager', 'ManagerController');
    Route::resource('employer', 'EmployerController');
    Route::resource('customer', 'CustomerController');
    Route::resource('service', 'ServiceController');
    Route::resource('timetable', 'TimetableController');
    Route::resource('reserve', 'ReserveController');
});