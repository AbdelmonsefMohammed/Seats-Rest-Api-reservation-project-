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
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'dashboard' . '.'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('categories'    ,'CategoryController');
    Route::resource('restaurants'   ,'RestaurantController');
    Route::resource('branches'      ,'BranchController');

    
    Route::get('/customers'         , 'CustomersController@index')->name('customers.index');
    Route::get('/reservations'      , 'ReservationController@index')->name('reservations.index');

    // ajax
    Route::get('/getcities/{governorate}', 'BranchController@getcities')->name('getcities');
});


