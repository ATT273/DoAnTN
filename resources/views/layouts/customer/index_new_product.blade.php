<div class="beta-products-list">
	<div class="block-title">
		<h4>New Products</h4>
	</div>
	<div class="row">
		@foreach($newProducts as $newPr)
		<div class="col-sm-3 item-block">
			<div class="single-item">
				<div class="single-item-header">
					<a href="product/{{$newPr->id}}"><img src="upload/product/{{$newPr->productimg->first()["name"]}}" width="200" alt=""></a>
				</div>
				<div class="single-item-body">
					<p class="single-item-title"><a href="product/{{$newPr->id}}">{{$newPr->name}}</a></p>
					<p class="single-item-price">
						<span>@money($newPr->price)</span>
					</p>
				</div>
				<div class="single-item-caption">
					<button type="button" class="btn btn-warning pull-left" id="add-to-cart-{{$newPr->id}}">
						<i class="fa fa-shopping-cart"></i>
					</button>&nbsp;
					<a class="beta-btn primary" href="product/{{$newPr->id}}">Details <i class="fa fa-chevron-right"></i></a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div> <!-- .beta-products-list -->
{{-- add-to-cart/{{$newPr->id}} --}}