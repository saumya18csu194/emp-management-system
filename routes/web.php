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

Route::resource('/home','HomeController@index');
Route::resource('employees', 'EmployeeController');
Route::resource('users', 'UserController');
Route::delete('/employees/{id}', 'EmployeeController@destroy')->name('employees.destroy');
Route::patch('/profile', 'ProfileController@update_profile')->name('profile.update');
Route::get('/users/home', 'HomeController@index11');
Route::get('/employees/home', 'HomeController@new_employee');
Route::get('/changePassword','EmployeeController@showChangePasswordForm')->name('changePassword');
Route::post('/changePassword','EmployeeController@changePassword')->name('changePassword');
Route::get('/newhomepage','HomeController@newhome');
Route::resource('attendance', 'AttendanceController');
// Route::get('/attendance', 'AttendanceController@show_emp_attendance');
