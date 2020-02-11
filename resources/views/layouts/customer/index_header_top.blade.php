<div class="header-top">
	<div class="top-left">
		<ul class="contact l-none">
			<li><a href=""><i class="fa fa-home"></i>Ha Noi- Viet Nam</a></li>
			<li><a href=""><i class="fa fa-phone"></i>1900-xxxxx</a></li>
		</ul>
	</div>
	<div class="logo">
		<a href="index" id="logo"><img src="upload/logo/logo.png" alt="logo_img"></a>
	</div>
	<div class="top-right">
		@if(Auth::check())
			<ul class="account l-none">
				<li><a href="u/profile/{{Auth::user()->id}}"><i class="fa fa-user"></i>{{Auth::user()->name}}</a></li>
				@if(Auth::user()->role == 1)
				<li><a href="admin/dashboard">Admin Dashboard</a></li>

				@endif
				<li><a href="logout">Logout</a></li>
			</ul>
		@else
			<ul class="account l-none">
				<li><a href="register">Đăng kí</a></li>
				<li><a href="login">Đăng nhập</a></li>
			</ul>
		@endif
	</div>
	<div class="clearfix"></div>
</div> 