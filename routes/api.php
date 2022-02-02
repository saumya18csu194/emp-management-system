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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('employees', 'API\EmployeeAPIController');
Route::get('/searchId', 'API\EmployeeAPIController@searchById');
Route::get('/searchName', 'API\EmployeeAPIController@searchByName');
Route::get('/searchMail', 'API\EmployeeAPIController@searchByMail');
Route::get('/sortJoin', 'API\EmployeeAPIController@sortByJoiningDate');
Route::get('/chooseRole', 'API\EmployeeAPIController@selectRole');
Route::get('/getRecords', 'API\EmployeeAPIController@index');
