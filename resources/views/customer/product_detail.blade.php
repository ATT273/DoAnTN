@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection
@section('content')
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
							<button type="button" class="btn btn-warning pull-left" id="add-to-cart-{{$product->id}}">
								<i class="fa fa-shopping-cart"></i>
							</button>
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
								<li><a href="#review" data-toggle="tab">Comments</a></li>
								<li><a href="#other" data-toggle="tab">other</a></li>
							</ul>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tab-content">
								<div class="tab-pane active" id="desc">
									{!!$product->description!!}
								</div>
								<div class="tab-pane" id="review">
									<div class="row">
										<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
											@if(Auth::check())
												<form action="add-comment" method="POST">
													<input type="hidden" name="_token" value="{{csrf_token()}}">
													<input type="hidden" name="product_id" value="{{$product->id}}">
													<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
													<div class="form-group">
														<label for="comment">Your comment</label>
														<textarea name="comment" class="form-control" required></textarea>
													</div>
													<button type="submit" class="btn btn-success">Send</button>
												</form>
											@else
												<p>Login to comment</p>
											@endif
										</div>
										<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
											@if(count($product->comment) > 0)
												@foreach($product->comment as $comment)
													<p>
														<div class="comment-user">
															<strong>
																<i class="fa fa-user" aria-hidden="true"></i>
																{{$comment->user->name}}
															</strong>
														</div>
														<div class="comment-content">{{$comment->content}}</div>
													</p>
													<br>
												@endforeach
											@endif
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

			$('#add-to-cart-{{$product->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$product->id}}');
				alert('Product is added to your cart');
			});
			@foreach($relatedProducts as $relatedPr)
			$('#add-to-cart-{{$relatedPr->id}}').click(function(){
				$('#cart-button').load('add-to-cart/{{$relatedPr->id}}');
				alert('Product is added to your cart');
			});
			@endforeach
		});
	</script>
@endsection