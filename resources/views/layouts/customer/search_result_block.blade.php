@foreach ($products->chunk(4) as $chunk)
	<div class="row">
		@foreach ($chunk as $product)
			<div class="col-sm-3 item-block">
				<div class="single-item">
					<div class="single-item-header">
						<a href="product/{{$product->id}}"><img src="upload/product/{{$product->productimg->first()["name"]}}" width="200" alt=""></a>
					</div>
					<div class="single-item-body">
						<p class="single-item-title">
							<a href="product/{{$product->id}}">{{$product->name}}</a>
							@if ($product->quantity == 0) 
							<span class="pull-right"><i class="fa fa-phone" aria-hidden="true"></i> - Please contact</span>
						@endif
						</p>
						<p class="single-item-price">
							<span>@money($product->price)</span>
						</p>
					</div>
					<div class="single-item-caption">
						<button type="button" class="btn btn-warning pull-left" id="add-to-cart-{{$product->id}}" @if ($product->quantity == 0) disabled @endif>
							<i class="fa fa-shopping-cart"></i>
						</button>&nbsp;
						<a  href="product/{{$product->id}}"><button type="button" class="btn btn-default" >Details<i class="fa fa-chevron-right"></i></button></a>
					<div class="clearfix"></div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<div class="space60">&nbsp;</div>
@endforeach