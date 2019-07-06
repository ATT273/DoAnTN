@extends('layouts.admin.admin_layout') 
@section('main_content')
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
				<div class="box">
		            <div class="box-header">
		            	<div class="row">
		            		<div class="col-xs-7">
		            			<h3 class="box-title">Bill List</h3>
		            		</div>
		            		<div class="col-xs-5">
		            			<form action="admin/report/daily-report/other" method="post">
		            				<input type="hidden" name="_token" value="{{csrf_token()}}">
									<div class="input-group date navbar-nav navbar-right" style="margin-right: 0;">
										<input type="text" name="date" id="datepicker" class="form-control" required>
										<span class="input-group-btn">
											<button type="submit" class=" btn btn-success">Check</button>
										</span>
									</div>
								</form>
		            		</div>
		            	</div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		                @if( count($bills) > 0 )
		                	<table id="example2" class="table table-bordered table-hover">
				                <thead>
				                  	<tr>
					                    <th>Date</th>
					                    <th>Bill Id</th>
					                    <th>Customer</th>
					                    <th>Discount Amount</th>
					                    <th>Subtotal</th>
					                    <th>Shipping Status</th>
					                    <th>Payment Status</th>
					                    <th>Edit</th>
					                    <th>Delete</th>
				                  	</tr>
				                </thead>
				                <tbody>
				                  	@foreach($bills as $bill)
						                <tr>
						                    <td>{{$bill->order_date}}</td>
						                    <td>{{$bill->id}}</td>
						                    <td>{{$bill->user->name}}</td>
						                    <td>{{$bill->discount_amount}}</td>
						                    <td>{{$bill->total}}</td>
						                    <td>{{$bill->transfer_status}}</td>
						                    <td>{{$bill->payment_status}}</td>
						                    <td><i class="fa fa-pencil"></i> <a href="admin/bill/edit/{{$bill->id}}">Edit</a></td>
						                    <td><i class="fa fa-trash-o"></i> <a href="admin/bill/del/{{$bill->id}}" onclick="return confirm('Ban co muon xoa danh muc nay khong?')">Delete</a></td>
						                </tr>
				                  	@endforeach
				                </tbody>
			             	</table>
			             	<br>
			             	<div class="row report-detail">
			             		<div class="row">
			             			<div class="col-xs-4">
			             				<div class="report-header col-xs-7"><h4>Date</h4></div>
			             				<div class="report-body col-xs-5"><h4 class="pull-right">{{$report[0]->date}}</h4></div>
			             			</div>
				             		<div class="col-xs-4">
				             			<div class="report-header col-xs-7"><h4>Number of orders</h4></div>
			             				<div class="report-body col-xs-5"><h4 class="pull-right">{{$report[0]->number_of_orders}}</h4></div>
				             		</div>
				             		<div class="col-xs-4">
				             			<div class="report-header col-xs-7"><h4>Sold Products</h4></div>
			             				<div class="report-body col-xs-5"><h4 class="pull-right">{{$report[0]->number_products_sold}}</h4></div>
				             		</div>
			             		</div>
			             		<div class="row">
			             			<div class="col-xs-4">
			             				<div class="report-header col-xs-7"><h4>Gross Revenue</h4></div>
			             				<div class="report-body col-xs-5"><h4 class="pull-right">@money($report[0]->gross_revenue)</h4></div>
			             			</div>
				             		<div class="col-xs-4">
				             			<div class="report-header col-xs-7"><h4>Discount Amount</h4></div>
			             				<div class="report-body col-xs-5"><h4 class="pull-right">@money($report[0]->discount_amount)</h4></div>
				             		</div>
				             		<div class="col-xs-4">
				             			<div class="report-header col-xs-7"><h4>Received</h4></div>
			             				<div class="report-body col-xs-5"><h4 class="pull-right">@money($report[0]->received)</h4></div>
				             		</div>
			             		</div>
			             	</div>
		                @else
			            	<h3>{{'There is no order today'}}</h3>
			           	@endif
		            </div>

		            <!-- BAR CHART -->
					{{-- <div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Bar Chart</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="chart">
								<canvas id="barChart" style="height:230px"></canvas>
							</div>
						</div>
						<!-- /.box-body -->
					</div> --}}
					<!-- /.box -->
		            <!-- /.box-body -->
		        </div>
	        </div>
        <!-- /.col -->
		</div>
      <!-- /.row -->
    </section>
@endsection
@section('script')

<script type="text/javascript">
	$(document).ready(function(){
	    $('#datepicker').datepicker({
	    	format: 'yyyy-mm-dd',
	    });



	//-------------
    //- BAR CHART -
    //-------------
		var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
	    var barChart                         = new Chart(barChartCanvas)
	    var barChartData = {
	      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','January', 'February', 'March', 'April', 'May', 'June', 'July'],
	      datasets: [
	        {
	          label               : 'Electronics',
	          fillColor           : 'rgba(210, 214, 222, 1)',
	          strokeColor         : 'rgba(210, 214, 222, 1)',
	          pointColor          : 'rgba(210, 214, 222, 1)',
	          pointStrokeColor    : '#c1c7d1',
	          pointHighlightFill  : '#fff',
	          pointHighlightStroke: 'rgba(220,220,220,1)',
	          data                : [
	          		@foreach ($bills as $bill) 
	          			{{$bill->total }}{{","}}
	          		@endforeach 
	          ]
	        },
	        // {
	        //   label               : 'Digital Goods',
	        //   fillColor           : 'rgba(60,141,188,0.9)',
	        //   strokeColor         : 'rgba(60,141,188,0.8)',
	        //   pointColor          : '#3b8bba',
	        //   pointStrokeColor    : 'rgba(60,141,188,1)',
	        //   pointHighlightFill  : '#fff',
	        //   pointHighlightStroke: 'rgba(60,141,188,1)',
	        //   data                : [28, 48, 40, 19, 86, 27, 90]
	        // }
	      ]
	    }
	    barChartData.datasets[0].fillColor   = '#00a65a'
	    barChartData.datasets[0].strokeColor = '#00a65a'
	    barChartData.datasets[0].pointColor  = '#00a65a'
	    var barChartOptions                  = {
	      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
	      scaleBeginAtZero        : true,
	      //Boolean - Whether grid lines are shown across the chart
	      scaleShowGridLines      : true,
	      //String - Colour of the grid lines
	      scaleGridLineColor      : 'rgba(0,0,0,.05)',
	      //Number - Width of the grid lines
	      scaleGridLineWidth      : 1,
	      //Boolean - Whether to show horizontal lines (except X axis)
	      scaleShowHorizontalLines: true,
	      //Boolean - Whether to show vertical lines (except Y axis)
	      scaleShowVerticalLines  : true,
	      //Boolean - If there is a stroke on each bar
	      barShowStroke           : true,
	      //Number - Pixel width of the bar stroke
	      barStrokeWidth          : 2,
	      //Number - Spacing between each of the X value sets
	      barValueSpacing         : 5,
	      //Number - Spacing between data sets within X values
	      barDatasetSpacing       : 1,
	      //String - A legend template
	      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
	      //Boolean - whether to make the chart responsive
	      responsive              : true,
	      maintainAspectRatio     : true
	    }

	    barChartOptions.datasetFill = false
	    barChart.Bar(barChartData, barChartOptions)
	})
</script>
@endsection