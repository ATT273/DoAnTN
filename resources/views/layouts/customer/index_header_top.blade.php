<div class="header-top">
	<div class="container">
		<div class="pull-left auto-width-left">
			<ul class="top-menu menu-beta l-inline">
				<li><a href=""><i class="fa fa-home"></i> O dau con lau moi noi</a></li>
				<li><a href=""><i class="fa fa-phone"></i>1900-10 khong co</a></li>
			</ul>
		</div>
		<div class="pull-right auto-width-right">
			@if(Auth::check())
				<ul class="top-details menu-beta l-inline">
					<li><a href="profile/{{Auth::user()->name}}"><i class="fa fa-user"></i>{{Auth::user()->name}}</a></li>
					@if(Auth::user()->role == 1)
					<li><a href="admin/dashboard">Admin Dashboard</a></li>

					@endif
					<li><a href="logout">Logout</a></li>
				</ul>
			@else
				<ul class="top-details menu-beta l-inline">
					<li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
					<li><a href="register">Đăng kí</a></li>
					<li><a href="login">Đăng nhập</a></li>
				</ul>
			@endif
		</div>
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div> 