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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/view', 'PublicController@index')->name('public');
Route::get('/devices/rules/{id}', 'RuleController@create')->name('rules');
Route::put('/devices/rules/{id}', 'RuleController@update')->name('rules.update');
Route::get('/api/{id}/{token}/{dataUp}', 'CardController@update')->name('apiD');

Route::resource('users', 'UserController')->middleware('isYour');
Route::resource('rooms', 'RoomController');
Route::resource('houses', 'HouseController');
Route::resource('devices', 'DeviceController');
