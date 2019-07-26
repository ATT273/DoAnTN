@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection

@section('content')
	@include('layouts.customer.index_slide')
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						@include('layouts.customer.index_new_product')

						<div class="space50">&nbsp;</div>

						@include('layouts.customer.index_top_product')
					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> 
	</div><!-- #content -->
	@include('layouts.customer.comparison_list')
@endsection
@section('script')
	<script type="text/javascript" src="slick-1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.slide').slick({
				autoplay:true,
				arrows:true,
				autoplaySpeed:1000,
			});
			// new product
			@foreach($newProducts as $newPr)
			$('#add-to-cart-{{$newPr->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$newPr->id}}');
				alert('Product is added to your cart');
			});
			$('#compare-{{$newPr->id}}').click(function(){
				$('#modal-body').load('compare/{{$newPr->id}}');
			});
			@endforeach

			// top product
			@foreach($topProducts as $topPr)
			$('#add-to-cart-{{$topPr->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$topPr->id}}');
				alert('Product is added to your cart');
			});
			@endforeach

			// delete compare item
			@if(Session::has('compare_list'))
			@foreach($list->items as $item)
				$('#del-item-{{$item['item']['id']}}').click(function(){
					$('#modal-body').load('del-compare/{{$item['item']['id']}}');
				});
			@endforeach
		@endif
		});
	</script>
@endsection