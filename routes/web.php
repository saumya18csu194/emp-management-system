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
use App\User;
use Illuminate\Support\Facades\Input;
use App\Employee;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('employees', 'EmployeeController');
Route::resource('users', 'UserController');
Route::delete('/employees/{id}', 'EmployeeController@destroy')->name('employees.destroy');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::patch('/profile', 'ProfileController@update_profile')->name('profile.update');
Route::get('/admin/home', 'HomeController@index')->name('admin.home');
Route::get('/changePassword','EmployeeController@showChangePasswordForm')->name('changePassword');
Route::post('/changePassword','EmployeeController@changePassword')->name('changePassword');