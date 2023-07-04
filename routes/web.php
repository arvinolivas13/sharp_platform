<?php

use App\Events\FormSubmitted;

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
Route::group(['middleware' => ['auth']], function() {
    
    Route::get('/project', function () {
        return view('backend.pages.dashboard');
    });

    // Dynamic Routes
    Route::group(['prefix' => 'project'], function() {
        Route::get         ('/{app_type}/{app}/{module}',       'Controller@index'                                              )->name('app');
        Route::get         ('/{app_type}/{app}',                'Controller@direct_app'                                         )->name('direct_app');
    });

    // Controller action
    Route::group(['prefix' => 'actions'], function() {

        Route::group(['prefix' => 'app_type'], function() {
            Route::get          ('/get',                            'AppTypeController@get'                                         )->name('get');
            Route::post         ('/save',                           'AppTypeController@store'                                       )->name('save');
            Route::get          ('/edit/{id}',                      'AppTypeController@edit'                                        )->name('edit');
            Route::post         ('/update/{id}',                    'AppTypeController@update'                                      )->name('update');
            Route::post         ('/destroy',                        'AppTypeController@destroy'                                     )->name('delete');
            Route::get          ('/list/{id}',                      'AppTypeController@get_list'                                    )->name('list');
        });
        
        Route::group(['prefix' => 'app'], function() {
            Route::get          ('/get',                            'AppController@get'                                             )->name('get');
            Route::post         ('/save',                           'AppController@store'                                           )->name('save');
            Route::get          ('/edit/{id}',                      'AppController@edit'                                            )->name('edit');
            Route::post         ('/update/{id}',                    'AppController@update'                                          )->name('update');
            Route::post         ('/destroy',                        'AppController@destroy'                                         )->name('delete');
            Route::get          ('/list/{id}',                      'AppController@get_list'                                        )->name('list');
        });
        
        Route::group(['prefix' => 'app_module'], function() {
            Route::get          ('/get',                            'AppModuleController@get'                                       )->name('get');
            Route::post         ('/save',                           'AppModuleController@store'                                     )->name('save');
            Route::get          ('/edit/{id}',                      'AppModuleController@edit'                                      )->name('edit');
            Route::post         ('/update/{id}',                    'AppModuleController@update'                                    )->name('update');
            Route::post         ('/destroy',                        'AppModuleController@destroy'                                   )->name('delete');
            Route::get          ('/list/{id}',                      'AppModuleController@get_list'                                  )->name('list');
        });
        
        Route::group(['prefix' => 'user'], function() {
            Route::get          ('/get',                            'UserController@get'                                            )->name('get');
            Route::post         ('/save',                           'UserController@store'                                          )->name('save');
            Route::get          ('/edit/{id}',                      'UserController@edit'                                           )->name('edit');
            Route::post         ('/update/{id}',                    'UserController@update'                                         )->name('update');
            Route::post         ('/destroy',                        'UserController@destroy'                                        )->name('delete');
            Route::get          ('/list/{id}',                      'UserController@get_list'                                       )->name('list');
        });
        
        Route::group(['prefix' => 'role'], function() {
            Route::get          ('/get',                            'RoleController@get'                                            )->name('get');
            Route::post         ('/save',                           'RoleController@store'                                          )->name('save');
            Route::get          ('/edit/{id}',                      'RoleController@edit'                                           )->name('edit');
            Route::post         ('/update/{id}',                    'RoleController@update'                                         )->name('update');
            Route::post         ('/destroy',                        'RoleController@destroy'                                        )->name('delete');
            Route::get          ('/list/{id}',                      'RoleController@get_list'                                       )->name('list');
        });
        
        Route::group(['prefix' => 'activity_log'], function() {
            Route::get          ('/get/{date}',                     'Controller@log_get'                                            )->name('get');
        });
        
        Route::group(['prefix' => 'access'], function() {
            Route::get          ('/get_apps/{id}',                       'AccessController@get_apps'                                     )->name('get');
        });

    });
    
    Route::group(['prefix' => '/payroll'], function (){
        Route::get          ('/',                                'PayrollController@index'                                      )->name('payroll');

        Route::group(['prefix' => '/leave-type'], function (){
            Route::get          ('/',                            'LeaveTypeController@index'                                    )->name('leave_type');
            Route::get          ('/get',                         'LeaveTypeController@get'                                      )->name('get_leave_type');
            Route::post         ('/save',                        'LeaveTypeController@store'                                    )->name('save_leave_type');
            Route::get          ('/edit/{id}',                   'LeaveTypeController@edit'                                     )->name('edit_leave_type');
            Route::post         ('/update/{id}',                 'LeaveTypeController@update'                                   )->name('update_leave_type');
            Route::post         ('/destroy',                     'LeaveTypeController@destroy'                                  )->name('destroy_position');
        });
        
    });

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
