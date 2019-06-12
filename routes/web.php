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
Route::get('/updateUser', 'UserController@index')->name('updateUser');
Route::post('updateProfile/{id}', 'UserController@updateProfile')->name('updateProfile');
Route::post('updatePassword/{id}', 'UserController@updatePassword')->name('updatePassword');
Route::post('removeUser/{id}', 'UserController@removeUser')->name('removeUser');





