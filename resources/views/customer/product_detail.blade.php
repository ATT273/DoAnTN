@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Product</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="index">Home</a> / <span>Product</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-images-slide">
								@foreach($product->productimg as $image)
									<div>
										<img src="upload/product/{{$image->name}}" alt="" height="300px">
									</div>
								@endforeach
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 slide-nav">
								@foreach($product->productimg as $image)
									<div>
										<img src="upload/product/{{$image->name}}" alt="" height="90px">
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-8">
						<div class="single-item-body">
							<p class="single-item-title"><h3>{{$product->name}}</h3></p>
							<p class="single-item-price">
								<span>@money($product->price)</span>
							</p>
						</div>
						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>
						<div class="single-item-desc">
							<p>@excerpt($product->description)</p>
						</div>
						<div class="space20">&nbsp;</div>
						<p>Options:</p>
						<div class="single-item-options">
							<select class="wc-select" name="color">
								<option>Qty</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
						</div>
						<br>
						<p>Tags: </p>
						<p>
							@foreach($tags as $tag)
								<span class="label label-default">{{$tag->name}}</span>
							@endforeach
						</p>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div id="tabs">
					<div><h5>Tabs</h5></div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul id="tabs" class="nav nav-tabs">
								<li class="active"><a href="#desc" data-toggle="tab">Description</a></li>
								<li><a href="#review" data-toggle="tab">Review</a></li>
								<li><a href="#other" data-toggle="tab">other</a></li>
							</ul>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tab-content">
								<div class="tab-pane" id="desc">
									{!!$product->description!!}
								</div>
								<div class="tab-pane active" id="review">
									<div class="row">
										<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
											<form action="comment/add" method="Post">
												<input type="hidden" name="_token" value="{{csrf_token()}}">
												<div class="form-group">
													<label for="title">Title</label>
													<input type="text" name="title" class="form-control">
												</div>
												<div class="form-group">
													<label for="review">Your review</label>
													<textarea name="review" class="form-control"></textarea>
												</div>
												<button type="submit" class="btn btn-success">Send</button>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="other">
									fasdfa
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="space50">&nbsp;</div>
				@include('layouts.customer.related_products')
			</div>
			
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection
@section('script')
	<script type="text/javascript" src="slick-1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.product-images-slide').slick({
				autoplay:true,
				autoplaySpeed:1000,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slide-nav',
			});

			$('.slide-nav').slick({
				infinite: true,
				slidesToShow: 2,
				slidesToScroll: 1,
				arrows: true,
				dots: true,
				centerMode: true,
				focusOnSelect: true,
				asNavFor: '.product-images-slide',
			});

			// $('#tabs li').click(function(){
			// 	$('#tabs li').removeClass('active');
			// 	$(this).addClass('active');
			// });
		});
	</script>
@endsection