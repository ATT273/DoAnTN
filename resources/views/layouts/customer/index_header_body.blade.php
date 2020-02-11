<div class="header-body">
	<div class="container beta-relative">
		<div class="pull-left">
			
		</div>
		<div class="pull-right">
			<div class="row">
				<div class="col-xs-8">
					
				</div>
				<div class="col-xs-4">
					<ul class="dropdown-menu cart-items-list" id="cart-items-list">
						@if(Session::has('cart'))
							@foreach ($items as $item)
								<li>
									<div class="row" style="margin-left: 0; margin-top: 10px;">
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											<img src="upload/product/{{$item['item']->productimg->first()->name}}" width="100">
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
											<div class="row">
												<a href="product/{{$item['item']['id']}}"><strong>{{$item['item']['name']}}</strong></a>
											</div>
											@if($item['item']['promo_price'] != 0)
												<div class="row">
													<strike>@money($item['item']['price'])</strike> X {{$item['qty']}}
												</div>
												<div class="row status-danger">
													@money($item['item']['promo_price']) X {{$item['qty']}}
												</div>
											@else
												<div class="row">
													@money($item['item']['price']) X {{$item['qty']}}
												</div>
											@endif
										</div>
									</div>
									
								</li>
							@endforeach
							<li><a><strong>Subtotal:</strong>&nbsp; <div class="pull-right">@money($totalPrice)</div></a></li>
							<li role="separator" class="divider"></li>
							<li><a href="checkout">To Checkout</a></li>
						@endif
						@if(!Session::has('cart'))
							<li><a>No item in your cart</a></li>
						@endif
					</ul>
				</div>
			</div>
			&nbsp;
		</div>
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div> 