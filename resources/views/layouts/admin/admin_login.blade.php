<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<base href="{{asset('')}}">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/my_style.css">
</head>
<body>
	
	<div class="login-admin">
		<h2><center>Login Your Account</center></h2>
		<br/>
		@if(count($errors) > 0)
	        <div class="alert alert-danger">
	          @foreach ($errors ->all() as $err)
	              {{$err}}<br>
	          @endforeach
	        </div>
	    @endif
	    @if(session('thongbao'))
	        <div class="alert alert-danger">
	            {{session('thongbao')}}

	        </div>
	    @endif
		<form action="admin/login" method="post">

			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group">
				<input class="form-control" type="text" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary login-btn">Login</button>
		</form>
	</div>
	
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
</body>
</html>