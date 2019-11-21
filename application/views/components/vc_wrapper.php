<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('dashboard') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-dragon"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Cajero <sup>App</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <?php if ($this->session->userdata('kelas') == 1) { ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if ($this->uri->segment(1) == 'dashboard') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
        <?php } ?>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Produk
        </div> -->

        <!-- Nav Item - data produk -->
        <li class="nav-item <?php if ($this->uri->segment(1) == 'produk') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('produk') ?>">
                <i class="fas fa-fw fa-box-open"></i>
                <span>Produk</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Kategori -->
        <li class="nav-item <?php if ($this->uri->segment(1) == 'kategori') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('kategori') ?>">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Kategori</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Kategori -->
        <li class="nav-item <?php if ($this->uri->segment(1) == 'supplier') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('supplier') ?>">
                <i class="fas fa-fw fa-dolly-flatbed"></i>
                <span>Supplier</span></a>
        </li>

        <!-- Divider -->
        <!-- <hr class="sidebar-divider"> -->

        <!-- Nav Item - Pemasukan -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('pemasukan') ?>">
                <i class="fas fa-fw fa-cart-arrow-down"></i>
                <span>Pemasukan</span></a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Profil
        </div> -->

        <!-- Nav Item - Profil -->
        <li class="nav-item <?php if ($this->uri->segment(1) == 'user') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('user') ?>">
                <i class="fas fa-fw fa-id-card"></i>
                <span>User</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Profil -->
        <li class="nav-item <?php if ($this->uri->segment(1) == 'log') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('log') ?>">
                <i class="fas fa-fw fa-list"></i>
                <span>Log Aktivitas</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Transaksi
        </div> -->

        <!-- Nav Item - Penjualan -->
        <li class="nav-item <?php if ($this->uri->segment(1) == 'penjualan') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url('penjualan') ?>">
                <i class="fas fa-fw fa-cash-register"></i>
                <span>Penjualan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <?php if ($this->session->userdata('kelas') == 1) { ?>
            <!-- Nav Item - Transaksi -->
            <li class="nav-item <?php if ($this->uri->segment(1) == 'transaksi') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo base_url('transaksi') ?>">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Transaksi</span></a>
            </li>
        <?php } ?>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span id="jumlah-alert" class="badge badge-danger badge-counter"></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Pusat Peringatan
                            </h6>
                            <div id="alert-target"></div>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username ?></span>
                            <img class="img-profile rounded-circle" src="<?php echo base_url('assets/img/user_default.png') ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('user') ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                            </a>
                            <!-- <a class="dropdown-item" href="">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a> -->
                            <a class="dropdown-item" href="<?php echo base_url('log') ?>">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Log Aktivitas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->