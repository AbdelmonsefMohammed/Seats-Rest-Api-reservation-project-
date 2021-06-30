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

    Route::get('/getbranches/{category}', 'Api\BranchApiController@getBranchesByCategory');
    
    // Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
});
