<?php

use Illuminate\Support\Facades\Route;
use App\product;
use App\user;


Route::get('/', function () { 

    $products = product::all();
    return view('landing')->with('product', $products);

})->name('landing');

Route::get('/register', 'loginController@register')->name('register');
Route::post('/register', 'loginController@registered')->name('registered');

Route::get('/login', 'loginController@login')->name('login');
Route::post('/login', 'loginController@verify')->name('verify');

Route::get('/logout', 'logoutController@destroy')->name('logout');

Route::group(['middleware' => ['sess']], function(){

    Route::get('/home', 'homeController@home')->name('home');
    Route::get('/home/Seller_List', 'homeController@seeSellers')->name('seeSellers');
    Route::get('/home/Farmer_List', 'homeController@seeFarmers')->name('seeFarmers');
    Route::get('/home/Profile', 'homeController@profile')->name('profile');
    Route::post('/home/Profile', 'homeController@profile_edited')->name('profile_edited');

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

    Route::get('/home/Add_Category', 'homeController@addCategory')->name('addCategory');
    Route::post('/home/Add_Category', 'homeController@addedCategory')->name('addedCategory');
    Route::get('/home/See_Categories', 'homeController@seeCategories')->name('seeCategories');
    Route::get('/home/Edit_Category/{id}', 'homeController@editCategory')->name('editCategory');
    Route::post('/home/Edit_Category/{id}', 'homeController@editedCategory')->name('editedCategory');
    Route::get('/deleteCategory{id}', 'homeController@deletedCategory');

    Route::get('/home/ADD_Product', 'homeController@addProduct')->name('addProduct');
    Route::post('/home/ADD_Product', 'homeController@addedProduct')->name('addedProduct');

    Route::get('/home/Customize_Products', 'homeController@customizeProducts')->name('customizeProducts');
    Route::get('/home/Edit_Product/{id}', 'homeController@editProduct')->name('editProduct');
    Route::post('/home/Edit_Product/{id}', 'homeController@editedProduct')->name('editedProduct');
    Route::get('/home/Delete_Product/{id}', 'homeController@deleteProduct')->name('deleteProduct');
    Route::post('/home/Delete_Product/{id}', 'homeController@deletedProduct')->name('deletedProduct');

    Route::get('/home/Check_Notifications', 'homeController@checkNotifications')->name('checkNotifications');
    Route::get('/accepted{id}', 'homeController@accepted');
    Route::get('/rejected{id}', 'homeController@rejected');

    Route::get('/downloadPDF','homeController@downloadPDF')->name('pdf');

});

Route::group(['middleware' => ['verifyFarmer']], function(){

    Route::get('/Add_Cart/{productId}', 'cartController@addCart')->name('addCart');
    Route::post('/Add_Cart/{productId}', 'cartController@addedCart')->name('addedCart');

});
