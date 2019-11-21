$(document).ready(function () {

	var keuntungan = $('#totalPenjualan').text() - $('#totalModal').text()
	var kerugian = $('#totalModal').text() - $('#totalPenjualan').text()

	if (keuntungan < 0) keuntungan = 0

	if (kerugian < 0) kerugian = 0

	$('#totalLaba').text(formatRupiah((keuntungan).toString(), "Rp. "))
	$('#totalMinus').text(formatRupiah((kerugian).toString(), "Rp. "))
	$('#totalPenjualan').text(formatRupiah($('#totalPenjualan').text(), "Rp. "))
	$('#totalModal').text(formatRupiah($('#totalModal').text(), "Rp. "))

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
			split = number_string.split(","),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	}

})
