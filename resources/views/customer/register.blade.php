@extends('layouts.customer.customer_layout')
@section('content')
	<div class="container">
		<div id="content">
			<form action="#" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					@if(count($errors) > 0)
		                <div class="alert alert-danger">
		                  @foreach ($errors ->all() as $err)
		                      {{$err}}<br>
		                  @endforeach
		                </div>
		            @endif
		            @if(session('thongbao'))
		                <div class="alert alert-success">
		                    {{session('thongbao')}}

		                </div>
		            @endif
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>

						<div class="form-block">
							<label for="your_last_name">FullName*</label>
							<input type="text" id="your_last_name" name="fullname" class="form-control" required>
						</div>
						<div class="form-block">
							<label for="your_last_name">UserName*</label>
							<input type="text" id="username" name="username" class="form-control" required>
						</div>
						<div class="form-block">
							<label for="phone">Password*</label>
							<input type="password" id="password" name="password" class="form-control" required>
						</div>
						<div class="form-block">
							<label for="phone">Re password*</label>
							<input type="password" id="password" name="password_confirmation" class="form-control" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div>
@endsection