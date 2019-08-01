<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laravel </title>
	<base href="{{asset('')}}">
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	{{-- <link rel="stylesheet" href="css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" title="style" href="css/my_style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/colorbox.css">
	<link rel="stylesheet" href="css/settings.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" title="style" href="css/style.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" title="style" href="css/huong-style.css">
	<link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="slick-1.8.1/slick/slick-theme.css"/>
</head>
<body>

	<div id="header">
		@include('layouts.customer.index_header_top')<!-- .header-top -->
		@include('layouts.customer.index_header_body')<!-- .header-body -->
		@yield('menu')
	</div> <!-- #header -->
	
	@yield('search_filter')
	@yield('content')
	


	@include('layouts.customer.index_footer')
	<div class="copyright">
		<div class="container">
			<p class="pull-left">Privacy policy. (&copy;) 2014</p>
			<p class="pull-right pay-options">
				<a href="#"><img src="assets/dest/images/pay/master.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/pay.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/visa.jpg" alt="" /></a>
				<a href="#"><img src="assets/dest/images/pay/paypal.jpg" alt="" /></a>
			</p>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .copyright -->
	
	<!-- include js files -->
	<script src="js/jquery-3.4.1.min.js"></script>
	{{-- <script src="js/jquery-ui-1.10.4.custom.min.js"></script> --}}
	<script src="js/adminlte.js"></script>
	<script src="js/bootstrap.min.js"></script>
	@yield('script')
	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)

		$('#myModal').on('shown.bs.modal', function () {
		  $('#myInput').focus()
		})
	})
	</script>
</body>
</html>
