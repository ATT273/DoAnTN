<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Bill;
use App\BillDetail;
use App\Category;
use App\Product;
use App\Slide;
use App\ProductType;
use App\ProductImage;
use App\PromoCode;
use App\Tag;
use App\Cart;
use App\Compare;
use Validator;
use Session;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //////////////////////
    // re-used function////
    /// //////////////////

    // money formating
    public function money($m){
       return number_format($m).' VND';
    }
    // reload mini cart
    public function ajaxReloadCart($totalQty, $totalPrice, $items){
        echo '  <button type="button" class="btn btn-default">
                    <a href="view-cart">
                        <i class="fa fa-shopping-cart fa-lg"></i>
                        <div class="item-number">'
                            .$totalQty.
                        '</div>
                    </a>
                </button>';
        echo   '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>';
        echo '  <ul class="dropdown-menu cart-items-list" id="cart-items-list">';
        foreach($items as $item){
            $price = $this->money($item['item']['price']);
            $promo_price = $this->money($item['item']['promo_price']);
            echo '  <li>
                    <div class="row" style="margin-left:0; margin-top:10px;">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="upload/product/'.$item['item']->productimg->first()->name.'" width="100" />
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="row">
                                <a href="product/'.$item['item']['id'].'"><strong>'.$item['item']['name'].'</strong></a>
                            </div>';
            if($item['item']['promo_price'] != 0){
                echo    '<div class="row">
                                <strike>'.$price.'</strike> X '.$item['qty'].'
                        </div>
                        <div class="row status-danger">
                            '.$promo_price.' X '.$item['qty'].'
                        </div>';
            }
            else{
                echo    '<div class="row">'
                            .$price.' X '.$item['qty'].
                        '</div>';
            }
            echo  '</div></div></li>';
                            
        }
        echo '  <li><a><strong>Subtotal:</strong>&nbsp; <div class="pull-right">'.$totalPrice.'</div></a></li>
                <li role="separator" class="divider"></li><li><a href="checkout">To Checkout</a></li></ul>';
    }

    // reload comparison list
    public function ajaxReloadComparionList($items){
        foreach ($items as $item) { 
            $price = $this->money($item['item']['price']);
            $promo_price = $this->money($item['item']['promo_price']);
            echo'<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 .compare-item">
                    <div class="compare-item-del">
                        <button type="button" class="btn btn-default" id="del-item-'.$item['item']['id'].'">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="compare-img">
                        <img src="upload/product/'.$item['item']->productimg->first()->name.'" height="100">
                    </div>
                    <hr>
                    <h5><strong>'.$item['item']['name'].'</strong></h5>
                    <div class="compare-detail">
                        <div class="row">
                            <div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Product ID:</div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">'.$item['item']['id'].'</div>
                            </div>
                            <div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">In Stock:</div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">'.$item['item']['quantity'].'</div>
                            </div>
                            <div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Price:</div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">'.$price.'</div>
                            </div>
                            <div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">Promo Price:</div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">'.$promo_price.'</div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }







    public function getAdminDashboard(){
        $user = User::all();
        $bill = Bill::all();
    	return view('admin.dashboard.dashboard',['users'=>$user, 'bills'=>$bill]);
    }
    // Admin login
    public function getAdminlogin(){
    	return view('layouts.admin.admin_login');
    }
    // Customer login
    public function getlogin(){
        $categories = Category::all();
        $oldCart  = Session::get('cart');
        $cart = new Cart($oldCart);
    	return view('customer.login',['categories' => $categories,'cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getRegister(){
        $categories = Category::all();
        $oldCart  = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('customer.register',['categories' => $categories,'cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    // profile
    public function getProfile($id){
        $user = User::findOrFail($id);
        $bills = Bill::where('user_id',$id)->get();
        $oldCart  = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('customer.profile',['user' => $user, 'bills' => $bills, 'cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    // Index
    public function getIndex(){
        $categories = Category::all();
        $newProducts = Product::orderBy('id','DESC')->take(4)->get();
        $topProducts = Product::orderBy('sold','DESC')->take(4)->get();
        $banners  = Slide::all();


        $oldCart  = Session::get('cart');
        $cart = new Cart($oldCart);

        $oldList  = Session::get('compare_list');
        $list = new Compare($oldList);

        return view('customer.index',['categories' => $categories, 'banners' => $banners, 'newProducts' => $newProducts, 'topProducts' => $topProducts, 'cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice, 'list' => $list]);
    }
    


    public function getDetailProduct($id){
        $product = Product::findOrFail($id);
        
        $relatedProducts = Product::where('type_id',$product->type_id)->take(4)->get();
        $categories = Category::all();
        $tags = Tag::whereIn('id',$product->tag()->allRelatedIds())->get();
        if(!Session::has('cart')){
            return view('customer.product_detail',['product' => $product, 'categories' => $categories, 'relatedProducts' => $relatedProducts, 'tags' => $tags]);
        }
        if (Session::has('cart')) {
            $oldCart  = Session::get('cart');
            $cart = new Cart($oldCart);

            return view('customer.product_detail',['product' => $product, 'categories' => $categories, 'relatedProducts' => $relatedProducts, 'tags' => $tags, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }
        
    }

    // Sorting search result
    public function getSearch(Request $request){
        $categories = Category::all();
        if(!$request->has('sort')){
            $products = Product::where('name','LIKE', '%'.$request->keyword.'%')->orWhere('price',$request->keyword)->paginate(3);
            $products->appends(['keyword' => $request->keyword]);
            return view('customer.search_result',['products' => $products, 'categories' => $categories, 'keyword' => $request->keyword]);
        }elseif ($request->has('sort')) {
            $sortBy = $request->sort;
           switch ($request->sort) {
            //latest
               case 'latest':
                    $products = Product::where('name','LIKE', '%'.$request->keyword.'%')->orWhere('price',$request->keyword)->orderBy('created_at','DESC')->paginate(3);
                    $products->appends(['keyword' => $request->keyword, 'sort' => $sortBy]);
                    return view('customer.search_result',['products' => $products, 'categories' => $categories, 'keyword' => $request->keyword]);
                    break;

            // price ascending
               case 'price-asc':
                    $products = Product::where('name','LIKE', '%'.$request->keyword.'%')->orWhere('price',$request->keyword)->orderBy('price','ASC')->paginate(3);
                    $products->appends(['keyword' => $request->keyword, 'sort' => $sortBy]);
                    return view('customer.search_result',['products' => $products, 'categories' => $categories, 'keyword' => $request->keyword]);
                   break;

            // price descending
               case 'price-desc':
                    $products = Product::where('name','LIKE', '%'.$request->keyword.'%')->orWhere('price',$request->keyword)->orderBy('price','DESC')->paginate(3);
                    $products->appends(['keyword' => $request->keyword, 'sort' => $sortBy]);
                    return view('customer.search_result',['products' => $products, 'categories' => $categories, 'keyword' => $request->keyword]);
               break;
           }
        }
        
   }

   // CART functions

    public function getAddToCart(Request $request, $id){
        $product = Product::findOrFail($id);

        //check neu session 'cart' duoc set, if duoc set -> lay 'cart', if khong -> khong lam j
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        //tao $cart = $oldCart (Cart() = __construct())
        $cart = new Cart($oldCart);

        //them san pham vao cart
        $cart->add($product, $product->id);

        //dua $cart vao session 'cart'
        Session::put('cart',$cart);

        
        // dd($cart->items);
        $this->ajaxReloadCart($cart->totalQty, $this->money($cart->totalPrice), $cart->items);
            
    }

    public function addOneItem($id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->addOne($product, $id);
        Session::put('cart',$cart);


        $totalPrice = $this->money($cart->totalPrice);

        // display and total price
        echo $totalPrice;
        
    }
    public function subOneItem($id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->subOne($product, $id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
            Session::save();
        }else{
            Session::forget('cart');
        }
        $totalPrice = $this->money($cart->totalPrice);
        // display mini cart and total price
        echo $totalPrice;
        // $this->ajaxReloadCart($cart->totalQty, $this->money($cart->totalPrice), $cart->items);
        
    }

    public function getDeleteItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->delete($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
            Session::save();
        }else{
            Session::forget('cart');
        }
        
        return redirect('view-cart');
    }

    public function getDeleteCart(Request $request){
        $request->session()->forget('cart');
        return redirect('index');
    }
    public function reloadMiniCart(){
        $oldCart =  Session::get('cart');
        $cart = new Cart($oldCart);
        $this->ajaxReloadCart($cart->totalQty, $this->money($cart->totalPrice), $cart->items);
    }
    public function getCartView(){

        if(!Session::has('cart')){
            return view('customer.cart');
        }
        if(Session::has('cart')){
            $oldCart  = Session::get('cart');
            $cart = new Cart($oldCart);
            return view('customer.cart',['cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }
    }

    //////////////////
    // Comapre list//
    /////////////////
    public function addToComparisonList(Request $request, $id){
        $product = Product::findOrFail($id);
        $oldList = Session::has('compare_list') ? Session::get('compare_list') : null;

        //tao $list = $oldList (List() = __construct())
        $list = new Compare($oldList);

        if(count($list->items) == 3){
            echo '<div class="alert alert-danger">List is full, please delete 1 item</div>';
            $this->ajaxReloadComparionList($list->items);
        }elseif(count($list->items) < 3){
            //them san pham vao list
            $list->add($product, $product->id);

            //dua $list vao session 'compare_list'
            Session::put('compare_list',$list);
            // dd(Session::get('compare_list'));
            $this->ajaxReloadComparionList($list->items);
        }
    }

    public function delComparisonItem($id){
        $oldList = Session::has('compare_list') ? Session::get('compare_list') : null;

        //tao $list = $oldList (List() = __construct())
        $list = new Compare($oldList);
        $list->delete($id);
        Session::put('compare_list',$list);
        $this->ajaxReloadComparionList($list->items);
    }


    ////////////////////
    // Checkout//
    ////////////////
    public function getCheckOut(Request $request){
        if(Auth::check()){
            $receiver = $payer = Auth::user()->name;
            $receiver_phone = $payer_phone =  Auth::user()->phone;
            $shipping_add = $billing_add = Auth::user()->address;

            if ($request->has('change_info')) {
                if($request->change_info == 'billing'){
                    $payer = $request->payer_name;
                    $payer_phone = $request->payer_phone;
                    $billing_add = $request->billing_address;
                }elseif ($request->change_info == 'shipping') {
                    $receiver = $request->receiver_name;
                    $receiver_phone = $request->receiver_phone;
                    $shipping_add = $request->shipping_address;
                }
            }
            
            $oldCart  = Session::get('cart');
            $cart = new Cart($oldCart);
            return view('customer.checkout',['cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice, 'receiver' => $receiver, 'payer' => $payer, 'receiver_phone' => $receiver_phone, 'payer_phone' => $payer_phone, 'shipping_add' => $shipping_add, 'billing_add' => $billing_add]);
        }else{
            return redirect('login')->with('loi','Please login your account');
        }
    }

    public function applyPromoCode(Request $request){
        $oldCart  = Session::get('cart');
        $cart = new Cart($oldCart);
        $codes = PromoCode::where('name',$request->promo_code)->get();
        $code = $codes[0];
        if($code->fixed != 0){
            $amount = $code->fixed;
            if($cart->totalPrice > $amount){
                $totalAfterDicount = $cart->totalPrice - $amount;
            }elseif ($cart->totalPrice <= $amount) {
                $totalAfterDicount = 0;
            }
        }elseif ($code->percentage != 0) {
            $amount = $cart->totalPrice * $code->percentage / 100;
            $totalAfterDicount = $cart->totalPrice -  $amount;
        }

       return view('customer.checkout',['cart' => $cart, 'items' => $cart->items, 'totalPrice' => $cart->totalPrice, 'amount' => $amount, 'totalAfterDicount' => $totalAfterDicount]);
    }

    public function postPlaceOrder(Request $request){
        $oldCart  = Session::get('cart');
        $cart = new Cart($oldCart);
        $user_id = Auth::user()->id;

        $bill = new Bill;
        $bill->user_id = $user_id;
        $bill->sub_total = $cart->totalPrice;
        if($request->has('amount')){
            $bill->total = $request->total;
            $bill->discount_amount = $request->amount;
        }elseif (!$request->has('amount')) {
            $bill->total = $cart->totalPrice;
            $bill->discount_amount = 0;
        }
        
        $bill->order_date = date('Y-m-d');
        $bill->receiver = $request->receiver_name;
        $bill->receiver_phone = $request->receiver_phone;
        $bill->shipping_address = $request->shipping_address;
        $bill->payer = $request->payer_name;
        $bill->payer_phone = $request->payer_phone;
        $bill->billing_address = $request->billing_address;
        $bill->save();

        $latest_bill_id = Bill::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->first()->id;
        foreach ($cart->items as $item) {
            $bill_detail = new BillDetail;
            $bill_detail->bill_id = $latest_bill_id;
            $bill_detail->product_id = $item['item']->id;
            $bill_detail->product_name = $item['item']->name;
            $bill_detail->quantity = $item['qty'];
            $bill_detail->product_price = $item['price'] / $item['qty'];
            $bill_detail->save();
        }
        
        $request->session()->forget('cart');
        return redirect('index');

    }
    // for debug
    public function getdelsession(Request $request){
        $request->session()->flush();
    }

    //output session
    public function getAddToCart2(){
         $sid = session()->getId();
        echo $sid.'<br>';
        dd(Session::all());
        
    }
}