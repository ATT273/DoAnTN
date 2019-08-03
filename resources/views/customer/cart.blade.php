@extends('layouts.customer.customer_layout')
@section('content')
<div class="container" id="content">
    <div class="cart-title">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <p><h4><strong>Your Cart</strong> - @if(Session::has('cart')){{$cart->totalQty}}@elseif(!Session::has('cart')){{0}}@endif items</h4></p>        
            </div>
            @if(Session::has('cart'))
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 pull-right" style="margin-top: 10px;">
                <a href="cart-delete"><button type="button" class="btn btn-danger pull-right">Delete Cart</button></a>
                <a href="checkout"><button type="button" class="btn btn-success pull-right">To Checkout</button></a>
            </div>
            @endif
        </div>
        <div class="cart">
            @if(Session::has('cart'))
                @foreach($items as $item)
                    <div class="cart-item">
                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <img src="upload/product/{{$item['item']->productimg->first()->name}}" width="150">
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                <h5><a href="product/{{$item['item']['id']}}">{{$item['item']['name']}}</a></h5>
                                <div class="item-price">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            @money($item['item']['price']) &nbsp;
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sub-1-{{$item['item']['id']}}">-</span>
                                                <input type="text" class="form-control qty" name="qty" id="qty-{{$item['item']['id']}}" value="{{$item['qty']}}" style="width: 50px;" disabled>
                                                <span class="input-group-addon" id="add-1-{{$item['item']['id']}}">+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="delete-item">
                                    <a href="cart-item-delete/{{$item['item']['id']}}">
                                        <i class="fa fa-2x fa-trash-o pull-right status-danger" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="sub-total">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">
                            <div><h4><strong>Subtotal: </strong><span class="pull-right" id="sub-total">@money($cart->totalPrice)</span></h4></div>
                        </div>
                    </div>
                </div>
            @elseif(!Session::has('cart'))
                <h4>No items in your cart</h4>
            @endif
        </div>
    </div>
</div>
 <!-- #content -->
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){

        @if(Session::has('cart'))
            @foreach ($items as $item)
               $('#sub-1-{{$item['item']['id']}}').click(function(){
                    var qty = $('#qty-{{$item['item']['id']}}').val();
                    var int_qty = parseInt(qty);
                    if(int_qty > 1){
                        int_qty--;
                        $('input#qty-{{$item['item']['id']}}').val(int_qty);
                        $('#sub-total').load('sub-one/{{$item['item']['id']}}');
                     }
                     if(int_qty <= 1){
                        int_qty = 1;
                     }
                   
                });
               $('#add-1-{{$item['item']['id']}}').click(function(){
                    var qty = $('#qty-{{$item['item']['id']}}').val();
                    var int_qty = parseInt(qty);
                    if(int_qty >= 10){
                         int_qty = 10;
                     }
                     if(int_qty < 10){
                        int_qty++;
                        $('input#qty-{{$item['item']['id']}}').val(int_qty);
                        $('#sub-total').load('add-one/{{$item['item']['id']}}');
                     }
                });
            @endforeach
        @endif

    });
    
    setInterval(function(){
        $('#cart-button').load('reload-mini');
    },1000);
</script>
@endsection

