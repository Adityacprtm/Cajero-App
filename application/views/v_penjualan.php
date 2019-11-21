<!-- Begin Page Content -->
<div class="container-fluid">

	<?php $this->load->view('components/vc_breadcrumb.php') ?>

	<!-- Page Heading -->
	<h1 class="h3 mb-3 text-gray-800">Penjualan</h1>

	<?php if ($this->session->flashdata('success')) : ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo $this->session->flashdata('success'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')) : ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php echo $this->session->flashdata('error'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif; ?>

	<div id="res-err-message" class="d-none alert alert-danger alert-dismissible fade show" role="alert">
		<!-- <div id="res-message"></div> -->
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div id="res-ok-message" class="d-none alert alert-success alert-dismissible fade show" role="alert">
		<!-- <div id="res-message"></div> -->
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="row">
		<div class="col-xl-8 col-lg-7">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Produk</th>
									<th>Kategori</th>
									<th>Supplier</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Unit</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Produk</th>
									<th>Kategori</th>
									<th>Supplier</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Unit</th>
									<th>Aksi</th>
								</tr>
							</tfoot>
							<!-- <tbody>
								<?php foreach ($produk as $produk) { ?>
									<tr>
										<td><?php echo $produk->ProdukID ?></td>
										<td>
											<?php echo $produk->ProdukNama ?>
										</td>
										<td>
											<?php echo $produk->KategoriNama ?>
										</td>
										<td>
											<?php echo $produk->SupplierNama ?>
										</td>
										<td>
											<?php echo $produk->Harga ?>
										</td>
										<td>
											<?php echo $produk->Jumlah ?>
										</td>
										<td>
											<?php echo $produk->Unit ?>
										</td>
										<td>
											<button <?php echo ($produk->Jumlah == 0) ? "disabled" : ""; ?> id="btnAddCart" class="btn btn-sm <?php echo ($produk->Jumlah == 0) ? " btn-secondary" : " btn-success"; ?>"><i class="fas fa-cart-plus"></i></button>
										</td>
									</tr>
								<?php } ?>
							</tbody> -->
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Keranjang Belanja</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="table-responsive">
						<table id="cartTable" class="table display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Aksi</th>
								</tr>
							</tfoot>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php $this->load->view('components/vc_modal_bayar') ?>