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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=> true]);

Route::get('/','HomeController@index')->name('home');
Route::get('/departments','HomeController@showDepartments')->name('department');
Route::get('/shop','HomeController@showShop')->name('shop');
Route::get('/category/{slug}','HomeController@catList')->name('catList');

//authentication
Route::get('/login','AuthController@loginForm')->name('auth.login');
Route::post('/login','AuthController@LoginProcess');
Route::get('/register','AuthController@RegisterForm')->name('patient.register');
Route::post('/register','AuthController@RegisterProcess');
Route::get('/doctor/register','AuthController@DocRegisterForm')->name('doctor.register');
Route::post('/doctor/register','AuthController@DocRegisterProcess');

//cart
Route::get('/cart','CartController@index')->name('cart');
Route::post('/cart','CartController@AddToCart');
Route::post('/cart/decrease','CartController@DecreaseFromCart')->name('decrease.cart');
Route::post('/cart/remove','CartController@RemoveFromCart')->name('remove.cart');
Route::get('/cart/clear','CartController@ClearFromCart')->name('clear.cart');

Route::group(['middleware' => 'auth' ], function (){
    Route::get('/logout','AuthController@logout')->name('logout');
    Route::get('/account','AccountController@index')->name('myProfile');
    //Checkout
    Route::get('/checkout','CheckoutController@index')->name('checkout');
    Route::post('/checkout','CheckoutController@CheckoutProcess');
//    order
    Route::get('/account/myOrder','AccountController@showOrder')->name('myOrder');
    Route::get('/account/OrderDetails/{id}','AccountController@OrderDetails')->name('orderDetails');
    Route::get('/account/OrderDetails/{id}/invoice','AccountController@generatePdf')->name('order.pdf');

    Route::group(['middleware' => 'admin' ], function (){
        Route::get('/dashboard','DashboardController@showDashboard')->name('dashboard');
        Route::resource('/dashboard/departments','departmentsController');
        Route::resource('/dashboard/orders','OrdersController');
        Route::resource('/dashboard/categories','categoriesController');
        Route::resource('/dashboard/products','ProductsController');
    });
});
