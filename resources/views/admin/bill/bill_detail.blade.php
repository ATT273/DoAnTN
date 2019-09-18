@extends('layouts.admin.admin_layout')
@section('main_content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Bill detail</li>
        </ol>
    </section>
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
    <!-- Main content -->
    <section class="content">
      <div class="row">
	        <div class="col-xs-7">
	          	<div class="box">
            		<div class="box-header">
            			<h3>
            				Bill Detail - {{$bill->id}}
            			</h3>
                  <p>Created At: {{$bill->created_at}}</p>
            		</div>
            		<div class="box-body">
      						<table id="example2" class="table table-bordered table-hover">
      							<thead>
      								<tr>
      									<th>Product</th>
      									<th>Price</th>
      									<th>Quantity</th>
      								</tr>
      							</thead>
      							<tbody>
      								@foreach($billDetails as $item)
      									<tr>
      										<td><a href="product/{{$item->product_id}}">{{$item->product_name}}</a></td>
      										<td>
      										@money($item->product_price)
      										</td>
      										<td>
      										{{$item->quantity}}
      										</td>
      									</tr>
      								@endforeach
      							</tbody>
      						</table>
                  {{-- subtotal --}}
                  <div class="subtotal">
                    <div class="row">
                      <div class="col-xs-3">
                        <div class="subtotal-name">
                          <strong>Subtotal:</strong>
                        </div>
                      </div>
                      <div class="col-xs-9">
                        <div class="subtotal-amount">
                          @money($bill->sub_total)
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- discount --}}
                  <div class="subtotal">
                    <div class="row">
                      <div class="col-xs-3">
                        <div class="subtotal-name">
                          <strong>Discount:</strong>
                        </div>
                      </div>
                      <div class="col-xs-9">
                        <div class="subtotal-amount">
                          @money($bill->discount_amount)
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- total --}}
                  <div class="subtotal">
                    <div class="row">
                      <div class="col-xs-3">
                        <div class="subtotal-name">
                          <strong>Total:</strong>
                        </div>
                      </div>
                      <div class="col-xs-9">
                        <div class="subtotal-amount">
                          @money($bill->total)
                        </div>
                      </div>
                    </div>
                  </div>
            		</div>
	            </div>
	        </div>
	    	  <div class="col-xs-5">
  	    		<div class="box">
  	    			<div class="box-header"><h3>Bill's Status</h3></div>
  	    			<div class="box-body">
                <div class="status">
                  <div id="confirm_status" class="confirmation-st">
                    <strong>Confirmation: </strong>
                    @if($bill->confirmation == 0)
                      <span class="label label-danger">{{'Chua xac nhan'}}</span>
                    @endif
                    @if($bill->confirmation == 1)
                      <span  class="label label-success">{{'Da xac nhan'}}</span>
                    @endif
                  </div>
                  <button id="btn_xacnhan" class="btn btn-success btn-xs" @if($bill->confirmation == 1){{'disabled'}}@endif> Xac nhan</button>
                  {{-- <button id="btn_huy" class="btn btn-danger btn-xs"> Huy</button> --}}
                </div>
                <div class="status">
                  <div id="transfer_status" class="confirmation-st">
                    <strong>Transfer status: </strong>
                    @if($bill->transfer_status == 0)
                      <span class="label label-danger">{{'Chua gui'}}</span>
                    @endif
                    @if($bill->transfer_status == 1)
                      <span class="label label-success">{{'Da gui'}}</span>
                    @endif
                  </div>
                    <button id="btn_transfer" class="btn btn-success btn-xs" @if($bill->transfer_status == 1){{'disabled'}}@endif> Xac nhan</button>
                </div>
                <div class="status">
                  <div id="payment_status" class="confirmation-st">
                    <strong>Payment status: </strong>
                    @if($bill->payment_status == 0)
                      <span class="label label-danger">{{'Chua thanh toan'}}</span>
                    @endif
                    @if($bill->payment_status == 1)
                      <span class="label label-success">{{'Da thanh toan'}}</span>
                    @endif
                  </div>
                  <button id="btn_payment" class="btn btn-success btn-xs" @if($bill->payment_status == 1){{'disabled'}}@endif> Xac nhan</button>
                </div>
  	    			</div>
  	    		</div>
      		</div>
    	</div>
      {{-- Shipping Address --}}
      <div class="row">
        <div class="col-xs-7">
          <div class="box">
            <div class="box-header">
              Shipping
            </div>
            <div class="box-body">
              <strong>Full name: </strong>{{$bill->receiver}} - <strong>Phone number: </strong>{{$bill->receiver_phone}}<br>
              <strong>Address: </strong>{{$bill->shipping_address}}
            </div>
          </div>
        </div>
      </div>
      {{-- Payment Address --}}
      <div class="row">
        <div class="col-xs-7">
          <div class="box">
            <div class="box-header">
              Billing
            </div>
            <div class="box-body">
              <strong>Full name: </strong>{{$bill->payer}} - <strong>Phone number: </strong>{{$bill->payer_phone}}<br>
              <strong>Address: </strong>{{$bill->billing_address}}
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

  @endsection
  @section('script')
   <script type="text/javascript">
    $(document).ready(function(){
            
            $("#btn_xacnhan").click(function(){
              
               //gọi trang ajax lên ,trang ajax tạo trong route
                $.get("admin/bill/ajax/confirm/1/"+{{$bill->id}},function(data){
                    $("#confirm_status").html(data);
                });

                $(this).attr('disabled',true);
            });
            $("#btn_transfer").click(function(){
              
               //gọi trang ajax lên ,trang ajax tạo trong route
                $.get("admin/bill/ajax/confirm/2/"+{{$bill->id}},function(data){
                    $("#transfer_status").html(data);
                });

                $(this).attr('disabled',true);
            });
            $("#btn_payment").click(function(){
              
               //gọi trang ajax lên ,trang ajax tạo trong route
                $.get("admin/bill/ajax/confirm/3/"+{{$bill->id}},function(data){
                    $("#payment_status").html(data);
                });

                $(this).attr('disabled',true);
            });
        });
  </script>
  @endsection