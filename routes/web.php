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
    Route::get('/services','App\Http\Controllers\Frontend\ServiceController@index')->name('services');
    Route::get('/services/{slug}','App\Http\Controllers\Frontend\ServiceController@show')->name('services.show');
    Route::get('/contact','App\Http\Controllers\Frontend\ContactController@index')->name('contact');
    Route::post('/contact/send','App\Http\Controllers\Frontend\ContactController@ctsend')->name('contact.send');
    Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');

    Route::get('/invoice/{id}', [App\Http\Controllers\HomeController::class, 'invoice'])->name('invoice.generator');

    Route::get('/widthdarw', 'App\Http\Controllers\TransactionController@create')->name('send.widthdraw');
    Route::post('/widthdarw/amount/request/{id}', 'App\Http\Controllers\TransactionController@needtoknowamount')->name('send.knowprice');

    Route::post('/widthdarw/amount/success', 'App\Http\Controllers\TransactionController@store')->name('send.store');

    
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

// Agent Login
Route::get('/login/agent', 'App\Http\Controllers\Auth\LoginController@showUserAgentloginform')->name('Agentlogin');
Route::post('/login/agent', 'App\Http\Controllers\Auth\LoginController@Agentlogin');

// Agent Registration
Route::get('/register/agent', 'App\Http\Controllers\Auth\RegisterController@ShowAgentRegiterForm');
Route::post('/register/agent', 'App\Http\Controllers\Auth\RegisterController@createAgentUser');

// User Registration
Route::get('/register/user', 'App\Http\Controllers\Auth\RegisterController@ShowRegiterForm');
Route::post('/register/user', 'App\Http\Controllers\Auth\RegisterController@createUser');
Route::post('/register/ref', 'App\Http\Controllers\Auth\RegisterController@createRefUser');

