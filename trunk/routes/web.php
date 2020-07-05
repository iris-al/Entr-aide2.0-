<?php

use Illuminate\Support\Facades\Route;

/*
toutes les requettes vers notre serveurs passent pas web.php 
make sure  to make {any}= everything
*/

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
Route::get('/','CommentsController@index');