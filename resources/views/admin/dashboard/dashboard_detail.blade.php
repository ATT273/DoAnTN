{{-- Orders --}}
<div class="row" id="orders-sec">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header"><h4>New Orders</h4></div>
            <div class="box-body">
            	<table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order Date</th>
                    <th>Customer</th>
                    <th>Confirmation</th>
                    <th>Transfer Status</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bills as $bill)
                  <tr>
                    <td><a href="admin/bill/detail/{{$bill->id}}">{{$bill->id}}</a></td>
                    <td>{{$bill->order_date}}</td>
                    <td><a href="admin/user/p/{{$bill->user->id}}">{{$bill->user->name}}</a></td>
                    <td>
                      @if($bill->confirmation == 0)<i class="fa fa-check status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua xac nhan"></i>@endif
                      @if($bill->confirmation == 1)<i class="fa fa-check status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da xac nhan"></i>@endif
                    </td>
                    <td>
                      @if($bill->transfer_status == 0)<i class="fa fa-truck status-default fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua van chuyen"></i>@endif
                      @if($bill->transfer_status == 1)<i class="fa fa-truck status-success fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Dang van chuyen">@endif
                    </td>
                    <td>
                      @if($bill->payment_status == 0)<i class="fa fa-credit-card status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua thanh toan"></i>@endif
                      @if($bill->payment_status == 1)<i class="fa fa-credit-card status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da thanh toan"></i>@endif
                    </td>
                    <td>@money($bill->total)</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

{{-- Report --}}
<div class="row" id="report-sec">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header"><h4>Gross Revenue</h4></div>
            <div class="box-body">
            	<div class="row">
         			<div class="col-xs-4">
         				<div class="report-header col-xs-7"><h4>Date</h4></div>
         				<div class="report-body col-xs-5"><h4 class="pull-right">{{$report->date}}</h4></div>
         			</div>
             		<div class="col-xs-4">
             			<div class="report-header col-xs-7"><h4>Number of orders</h4></div>
         				<div class="report-body col-xs-5"><h4 class="pull-right">{{$report->number_of_orders}}</h4></div>
             		</div>
             		<div class="col-xs-4">
             			<div class="report-header col-xs-7"><h4>Sold Products</h4></div>
         				<div class="report-body col-xs-5"><h4 class="pull-right">{{$report->number_products_sold}}</h4></div>
             		</div>
         		</div>
         		<div class="row">
         			<div class="col-xs-4">
         				<div class="report-header col-xs-7"><h4>Gross Revenue</h4></div>
         				<div class="report-body col-xs-5"><h4 class="pull-right">@money($report->gross_revenue)</h4></div>
         			</div>
             		<div class="col-xs-4">
             			<div class="report-header col-xs-7"><h4>Discount Amount</h4></div>
         				<div class="report-body col-xs-5"><h4 class="pull-right">@money($report->discount_amount)</h4></div>
             		</div>
             		<div class="col-xs-4">
             			<div class="report-header col-xs-7"><h4>Received</h4></div>
         				<div class="report-body col-xs-5"><h4 class="pull-right">@money($report->received)</h4></div>
             		</div>
         		</div>
            </div>
        </div>
    </div>
</div>

{{-- Top product --}}
<div class="row" id="products-sec">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header"><h4>Top products</h4></div>
            <div class="box-body">
            	<div class="row">
            		@foreach($topProducts as $topPr)
            			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            				<div class="topPr-img">
            					<img src="upload/product/{{$topPr->productimg->first()->name}}" width="200">
            				</div>
            				<div class="topPr-body">
            					<h4><a href="product/{{$topPr->id}}">{{$topPr->name}}</a></h4>
                                @if($topPr->promo_price != 0)
                                    <p><strike>Price: @money($topPr->price)</strike></p>
                                    <p>Promo Price: @money($topPr->promo_price)</p>
                                @elseif($topPr->promo_price == 0)
                                    <p>Price: @money($topPr->price)</p>
                                @endif
                                <p>In Stock: {{$topPr->quantity}}</p>
                                <p>Sold: {{$topPr->sold}}</p>
            				</div>
            			</div>
            		@endforeach
            	</div>
            </div>
        </div>
    </div>
</div>

{{-- Users --}}
<div class="row" id="users-sec">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header"><h4>Users</h4></div>
            <div class="box-body"></div>
        </div>
    </div>
</div>