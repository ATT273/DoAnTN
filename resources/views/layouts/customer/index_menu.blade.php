{{-- <div class="header-bottom" style="background-color: #0277b8;">
	<div class="container">
		<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
		<div class="visible-xs clearfix"></div>
		<nav class="main-menu">
			<ul class="l-inline ov">
				<li><a href="index.html">Trang chủ</a></li>
				<li><a href="#">Sản phẩm</a>
					<ul class="sub-menu">
						<li><a href="product_type.html">Sản phẩm 1</a></li>
						<li><a href="product_type.html">Sản phẩm 2</a></li>
						<li><a href="product_type.html">Sản phẩm 4</a></li>
					</ul>
				</li>
				<li><a href="about.html">Giới thiệu</a></li>
				<li><a href="contacts.html">Liên hệ</a></li>
			</ul>
			<div class="clearfix"></div>
		</nav>
	</div> <!-- .container -->
</div>  --}}

<div id="main_menu">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Products</a>
						<ul>
							@foreach($categories as $cat)
								@if(count($cat->product_type) > 0)
									<li class="has_sub">
										<a href="#"> {{$cat->name}}</a>
										<ul>
											@foreach($cat->product_type as $prType)
												<li><a href="#">{{$prType->name}}</a></li>
											@endforeach
										</ul>
									</li>
								@else
									<li><a href="#"> {{$cat->name}}</a></li>
								@endif
							@endforeach
							<li><a href="#"> Product 1</a></li>
							<li class="has_sub"><a href="#"> Product 2</a>
								<ul>
									<li><a href="#">Product 2.2</a></li>
									<li><a href="#">Product 2.3</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>