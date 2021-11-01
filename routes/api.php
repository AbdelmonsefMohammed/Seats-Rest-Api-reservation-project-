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
    Route::get('/branch/{category}/show' , 'Api\BranchApiController@show');

    Route::group(['middleware' => ['auth:sanctum']], function(){

        Route::post('/logout', 'Api\AuthController@logout');     
        Route::patch('/profile', 'Api\ProfileController@updateProfileData');
        Route::post('/profile/avatar', 'Api\ProfileController@updateAvatar'); 
        Route::delete('/profile/avatar', 'Api\ProfileController@deleteAvatar'); 

        Route::post('/rate/{branch}', 'Api\RatingController@logout');

        //saved places
        Route::get('/saved_places', 'Api\SavedPlacesController@index');
        Route::post('/save_branch/{branch_id}', 'Api\SavedPlacesController@store');
        Route::post('/forget_branch/{branch_id}', 'Api\SavedPlacesController@destroy');


        Route::post('/logout', 'Api\AuthController@logout');
        
        Route::get('/authenticateduser', function (Request $request) {
            return $request->user();
        });
    });

    
});

