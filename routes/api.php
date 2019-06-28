<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// //Logout
// Route::group(['middleware' => 'auth:api'],function(){
// 	Route::get('logout','UserController@getLogout');
// 	// Route::post('admin/login','UserController@postAdminLogin');
// 	Route::get('admin/login','PageController@getAdminlogin');
// });

