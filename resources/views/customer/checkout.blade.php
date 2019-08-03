@extends('layouts.customer.customer_layout')
@section('content')
<div class="container" id="content">
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
	    				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
	    					<a href="product/{{$item['item']->id}}"><strong>{{$item['item']->name}}</strong></a>
	    				</div>
	    				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	    					<p>Price</p>
	    					@money($item['item']->price)
	    				</div>
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
	    			@if(isset($totalAfterDicount))
		    			<form id="calculate-total" action="post-placeorder" method="POST">
		    				<input type="hidden" name="_token" value="{{csrf_token()}}">
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    					<div class="pull-right"><h4>- @money($amount)</h4></div>
			    					<input type="hidden" name="amount" value="{{$amount}}">
				    			</div>
				    		</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    					<div class="pull-right"><h4> = @money($totalAfterDicount)</h4></div>
			    					<input type="hidden" name="total" value="{{$totalAfterDicount}}">
				    			</div>
				    		</div>
				    	</form>
		    		@endif
	    		</div>
	    	</div>
		</div>
	</div>
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
								<strong>Full name: </strong>{{$receiver}} - <strong>Phone number: </strong>{{$receiver_phone}}<br>
								<strong>Address: </strong>{{$shipping_add}}
								<input type="hidden" name="receiver_name" value="{{$receiver}}">
								<input type="hidden" name="receiver_phone" value="{{$receiver_phone}}">
								<input type="hidden" name="shipping_address" value="{{$shipping_add}}">
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
								<strong>Full name: </strong>{{$payer}} - <strong>Phone number: </strong>{{$payer_phone}}<br>
								<strong>Address: </strong>{{$billing_add}}
								<input type="hidden" name="payer_name" value="{{$payer}}">
								<input type="hidden" name="payer_phone" value="{{$payer_phone}}">
								<input type="hidden" name="billing_address" value="{{$billing_add}}">
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
						<input type="text" name="promo_code" id="promo_code" class="form-control" placeholder="Enter Promo CODE">
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<button type="submit" class="btn btn-default">Apply</button>
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

