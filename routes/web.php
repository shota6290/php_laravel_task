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
Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::get('news', 'Admin\NewsController@index')->middleware('auth'); // 追記
    Route::get('news/edit','Admin\NewsController@edit')->middleware('auth');
    Route::get('news/delete','Admin\NewsController@delete')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create'); # 追記
    Route::post('news/edit','Admin\NewsController@update')->middleware('auth');
    
    Route::get('profile', 'Admin\ProfilesController@index')->middleware('auth'); // 追記
    Route::get('profile/create', 'Admin\ProfilesController@add')->middleware('auth');
    Route::get('profile/delete', 'Admin\ProfilesController@delete')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfilesController@edit')->middleware('auth');
    Route::post('profile/create', 'Admin\ProfilesController@create')->middleware('auth');
    Route::post('profile/edit', 'Admin\ProfilesController@update')->middleware('auth');
    

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
