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
		});
	</script>
@endsection