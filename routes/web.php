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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/departments', 'HomeController@showDepartments')->name('department');
Route::get('/shop', 'HomeController@showShop')->name('shop');
Route::get('/category/{slug}', 'HomeController@catList')->name('catList');
Route::get('/departments-doctors/{slug}', 'HomeController@DeptDocList')->name('deptDoctor.show');
Route::get('/departments-doctors/profile/{id}', 'HomeController@DocProfile')->name('DocProfile.show');


//authentication
Route::get('/login', 'AuthController@loginForm')->name('auth.login');
Route::post('/login', 'AuthController@LoginProcess');
Route::get('/register', 'AuthController@RegisterForm')->name('patient.register');
Route::post('/register', 'AuthController@RegisterProcess');
Route::get('/doctor/register', 'AuthController@DocRegisterForm')->name('doctor.register');
Route::post('/doctor/register', 'AuthController@DocRegisterProcess');

//cart
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart', 'CartController@AddToCart');
Route::post('/cart/increase', 'CartController@IncreaseCart')->name('increase.cart');
Route::post('/cart/decrease', 'CartController@DecreaseFromCart')->name('decrease.cart');
Route::post('/cart/remove', 'CartController@RemoveFromCart')->name('remove.cart');
Route::get('/cart/clear', 'CartController@ClearFromCart')->name('clear.cart');


//Authenticated User
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');


//    Doctors
    Route::group(['middleware' => 'doctor'], function () {
        Route::get('/doctor/verify/license', 'doctorsController@verify')->name('license.verify');
        Route::put('/doctor/verify/{id}/license', 'doctorsController@verifyKey')->name('license.update');
        Route::group(['middleware' => 'verified'], function () {
            Route::get('/account', 'AccountController@index')->name('myProfile');
            Route::get('/account/doctor/information', 'doctorsController@DocAccountInformation')->name('docAccount.information');
            Route::get('/account/doctor/license/update', 'doctorsController@licenseUpdateForm')->name('licenseForm.update');
            Route::put('/account/doctor/license/{id}/update', 'doctorsController@licenseUpdate')->name('licenseKey.update');
            Route::get('/account/doctor/info/{id}/update', 'doctorsController@UpdateInfoShow')->name('info.show');
            Route::put('/account/doctor/info/{id}/update', 'doctorsController@InfoUpdate')->name('info.update');
            Route::get('/account/doctor/working-hours', 'doctorsController@shoeWorkingHours')->name('hours.show');
            Route::post('/account/doctor/working-hours', 'doctorsController@SetHours');
        });
    });


//    Verified User
    Route::group(['middleware' => 'verified'], function () {
        Route::get('/account', 'AccountController@index')->name('myProfile');
        Route::get('/account/patient/information', 'AccountController@PatientAccountInformation')->name('account.information');
        Route::get('/account/info/{id}/update', 'AccountController@UserUpdateInfoShow')->name('UserInfo.show');
        Route::put('/account/info/{id}/update', 'AccountController@UserInfoUpdate')->name('UserInfo.update');


        //Appointments
        Route::get('/doctor-appointment/{id}','AppointmentController@showAppointment')->name('appointment');
        Route::post('/doctor-appointment/{id}','AppointmentController@appointmentStore');
        Route::get('/account/appointment-info','AppointmentController@MyAppointments')->name('myAppointments');


        //Checkout
        Route::get('/checkout', 'CheckoutController@index')->name('checkout');
        Route::post('/checkout', 'CheckoutController@CheckoutProcess');

        //order
        Route::get('/account/myOrder', 'AccountController@showOrder')->name('myOrder');
        Route::get('/account/OrderDetails/{id}', 'AccountController@OrderDetails')->name('orderDetails');
        Route::get('/account/OrderDetails/{id}/invoice', 'AccountController@generatePdf')->name('order.pdf');
    });


//    Admin
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard', 'DashboardController@showDashboard')->name('dashboard');
        Route::get('/dashboard/orderDetails/{id}/invoice', 'DashboardController@createPdf')->name('pdf.create');
        Route::resource('/dashboard/departments', 'departmentsController');
        Route::resource('/dashboard/orders', 'OrdersController');
        Route::resource('/dashboard/categories', 'categoriesController');
        Route::resource('/dashboard/products', 'ProductsController');
        Route::resource('/dashboard/doctors', 'adminDoctorsController');
        Route::resource('/dashboard/appointments', 'adminAppointmentsController');
    });
});
