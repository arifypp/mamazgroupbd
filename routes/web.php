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
    Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');

});
// Sign up payment
Route::group(['prefix' => 'paysignupcash'], function(){
    Route::post('/store', 'App\Http\Controllers\Frontend\TotalAmmountController@store')->name('paysignupcash.store');                
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

Route::get('/login', function () {
    return redirect(route('userlogin'));
});

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
            
            // Booking online
            Route::group(['prefix' => 'booking'], function(){

                Route::get('/manage', 'App\Http\Controllers\Frontend\BookingController@index')->name('booking.manage');
                // Booking list
                Route::get('/list', 'App\Http\Controllers\Frontend\BookingController@list')->name('booking.list');
                // booking pdf file
                Route::get('/pdfgenerate/{id}', 'App\Http\Controllers\Frontend\BookingController@generatepdf')->name('booking.generatepdf');

        
                Route::get('/create', 'App\Http\Controllers\Frontend\BookingController@create')->name('booking.create');
        
                Route::post('/store', 'App\Http\Controllers\Frontend\BookingController@store')->name('booking.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Frontend\BookingController@edit')->name('booking.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Frontend\BookingController@update')->name('booking.update');   
        
                Route::get('/delete/{id}', 'App\Http\Controllers\Frontend\BookingController@destroy')->name('booking.destroy');

                /* Dependent Table CRUD */
                Route::post('/district-by-division', 'App\Http\Controllers\Frontend\BookingController@getDistrictsByDivision')->name('divisions');
                Route::post('/thana-by-district', 'App\Http\Controllers\Frontend\BookingController@getThanaByDistrict')->name('district');
        
            });

            // Platform Report Route For CRUD
            Route::group(['prefix' => 'report'], function(){

                Route::get('/manage', 'App\Http\Controllers\Frontend\ReportController@index')->name('report.manage');
        
                Route::get('/create', 'App\Http\Controllers\Frontend\ReportController@create')->name('report.create');
        
                Route::post('/store', 'App\Http\Controllers\Frontend\ReportController@store')->name('report.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Frontend\ReportController@edit')->name('report.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Frontend\ReportController@update')->name('report.update');
        
                Route::get('/delete/{id}', 'App\Http\Controllers\Frontend\ReportController@destroy')->name('report.destroy');
        
            });

            // Add mamaz money
            Route::group(['prefix' => 'addmoney'], function(){

                Route::get('/manage', 'App\Http\Controllers\Frontend\AddmoneyController@index')->name('addmoney.manage');
        
                Route::get('/create', 'App\Http\Controllers\Frontend\AddmoneyController@create')->name('addmoney.create');
        
                Route::post('/store', 'App\Http\Controllers\Frontend\AddmoneyController@store')->name('addmoney.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Frontend\AddmoneyController@edit')->name('addmoney.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Frontend\AddmoneyController@update')->name('addmoney.update');
        
                Route::get('/delete/{id}', 'App\Http\Controllers\Frontend\AddmoneyController@destroy')->name('addmoney.destroy');
        
            });


            
            // Application Route For CRUD
            Route::group(['prefix' => 'apply'], function(){

                Route::get('/manage', 'App\Http\Controllers\Frontend\ApplicationController@index')->name('apply.manage');
        
                Route::get('/create', 'App\Http\Controllers\Frontend\ApplicationController@create')->name('apply.create');
        
                Route::post('/store', 'App\Http\Controllers\Frontend\ApplicationController@store')->name('apply.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Frontend\ApplicationController@edit')->name('apply.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Frontend\ApplicationController@update')->name('apply.update');
        
                Route::get('/delete/{id}', 'App\Http\Controllers\Frontend\ApplicationController@destroy')->name('apply.destroy');
        
            });
        });
    });
    Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => 'admin'], function () {

            Route::get('/dashboard','App\Http\Controllers\Backend\DashboardController@index')->name('admin.dashboard');

            // Landcat Route For CRUD
            Route::group(['prefix' => 'landcat'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\LandcatController@index')->name('landcat.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\LandcatController@create')->name('landcat.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\LandcatController@store')->name('landcat.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\LandcatController@edit')->name('landcat.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\LandcatController@update')->name('landcat.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\LandcatController@destroy')->name('landcat.destroy');
        
            });

            // LandCost Route For CRUD
            Route::group(['prefix' => 'landcost'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\LandCostController@index')->name('landcost.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\LandCostController@create')->name('landcost.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\LandCostController@store')->name('landcost.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\LandCostController@edit')->name('landcost.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\LandCostController@update')->name('landcost.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\LandCostController@destroy')->name('landcost.destroy');
        
            });

            // Booking Management
            Route::group(['prefix' => 'booking'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\BookingController@index')->name('bbooking.manage');

                Route::get('/new', 'App\Http\Controllers\Backend\BookingController@new')->name('bbooking.new');

                Route::post('/status/{id}', 'App\Http\Controllers\Backend\BookingController@status')->name('bbooking.status');
        
                Route::get('/show/{id}', 'App\Http\Controllers\Backend\BookingController@show')->name('bbooking.show');

                Route::get('/notifyread/{id}', 'App\Http\Controllers\Backend\BookingController@notifyread')->name('bbooking.notifyread');

                Route::get('/create', 'App\Http\Controllers\Backend\BookingController@create')->name('bbooking.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\BookingController@store')->name('bbooking.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\BookingController@edit')->name('bbooking.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\BookingController@update')->name('bbooking.update');
           
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\BookingController@destroy')->name('bbooking.destroy');
        
            });

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

            // Customer Route For CRUD
            Route::group(['prefix' => 'customer'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\AdminCustomerController@index')->name('customer.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\AdminCustomerController@create')->name('customer.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\AdminCustomerController@store')->name('customer.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\AdminCustomerController@edit')->name('customer.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\AdminCustomerController@update')->name('customer.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\AdminCustomerController@destroy')->name('customer.destroy');
        
            });

            // Employee Route For CRUD
            Route::group(['prefix' => 'employe'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\EmployeController@index')->name('employe.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\EmployeController@create')->name('employe.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\EmployeController@store')->name('employe.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\EmployeController@edit')->name('employe.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\EmployeController@update')->name('employe.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\EmployeController@destroy')->name('employe.destroy');
        
            });

            // Application Route For CRUD
            Route::group(['prefix' => 'application'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\ApplicationController@index')->name('application.manage');

                Route::get('/pending', 'App\Http\Controllers\Backend\ApplicationController@pending')->name('application.pending');

                Route::get('/show/{id}', 'App\Http\Controllers\Backend\ApplicationController@show')->name('application.show');
        
                Route::get('/create', 'App\Http\Controllers\Backend\ApplicationController@create')->name('application.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\ApplicationController@store')->name('application.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\ApplicationController@edit')->name('application.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\ApplicationController@update')->name('application.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\ApplicationController@destroy')->name('application.destroy');
        
            });



            // হোম পেইজ সেটিং
            Route::group(['prefix' => 'homesettings'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\HomepageController@index')->name('homesetting.manage');

                Route::post('/update/{id}', 'App\Http\Controllers\Backend\HomepageController@update')->name('homesetting.update');

                Route::get('/favclient', 'App\Http\Controllers\Backend\HomepageController@favclient')->name('homesetting.favclient');

                Route::post('/favclientupdate/{id}', 'App\Http\Controllers\Backend\HomepageController@favclientupdate')->name('homesetting.favclientupdate');

                Route::post('/favclientlogo', 'App\Http\Controllers\Backend\HomepageController@favclientlogo')->name('homesetting.favclientlogo');


            });
            
        });
    });
});

Route::get('/dashboardd', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');

Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
Route::get('/update-status/{id}', [App\Http\Controllers\HomeController::class, 'updateStatus'])->name('updateStatus');


Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
