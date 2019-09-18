@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection
@section('search_filter')
	@include('layouts.customer.search_filter')
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