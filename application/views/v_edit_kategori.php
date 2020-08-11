<div class="container-fluid">

	<?php $this->load->view('components/vc_breadcrumb.php') ?>

	<h1 class="h3 mb-3 text-gray-800">Kategori</h1>

	<?php if ($this->session->flashdata('error')) : ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php echo $this->session->flashdata('error'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php endif; ?>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Edit Kategori</h6>
		</div>
		<div class="card-body">
			<form action="<?php echo base_url('kategori/edit') ?>" method="post">
				<input type="hidden" name="kategori-id" value="<?php echo $kategori->KategoriID ?>">
				<div class="form-row">
					<div class="form-group col-md-6">
						<div class="form-group">
							<label>Nama kategori</label>
							<input type="text" name="kategori" class="form-control" value="<?php echo $kategori->KategoriNama ?>" required>
						</div>
						<div class="form-group"><label>Deskripsi</label>
							<input type="text" name="deskripsi" class="form-control" value="<?php echo $kategori->Deskripsi ?>" required>
						</div>
						<input type="submit" name="submit" class="btn btn-primary" value="Update"></input>
						<a href="<?php echo base_url('kategori') ?>" class="btn btn-secondary" role="button">Kembali</a>
					</div>
					<div class="form-group col-md-6">
						<label>Daftar kategori Barang</label>
						<textarea class="form-control" id="log" name="log" style="overflow-y: scroll; height: 125px; resize: none;" readonly><?php foreach ($kategori_all as $kategori) {
																																					echo $kategori->KategoriNama . "\n";
																																				} ?></textarea>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>