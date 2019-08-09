<div class="beta-products-list">
	<div class="block-title">
		<h4>Top Products</h4>
	</div>
	<div class="row">
		@foreach($topProducts as $topPr)
		<div class="col-sm-3 item-block">
			<div class="single-item">
				<div class="single-item-header">
					<div class="df" id="wl-{{$topPr->id}}">
						<i id="heart-{{$topPr->id}}" class="fa fa-heart fa-2x status-default
							@if(Auth::check())
								@foreach(Auth::user()->wishlist as $wl)
									@if($wl->product_id == $topPr->id)
										{{'status-danger'}}
									@endif
								@endforeach
							@endif
						 "aria-hidden="true"></i>
					</div>
					<a href="product/{{$topPr->id}}"><img src="upload/product/{{$topPr->productimg->first()["name"]}}" width="200" alt=""></a>
				</div>
				<div class="single-item-body">
					<p class="single-item-title">
						<a href="product/{{$topPr->id}}">{{$topPr->name}}</a>
						@if ($topPr->quantity == 0) 
							<span class="pull-right"><i class="fa fa-phone" aria-hidden="true"></i> - Please contact</span>
						@endif
					</p>
					<p class="single-item-price">
						@if($topPr->promo_price != 0)
							<span>
								<strike>@money($topPr->price)</strike>
							</span>
							&nbsp;
							<span class="status-danger">
								@money($topPr->promo_price)
							</span>
						@else
							<span>@money($topPr->price)</span>
						@endif
					</p>
				</div>
				<div class="single-item-caption">
					<button type="button" class="btn btn-warning pull-left" id="add-to-cart-{{$topPr->id}}" @if ($topPr->quantity == 0) disabled @endif>
						<i class="fa fa-shopping-cart"></i>
					</button>&nbsp;
					<button type="button" class="btn btn-default" id="compare-{{$topPr->id}}">Add to compare</button>
					<a  href="product/{{$topPr->id}}"><button type="button" class="btn btn-default" >Details<i class="fa fa-chevron-right"></i></button></a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div> <!-- .beta-products-list -->