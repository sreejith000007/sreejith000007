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


  Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index');
    Route::post('/submit-form', 'HomeController@store');
    
    Route::prefix('admin')->group(function() {
      Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
      Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
      Route::get('/', 'AdminController@index')->name('admin.dashboard');
      //Route::get('/page', 'AdminController@page')->name('admin.page');
      Route::get('/createform', 'AdminController@page')->name('admin.page');
      Route::post('/save-form', 'AdminController@store');
      Route::get('/user-details', 'AdminController@userDetails')->name('admin.user');
      Route::get('/user-submit-details', 'AdminController@userSubmitDetails')->name('admin.user-submit-details');
      Route::get('/user-submit-details-all/{id}', 'AdminController@userSubmitDetailsAll')->name('admin.user-submit-details-all');
      
    });
  });
