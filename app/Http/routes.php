<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('convert', 'ApiController@convert');
Route::get('home', 'ApiController@index');
Route::get('test', function(){
    $str = 'sdssdsd';
    $str = mb_convert_encoding($str, "UTF-8", "ANSI");
    echo $str;
});
