<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Frotend Route Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => '/'], function(){
    // Homepage
    Route::get('/','App\Http\Controllers\Frontend\HomepageController@index')->name('homepage');
    Route::get('/about','App\Http\Controllers\Frontend\AboutController@index')->name('about');
    Route::get('/contact','App\Http\Controllers\Frontend\ContactController@index')->name('contact');
});


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User Login
Route::get('/login/user', 'App\Http\Controllers\Auth\LoginController@showUserloginform');
Route::post('/login/user', 'App\Http\Controllers\Auth\LoginController@Userlogin');

Auth::routes();
// User Dashboard Fuction
Route::get('/auth/dashboard','App\Http\Controllers\Frontend\DashboardController@index')->name('user.dashboard');

Route::get('/dashboardd', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
