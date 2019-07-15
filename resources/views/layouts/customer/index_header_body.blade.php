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

			<div class="beta-comp">
				<div class="cart">
					<div class="beta-select"><i class="fa fa-shopping-cart"></i><i class="fa fa-chevron-down"></i></div>
					<div class="beta-dropdown cart-body">
						<div class="cart-item">
							<div class="media">
								<a class="pull-left" href="#"><img src="assets/dest/images/products/cart/1.png" alt=""></a>
								<div class="media-body">
									<span class="cart-item-title">Sample Woman Top</span>
									<span class="cart-item-options">Size: XS; Colar: Navy</span>
									<span class="cart-item-amount">1*<span>$49.50</span></span>
								</div>
							</div>
						</div>

						<div class="cart-item">
							<div class="media">
								<a class="pull-left" href="#"><img src="assets/dest/images/products/cart/2.png" alt=""></a>
								<div class="media-body">
									<span class="cart-item-title">Sample Woman Top</span>
									<span class="cart-item-options">Size: XS; Colar: Navy</span>
									<span class="cart-item-amount">1*<span>$49.50</span></span>
								</div>
							</div>
						</div>

						<div class="cart-item">
							<div class="media">
								<a class="pull-left" href="#"><img src="assets/dest/images/products/cart/3.png" alt=""></a>
								<div class="media-body">
									<span class="cart-item-title">Sample Woman Top</span>
									<span class="cart-item-options">Size: XS; Colar: Navy</span>
									<span class="cart-item-amount">1*<span>$49.50</span></span>
								</div>
							</div>
						</div>

						<div class="cart-caption">
							<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">$34.55</span></div>
							<div class="clearfix"></div>

							<div class="center">
								<div class="space10">&nbsp;</div>
								<a href="checkout.html" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
							</div>
						</div>
					</div>
				</div> <!-- .cart -->
			</div>
		</div>
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div> 