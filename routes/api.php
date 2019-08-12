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


///////////////////////////
//customer route//
///////////////////////////

	//index
	Route::get('index','PageController@getIndexApi');
	//ProductType
	Route::get('loai-sp','PageController@getLoaisp');
	//Prodct Detail
	Route::get('product/{id}','PageController@getDetailProduct');
	//Other
	Route::get('lien-he','PageController@lienHe');
	Route::get('gioi-thieu','PageController@gioiThieu');
	//search item
	Route::get('search', 'PageController@getSearch');
	//cart
	Route::get('add-to-cart/{id}','PageController@getAddToCart');
	Route::get('add-one/{id}','PageController@addOneItem');
	Route::get('sub-one/{id}','PageController@subOneItem');
	Route::get('reload-mini','PageController@reloadMiniCart');
	Route::get('view-cart','PageController@getCartView');
	// Compare items
	Route::get('compare/{id}','PageController@addToComparisonList');
	Route::get('del-compare/{id}','PageController@delComparisonItem');

	// for debug
	Route::get('del-session', 'PageController@getdelsession');
	Route::get('session','PageController@getAddToCart2');

	//register
	Route::post('register','UserController@postRegisterApi');
	//Login
	Route::post('login','UserController@postLoginApi');
	//Logout
	Route::get('logout','UserController@getLogout');


///////////////////////////
//admin routes//
///////////////////////////
//admin login
Route::post('admin/login','UserController@postAdminLoginApi');
Route::get('admin/login','PageController@getAdminloginApi');

Route::group(['prefix'=>'admin'],function(){
	
	//DashBoard
	Route::get('dashboard','PageController@getAdminDashboardApi');

	//product
	Route::group(['prefix'=>'product'], function(){ 
		Route::get('danhsach-sp',['as'=>'sp', 'uses'=>'ProductController@getDanhsachApi']);
	
		Route::post('add','ProductController@postAddApi');
		
		Route::post('edit/{id}','ProductController@postEdit');

		Route::get('del/{id}','ProductController@getDelApi');

		Route::get('search','ProductController@getSearchProduct');
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

	//Tag
	Route::group(['prefix'=>'tag'], function(){
		Route::get('danhsach-tag',['as'=>'tag', 'uses'=>'TagController@getDanhsachApi']);

		Route::post('add','TagController@postAddApi');


		Route::post('edit/{id}','TagController@postEditApi');

		Route::get('del/{id}','TagController@getDelApi');
	});

	//Bill
	Route::group(['prefix'=>'bill'], function(){
		Route::get('danhsach-bill','BillController@getDanhsachApi');

		Route::get('add','BillController@getAdd');
		Route::post('add','BillController@postAdd');

		Route::get('edit/{id}','BillController@getEdit');
		Route::post('edit/{id}','BillController@postEdit');

		Route::get('del/{id}','BillController@getDel');


		//BIll detail
		Route::get('detail/{id}','BillController@getDetailApi');
		Route::get('confirm/{id}','BillController@getConfirmApi');
	});

	//Users
	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach-users','UserController@getDanhsachApi');

		Route::get('p/{id}','UserController@getUserProfileApi');

		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');

		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');

		Route::get('del/{id}','UserController@getDel');

		Route::get('search','UserController@getSearchUser');
	});

	//Promo Code
	Route::group(['prefix'=>'promo_code'], function(){
		Route::get('danhsach-code','PromoCodeController@getDanhsachApi');
		Route::post('add','PromoCodeController@postAddApi');

		
		Route::post('edit/{id}','PromoCodeController@postEditApi');

		Route::get('del/{id}','PromoCodeController@getDelApi');

		Route::get('search','PromoCodeController@getSearchCode');
	});

	// Report
	Route::group(['prefix' => 'report'],function(){

		Route::get('weekly-report','ReportController@getWeeklyReportApi');
		Route::get('monthly-report','ReportController@getMonthlyReportApi');
		Route::get('daily-report/today','ReportController@getDailyReportTodayApi');
		Route::post('daily-report/other','ReportController@getDailyReportOtherApi');
	});
});

