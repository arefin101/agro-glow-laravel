<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('landing');})->name('landing');

Route::get('/register', 'loginController@register')->name('register');
Route::post('/register', 'loginController@registered')->name('registered');

Route::get('/login', 'loginController@login')->name('login');
Route::post('/login', 'loginController@verify')->name('verify');

Route::get('/logout', 'logoutController@destroy')->name('logout');

Route::group(['middleware' => ['sess']], function(){

    Route::get('/home', 'homeController@home')->name('home');
    Route::get('/home/Seller_List', 'homeController@seeSellers')->name('seeSellers');
    Route::get('/home/Farmer_List', 'homeController@seeFarmers')->name('seeFarmers');

    Route::get('/home/Add_seller', 'homeController@addSeller')->name('addSeller');
    Route::post('/home/Add_seller', 'homeController@addedSeller')->name('addedSeller');    
    Route::get('/home/Add_Farmer', 'homeController@addFarmer')->name('addFarmer');
    Route::post('/home/Add_Farmer', 'homeController@addedFarmer')->name('addedFarmer');
    
    Route::get('/home/Customize_Seller', 'homeController@customizeSeller')->name('customizeSeller');

    Route::get('/home/Edit_Seller/{id}', 'homeController@editSeller')->name('editSeller');
    Route::post('/home/Edit_Seller/{id}', 'homeController@editedSeller')->name('editedSeller');
    Route::get('/validitySeller', 'homeController@validitySeller');
    Route::get('/deleteSeller{id}', 'homeController@deleteSeller');


    Route::get('/home/Customize_Farmer', 'homeController@customizeFarmer')->name('customizeFarmer');

    Route::get('/home/Edit_Farmer/{id}', 'homeController@editFarmer')->name('editFarmer');
    Route::post('/home/Edit_Farmer/{id}', 'homeController@editedFarmer')->name('editedFarmer');
    Route::get('/validityFarmer', 'homeController@validityFarmer');
    Route::get('/deleteFarmer{id}', 'homeController@deleteFarmer');


});
