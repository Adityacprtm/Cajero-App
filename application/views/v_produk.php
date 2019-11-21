<!-- Begin Page Content -->
<div class="container-fluid">

	<?php $this->load->view('components/vc_breadcrumb.php') ?>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-3">
		<h1 class="h3 mb-0 text-gray-800">Produk</h1>
		<a href="<?php echo base_url('produk/add') ?>" role="button" class="btn btn-sm btn-primary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fas fa-cart-plus"></i>
			</span>
			<span class="text">Tambah Produk</span>
		</a>
	</div>

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

	<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="produkTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Kategori</th>
							<th>Supplier</th>
							<th>Modal</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Unit</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Nama</th>
							<th>Kategori</th>
							<th>Supplier</th>
							<th>Modal</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Unit</th>
							<th>Aksi</th>
						</tr>
					</tfoot>
					<!-- <tbody>
						<?php foreach ($produk as $produk) { ?>
							<tr>
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
									<?php echo $produk->Modal ?>
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
									<a href="<?php echo base_url('produk/edit/' . $produk->ProdukID) ?>" role="button" class="btn btn-sm btn-warning btn-icon-split">
										<span class="icon text-white-50">
											<i class="fas fa-edit"></i>
										</span>
										<span class="text">Edit</span>
									</a>
									<a href="<?php echo base_url('produk/delete/' . $produk->ProdukID) ?>" role="button" class="btn btn-sm btn-danger btn-icon-split">
										<span class="icon text-white-50">
											<i class="fas fa-trash"></i>
										</span>
										<span class="text">Hapus</span>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody> -->
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->