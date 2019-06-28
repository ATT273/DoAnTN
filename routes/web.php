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

Route::get('/', function () {
    return view('welcome');
});


///////////////////////////
//customer route//
///////////////////////////
Route::group(['middleware'],function(){
	//index
	Route::get('index',['as'=>'trang-chu','uses'=>'PageController@getIndex']);
	//ProductType
	Route::get('loai-sp',['as'=>'loaisp','uses'=>'PageController@getLoaisp']);
	//Prodct Detail
	Route::get('detail/{id}','ProductController@getDetailSp');
	//Other
	Route::get('lien-he',['as'=>'lienhe', 'uses'=>'PageController@lienHe']);
	Route::get('gioi-thieu',['as'=>'gioithieu', 'uses'=>'PageController@gioiThieu']);
	//search item
	Route::get('search', 'ProductController@getSearch');
});
//register
Route::get('register','PageController@getRegister');
Route::post('register','UserController@postRegister');
//Login
Route::get('login','PageController@getlogin');
Route::post('login','UserController@postLogin');
//Logout
Route::get('logout','UserController@getLogout');



 Route::get('last','ProductController@getLastest');

///////////////////////////
//admin routes//
///////////////////////////

//Login
Route::post('admin/login','UserController@postAdminLogin');
Route::get('admin/login','PageController@getAdminlogin');


Route::group(['prefix'=>'admin', 'middleware'=>'admin-middleware'],function(){
	
	//DashBoard
	Route::get('dashboard','PageController@getAdminDashboard');


	//ProductType
	Route::group(['prefix'=>'product_type'], function(){
		Route::get('danhsach-loaisp',['as'=>'loaisp', 'uses'=>'ProductTypeController@getDanhsach']);
		Route::get('add',['as'=>'addloaisp', 'uses'=>'ProductTypeController@getAdd']);
		Route::post('add','ProductTypeController@postAdd');

		Route::get('edit/{id}','ProductTypeController@getEdit');
		Route::post('edit/{id}','ProductTypeController@postEdit');

		Route::get('del/{id}','ProductTypeController@getDel');
	});

	//Product
	Route::group(['prefix'=>'product'], function(){
		Route::get('danhsach-sp','ProductController@getDanhsach');
		Route::get('add',['as'=>'addsp', 'uses'=>'ProductController@getAdd']);
		Route::post('add','ProductController@postAdd');
		
		Route::get('edit/{id}','ProductController@getEdit');
		Route::post('edit/{id}','ProductController@postEdit');

		Route::get('del/{id}','ProductController@getDel');

		Route::get('ajax/search','ProductController@getSearchProduct1');
	});

	//Tag
	Route::group(['prefix'=>'tag'], function(){
		Route::get('danhsach-tag','TagController@getDanhsach');
		Route::get('add','TagController@getAdd');
		Route::post('add','TagController@postAdd');

		Route::get('edit/{id}','TagController@getEdit');
		Route::post('edit/{id}','TagController@postEdit');

		Route::get('del/{id}','TagController@getDel');
	});
	//Promo Code
	Route::group(['prefix'=>'promo_code'], function(){
		Route::get('danhsach-code','PromoCodeController@getDanhsach');
		Route::get('add','PromoCodeController@getAdd');
		Route::post('add','PromoCodeController@postAdd');

		Route::get('edit/{id}','PromoCodeController@getEdit');
		Route::post('edit/{id}','PromoCodeController@postEdit');

		Route::get('del/{id}','PromoCodeController@getDel');
	});
	//Product Image
	Route::group(['prefix' => 'img_product'],function(){
		Route::get('del/{id}','ProductController@getDeleteImage');
	});
	//Category
	Route::group(['prefix'=>'category'], function(){
		Route::get('danhsach-danhmuc',['as'=>'danhmuc', 'uses'=>'CategoryController@getDanhsach']);
		Route::get('add',['as'=>'adddanhmuc', 'uses'=>'CategoryController@getAdd']);
		Route::post('add','CategoryController@postAdd');

		Route::get('edit/{id}','CategoryController@getEdit');
		Route::post('edit/{id}','CategoryController@postEdit');

		Route::get('del/{id}','CategoryController@getDel');
	});

	//Slide
	Route::group(['prefix'=>'slide'], function(){
		Route::get('danhsach-slide','SlideController@getDanhsach');
		Route::get('add','SlideController@getAdd');
	});

	//Bill
	Route::group(['prefix'=>'bill'], function(){
		Route::get('danhsach-bill','BillController@getDanhsach');

		Route::get('add','BillController@getAdd');
		Route::post('add','BillController@postAdd');

		Route::get('edit/{id}','BillController@getEdit');
		Route::post('edit/{id}','BillController@postEdit');

		Route::get('del/{id}','BillController@getDel');


		//BIll detail
		Route::get('detail/{id}','BillController@getDetail');
		Route::get('ajax/confirm/{id}','BillController@getConfirm');
	});
	//Users
	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach-users','UserController@getDanhsach');

		Route::get('p/{id}','UserController@getUserProfile');

		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');

		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');

		Route::get('del/{id}','UserController@getDel');
	});
});