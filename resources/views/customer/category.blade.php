@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection
@section('search_filter')
	<div class="filter-bar">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<h4>{{$category->name}}</h4>
		</div>
		<div class="col-xs-7 col-sm-7 col-md-3 col-lg-3 filter-input">
			<form action="category/{{$category->name}}/{{$category->id}}" method="GET" role="form">
				<div class="row" style="margin-top: 10px">
					
					<div class="col-xs-8 col-sm-8 col-md-9 col-lg-9">
						<select class="form-control" name="sort">
							<option value="" disabled selected>Sort By</option>
							<option value="latest">Latest</option>
							<option value="price-asc">Price low to high</option>
							<option value="price-desc">Price high to low</option>
						</select>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<button type="submit" class="btn btn-default btn-sm">Loc</button>
					</div>
					{{-- <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					</div> --}}
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('content')
	<div class="container">
		<div class="pull-right">
			{{$products->links()}}
		</div>
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				@include('layouts.customer.search_result_block')
				<!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> 
		<div class="pull-right">
			{{$products->links()}}
		</div>
	</div>
 <!-- #content -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		@foreach($products as $product)
			$('#add-to-cart-{{$product->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$product->id}}');
				alert('Product is added to your cart');
			});
		@endforeach
	});
</script>
@endsection