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
							<span>@money($relatedPr->price)</span>
						</p>
					</div>
					<div class="single-item-caption">
						<a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
						<a class="beta-btn primary" href="product/{{$relatedPr->id}}">Details <i class="fa fa-chevron-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div> <!-- .beta-products-list -->