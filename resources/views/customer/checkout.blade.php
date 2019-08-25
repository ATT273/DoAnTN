@extends('layouts.customer.customer_layout')
@section('content')
<div class="container" id="content">
	@if(count($errors) > 0)
	    <div class="alert alert-danger">
	        @foreach ($errors ->all() as $err)
	            {{$err}}<br>
	        @endforeach
	    </div>
	@endif
	@if(session('thongbao'))
	    <div class="alert alert-success">
	        {{session('thongbao')}}
	    </div>
	@endif
	@if(session('loi'))
	    <div class="alert alert-danger">
	    {{session('loi')}}
	    </div>
	@endif
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="box box-success">
				<div class="box-head checkout">
					<h4>Products</h4>
				</div>
	    		<div class="box-body checkout">
	    			@foreach($items as $item)
	    			<div class="row checkout">
	    				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	    					<img src="upload/product/{{$item['item']->productimg->first()->name}}" width="50">
	    				</div>
	    				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
	    					<a href="product/{{$item['item']->id}}"><strong>{{$item['item']->name}}</strong></a>
	    				</div>
	    				 @if($item['item']['promo_price'] != 0)
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		    					<p>Price</p>
		    					<strike>@money($item['item']->price)</strike>
		    				</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 status-danger">
                            	<p>Promo Price</p>
                                @money($item['item']['promo_price'])
                            </div>
                        @else
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		    					<p>Price</p>
		    					@money($item['item']->price)
	    					</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		    					
		    				</div>
                        @endif
	    				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	    					<p>Quantity</p>
	    					{{$item['qty']}}
	    				</div>
	    			</div>
	    			@endforeach
	    			<div class="row">
	    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    					<div class="pull-right" style="margin-right: 10px;"><h4><strong>Subtotal: </strong>@money($totalPrice)</h4></div>
	    				</div>
	    			</div>
	    			{{-- Calculate discount --}}
	    			@if($cart->promoCode != 0)
		    			<form id="calculate-total" action="post-placeorder" method="POST">
		    				<input type="hidden" name="_token" value="{{csrf_token()}}">
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    					<div class="pull-right"><h4>- @money($cart->discountAmount)</h4></div>
			    					<input type="hidden" name="amount" value="{{$cart->discountAmount}}">
				    			</div>
				    		</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    					<div class="pull-right"><h4> = @money($cart->totalAfterDiscount)</h4></div>
			    					<input type="hidden" name="total" value="{{$cart->totalAfterDiscount}}">
				    			</div>
				    		</div>
				    	</form>
		    		@endif
	    		</div>
	    	</div>
		</div>
	</div>
	@if(Session::has('checkout_info'))
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<form id="ship-bill" action="post-placeorder" method="POST">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="box">
							<div class="box-header">
								<div class="row">
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										<h4>Shipping</h4>
									</div>
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
										<h4><button type="button" class="btn btn-success" data-toggle="modal" data-target="#shippingModal">Change</button></h4>
									</div>
								</div>
							</div>
							<div class="box-body">
								<strong>Full name: </strong>{{$checkout_info['receiver']}} - <strong>Phone number: </strong>{{$checkout_info['receiver_phone']}}<br>
								<strong>Address: </strong>{{$checkout_info['shipping_address']}}
								<input type="hidden" name="receiver_name" value="{{$checkout_info['receiver']}}">
								<input type="hidden" name="receiver_phone" value="{{$checkout_info['receiver_phone']}}">
								<input type="hidden" name="shipping_address" value="{{$checkout_info['shipping_address']}}">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="box">
							<div class="box-header">
								<div class="row">
									<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
										<h4>Billing</h4>
									</div>
									<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
										<h4><button type="button" class="btn btn-success" data-toggle="modal" data-target="#billingModal">Change</button></h4>
									</div>
								</div>
							</div>
							<div class="box-body">
								<strong>Full name: </strong>{{$checkout_info['payer']}} - <strong>Phone number: </strong>{{$checkout_info['payer_phone']}}<br>
								<strong>Address: </strong>{{$checkout_info['billing_address']}}
								<input type="hidden" name="payer_name" value="{{$checkout_info['payer']}}">
								<input type="hidden" name="payer_phone" value="{{$checkout_info['payer_phone']}}">
								<input type="hidden" name="billing_address" value="{{$checkout_info['billing_address']}}">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<form action="apply-code" method="GET">
				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						<input type="text" name="promo_code" id="promo_code" class="form-control" placeholder="Enter Promo CODE" required>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<button type="submit" class="btn btn-default" @if ($cart->promoCode == 1) disabled @endif>Apply</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="pull-right">
							<button id="submit-all" type="button" class="btn btn-danger btn-place-order"><h4>Place Order</h4></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endif
</div>
@include('layouts.customer.billing_info_modal')
@include('layouts.customer.shipping_info_modal')
 <!-- #content -->
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('#submit-all').click(function(){
			$('#calculate-total').submit();
			$('#ship-bill').submit();
		});
	});
</script>
@endsection

