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
	<a href="view-cart">
		<button type="button" class="btn btn-default compare-btn btn-other">
			<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
		</button>
	</a>
	@include('layouts.customer.comparison_list_modal')
@endsection
@section('script')
	<script type="text/javascript" src="slick-1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$.ajaxSetup({
				headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

			$('.slide').slick({
				autoplay:true,
				arrows:false,
				fade:true,
				easing:'swing',
				autoplaySpeed:2000,
			});
			// new product
			@foreach($newProducts as $newPr)
			$('#add-to-cart-new-{{$newPr->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$newPr->id}}');
				alert('Product is added to your cart');
			});
			$('#compare-{{$newPr->id}}').click(function(){
				$('#modal-body').load('compare/{{$newPr->id}}');
				$('#campareS').load('load-button');
			});

			$('#heart-new-{{$newPr->id}}').click(function(e){
				// $(this).addClass('status-danger');
		    	e.preventDefault();
		    	
		    	var pid = {{$newPr->id}};
				$.ajax({
					type: "POST",
					url: "post-wishlist",
					data:{id:pid},
					success:function(data){
						if(data.status == 1){
							$('#heart-new-{{$newPr->id}}').addClass('status-danger');
							alert(data.success);
						}
						if(data.status == 0){
							alert(data.error);
						}
					},
					error:function(data){
						alert(this.data);
					}
				});
			});
			@endforeach

			// top product
			@foreach($topProducts as $topPr)
			$('#add-to-cart-top-{{$topPr->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$topPr->id}}');
				alert('Product is added to your cart');
			});
			$('#compare-{{$topPr->id}}').click(function(){
				$('#modal-body').load('compare/{{$topPr->id}}');
				$('#campareS').load('load-button');
			});
			$('#heart-top-{{$topPr->id}}').click(function(e){
				// $(this).addClass('status-danger');
		    	e.preventDefault();
		    	
		    	var pid = {{$topPr->id}};
				$.ajax({
					type: "POST",
					url: "post-wishlist",
					data:{id:pid},
					success:function(data){
						$('#heart-top-{{$topPr->id}}').addClass('status-danger');
						if(data.status == 1){
							alert(data.success);
						}
						if(data.status == 0){
							alert(data.error);
						}
					},
					error:function(data){
						alert("fail "+this.data);
					}
				});
			});
			@endforeach

			// compare list
			
		});
	</script>
	
@endsection