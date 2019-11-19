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
    @if(session('loi'))
        <div class="alert alert-danger">
            {{session('loi')}}
        </div>
    @endif
	<div id="content">
		<form action="login" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			@if(Session::has('to_checkout'))
				<input type="hidden" name="to_checkout" value="1">
			@endif
			<div class="row">
				<div class="col-sm-1 col-xs-3"></div>
				<div class="col-sm-10 col-xs-6 form-login">
					<center><h4>Đăng nhập</h4></center>
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
						<button type="submit" class="btn btn-primary center">Login</button>
					</div>
				</div>
				<div class="col-sm-1 col-xs-3"></div>
			</div>
		</form>
	</div>
</div> <!-- #content -->
@endsection