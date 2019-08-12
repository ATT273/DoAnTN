<div id="main_menu">
	<ul>
		<li><a href="index">Home</a></li>
		<li><a href="index">Products</a>
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
		<li><a href="index">About</a></li>
		<li><a href="index">Contact</a></li>
	</ul>
</div>