@extends('layouts.admin.admin_layout') 
@section('main_content')
<section class="content">
@include('admin.dashboard.dashboard_overview')
@include('admin.dashboard.dashboard_detail')

</section>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#show-orders').click(function(){
				$('#orders-sec').show();
				$('#users-sec').hide();
				$('#report-sec').hide();
				$('#products-sec').hide();
			});
			$('#show-report').click(function(){
				$('#orders-sec').hide();
				$('#users-sec').hide();
				$('#report-sec').show();
				$('#products-sec').hide();
			});
			$('#show-users').click(function(){
				$('#orders-sec').hide();
				$('#users-sec').show();
				$('#report-sec').hide();
				$('#products-sec').hide();
			});
			$('#show-products').click(function(){
				$('#orders-sec').hide();
				$('#users-sec').hide();
				$('#report-sec').hide();
				$('#products-sec').show();
			});

		});
	</script>
@endsection