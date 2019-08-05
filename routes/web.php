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

	//index
	Route::get('index','PageController@getIndex');
	//ProductType
	Route::get('loai-sp','PageController@getLoaisp');
	//Prodct Detail
	Route::get('product/{id}','PageController@getDetailProduct');
	// Comment
	Route::post('add-comment','CommentController@postAddComment');
	//Other
	Route::get('lien-he','PageController@lienHe');
	Route::get('gioi-thieu','PageController@gioiThieu');
	//search item
	Route::get('search', 'PageController@getSearch');
	Route::get('category/{category}/{id}','PageController@getCategory');
	Route::get('product_type/{productType}/{id}','PageController@getProductType');
	//cart
	Route::get('add-to-cart/{id}','PageController@getAddToCart');
	Route::get('add-one/{id}','PageController@addOneItem');
	Route::get('sub-one/{id}','PageController@subOneItem');
	Route::get('cart-item-delete/{id}','PageController@getDeleteItem');
	Route::get('cart-delete','PageController@getDeleteCart');
	Route::get('reload-mini','PageController@reloadMiniCart');
	Route::get('view-cart','PageController@getCartView');

	// checkout
	Route::get('checkout','PageController@getCheckOut');
	Route::post('post-placeorder','PageController@postPlaceOrder');
	Route::get('apply-code','PageController@applyPromoCode');

	// Compare items
	Route::get('compare/{id}','PageController@addToComparisonList');
	Route::get('del-compare/{id}','PageController@delComparisonItem');
	Route::get('load-button','PageController@loadButton');

	
	// Profile
	Route::get('profile/{id}','PageController@getProfile');
	//register
	Route::get('register','PageController@getRegister');
	Route::post('register','UserController@postRegister');
	//Login
	Route::get('login','PageController@getlogin');
	Route::post('login','UserController@postLogin');
	//Logout
	Route::get('logout','UserController@getLogout');

	// for debug
	Route::get('del-session', 'PageController@getdelsession');
	Route::get('session','PageController@getAddToCart2');

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
		Route::get('danhsach-loaisp','ProductTypeController@getDanhsach');
		Route::get('add','ProductTypeController@getAdd');
		Route::post('add','ProductTypeController@postAdd');

		Route::get('edit/{id}','ProductTypeController@getEdit');
		Route::post('edit/{id}','ProductTypeController@postEdit');

		Route::get('del/{id}','ProductTypeController@getDel');

		Route::get('search','ProductTypeController@getSearchProductType');
	});

	//Product
	Route::group(['prefix'=>'product'], function(){
		Route::get('danhsach-sp','ProductController@getDanhsach');
		Route::get('add','ProductController@getAdd');
		Route::post('add','ProductController@postAdd');
		
		Route::get('edit/{id}','ProductController@getEdit');
		Route::post('edit/{id}','ProductController@postEdit');

		Route::get('del/{id}','ProductController@getDel');

		Route::get('search','ProductController@getSearchProduct');

		// Route::get('test','ProductController@testP');
	});

	//Tag
	Route::group(['prefix'=>'tag'], function(){
		Route::get('danhsach-tag','TagController@getDanhsach');
		Route::get('add','TagController@getAdd');
		Route::post('add','TagController@postAdd');

		Route::get('edit/{id}','TagController@getEdit');
		Route::post('edit/{id}','TagController@postEdit');

		Route::get('del/{id}','TagController@getDel');

		Route::get('search','TagController@getSearchTag');
	});
	//Promo Code
	Route::group(['prefix'=>'promo_code'], function(){
		Route::get('danhsach-code','PromoCodeController@getDanhsach');
		Route::get('add','PromoCodeController@getAdd');
		Route::post('add','PromoCodeController@postAdd');

		Route::get('edit/{id}','PromoCodeController@getEdit');
		Route::post('edit/{id}','PromoCodeController@postEdit');

		Route::get('del/{id}','PromoCodeController@getDel');

		Route::get('search','PromoCodeController@getSearchCode');
	});
	//Product Image
	Route::group(['prefix' => 'img_product'],function(){
		Route::get('del/{id}','ProductController@getDeleteImage');
	});
	//Category
	Route::group(['prefix'=>'category'], function(){
		Route::get('danhsach-danhmuc','CategoryController@getDanhsach');
		Route::get('add','CategoryController@getAdd');
		Route::post('add','CategoryController@postAdd');

		Route::get('edit/{id}','CategoryController@getEdit');
		Route::post('edit/{id}','CategoryController@postEdit');

		Route::get('del/{id}','CategoryController@getDel');

		Route::get('search','CategoryController@getSearchCategory');
	});

	//Slide
	Route::group(['prefix'=>'slide'], function(){
		Route::get('danhsach-banner','SlideController@getDanhsach');

		Route::get('add','SlideController@getAdd');
		Route::post('add','SlideController@postAdd');

		Route::get('edit/{id}','SlideController@getEdit');
		Route::post('edit/{id}','SlideController@postEdit');

		Route::get('del/{id}','SlideController@getDel');
	});
	//News
	Route::group(['prefix'=>'news'], function(){
		Route::get('danhsach-news','NewsController@getDanhsach');

		Route::get('add','NewsController@getAdd');
		Route::post('add','NewsController@postAdd');

		Route::get('edit/{id}','NewsController@getEdit');
		Route::post('edit/{id}','NewsController@postEdit');

		Route::get('del/{id}','NewsController@getDel');
		Route::get('delImage/{id}','NewsController@getDelImage');

		Route::get('search','NewsController@getSearchNews');
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

		Route::get('search','UserController@getSearchUser');
	});

	
	// Report
	Route::group(['prefix' => 'report'],function(){
		Route::get('menu','ReportController@getMenu');

		Route::get('weekly-report','ReportController@getWeeklyReport');
		Route::get('monthly-report','ReportController@getMonthlyReport');
		Route::get('daily-report/today','ReportController@getDailyReportToday');
		Route::post('daily-report/other','ReportController@getDailyReportOther');

		Route::get('export-report/{type}','ReportController@getExport');
		// Route::get('export-weekly-report','ReportController@getExportReport');
	});
});