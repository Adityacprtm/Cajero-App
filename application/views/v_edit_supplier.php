<div class="container-fluid">

    <?php $this->load->view('components/vc_breadcrumb.php') ?>

    <h1 class="h3 mb-3 text-gray-800">Supplier</h1>

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
            <h6 class="m-0 font-weight-bold text-primary">Edit Supplier</h6>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('supplier/edit') ?>" method="post">
                <input type="hidden" name="supplier-id" value="<?php echo $supplier->SupplierID ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" name="supplier-nama" class="form-control" value="<?= $supplier->SupplierNama ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?= $supplier->Alamat ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="<?= $supplier->Telepon ?>" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update"></input>
                        <a href="<?php echo base_url('supplier') ?>" class="btn btn-secondary" role="button">Kembali</a>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Daftar Supplier</label>
                        <textarea class="form-control" id="log" name="log" style="overflow-y: scroll; height: 210px; resize: none;" readonly><?php foreach ($suppliers as $supplier) {
                                                                                                                                                    echo $supplier->SupplierNama . "\n";
                                                                                                                                                } ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>