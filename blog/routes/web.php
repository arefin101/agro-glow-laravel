<?php

use Illuminate\Support\Facades\Route;

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
    return view('landing');
})->name('landing');

Route::get('/register', 'loginController@register')->name('register');
Route::post('/register', 'loginController@registered')->name('registered');

Route::get('/login', 'loginController@login')->name('login');
Route::post('/login', 'loginController@verify')->name('verify');

Route::get('/logout', 'logoutController@destroy')->name('logout');

Route::group(['middleware' => ['sess']], function(){

    Route::get('/home', 'homeController@home')->name('home');
});
