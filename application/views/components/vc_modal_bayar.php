<!-- Logout Modal-->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<div class="modal-body" id="checkoutModalBody">
				<div id="modal-err-message" class="d-none alert alert-danger alert-dismissible fade show" role="alert">
					<!-- <div id="res-message"></div> -->
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="form-group">
					<label>Total Harga</label>
					<input readonly type="text" id="total-harga" class="form-control">
				</div>
				<div class="form-group">
					<label>Total Bayar</label>
					<input type="text" id="total-bayar" class="form-control">
				</div>
				<div class="form-group">
					<label>Kembalian</label>
					<input type="text" id="kembalian" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button id="checkout-cancel" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<button id="submitCheckout" class="btn btn-primary" type="button">Submit</button>

			</div>

		</div>
	</div>
</div>