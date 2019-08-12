@extends('layouts.customer.customer_layout')
@section('menu')
	@include('layouts.customer.index_menu')<!-- .header-bottom - menu-->
@endsection
@section('content')
	<div class="container">
		<div class="jumbotron">
			<h3>
				{{$news->title}}
			</h3>
		</div>
		<div class="news-title">
		
		</div>
		<img src="upload/news/{{$news->image}}" height="500">
		<div class="news-content">
			{!!$news->content!!}
		</div>
	</div>
	<br>
 <!-- #content -->
@endsection
@section('script')
@endsection