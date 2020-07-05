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
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//les routes pour les annonces 
Route::get('/annonces', 'AdController@index')->name('ad.index');
Route::get('/annonce','AdController@create')->name('ad.create');
Route::post('/annonce','AdController@store')->name('ad.store');
Route::post('/search', 'AdController@search')->name('ad.search');
//pour les messages
Route::get('/message/{annonceur_id}/{ad_id}','MessageController@create')->name('message.create');
Route::post('/message','MessageController@store')->name('message.store');