Auth::routes(['verify' => true]);
// User Dashboard Fuction
Route::middleware(['verified'])->group(function () {
    Route::group(['prefix' => 'auth'], function(){
        Route::group(['middleware' => 'auth_role'], function () {

            Route::get('/dashboard','App\Http\Controllers\Frontend\DashboardController@index')->name('user.dashboard');

            Route::post('/userupdate/{id}','App\Http\Controllers\Frontend\DashboardController@updateuser')->name('user.updatedata');

            // User promotion level updating
            Route::post('/promotion/{id}','App\Http\Controllers\Frontend\DashboardController@updatepromoid')->name('user.updatepromoid');
            
            Route::get('/user/{id}', 'App\Http\Controllers\HomeController@referelink')->name('user.referel');

            Route::get('/ref/user/{username}', 'App\Http\Controllers\HomeController@reflist')->name('user.reflist');

            Route::get('/history/transaction', 'App\Http\Controllers\Frontend\DashboardController@history')->name('user.history');

            // User profile update
            Route::get('/usersettings/{username}','App\Http\Controllers\Frontend\DashboardController@usersetting')->name('user.usersetting');
            
            // Booking online
            Route::group(['prefix' => 'booking'], function(){

                Route::get('/manage', 'App\Http\Controllers\Frontend\BookingController@index')->name('booking.manage');
                // Booking list
                Route::get('/list', 'App\Http\Controllers\Frontend\BookingController@list')->name('booking.list');
                // booking pdf file
                Route::get('/pdfgenerate/{id}', 'App\Http\Controllers\Frontend\BookingController@generatepdf')->name('booking.generatepdf');

                // Leveling
                Route::post('/fetchmessage', 'App\Http\Controllers\Backend\PromoteLevelController@fetchmessage')->name('promote.fetchmessage');
        
                Route::get('/create', 'App\Http\Controllers\Frontend\BookingController@create')->name('booking.create');
        
                Route::post('/store', 'App\Http\Controllers\Frontend\BookingController@store')->name('booking.store');

                Route::post('/duecash/{id}', 'App\Http\Controllers\Frontend\BookingController@duecash')->name('booking.duecash');

        
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

                Route::post('/transfer', 'App\Http\Controllers\Frontend\AddmoneyController@transfer')->name('addmoney.transfer');

                Route::post('/transferagentmoney', 'App\Http\Controllers\Frontend\AddmoneyController@transferagentmoney')->name('addmoney.transferagentmoney');
        
                Route::get('/create', 'App\Http\Controllers\Frontend\AddmoneyController@create')->name('addmoney.create');
        
                Route::post('/store', 'App\Http\Controllers\Frontend\AddmoneyController@store')->name('addmoney.store');

                Route::get('/find/agent', 'App\Http\Controllers\Frontend\AddmoneyController@findagent')->name('addmoney.findagent');
        
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
    // Agent Web Routes 
    Route::group(['prefix' => 'agent'], function(){
        Route::group(['middleware' => 'agent'], function () {
            Route::get('/dashboard','App\Http\Controllers\Backend\AgentDashboardController@index')->name('agent.dashboard');
            // User promotion level updating
            Route::post('/promotion/{id}','App\Http\Controllers\Backend\AgentDashboardController@updatepromoid')->name('agent.updatepromoid');

            Route::get('/notifyseen/{id}','App\Http\Controllers\Backend\AgentDashboardController@notify')->name('agent.notify');

            Route::get('/transactionlist','App\Http\Controllers\Backend\AgentDashboardController@transactionlist')->name('agent.transactionlist');

            // withdraw request
            Route::group(['prefix' => 'withdraw'], function() {
                Route::get('/manage/pending', 'App\Http\Controllers\Backend\Agent\WithdrawController@index')->name('withdraw.agent.manage');
                
                Route::post('accpet/request/{id}', 'App\Http\Controllers\Backend\Agent\WithdrawController@requestAccept')->name('withdraw.agent.request');

                Route::get('/request', 'App\Http\Controllers\Backend\Agent\WithdrawController@withdraw')->name('withdraw.agent.withdraw');

                Route::post('/store', 'App\Http\Controllers\Backend\Agent\WithdrawController@store')->name('withdraw.agent.store');
                
                Route::post('delete/{id}', 'App\Http\Controllers\Backend\Agent\WithdrawController@destroy')->name('withdraw.agent.destroy');
            });

            // booking list
            Route::group(['prefix' => 'booking'], function() {
                Route::get('/manage', 'App\Http\Controllers\Backend\Agent\BookingController@index')->name('booking.agent.manage');

                Route::get('/new', 'App\Http\Controllers\Backend\Agent\BookingController@new')->name('booking.agent.new');

                Route::post('/status/{id}', 'App\Http\Controllers\Backend\Agent\BookingController@status')->name('booking.agent.status');
        
                Route::get('/show/{id}', 'App\Http\Controllers\Backend\Agent\BookingController@show')->name('booking.agent.show');

                Route::get('/notifyread/{id}', 'App\Http\Controllers\Backend\Agent\BookingController@notifyread')->name('booking.agent.notifyread');

                Route::get('/create', 'App\Http\Controllers\Backend\Agent\BookingController@create')->name('booking.agent.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\Agent\BookingController@store')->name('booking.agent.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\Agent\BookingController@edit')->name('booking.agent.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\Agent\BookingController@update')->name('booking.Agent.update');
           
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\Agent\BookingController@destroy')->name('booking.Agent.destroy');
                
            }); 

            // Add money
            Route::get('/add-money', 'App\Http\Controllers\Backend\Agent\AddMoneyController@index')->name('agent.addmoney');
            Route::post('/add-money/store', 'App\Http\Controllers\Backend\Agent\AddMoneyController@store')->name('agent.store');
            Route::get('/user-request', 'App\Http\Controllers\Backend\Agent\AddMoneyController@userrequest')->name('agent.userrequest');
            Route::post('/user-request/accept/{id}', 'App\Http\Controllers\Backend\Agent\AddMoneyController@userrequestaccept')->name('agent.userrequestaccept');
            Route::post('/request/delete/{id}', 'App\Http\Controllers\Backend\Agent\AddMoneyController@destroy')->name('agent.destroy');

            // All user under agent
            Route::group(['prefix' => 'users'], function() {
                Route::get('/manage', 'App\Http\Controllers\Backend\Agent\UserController@index')->name('user.manage');

                Route::get('/referel/{referrer_id}', 'App\Http\Controllers\Backend\Agent\UserController@referel')->name('user.referel');

            });

            // All application under agent 
            Route::group(['prefix' => 'application'], function() {
                Route::get('/manage', 'App\Http\Controllers\Backend\Agent\ApplicationController@index')->name('agent.application');
                Route::get('/approved', 'App\Http\Controllers\Backend\Agent\ApplicationController@approved')->name('agent.approved.application');
                Route::get('/show/{id}', 'App\Http\Controllers\Backend\Agent\ApplicationController@show')->name('agent.application.show');
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\Agent\ApplicationController@update')->name('agent.application.update');

                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\Agent\ApplicationController@destroy')->name('agent.application.destroy');
            });

            // All Report under agent 
            Route::group(['prefix' => 'reports'], function() {
                Route::get('/pending', 'App\Http\Controllers\Backend\Agent\ReportsController@index')->name('agent.report.pending');
                Route::get('/approved', 'App\Http\Controllers\Backend\Agent\ReportsController@approved')->name('agent.approved.report');
                Route::get('/show/{id}', 'App\Http\Controllers\Backend\Agent\ReportsController@show')->name('agent.report.show');
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\Agent\ReportsController@update')->name('agent.report.update');

                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\Agent\ReportsController@destroy')->name('agent.report.destroy');
            });

        });
    });
    Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => 'admin'], function () {

            Route::get('/dashboard','App\Http\Controllers\Backend\DashboardController@index')->name('admin.dashboard');

            Route::get('/profile/{username}','App\Http\Controllers\Backend\DashboardController@profile')->name('admin.profile');

            Route::get('/reports','App\Http\Controllers\Backend\DashboardController@report')->name('admin.report');

            Route::get('/referel/list', 'App\Http\Controllers\Backend\DashboardController@referellist')->name('user.referellist');
            Route::get('/referel/{referrer_id}', 'App\Http\Controllers\Backend\DashboardController@refereladmin')->name('admin.user.referel');

            Route::post('/send/fundation','App\Http\Controllers\Backend\DashboardController@fundation')->name('admin.fundation');

            Route::get('/notifyseen/{id}', 'App\Http\Controllers\Backend\DashboardController@notify')->name('notify.seend');

            Route::group(['prefix' => 'bonusetting'], function() {
                Route::get('/manage', 'App\Http\Controllers\Backend\DashboardController@bonus')->name('bonus.manage');

                Route::post('/bonusSetPost', 'App\Http\Controllers\Backend\DashboardController@bonusSetPost')->name('bonus.post');

                Route::get('/bonus/create', 'App\Http\Controllers\Backend\DashboardController@create')->name('bonus.create');

                Route::post('/bonus/store', 'App\Http\Controllers\Backend\DashboardController@store')->name('bonus.store');


                
            });

            Route::get('/notifyseen/{id}', 'App\Http\Controllers\Backend\DashboardController@notify')->name('notify.seend');

            // withdraw request
            Route::group(['prefix' => 'withdraw'], function() {

                Route::get('/manage/pending', 'App\Http\Controllers\Backend\WithdrawController@index')->name('withdraw.manage');
                
                Route::post('accpet/request/{id}', 'App\Http\Controllers\Backend\WithdrawController@requestAccept')->name('withdraw.request');
                
                Route::get('manage/accept', 'App\Http\Controllers\Backend\WithdrawController@accept')->name('withdraw.accept');

                Route::post('delete/{id}', 'App\Http\Controllers\Backend\WithdrawController@destroy')->name('withdraw.destroy');
            });

            // deposit request
            Route::group(['prefix' => 'deposit'], function() {

                Route::get('/create', 'App\Http\Controllers\Backend\DepositController@create')->name('withdraw.create');

                Route::post('/store', 'App\Http\Controllers\Backend\DepositController@store')->name('withdraw.store');

                Route::get('/credit', 'App\Http\Controllers\Backend\DepositController@credit')->name('withdraw.credit');

                Route::post('/credit/store', 'App\Http\Controllers\Backend\DepositController@creditstore')->name('credit.store');
                
                Route::get('/manage', 'App\Http\Controllers\Backend\DepositController@index')->name('deposit.manage');

            });

            // Landcat Route For CRUD
            Route::group(['prefix' => 'landcat'], function(){
                Route::get('/manage', 'App\Http\Controllers\Backend\LandcatController@index')->name('landcat.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\LandcatController@create')->name('landcat.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\LandcatController@store')->name('landcat.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\LandcatController@edit')->name('landcat.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\LandcatController@update')->name('landcat.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\LandcatController@destroy')->name('landcat.destroy');
        
            });

            Route::group(['prefix' => 'landreserve'], function(){
                Route::get('/manage', 'App\Http\Controllers\Backend\LandReserveController@index')->name('landreserve.manage');

                Route::get('/create', 'App\Http\Controllers\Backend\LandReserveController@create')->name('landreserve.create');

                Route::post('/store', 'App\Http\Controllers\Backend\LandReserveController@store')->name('landreserve.store');

                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\LandReserveController@edit')->name('landreserve.edit');
                
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\LandReserveController@update')->name('landreserve.update');

                Route::post('/catstore', 'App\Http\Controllers\Backend\LandReserveController@catstore')->name('landreserve.catstore');

                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\LandReserveController@destroy')->name('landreserve.delete');
            });

            // Agent Payment Route For CRUD
            Route::group(['prefix' => 'payment'], function(){

                Route::get('/request', 'App\Http\Controllers\Backend\PaymentController@index')->name('payament.request');
        
                Route::get('/approve', 'App\Http\Controllers\Backend\PaymentController@approve')->name('payament.approve');

                Route::get('/show/{id}','App\Http\Controllers\Backend\PaymentController@show')->name('payament.show');
        
                Route::post('/store', 'App\Http\Controllers\Backend\PaymentController@store')->name('payament.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\PaymentController@edit')->name('payament.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\PaymentController@update')->name('payament.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\PaymentController@destroy')->name('payament.destroy');
        
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

            // Wallet Route for Crud
            
            Route::group(['prefix' => 'wallettype'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\WallettypeController@index')->name('wallettype.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\WallettypeController@create')->name('wallettype.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\WallettypeController@store')->name('wallettype.store');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\WallettypeController@edit')->name('wallettype.edit');

                Route::get('/show/{id}', 'App\Http\Controllers\Backend\WallettypeController@show')->name('wallettype.show');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\WallettypeController@update')->name('wallettype.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\WallettypeController@destroy')->name('wallettype.destroy');
        
            });

            // Promote Level Route for Crud
            
            Route::group(['prefix' => 'promote'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\PromoteLevelController@index')->name('promote.manage');
        
                Route::get('/create/message/', 'App\Http\Controllers\Backend\PromoteLevelController@create')->name('promote.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\PromoteLevelController@store')->name('promote.store');

                Route::post('/store/message', 'App\Http\Controllers\Backend\PromoteLevelController@storemessage')->name('promote.message.store');

                Route::post('/delete/message/{id}', 'App\Http\Controllers\Backend\PromoteLevelController@destroymessage')->name('promote.destroymessage');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\PromoteLevelController@edit')->name('promote.edit');

                Route::get('/show/{id}', 'App\Http\Controllers\Backend\PromoteLevelController@show')->name('promote.show');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\PromoteLevelController@update')->name('promote.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\PromoteLevelController@destroy')->name('promote.destroy');
        
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



            // ????????? ???????????? ???????????????
            Route::group(['prefix' => 'homesettings'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\HomepageController@index')->name('homesetting.manage');

                Route::post('/update/{id}', 'App\Http\Controllers\Backend\HomepageController@update')->name('homesetting.update');

                Route::get('/favclient', 'App\Http\Controllers\Backend\HomepageController@favclient')->name('homesetting.favclient');

                Route::post('/favclientupdate/{id}', 'App\Http\Controllers\Backend\HomepageController@favclientupdate')->name('homesetting.favclientupdate');

                Route::post('/favclientdelete/{id}', 'App\Http\Controllers\Backend\HomepageController@favclientdelete')->name('homesetting.favclientdelete');

                Route::post('/favclientlogo', 'App\Http\Controllers\Backend\HomepageController@favclientlogo')->name('homesetting.favclientlogo');

            });

            // ????????????????????? ???????????? ???????????????
            Route::group(['prefix' => 'service'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\ServiceController@index')->name('service.manage');

                Route::post('/store/pagehead/{id}', 'App\Http\Controllers\Backend\ServiceController@storehead')->name('service.pagehead');

                Route::post('/store/service/', 'App\Http\Controllers\Backend\ServiceController@storeservice')->name('service.storeservice');

                Route::post('/update/{id}', 'App\Http\Controllers\Backend\ServiceController@update')->name('service.update');

                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\ServiceController@destroy')->name('service.destroy');
                

            });

            // Gallery settings
            Route::group(['prefix' => 'gallery'], function(){

                Route::get('/manage', 'App\Http\Controllers\Backend\GalleryController@index')->name('gallery.manage');
        
                Route::get('/create', 'App\Http\Controllers\Backend\GalleryController@create')->name('gallery.create');
        
                Route::post('/store', 'App\Http\Controllers\Backend\GalleryController@store')->name('gallery.store');

                Route::post('/store/cat', 'App\Http\Controllers\Backend\GalleryController@storecat')->name('gallery.storecat');
        
                Route::get('/edit/{id}', 'App\Http\Controllers\Backend\GalleryController@edit')->name('gallery.edit');
        
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\GalleryController@update')->name('gallery.update');
        
                Route::post('/delete/{id}', 'App\Http\Controllers\Backend\GalleryController@destroy')->name('gallery.destroy');

                Route::post('/remove', 'App\Http\Controllers\Backend\GalleryController@remove')->name('gallery.remove');
        
            });

            // Our details 
            Route::group(['prefix' => 'our-setting'], function(){
                Route::get('/manage', 'App\Http\Controllers\Backend\OurDetailsController@index')->name('oursetting.manage');
                Route::post('/store', 'App\Http\Controllers\Backend\OurDetailsController@store')->name('oursetting.store');
                Route::post('/update/{id}', 'App\Http\Controllers\Backend\OurDetailsController@update')->name('oursetting.update');
                
            });

            // About content             
            Route::group(['prefix' => 'about-setting'], function() {
                Route::get('/manage','App\Http\Controllers\Frontend\AboutController@create')->name('about.create');

                Route::post('/storepagetitle', 'App\Http\Controllers\Frontend\AboutController@storepagetitle')->name('about.storepagetitle');

                Route::post('/update/pagetitle/{id}', 'App\Http\Controllers\Frontend\AboutController@updatepagetitle')->name('about.updatepagetitle');

                Route::post('/store', 'App\Http\Controllers\Frontend\AboutController@store')->name('about.store');
                Route::post('/update/{id}', 'App\Http\Controllers\Frontend\AboutController@update')->name('about.update');

                Route::post('/delete/{id}', 'App\Http\Controllers\Frontend\AboutController@destroy')->name('about.destroy');
            });

            // contact page setting 
            Route::group(['prefix' => 'contact'], function(){
                Route::get('/manage','App\Http\Controllers\Frontend\ContactController@manage')->name('contact.manage');

                Route::post('/store','App\Http\Controllers\Frontend\ContactController@store')->name('contact.store');

                Route::post('/update/{id}','App\Http\Controllers\Frontend\ContactController@update')->name('contact.update');

                Route::post('/delete/{id}','App\Http\Controllers\Frontend\ContactController@destroy')->name('contact.delete');

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
