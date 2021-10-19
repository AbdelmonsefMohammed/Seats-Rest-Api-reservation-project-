<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => '/v1'], function() {
    Route::post('/register', 'Api\AuthController@register');

    Route::post('/login', 'Api\AuthController@login');

    Route::post('/password/email', 'Api\AuthController@sendPasswordResetLinkEmail')->middleware('throttle:5,1');
    Route::post('/password/reset', 'Api\AuthController@resetPassword');

    Route::get('/getbranches/{category?}', 'Api\BranchApiController@getBranchesByCategory');

    Route::group(['middleware' => ['auth:sanctum']], function(){

        Route::post('/logout', 'Api\AuthController@logout');     
        Route::patch('/profile', 'Api\ProfileController@updateProfileData');
        Route::post('/profile/avatar', 'Api\ProfileController@updateAvatar'); 
        Route::delete('/profile/avatar', 'Api\ProfileController@deleteAvatar'); 
        
        Route::get('/authenticateduser', function (Request $request) {
            return $request->user();
        });
    });

    
});

