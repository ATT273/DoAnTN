<div class="row" style="width: 100%">
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<div class="slide">
			@foreach( $banners as $banner)
				<div>
					<a href="#">
						<img src="upload/slide/{{$banner->image}}" alt="{{$banner->image}}" height="530" >
					</a>
				</div>
			@endforeach
		</div>
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
</div>
