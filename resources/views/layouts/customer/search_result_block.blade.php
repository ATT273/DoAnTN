@foreach ($products->chunk(3) as $chunk)
	<div class="row">
		@foreach ($chunk as $product)
			<div class="col-sm-3 item-block">
				<div class="single-item">
					<div class="single-item-header">
						<a href="product/{{$product->id}}"><img src="upload/product/{{$product->productimg->first()["name"]}}" width="200" alt=""></a>
					</div>
					<div class="single-item-body">
						<p class="single-item-title"><a href="product/{{$product->id}}">{{$product->name}}</a></p>
						<p class="single-item-price">
							<span>@money($product->price)</span>
						</p>
					</div>
					<div class="single-item-caption">
						<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
						<a class="beta-btn primary" href="product/{{$product->id}}">Details <i class="fa fa-chevron-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<div class="space60">&nbsp;</div>
@endforeach