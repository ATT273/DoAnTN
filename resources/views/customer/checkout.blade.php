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
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    					- {{$totalAfterDicount}}
			    			</div>
			    		</div>
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    					= {{$totalAfterDicount}}
			    			</div>
			    		</div>
		    		@endif
	    		</div>
	    	</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="box">
						<div class="box-header">
							<h4>Shipping</h4>
						</div>
						<div class="box-body">
							<strong>Full name: </strong>{{Auth::user()->name}} - <strong>Phone number: </strong>{{Auth::user()->phone}}<br>
							<strong>Address: </strong>{{Auth::user()->address}}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="box">
						<div class="box-header">
							<h4>Billing</h4>
						</div>
						<div class="box-body">
							<strong>Full name: </strong>{{Auth::user()->name}} - <strong>Phone number: </strong>{{Auth::user()->phone}}<br>
							<strong>Address: </strong>{{Auth::user()->address}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<form action="apply-code" method="GET">
				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						<input type="text" name="promo_code" id="promo_code" class="form-control" placeholder="Enter Promo CODE">
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						{{-- <a href="apply-code"> --}}<button type="submit" class="btn btn-default">Apply</button>{{-- </a> --}}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="pull-right">
							<button type="button" class="btn btn-success">Place Order</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
 <!-- #content -->
@endsection

@section('script')
@endsection

