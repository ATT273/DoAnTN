<div class="beta-products-list">
	<div class="block-title">
		<h4>New Products</h4>
	</div>
	<div id="test"></div>

	<div class="row">
		@foreach($newProducts as $newPr)
		<div class="col-md-3 col-sm-4 col-xs-12 item-block">
			<div class="single-item">
				<div class="single-item-header">
					<div class="df" id="wl-{{$newPr->id}}">
						<i id="heart-new-{{$newPr->id}}" class="fa fa-heart fa-2x status-default
							@if(Auth::check())
								@foreach(Auth::user()->wishlist as $wl)
									@if($wl->product_id == $newPr->id)
										{{'status-danger'}}
									@endif
								@endforeach
							@endif
						 "aria-hidden="true"></i>
					</div>
					<a href="product/{{$newPr->id}}"><img src="upload/product/{{$newPr->productimg->first()["name"]}}" width="200" alt=""></a>
				</div>
				<div class="single-item-body">
					<p class="single-item-title">
						<a href="product/{{$newPr->id}}">{{$newPr->name}}</a>&nbsp;
						@if ($newPr->quantity == 0) 
							<span class="pull-right"><i class="fa fa-phone" aria-hidden="true"></i> - Please contact</span>
						@endif
					</p>
					<p class="single-item-price">
						@if($newPr->promo_price != 0)
							<span>
								<strike>@money($newPr->price)</strike>
							</span>
							<span class="status-danger">
								@money($newPr->promo_price)
							</span>
						@else
							<span>@money($newPr->price)</span>
						@endif
					</p>
					
				</div>
				<div class="single-item-caption">
					<button type="button" class="btn btn-warning pull-left" id="add-to-cart-new-{{$newPr->id}}" @if ($newPr->quantity == 0) disabled @endif>
						<i class="fa fa-shopping-cart"></i>
					</button>&nbsp;
					{{-- <button type="button" class="btn btn-default" id="compare-{{$newPr->id}}">Add to compare</button> --}}
					<a  href="product/{{$newPr->id}}"><button type="button" class="btn btn-default" >Details<i class="fa fa-chevron-right"></i></button></a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div> <!-- .beta-products-list -->
{{-- add-to-cart/{{$newPr->id}} --}}