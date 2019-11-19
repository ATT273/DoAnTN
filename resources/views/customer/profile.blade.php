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
		<div class="row">
			<div class="col-xs-12 col-md-3">
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
		                <button class="btn btn-default2 btn-block" id="btn-order"><b>Orders</b></button>
		                <button class="btn btn-default2 btn-block" id="btn-wishlist"><b>Wishlist</b></button>
		                {{-- <a href="#" class="btn btn-default2 btn-block"><b>Change password</b></a> --}}
		                <button class="btn btn-default2 btn-block" id="btn-info"><b>Change information</b></button>
		            </div>
		        </div>
		        <!-- About Me Box -->
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 " id="order-sec">
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
				                				<strong>Total: </strong>@money($bill->total)
				                			</div>
				                		</div>
				                		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				                			<button type="button" class="btn btn-default show-d" id="btn-{{$bill->id}}"><i class="fa fa-search"></i></button> 
				                		</div>
				                	</div>
				                </div>
				                <br>
				                <div class="bill-detail" id="detail-{{$bill->id}}">
				                	@foreach($bill->bill_detail as $detail)
				                	<div class="row">
				                		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				                			@if($detail->product)
				                				<img src="upload/product/{{$detail->product->productimg->first()->name}}" width="70">
				                			@else
				                				<i class="fa fa-question fa-5x" aria-hidden="true"></i>
				                			@endif
				                		</div>
				                		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				                			<div class="row">
				                				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				                					<h5><strong class="item-name">{{$detail->product_name}}</strong></h5><br>
				                				</div>
				                				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				                					<p class="">@money($detail->product_price) X {{$detail->quantity}}</p>
				                				</div>
				                			</div>
				                		</div>
				                	</div>
				                	@endforeach
				                	<div class="row bill-total" style="margin-left: 0px; margin-right: 0px;">
				                		<div class="pull-right">
					                		<div><p class="pull-right"><strong>Subtotal: </strong>@money($bill->sub_total)</p></div>
					                		<div><p class="pull-right"><strong>Discount: </strong>@money($bill->discount_amount)</p></div>
					                		<div><p class="pull-right"><strong>Total: </strong>@money($bill->total)</p></div>
					                	</div>
				                	</div>
				                </div>
			                @endforeach
		                @endif
		            </div>
		        </div>
		    </div>
		    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 " id="wishlist-sec">
		    	<div class="box box-success">
		    		<div class="box-header"><h4>Wishlist</h4></div>
		    		<div class="box-body">
		    			@if(count(Auth::user()->wishlist) != 0)
			    			@foreach(Auth::user()->wishlist as $item)
			    			
			    				<div class="row wishlist-item">
			    					@if($item->product)
				    					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				    						<img src="upload/product/{{$item->product->productimg->first()->name}}" width="70">
				    					</div>
				    					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
				    						<div class="row">
				    							<h5 class="item-name">{{$item->product->name}}</h5>
				    						</div>
				    						<div class="row">
				    							<p>
				    								@if($item->product->promo_price != 0)
				    									<strike>@money($item->product->price)</strike>
				    									{{'---'}}
				    									@money($item->product->promo_price)
			    									@elseif($item->product->promo_price == 0)
				    									@money($item->product->price)
				    								@endif
				    							</p>
				    						</div>
				    						
				    					</div>
				    				@else
				    					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				    						<i class="fa fa-question fa-5x" aria-hidden="true"></i>
				    					</div>
				    					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
				    						<h3>san pham ma {{$item->product_id}} khong ton tai</h3>
				    					</div>
					    			@endif
			    					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			    						<div class="row">
			    							<a href="product/{{$item->product_id}}"><button type="button" class="btn btn-success">Detail</button></a>
			    						</div>
			    						<div class="row">
			    							<a href="u/del-wishlist-item/{{$item->id}}"><i class="fa fa-trash fa-2x status-danger" aria-hidden="true"></i></a>
			    						</div>
			    					</div>
			    				</div>
			    			
			    			@endforeach
		    			@else
		    				{{'chua co sp'}}
		    			@endif
		    		</div>
		    	</div>
		    </div>
		    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 " id="info-sec">
		    	<div class="box box-success">
		    		<div class="box-header">
		    			<h4>Profile Information</h4>
		    		</div>
		    		<div class="box-body">
		    			<form action="u/edit-profile/{{Auth::user()->id}}" method="POST" role="form">
		    				<input type="hidden" name="_token" value="{{csrf_token()}}">
		    				<div class="form-group">
		    					<label for="">Address</label>
		    					<input type="text" name="address" class="form-control" id="" value="{{Auth::user()->address}}" required>
		    				</div>
		    				<div class="form-group">
		    					<label for="">Phone</label>
		    					<input type="text" name="phone" class="form-control" id="" value="{{Auth::user()->phone}}" required>
		    				</div>
		    				<button type="submit" class="btn btn-primary">Submit</button>
		    			</form>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
</div> <!-- #content -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('#btn-wishlist').click(function(){
			$('#wishlist-sec').show();
			$('#order-sec').hide();
			$('#info-sec').hide();
		});
		$('#btn-order').click(function(){
			$('#wishlist-sec').hide();
			$('#order-sec').show();
			$('#info-sec').hide();
		});
		$('#btn-info').click(function(){
			$('#wishlist-sec').hide();
			$('#order-sec').hide();
			$('#info-sec').show();
		});
	});
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