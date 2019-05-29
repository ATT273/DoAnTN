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

//login
	// Route::get('login','UserController@getLogin');
	// Route::post('login','UserController@postLogin');
	// Route::get('logout','UserController@getLogout');
	// //register
	// Route::get('register','PageController@getRegister');
	// Route::post('register','UserController@postRegister');
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

//Login
Route::get('login','PageController@getlogin');
Route::post('login','UserController@postLogin');
//Logout
Route::get('logout','UserController@getLogout');

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
		Route::get('danhsach-sp',['as'=>'sp', 'uses'=>'ProductController@getDanhsach']);
		Route::get('add',['as'=>'addsp', 'uses'=>'ProductController@getAdd']);
		Route::post('add','ProductController@postAdd');
		
		Route::get('edit/{id}','ProductController@getEdit');
		Route::post('edit/{id}','ProductController@postEdit');

		Route::get('del/{id}','ProductController@getDel');
	});
	//Product Image
	Route::group(['prefix' => 'img_product'],function(){
		Route::get('del/{id}','ProductController@getImgDel');
	});
	//Category
	Route::group(['prefix'=>'category'], function(){
		Route::get('danhsach-danhmuc',['as'=>'danhmuc', 'uses'=>'CategoryController@getDanhsach']);
		Route::get('add',['as'=>'adddanhmuc', 'uses'=>'CategoryController@getAdd']);
		Route::post('add','CategoryController@postAdd');

		Route::get('edit/{id}','CategoryController@getEdit');
		Route::post('edit/{id}','CategoryController@postEdit');

		Route::post('del/{id}','CategoryController@postDel');
	});

	//Slide
	Route::group(['prefix'=>'slide'], function(){
		Route::get('danhsach-slide',['as'=>'slide', 'uses'=>'SlideController@getDanhsach']);
		Route::get('add',['as'=>'addslide', 'uses'=>'SlideController@getAdd']);
	});

	//Bill
	Route::group(['prefix'=>'bill'], function(){
		Route::get('danhsach-hoadon',['as'=>'bill', 'uses'=>'BillController@getBill']);

		Route::get('add',['as'=>'addbill', 'uses'=>'BillController@getAdd']);
		Route::post('add','BillController@postAdd');

		Route::get('edit/{id}','BillController@getEdit');
		Route::post('edit/{id}','BillController@postEdit');

		Route::get('del/{id}','BillController@getDel');
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