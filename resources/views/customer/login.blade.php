@extends('layouts.customer.customer_layout')
@section('content')
<div class="container">
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
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}

        </div>
    @endif
	<div id="content">

		<form action="login" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng nhập</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="email" class="form-control" required>
					</div>
					<div class="form-block">
						<label for="password">Password*</label>
						<input type="password" id="password" name="password" class="form-control" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div>
</div> <!-- #content -->
@endsection