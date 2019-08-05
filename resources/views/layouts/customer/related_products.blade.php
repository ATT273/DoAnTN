<div class="beta-products-list">
	<h4>Related Products</h4>

	<div class="row">
		@foreach($relatedProducts as $relatedPr)
			<div class="col-sm-3">
				<div class="single-item">
					<div class="single-item-header">
						<a href="product/{{$relatedPr->id}}"><img src="upload/product/{{$relatedPr->productimg->first()["name"]}}" alt=""></a>
					</div>
					<div class="single-item-body">
						<p class="single-item-title"><a href="product/{{$relatedPr->id}}">{{$relatedPr->name}}</a></p>
						<p class="single-item-price">
							
							@if($relatedPr->promo_price != 0)
							<span>
								<strike>@money($relatedPr->price)</strike>
							</span>
							&nbsp;
							<span class="status-danger">
								@money($relatedPr->promo_price)
							</span>
						@else
							<span>@money($relatedPr->price)</span>
						@endif
						</p>
					</div>
					<div class="single-item-caption">
						<button type="button" class="btn btn-warning pull-left" id="add-to-cart-{{$relatedPr->id}}">
							<i class="fa fa-shopping-cart"></i>
						</button>&nbsp;
						<a class="beta-btn primary" href="product/{{$relatedPr->id}}">Details <i class="fa fa-chevron-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div> <!-- .beta-products-list -->