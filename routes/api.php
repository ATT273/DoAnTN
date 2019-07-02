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


//admin login
Route::post('admin/login','UserController@postAdminLoginApi');
Route::get('admin/login','PageController@getAdminloginApi');

Route::group(['prefix'=>'admin'],function(){
	
	//DashBoard
	Route::get('dashboard','PageController@getAdminDashboardApi');

	//product
	Route::group(['prefix'=>'product'], function(){
			Route::get('danhsach','ProductController@getProductApi'); 
	});

	//Category
	Route::group(['prefix'=>'category'], function(){
		Route::get('danhsach-danhmuc',['as'=>'danhmuc', 'uses'=>'CategoryController@getDanhSachApi']);
		Route::post('add','CategoryController@postAddApi');

		Route::post('edit/{id}','CategoryController@postEditApi');

		Route::get('del/{id}','CategoryController@getDelApi');
	});

	//ProductType
	Route::group(['prefix'=>'product_type'], function(){
		Route::get('danhsach-loaisp',['as'=>'loaisp', 'uses'=>'ProductTypeController@getDanhsachApi']);
		Route::post('add','ProductTypeController@postAddApi');
		Route::post('edit/{id}','ProductTypeController@postEditApi');
		Route::get('del/{id}','ProductTypeController@getDelApi');
	});
});

