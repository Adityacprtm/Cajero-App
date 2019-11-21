<div class="container-fluid">

    <?php $this->load->view('components/vc_breadcrumb.php') ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
        </div>

        <div class="card-body">
            <form action="<?php echo base_url('produk/add') ?>" method="post">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nama</label>
                        <input type="text" name="produk-nama" class="form-control" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option selected value="" disabled="disabled">Pilih...</option>
                            <?php foreach ($kategori as $kategori) { ?>
                                <option value="<?php echo $kategori->KategoriID ?>"><?php echo $kategori->KategoriNama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier" class="form-control" required>
                        <option selected value="" disabled="disabled">Pilih...</option>
                        <?php foreach ($supplier as $supplier) { ?>
                            <option value="<?php echo $supplier->SupplierID ?>"><?php echo $supplier->SupplierNama ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Modal</label>
                        <input type="number" min="0" name="modal" class="form-control" placeholder="Harga Modal" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Harga</label>
                        <input type="number" min="0" name="harga" class="form-control" placeholder="Harga Jual" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Jumlah</label>
                        <input type="number" min="0" name="jumlah" class="form-control" placeholder="Jumlah" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Unit</label>
                        <select name="unit" class="form-control" required>
                            <option selected value="" disabled="disabled">Pilih...</option>
                            <option value="Kg">Kg</option>
                            <option value="Satuan">Satuan</option>
                            <option value="Pack">Pack</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Tambahkan"></input>
                <a href="<?php echo base_url('produk') ?>" class="btn btn-secondary" role="button">Kembali</a>

            </form>
        </div>

    </div>

</div>