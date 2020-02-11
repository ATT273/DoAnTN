<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>My Shop</title>
	<base href="{{asset('')}}">
	<link rel="shortcut icon" href="{{ asset('logo.png') }}">
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/slick.css">
	<link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
	<link rel="stylesheet" title="style" href="css/ultility.css">
	<link rel="stylesheet" title="style" href="css/my_style.css">
</head>
<body>

	<div id="header">
		@include('layouts.customer.index_header_top')<!-- .header-top -->
		{{-- @include('layouts.customer.index_header_body')<!-- .header-body --> --}}
		@yield('menu')
	</div> <!-- #header -->
	
	@yield('search_filter')
	@yield('content')
	


	@include('layouts.customer.index_footer')
	<!-- include js files -->
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	@yield('script')
	<script>
	$(document).ready(function() { 
		$('#myModal').on('shown.bs.modal', function () {
		  $('#myInput').focus()
		})
	})
	</script>
</body>
</html>
