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

// Admin login 
Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminloginform')->name('Adminlogin');
Route::post('/login/admin', 'App\Http\Controllers\Auth\LoginController@Adminlogin');

// User Login
Route::get('/login/user', 'App\Http\Controllers\Auth\LoginController@showUserloginform')->name('userlogin');
Route::post('/login/user', 'App\Http\Controllers\Auth\LoginController@Userlogin');

// User Registration
Route::get('/register/user', 'App\Http\Controllers\Auth\RegisterController@ShowRegiterForm');
Route::post('/register/user', 'App\Http\Controllers\Auth\RegisterController@createUser');

Auth::routes(['verify' => true]);
// User Dashboard Fuction
Route::middleware(['verified'])->group(function () {
    Route::group(['prefix' => 'auth'], function(){
        Route::group(['middleware' => 'auth_role'], function () {

            Route::get('/dashboard','App\Http\Controllers\Frontend\DashboardController@index')->name('user.dashboard');
            
        });
    });
    Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => 'admin'], function () {

            Route::get('/dashboard','App\Http\Controllers\Backend\DashboardController@index')->name('admin.dashboard');

        // Platform Settings Route For CRUD
        Route::group(['prefix' => 'platform'], function(){

            Route::get('/manage', 'App\Http\Controllers\Backend\PlatformSettingsController@index')->name('settings.manage');
    
            Route::get('/create', 'App\Http\Controllers\Backend\PlatformSettingsController@create')->name('settings.create');
    
            Route::post('/store', 'App\Http\Controllers\Backend\PlatformSettingsController@store')->name('settings.store');
    
            Route::get('/edit/{id}', 'App\Http\Controllers\Backend\PlatformSettingsController@edit')->name('settings.edit');
    
            Route::post('/update/{id}', 'App\Http\Controllers\Backend\PlatformSettingsController@update')->name('settings.update');

            Route::post('/updateemail/{id}', 'App\Http\Controllers\Backend\PlatformSettingsController@updateemail')->name('basic.updateemail');
  
            Route::post('/updatelogo/{id}', 'App\Http\Controllers\Backend\PlatformSettingsController@updatelogo')->name('basic.updatelogo');
    
            Route::get('/delete/{id}', 'App\Http\Controllers\Backend\PlatformSettingsController@destroy')->name('settings.destroy');
    
        });
            
        });
    });
});

Route::get('/dashboardd', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
