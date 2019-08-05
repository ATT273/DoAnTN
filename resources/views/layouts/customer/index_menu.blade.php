<div id="main_menu">
	<ul>
		<li><a href="#">Home</a></li>
		<li><a href="#">Products</a>
			<ul>
				@foreach($categories as $cat)
					@if(count($cat->product_type) > 0)
						<li class="has_sub">
							<a href="category/{{$cat->name}}/{{$cat->id}}"> {{$cat->name}}</a>
							<ul>
								@foreach($cat->product_type as $prType)
									<li><a href="product_type/{{$prType->name}}/{{$prType->id}}">{{$prType->name}}</a></li>
								@endforeach
							</ul>
						</li>
					@else
						<li><a href="category/{{$cat->name}}/{{$cat->id}}"> {{$cat->name}}</a></li>
					@endif
				@endforeach
			</ul>
		</li>
		<li><a href="#">About</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">News</a></li>
	</ul>
</div>