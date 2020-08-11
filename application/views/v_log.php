<div class="container-fluid">

	<?php $this->load->view('components/vc_breadcrumb.php') ?>

	<div class="d-sm-flex align-items-center justify-content-between mb-3">
		<h1 class="h3 mb-0 text-gray-800">Log Aktivitas</h1>
		<a href="<?php echo base_url('log/log_download') ?>" role="button" class="btn btn-sm btn-primary btn-icon-split float-right">
			<span class="icon text-white-50">
				<i class="fas fa-download"></i>
			</span>
			<span class="text">Log Aktivitas</span>
		</a>
	</div>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary float-left">Data Log Aktivitas</h6>
		</div>
		<div class="card-body">
			<textarea class="form-control" id="log" name="log" style="font-size: 12px; overflow-y: scroll; height: 300px; resize: none;" readonly><?php foreach ($logs as $log) {
																																						echo $log->Waktu . "\t\t" . $log->Username . "\t\t" . $log->Tipe . " \t\t" . $log->Deskripsi . "\n";
																																					} ?>
            </textarea>
		</div>
	</div>
</div>

<script>
	var textarea = document.getElementById('log');
	textarea.scrollTop = textarea.scrollHeight;
</script>