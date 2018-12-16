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


use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return Redirect::to('/doc/index.html');
});
Route::get('/thanks', 'HomeController@thanks');
Route::get('/home', 'HomeController@index');
Auth::routes();
