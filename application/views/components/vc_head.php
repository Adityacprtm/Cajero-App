<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?></title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>">
    <link href="<?php echo base_url('assets/nunito-font.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">

    <link rel="icon" href="<?php echo base_url('assets/img/icon.png') ?>" type="image/x-icon">

    <?php if ($this->uri->segment(1) != 'dashboard') { ?>
        <!-- Custom styles for this page -->
        <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
    <?php } ?>

</head>

<?php if ($this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'register') { ?>

    <body class="bg-gradient-primary">
    <?php } else { ?>

        <body id="page-top" class="sidebar-toggled">
        <?php } ?>