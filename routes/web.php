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

Auth::routes();

Route::get('/', 'MessageController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::post('messages', 'MessageController@store')->name('messages.store');
    Route::post('validate', 'MessageController@validation')->name('messages.validate');
});