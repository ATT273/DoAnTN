<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel </title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="css/style.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" title="style" href="css/huong-style.css">
	<link rel="stylesheet" title="style" href="css/my_style.css">
</head>
<body>

	<div id="header">
		@include('layouts.customer.index_header_top')<!-- .header-top -->
		@include('layouts.customer.index_header_body')<!-- .header-body -->
		@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
	</div> <!-- #header -->
	

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
	<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="assets/dest/vendors/animo/Animo.js"></script>
	<script src="assets/dest/vendors/dug/dug.js"></script>
	<script src="js/scripts.min.js"></script>
	<script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="js/waypoints.min.js"></script>
	<script src="js/wow.min.js"></script>
	<!--customjs-->
	<script src="assets/dest/js/custom2.js"></script>
	<script>
	$(document).ready(function($) {    
		$(window).scroll(function(){
			if($(this).scrollTop()>150){
			$(".header-bottom").addClass('fixNav')
			}else{
				$(".header-bottom").removeClass('fixNav')
			}}
		)
	})
	</script>
</body>
</html>
