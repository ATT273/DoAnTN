<div id="main_menu">
	<ul>
		<li><a href="#">Home</a></li>
		<li><a href="#">Products</a>
			<ul>
				@foreach($categories as $cat)
					@if(count($cat->product_type) > 0)
						<li class="has_sub">
							<a href="#"> {{$cat->name}}</a>
							<ul>
								@foreach($cat->product_type as $prType)
									<li><a href="#">{{$prType->name}}</a></li>
								@endforeach
							</ul>
						</li>
					@else
						<li><a href="#"> {{$cat->name}}</a></li>
					@endif
				@endforeach
				<li><a href="#"> Product 1</a></li>
				<li class="has_sub"><a href="#"> Product 2</a>
					<ul>
						<li><a href="#">Product 2.2</a></li>
						<li><a href="#">Product 2.3</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="#">About</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">News</a></li>
	</ul>
</div>