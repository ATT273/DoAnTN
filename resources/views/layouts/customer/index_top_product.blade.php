<div class="beta-products-list">
	<div class="block-title">
		<h4>Top Products</h4>
	</div>
	<div class="row">
		@foreach($topProducts as $topPr)
		<div class="col-sm-3 item-block">
			<div class="single-item">
				<div class="single-item-header">
					<a href="product/{{$topPr->id}}"><img src="upload/product/{{$topPr->productimg->first()["name"]}}" width="200" alt=""></a>
				</div>
				<div class="single-item-body">
					<p class="single-item-title"><a href="product/{{$topPr->id}}">{{$topPr->name}}</a></p>
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
					<button type="button" class="btn btn-warning pull-left" id="add-to-cart-{{$topPr->id}}">
						<i class="fa fa-shopping-cart"></i>
					</button>&nbsp;
					<button type="button" class="btn btn-default" id="compare-{{$topPr->id}}">Add to compare</button>
					<a class="beta-btn primary" href="product/{{$topPr->id}}">Details <i class="fa fa-chevron-right"></i></a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div> <!-- .beta-products-list -->