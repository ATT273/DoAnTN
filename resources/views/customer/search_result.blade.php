@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection
@section('content')
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				@include('layouts.customer.search_result_block')
				<!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> 
		{{$products->links()}}
	</div>
 <!-- #content -->
@endsection
@section('script')
@endsection