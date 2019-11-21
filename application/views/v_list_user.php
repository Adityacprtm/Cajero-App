<!-- Begin Page Content -->
<div class="container-fluid">

    <?php $this->load->view('components/vc_breadcrumb.php') ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">List Users</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">List User</h6>
            <!-- <a href="<?php echo base_url('user/users/add') ?>" role="button" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-cart-plus"></i>
                </span>
                <span class="text">Tambah User</span>
            </a> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Username</th>
                            <th>Kelas</th>
                            <th>Dibuat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User ID</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Username</th>
                            <th>Kelas</th>
                            <th>Dibuat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <!-- <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td> <?php echo $user->UserID ?> </td>
                                <td> <?php echo $user->NamaDepan ?> </td>
                                <td> <?php echo $user->NamaBelakang ?> </td>
                                <td> <?php echo $user->Username ?> </td>
                                <td> <?php echo $user->Kelas ?> </td>
                                <td> <?php echo $user->Tanggal ?> </td>
                                <td> <?php echo ($user->Status == 1) ? '<kbd class="text-dark bg-light border-left-success">Disetujui</kbd>' : (($user->Status == 2) ? '<kbd class="text-dark bg-light border-left-warning">Menunggu</kbd>' : '<kbd class="text-dark bg-light border-left-danger">Ditolak</kbd>')  ?> </td>
                                <td>
                                    <?php if ($user->Status == 1) { ?>
                                        <a href="<?php echo base_url('user/decline/' . $user->Username) ?>" role="button" class="btn btn-sm btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Tolak</span>
                                        </a>
                                        <a href="<?php echo base_url('user/wait/' . $user->Username) ?>" role="button" class="btn btn-sm btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-circle-notch"></i>
                                            </span>
                                            <span class="text text-dark">Tunggu</span>
                                        </a>
                                    <?php } elseif ($user->Status == 2) { ?>
                                        <a href="<?php echo base_url('user/approve/' . $user->Username) ?>" role="button" class="btn btn-sm btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Setujui</span>
                                        </a>
                                        <a href="<?php echo base_url('user/decline/' . $user->Username) ?>" role="button" class="btn btn-sm btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Tolak</span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url('user/approve/' . $user->Username) ?>" role="button" class="btn btn-sm btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Setujui</span>
                                        </a>
                                        <a href="<?php echo base_url('user/wait/' . $user->Username) ?>" role="button" class="btn btn-sm btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-circle-notch"></i>
                                            </span>
                                            <span class="text text-dark">Tunggu</span>
                                        </a>
                                    <?php } ?>
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