<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<?php if ($this->uri->segment(1) == 'dashboard') { ?>
	<!-- Page level plugins -->
	<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>
	<!-- Page level custom scripts -->
	<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js'); ?>"></script>
	<!-- Page level custom scripts -->
	<script src="<?php echo base_url('assets/js/dashboard-script.js'); ?>"></script>

<?php } elseif ($this->uri->segment(1) == 'penjualan') { ?>
	<!-- Page level plugins -->
	<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
	<!-- Page level custom scripts -->
	<script src="<?php echo base_url('assets/js/datatables-penjualan.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/js.cookie-2.2.1.min.js') ?>"></script>

<?php } ?>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/js/sb-admin-2.js'); ?>"></script>

</body>

</html>