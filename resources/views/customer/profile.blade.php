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
		<div class="row">
			<div class="col-md-3">
		        <div class="box box-primary">
		            <div class="box-body box-profile">
		                <h3 class="profile-username text-center">{{$user->username}}</h3>
		                <p class="text-muted text-center">
		                    @if($user->role ==0)
		                    {{'Khach hang '}}
		                    @elseif($user->role == 1)
		                    {{'Admin'}}
		                    @endif
		                </p>
		                <ul class="list-group list-group-unbordered">
		                    <li class="list-group-item">
		                        <b>Name:</b> &nbsp <a>{{$user->name}}</a>
		                    </li>
		                    <li class="list-group-item">
		                        <b>Email:</b> &nbsp <a>{{$user->email}}</a>
		                    </li>
		                    <li class="list-group-item">
		                        <b>Address:</b> &nbsp <a>{{$user->address}}</a>
		                    </li>
		                </ul>
		                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
		            </div>
		        </div>
		        <!-- About Me Box -->
		    </div>
		    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
		    	<div class="box box-success">
		    		<div class="box-body">
		                @if(count($bills) > 0)
			                @foreach($bills as $bill)
				                <div class="bill-overview">
				                	<div class="row">
				                		<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
				                			<strong>Order #{{$bill->id}} - </strong>
				                			<strong>Order Date: </strong>{{$bill->order_date}}
				                		</div>
				                		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				                			{{-- confirm --}}
				                			<div class="row">
				                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				                					@if($bill->confirmation == 0)
						                				<i class="fa fa-check status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua xac nhan"><br>Chua xac nhan</i>
						                			@elseif($bill->confirmation == 1)
														<i class="fa fa-check status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da xac nhan"><br>Da xac nhan</i>
													@endif
				                				</div>
				                				{{-- transfer --}}
				                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				                					@if($bill->transfer_status == 0)
				                						<i class="fa fa-truck status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua xac nhan"><br>Chua xac nhan</i>
				                					@elseif($bill->transfer_status ==1)
				                						<i class="fa fa-truck status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da xac nhan"><br>Da xac nhan</i>
				                					@endif
				                				</div>
				                				{{-- payment --}}
				                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				                					@if($bill->payment_status == 0)
														<i class="fa fa-credit-card status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua thanh toan"><br>Chua thanh toan</i>
													@elseif($bill->payment_status == 1)
														<i class="fa fa-credit-card status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da thanh toan"><br>Da thanh toan</i>
													@endif
				                				</div>
				                			</div>
				                		</div>
				                		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				                			<div class="pull-right">
				                				<strong>Subtotal: </strong>@money($bill->total)
				                			</div>
				                		</div>
				                		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				                			<button type="button" class="btn btn-default show-d" id="btn-{{$bill->id}}"><i class="fa fa-search"></i></button> 
				                		</div>
				                	</div>
				                </div>
				                <br>
				                <div class="bill-detail" id="detail-{{$bill->id}}">
				                	@foreach($bill->product as $pr)
				                	<div class="row">
				                		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				                			<img src="upload/product/{{$pr->productimg->first()->name}}" width="70">
				                		</div>
				                		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				                			<div class="row">
				                				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				                					<h5><strong>{{$pr->name}}</strong></h5><br>
				                				</div>
				                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				                					<p class="">@money($pr->price) X {{$pr->bill_detail->first()->quantity}}</p>
				                				</div>
				                			</div>
				                		</div>
				                	</div>
				                	<hr>
				                	@endforeach
				                </div>
			                @endforeach
		                @endif
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div> <!-- #content -->
@endsection
@section('script')
<script type="text/javascript">
	@if(count($bills) > 0)
		@foreach($bills as $bill)
		$(document).ready(function(){
			$('#btn-{{$bill->id}}').click(function(){
				$('#detail-{{$bill->id}}').toggle(1000);
			});
		});
		@endforeach
	@endif
</script>
@endsection