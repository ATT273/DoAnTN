
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Comparison List</h4>
			</div>
			<div class="modal-body" >
				<div class="row" id="modal-body">
					@if(Session::has('compare_list'))
						@foreach ($list->items as $item)
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 compare-item">
								<div class="compare-item-del">
									<button type="button" class="btn btn-default" id="del-item-{{$item['item']['id']}}">
										<i class="fa fa-times" aria-hidden="true"></i>
									</button>
								</div>
					            <div class="compare-img">
					                <img src="upload/product/{{$item['item']->productimg->first()->name}}" height="100">
					            </div>
					            <hr>
					            <h5><strong>{{$item['item']['name']}}</strong></h5>
					            <div class="compare-detail">
					            	<div class="row">
					            		<div>
						            		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Product ID:</div>
						            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">{{$item['item']['id']}}</div>
						            	</div>
						            	<div>
						            		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">In Stock:</div>
						            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">{{$item['item']['quantity']}}</div>
						            	</div>
						            	<div>
						            		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Price:</div>
						            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">@money($item['item']['price'])</div>
						            	</div>
						            	<div>
						            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">Promo Price:</div>
						            		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">@money($item['item']['promo_price'])</div>
						            	</div>
						            </div>
					            </div>
					        </div>
						@endforeach
					@endif

					@if(!Session::has('compare_list'))
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Please select items to compare</div>
					@endif
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
