<div class="header-body">
	<div class="container beta-relative">
		<div class="pull-left">
			<a href="index" id="logo"><img src="upload/logo/logo.png" width="200px" alt=""></a>
		</div>
		<div class="pull-right beta-components space-left ov">
			<div class="space10">&nbsp;</div>
			<div class="beta-comp">
				<form role="search" method="get" id="searchform" action="search">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
			        <input type="text" value="" name="keyword"  placeholder="Search..." class="form-control"/>
			        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
				</form>
			</div>
			&nbsp;
			<div class="btn-group" id="cart-button">
				<button type="button" class="btn btn-default">
					<a href="view-cart">
						<i class="fa fa-shopping-cart fa-lg"></i>
						<div class="item-number">
							@if(Session::has('cart'))
								{{$cart->totalQty}}
							@elseif(!Session::has('cart'))
								0
							@endif
						</div>
					</a>
				</button>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
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
										<div class="row">
											@money($item['item']['price']) X {{$item['qty']}}
										</div>
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
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div> 