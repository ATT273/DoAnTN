<div class="main-menu">
	<ul>
		<li><a href="index">Home</a></li>
		<li><a href="index">Products</a>
			<ul>
				@foreach($categories as $cat)
					@if(count($cat->product_type) > 0)
						<li class="has_sub">
							<a href="category/{{$cat->name}}/{{$cat->id}}"> {{$cat->name}}</a>
							<ul>
								@foreach($cat->product_type as $prType)
									<li><a href="product_type/{{$prType->name}}/{{$prType->id}}">{{$prType->name}}</a></li>
								@endforeach
							</ul>
						</li>
					@else
						<li><a href="category/{{$cat->name}}/{{$cat->id}}"> {{$cat->name}}</a></li>
					@endif
				@endforeach
			</ul>
		</li>
		<li><a href="index">About</a></li>
		<li><a href="index">Contact</a></li>
	</ul>
	<div class="right-block">
		<div class="search-block">
			<form role="search" method="get" id="searchform" action="search" class="search-form">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="text" value="" name="keyword"  placeholder="Search..." class="form-control"/>
				<button class="fa fa-search" type="submit" id="searchsubmit"></button>
			</form>
		</div>
		<div class="cart__button">
			<label for="mini-cart--toggle" class="btn btn-other" onclick="openNav()">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			</label>
			<input type="checkbox" id="mini-cart--toggle" class="mini-cart--toggle">
			<div class="item-number">
				@if(Session::has('cart'))
					{{$cart->totalQty}}
				@elseif(!Session::has('cart'))
					0
				@endif
			</div>
			@include('layouts.customer.mini_cart_index')
		</div>
	</div>
	<div class="clearfix"></div>
</div>