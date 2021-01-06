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

Route::get('/login/google', 'loginController@google')->name('google-login');
Route::get('/login/google/redirect', 'loginController@googleRedirect')->name('googleReditrect');

Route::get('/logout', 'logoutController@destroy')->name('logout');

Route::group(['middleware' => ['sess']], function(){

    Route::get('/home', 'homeController@home')->name('home');
    Route::get('/home/admin', 'adminController@home')->name('admin');
    Route::get('/home/admin/profile', 'adminController@home')->name('profile');


    //Admin Routes

    //***************************************** Users ******************************** */

    
    Route::get('/home/admin/Profile', 'adminController@profile')->name('admin_profile');
    Route::post('/home/admin/Profile', 'adminController@profile_edited')->name('admin_profileEdited');

    Route::get('/home/admin/Manager_List', 'adminController@seeManagers')->name('admin_seeManagers');
    Route::get('/home/admin/Seller_List', 'adminController@seeSellers')->name('admin_seeSellers');
    Route::get('/home/admin/Farmer_List', 'adminController@seeFarmers')->name('admin_seeFarmers');

    Route::get('/home/admin/Add_Manager', 'adminController@addManager')->name('admin_addManager');
    Route::post('/home/admin/Add_Manager', 'adminController@addedManager')->name('admin_addedManager');
    Route::get('/home/admin/Add_seller', 'adminController@addSeller')->name('admin_addSeller');
    Route::post('/home/admin/Add_seller', 'adminController@addedSeller')->name('admin_addedSeller');    
    Route::get('/home/admin/Add_Farmer', 'adminController@addFarmer')->name('admin_addFarmer');
    Route::post('/home/admin/Add_Farmer', 'adminController@addedFarmer')->name('admin_addedFarmer');

    Route::get('/home/admin/Customize_Manager', 'adminController@customizeManager')->name('admin_customizeManager');
    Route::get('/home/admin/Edit_Manager/{id}', 'adminController@editManager')->name('admin_editManager');
    Route::post('/home/admin/Edit_Manager/{id}', 'adminController@editedManager')->name('admin_editedManager');
    Route::get('/validityManager', 'adminController@validityManager');
    Route::get('/deleteManager{id}', 'adminController@deleteManager');

    Route::get('/home/admin/Customize_Seller', 'adminController@customizeSeller')->name('admin_customizeSeller');
    Route::get('/home/admin/Edit_Seller/{id}', 'adminController@editSeller')->name('admin_editSeller');
    Route::post('/home/admin/Edit_Seller/{id}', 'adminController@editedSeller')->name('admin_editedSeller');
    Route::get('/validitySeller', 'adminController@validitySeller');
    Route::get('/deleteSeller{id}', 'adminController@deleteSeller');

    Route::get('/home/admin/Customize_Farmer', 'adminController@customizeFarmer')->name('admin_customizeFarmer');
    Route::get('/home/admin/Edit_Farmer/{id}', 'adminController@editFarmer')->name('admin_editFarmer');
    Route::post('/home/admin/Edit_Farmer/{id}', 'adminController@editedFarmer')->name('admin_editedFarmer');
    Route::get('/validityFarmer', 'adminController@validityFarmer');
    Route::get('/deleteFarmer{id}', 'adminController@deleteFarmer');

//********************************************* Categories ***************************************** */
    Route::get('/home/admin/Add_Category', 'adminController@addCategory')->name('admin_addCategory');
    Route::post('/home/admin/Add_Category', 'adminController@addedCategory')->name('admin_addedCategory');
    Route::get('/home/admin/See_Categories', 'adminController@seeCategories')->name('admin_seeCategories');
    Route::get('/home/admin/Edit_Category/{id}', 'adminController@editCategory')->name('admin_editCategory');
    Route::post('/home/admin/Edit_Category/{id}', 'adminController@editedCategory')->name('admin_editedCategory');
    Route::get('/admin/deleteCategory{id}', 'adminController@deletedCategory');

//********************************************* Products ****************************************** */
    Route::get('/home/admin/ADD_Product', 'adminController@addProduct')->name('admin_addProduct');
    Route::post('/home/admin/ADD_Product', 'adminController@addedProduct')->name('admin_addedProduct');
    Route::get('/home/admin/See_Product', 'adminController@seeProduct')->name('admin_seeProduct');
    Route::get('/home/admin/Customize_Products', 'adminController@customizeProducts')->name('admin_customizeProducts');
    Route::get('/home/admin/Edit_Product/{id}', 'adminController@editProduct')->name('admin_editProduct');
    Route::post('/home/admin/Edit_Product/{id}', 'adminController@editedProduct')->name('admin_editedProduct');
    Route::get('/home/admin/Delete_Product/{id}', 'adminController@deleteProduct')->name('admin_deleteProduct');
    Route::post('/home/admin/Delete_Product/{id}', 'adminController@deletedProduct')->name('admin_deletedProduct');

//********************************************** Notifications ************************************** */
    Route::get('/home/admin/Check_Notifications', 'adminController@checkNotifications')->name('admin_checkNotifications');
    Route::get('/accepted{id}', 'adminController@accepted');
    Route::get('/rejected{id}', 'homeController@rejected');

//*********************************************** Reports **************************************************** */

    Route::get('/home/admin/salesReport', 'adminController@salesReport')->name('admin_salesReport');
    Route::get('/home/admin/purchaseReport', 'adminController@purchaseReport')->name('admin_purchaseReport');



    //******************************************* Manager **************************************************** */
    
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
    Route::post('/home/Customize_Products', 'LiveSearch@index1');
    Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
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
