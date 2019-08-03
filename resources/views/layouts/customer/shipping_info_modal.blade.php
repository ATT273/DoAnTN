<div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Shipping Information</h4>
			</div>
			<div class="modal-body" >
				<div class="row" id="modal-body">
					<form action="checkout" method="GET" role="form">
						<input type="hidden" name="change_info" value="shipping">
						{{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
						<div class="row change-info">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<legend>Form title</legend>
								<div class="form-group">
									<label for="">Full name</label>
									<input type="text" class="form-control" id="" name="receiver_name" required>
								</div>
								<div class="form-group">
									<label for="">Phone</label>
									<input type="text" class="form-control" id="" name="receiver_phone" required>
								</div>
								<div class="form-group">
									<label for="">Address</label>
									<input type="text" class="form-control" id="" name="shipping_address" required>
								</div>
								<button type="submit" class="btn btn-primary">Confirm</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>