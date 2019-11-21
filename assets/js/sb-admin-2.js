(function ($) {
	"use strict"; // Start of use strict
	// ERROR Handling datatables
	$.fn.dataTable.ext.errMode = 'throw';

	// Toggle the side navigation
	$("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
		$("body").toggleClass("sidebar-toggled");
		$(".sidebar").toggleClass("toggled");
		if ($(".sidebar").hasClass("toggled")) {
			$('.sidebar .collapse').collapse('hide');
		};
	});

	// Close any open menu accordions when window is resized below 768px
	$(window).resize(function () {
		if ($(window).width() < 768) {
			$('.sidebar .collapse').collapse('hide');
		};
	});

	// Prevent the content wrapper from scrolling when the fixed side navigation hovered over
	$('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
		if ($(window).width() > 768) {
			var e0 = e.originalEvent,
				delta = e0.wheelDelta || -e0.detail;
			this.scrollTop += (delta < 0 ? 1 : -1) * 30;
			e.preventDefault();
		}
	});

	// Scroll to top button appear
	$(document).on('scroll', function () {
		var scrollDistance = $(this).scrollTop();
		if (scrollDistance > 100) {
			$('.scroll-to-top').fadeIn();
		} else {
			$('.scroll-to-top').fadeOut();
		}
	});

	// Smooth scrolling using jQuery easing
	$(document).on('click', 'a.scroll-to-top', function (e) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: ($($anchor.attr('href')).offset().top)
		}, 1000, 'easeInOutExpo');
		e.preventDefault();
	});

	//-----------------------------------------------
	// Alert show fade timer
	if ($('.alert-success').show()) {
		setTimeout(() => {
			$('.alert-success').fadeOut()
		}, 3000)
	}
	if ($('.alert-danger').show()) {
		setTimeout(() => {
			$('.alert-danger').fadeOut()
		}, 3000)
	}
	//-----------------------------------------------

	//-----------------------------------------------
	// Alert information GET API
	$.get("api/alert", function (data, status) {
		if (!data.stok && !data.user) {
			$('#alert-target').append('<br><p class="text-center small text-gray-500">Yeay! tidak ada peringatan saat ini.</p>')
		} else {
			data.stok.forEach(item => {
				$('#alert-target').append('<a class="dropdown-item d-flex align-items-center" href="produk/edit/' + item.ProdukID + '"><div class="mr-3"><div class="icon-circle bg-warning"><i class="fas fa-exclamation-triangle text-white"></i></div></div><div><div class="small text-gray-500">Peringatan Produk</div>Stok <span style="color:red;"><strong>' + item.ProdukNama + '</strong></span> tersisa <strong>' + item.Jumlah + '</strong>. \n Silahkan pesan lagi!</div></a>')
			});
			data.user.forEach(item => {
				$('#alert-target').append('<a class="dropdown-item d-flex align-items-center" href="user/users/"><div class="mr-3"><div class="icon-circle bg-warning"><i class="fas fa-exclamation-triangle text-white"></i></div></div><div><div class="small text-gray-500">Peringatan User</div>Akun dengan username <span style="color:red;"><strong>' + item.Username + '</strong></span> telah mendaftar. Klik <strong>disini</strong></div></a>')
			});
		}
		var jumlah_alert = data.stok.length + data.user.length
		$('#jumlah-alert').text(jumlah_alert)
	});
	//-----------------------------------------------

	//-------------------------------------------------------
	//kategori table
	$('#kategoriTable').DataTable({
		"order": [
			[0, "asc"]
		],
		"ajax": {
			"dataType": 'json',
			"contentType": "application/json; charset=utf-8",
			"type": "GET",
			"url": "api/kategori",
			"dataSrc": "kategori"
		},
		"columns": [{
			"data": "KategoriNama"
		}, {
			"data": "JumlahProduk"
		}, {
			"data": "Deskripsi"
		}, {
			"data": "KategoriID",
			render: function (data, type, row, meta) {
				return '<a href="kategori/edit/' + data + '" role="button" class="btn btn-sm btn-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">Edit</span></a> <a id="kategori-del-' + data + '" href="kategori/delete/' + data + '" role="button" class="btn btn-sm btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Hapus</span></a>';
			}
		}],
		"initComplete": function (settings, json) {
			json.kategori.forEach(item => {
				if (item.JumlahProduk != 0) {
					$('#kategori-del-' + item.KategoriID).css('pointer-events', 'none')
					$('#kategori-del-' + item.KategoriID).removeClass('btn-danger')
					$('#kategori-del-' + item.KategoriID).addClass('btn-secondary')
				}
			});

		}
	});
	//-------------------------------------------------------

	//-------------------------------------------------------
	//supplier table
	$('#supplierTable').DataTable({
		"order": [
			[0, "asc"]
		],
		"ajax": {
			"dataType": 'json',
			"contentType": "application/json; charset=utf-8",
			"type": "GET",
			"url": "api/supplier",
			"dataSrc": "suppliers"
		},
		"columns": [{
			"data": "SupplierNama"
		}, {
			"data": "Alamat"
		}, {
			"data": "Telepon"
		}, {
			"data": "SupplierID",
			render: function (data, type, row, meta) {
				return '<a href="supplier/edit/' + data + '" role="button" class="btn btn-sm btn-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">Edit</span></a> <a href="supplier/delete/' + data + '" role="button" class="btn btn-sm btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Hapus</span></a>';
			}
		}]
	});
	//-------------------------------------------------------

	//-------------------------------------------------------
	//produk table
	$('#produkTable').DataTable({
		"order": [
			[0, "asc"]
		],
		"ajax": {
			"dataType": 'json',
			"contentType": "application/json; charset=utf-8",
			"type": "GET",
			"url": "api/produk",
			"dataSrc": "produk"
		},
		"columns": [{
			"data": "ProdukNama"
		}, {
			"data": "KategoriNama"
		}, {
			"data": "SupplierNama"
		}, {
			"data": "Modal"
		}, {
			"data": "Harga"
		}, {
			"data": "Jumlah"
		}, {
			"data": "Unit"
		}, {
			"data": "ProdukID",
			render: function (data, type, row, meta) {
				return '<a href="produk/edit/' + data + '" role="button" class="btn btn-sm btn-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">Edit</span></a> <a href="produk/delete/' + data + '" role="button" class="btn btn-sm btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Hapus</span></a>';
			}
		}]
	});
	//-------------------------------------------------------

	//-------------------------------------------------------
	//user table
	$('#userTable').DataTable({
		"order": [
			[0, "asc"]
		],
		"ajax": {
			"dataType": 'json',
			"contentType": "application/json; charset=utf-8",
			"type": "GET",
			"url": "api/user",
			"dataSrc": "users"
		},
		"columns": [{
			"data": "UserID"
		}, {
			"data": "NamaDepan"
		}, {
			"data": "NamaBelakang"
		}, {
			"data": "Username"
		}, {
			"data": "Kelas"
		}, {
			"data": "Tanggal"
		}, {
			"data": "Status",
			render: function (data, type, row, meta) {
				if (data == 1) {
					return '<kbd class="text-dark bg-light border-left-success">Disetujui</kbd>';
				} else if (data == 2) {
					return '<kbd class="text-dark bg-light border-left-warning">Menunggu</kbd>';
				} else if (data == 3) {
					return '<kbd class="text-dark bg-light border-left-danger">Ditolak</kbd>';
				}
			}
		}, {
			"data": "UserID",
			render: function (data, type, row, meta) {
				return '<a id="user-apprv-' + data + '" href="approve/' + data + '" role="button" class="btn btn-sm btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Setujui</span></a> <a id="user-wait-' + data + '" href="wait/' + data + '" role="button" class="btn btn-sm btn-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-circle-notch"></i></span><span class="text text-dark">Tunggu</span></a> <a id="user-dcln-' + data + '" href="decline/' + data + '" role="button" class="btn btn-sm btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Tolak</span></a>';
			}
		}],
		"initComplete": function (settings, json) {
			json.users.forEach(item => {
				if (item.Status == 1) {
					$('#user-apprv-' + item.UserID).addClass('d-none')
				} else if (item.Status == 2) {
					$('#user-wait-' + item.UserID).addClass('d-none')
				} else if (item.Status == 3) {
					$('#user-dcln-' + item.UserID).addClass('d-none')
				}
			});
		}
	});
	//-------------------------------------------------------

	//-------------------------------------------------------
	//user table
	$('#transaksiTable').DataTable({
		"order": [
			[3, "desc"]
		],
		"ajax": {
			"dataType": 'json',
			"contentType": "application/json; charset=utf-8",
			"type": "GET",
			"url": "api/transaksi",
			"dataSrc": "transaksi"
		},
		"columns": [{
			"data": "ProdukNama"
		}, {
			"data": "Jumlah"
		}, {
			"data": "Username"
		}, {
			"data": "Tanggal"
		}]
	});
	//-------------------------------------------------------

})(jQuery); // End of use strict
