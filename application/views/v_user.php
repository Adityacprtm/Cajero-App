<div class="container-fluid">
    <?php $this->load->view('components/vc_breadcrumb.php') ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <?php if ($user->Kelas == 1) { ?>
            <a href="<?php echo base_url('user/users') ?>" class="btn btn-sm btn-primary shadow-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-users"></i>
                </span>
                <span class="text">Daftar user</span>
            </a>
        <?php } ?>
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
    <div class="row">
        <div class="col-lg-6 mb-4">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil User</h6>
                </div>

                <div class="card-body">
                    <form action="<?php echo base_url('user/edit') ?>" method="post">
                        <input type="hidden" name="user-id" value="<?php echo $user->UserID; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Depan</label>
                                <input type="text" name="nama-depan" class="form-control" value="<?php echo $user->NamaDepan ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama Belakang</label>
                                <input type="text" name="nama-belakang" class="form-control" value="<?php echo $user->NamaBelakang ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input readonly type="text" name="username" class="form-control" value="<?php echo $user->Username ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal dibuat</label>
                                <input readonly type="text" name="tanggal" class="form-control" value="<?php echo $user->Tanggal ?>">
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update"></input>
                        <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">Hapus</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('user/password') ?>" method="post">
                        <input type="hidden" name="user-id" value="<?php echo $user->UserID; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input required type="password" name="password" class="form-control" placeholder="Password baru">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ulangi Password</label>
                                <input required type="password" name="repassword" class="form-control" placeholder="Ulangi password baru">
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>