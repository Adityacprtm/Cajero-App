// Call the dataTables jQuery plugin
$(document).ready(function () {

	// ERROR Handling datatables
	$.fn.dataTable.ext.errMode = 'throw';

	// window.onbeforeunload = function () {
	// 	return "Jangan refresh halaman ini secara manual!";
	// }
	//-------------------------------------------------------
	//prevent refresh
	// function disableF5(e) {
	// 	if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault();
	// };
	// $(document).on("keydown", disableF5);

	//-------------------------------------------------------
	//data table
	$('#dataTable').DataTable({
		lengthMenu: [
			[10, 25, 50, 100, -1],
			[10, 25, 50, 100, "All"]
		],
		"order": [
			[1, "asc"]
		],
		"ajax": {
			"dataType": 'json',
			"contentType": "application/json; charset=utf-8",
			"type": "GET",
			"url": "api/produk",
			"dataSrc": "produk"
		},
		"columns": [{
			"data": "ProdukID"
		}, {
			"data": "ProdukNama"
		}, {
			"data": "KategoriNama"
		}, {
			"data": "SupplierNama"
		}, {
			"data": "Harga"
		}, {
			"data": "Jumlah"
		}, {
			"data": "Unit"
		}, {
			"data": "Jumlah",
			render: function (data, type, row, meta) {
				if (data == 0) {
					return '<button disabled id="btnAddCart" class="btn btn-sm btn-secondary"><i class="fas fa-cart-plus"></i></button>';
				} else {
					return '<button id="btnAddCart" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"></i></button>';
				}
			}
		}]
	});
	var dataTable = $('#dataTable').DataTable(); //define the cart table
	dataTable.column(0).visible(false);
	//-------------------------------------------------------


	//-------------------------------------------------------
	//cart table
	$('#cartTable').DataTable({
		// "scrollY": "200px",
		// "scrollCollapse": true,
		"order": [
			[1, "asc"]
		],
		"searching": false, //remove search box
		"paging": false, //remove paging 
		"info": false, //remove 1 of x entries
		"language": {
			"emptyTable": "Keranjang belanja kosong",
		},
		"footerCallback": function (row, data, start, end, display) {
			var api = this.api(),
				data;

			// Total over all pages
			var total = api
				.column(3)
				.data()
				.reduce(function (a, b) {
					return parseInt(a) + parseInt(b);
				}, 0);

			// Update footer
			$(api.column(0).footer()).html('');
			$(api.column(1).footer()).html('');
			$(api.column(2).footer()).html('');
			$(api.column(3).footer()).html('<div class="a_checkout_outer">' + Number(total) + '</div>');
			$(api.column(4).footer()).html('<div class="a_checkout_outer"><button id="btnCheckout" class="btn btn-sm btn-warning text-dark a_checkout">Checkout</button></div>');
		}
	});
	var cartTable = $('#cartTable').DataTable(); //define the cart table
	cartTable.column(0).visible(false);
	//-------------------------------------------------------

	//--------------------------------------------------			 
	//Action click event data table - add to cart
	$('#dataTable tbody').on('click', '#btnAddCart', function () {
		var row = dataTable.row($(this).parents('tr')).index()
		var data = dataTable.row($(this).parents('tr')).data();

		console.log(data)

		var currentValue = data.Jumlah

		if (currentValue != 0) {
			dataTable.cell({
				row: row,
				column: 5
			}).data(parseInt(data.Jumlah) - 1).draw()

			if (cartTable.rows().count() == 0) {
				cartTable.row.add([data.ProdukID, data.ProdukNama, 1, data.Harga, '<button id="btnRemoveCart" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>']).draw(false);
			} else {
				var isExist = false
				for (let i = 0; i < cartTable.rows().count(); i++) {
					if (data.ProdukID == cartTable.cell(i, 0).data()) {
						cartTable.cell(i, 2).data(parseInt(cartTable.cell(i, 2).data()) + 1)
						cartTable.cell(i, 3).data(parseInt(cartTable.cell(i, 2).data()) * parseInt(dataTable.cell(row, 4).data()))
						// cartTable.draw();
						isExist = true
					}
				}
				if (isExist == false) {
					cartTable.row.add([data.ProdukID, data.ProdukNama, 1, data.Harga, '<button id="btnRemoveCart" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>']).draw(false);
				}
			}
			//Add to cart table
			createCartCookie();
			// dataTable.draw()
			cartTable.draw();
		}

		var valueAfterClick = data.Jumlah

		if (valueAfterClick == 0) {

			dataTable.cell({
				row: row,
				column: 7
			}).render('<button disabled id="btnAddCart" class="btn btn-sm btn-secondary"><i class="fas fa-cart-plus"></i></button>')
		}

		dataTable.draw()
	});
	//--------------------------------------------------

	//--------------------------------------------------
	//Action click event row().remove() - remove from cart
	$('#cartTable tbody').on('click', '#btnRemoveCart', function () { //remove the row
		var rowCart = cartTable.row($(this).parents('tr'));
		var dataCart = cartTable.row($(this).parents('tr')).data();

		for (let i = 0; i < dataTable.rows().count(); i++) {
			if (dataTable.cell(i, 0).data() === dataCart[0]) {
				// console.log(dataTable.cell(i, 5).data())
				dataTable.cell({
					row: i,
					column: 5
				}).data(parseInt(dataTable.cell(i, 5).data()) + parseInt(cartTable.cell(rowCart, 2).data())).draw()
				// console.log(dataTable.cell(i, 5).data())
				dataTable.cell({
					row: i,
					column: 7
				}).render('<button id="btnAddCart" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"></i></button>')
				console.log(dataTable.cell(i, 5).data())
			}
		}

		//var rowNode = row.node();
		rowCart.remove();
		//Cookies.remove('itemCart');	//Delete all cookies				
		cartTable.draw();
		createCartCookie(); //Create new cookie		
	});
	//--------------------------------------------------

	//--------------------------------------------------
	//Action click event for checkout - checkoutF from cart
	$('#cartTable tfoot').on('click', '#btnCheckout', function () {
		var cartTableData = cartTable.rows().data().toArray();
		var totalHarga = $("#cartTable tfoot th:nth-child(3)").text()
		var checkout = []

		if (cartTableData.length != 0) {
			for (let i = 0; i < cartTableData.length; i++) {
				checkout.push({
					'ProdukID': cartTableData[i][0],
					'ProdukNama': cartTableData[i][1],
					'Jumlah': cartTableData[i][2],
					'Harga': cartTableData[i][3]
				})
			}
			checkout.push(totalHarga)

			// console.log(JSON.stringify(checkout))

			if ($('#checkoutModal').modal('show')) {

				$('#total-harga').val(checkout[checkout.length - 1])

				$("#total-bayar").on("keypress keyup blur", function (event) {
					$(this).val($(this).val().replace(/[^\d].+/, ""));
					if ((event.which < 48 || event.which > 57)) {
						event.preventDefault();
					} else {
						$('#kembalian').val(parseInt($('#total-bayar').val()) - parseInt($('#total-harga').val()))
					}
				});
			}

			$('#submitCheckout').on('click', function () {
				if ($('#kembalian').val() > 0) {
					var request
					request = new XMLHttpRequest()
					request.open("POST", "penjualan/checkout", true)
					request.setRequestHeader("Content-type", "application/json")
					request.send(JSON.stringify(checkout))
					request.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							var contentType = request.getResponseHeader("Content-Type");
							if (contentType == 'application/json') {
								var res = JSON.parse(this.responseText)
								if ((res.status).toLowerCase() != 'ok') {
									$('#res-err-message').text(res.message)
									$('#res-err-message').removeClass("d-none")
									setTimeout(() => {
										$('#res-err-message').addClass("d-none")
									}, 5000)
								} else {
									$('#checkoutModal').modal('toggle');
									$('#res-ok-message').text(res.message)
									$('#res-ok-message').removeClass("d-none")
									setTimeout(function () {
										$('#res-ok-message').addClass("d-none")
										Cookies.remove('itemCart'); //Delete all cookies
										location.reload()
									}, 2000)
								}
							}
						}
					};
				} else {
					$('#modal-err-message').text('Oops! Periksa kembali pembayaran')
					$('#modal-err-message').removeClass("d-none")
					setTimeout(() => {
						$('#modal-err-message').addClass("d-none")
					}, 3000)
				}
			})
			// console.log(checkout)

		} else {
			$('#res-err-message').text('Oops! Keranjang masih kosong')
			$('#res-err-message').removeClass("d-none")
			setTimeout(() => {
				$('#res-err-message').addClass("d-none")
			}, 5000)
		}
	});
	//--------------------------------------------------

	$('#checkoutModal').on('hidden.bs.modal', function () {
		$(this).find('form').trigger('reset');
	})

	$('#checkout-cancel').on('click', function () {
		$(this).find('form').trigger('reset');
	})

	//--------------------------------------------------
	/* Fungsi formatRupiah */
	// function formatRupiah(angka, prefix) {
	// 	var number_string = angka.replace(/[^,\d]/g, "").toString(),
	// 		split = number_string.split(","),
	// 		sisa = split[0].length % 3,
	// 		rupiah = split[0].substr(0, sisa),
	// 		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// 	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	// 	if (ribuan) {
	// 		separator = sisa ? "." : "";
	// 		rupiah += separator + ribuan.join(".");
	// 	}
	// 	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	// 	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	// }
	//--------------------------------------------------

	//--------------------------------------------------			
	//Update the cookie with new cartText string
	function saveCookieJSON(cartText) {
		//Cookies.remove('itemCart');							//remove old cookie
		Cookies.set('itemCart', cartText, {
			expires: 7
		}); //overwrite cookie using the text data
	}
	//--------------------------------------------------

	//--------------------------------------------------			
	//Crete the cookie from table data
	function createCartCookie() {
		// var data = table.row($(this).parents('tr')).data();
		var id = "";
		var produk = "";
		var jumlah = "";
		var harga = "";
		var cartText = " [ ";
		var tableCookie = $('#cartTable').DataTable();
		var cartTableCookie = tableCookie.rows().data();
		var j = 0;
		cartTableCookie.each(function (value, index) {
			if (j > 0) {
				cartText = cartText + ",";
			}
			j++;
			id = value[0];
			produk = value[1];
			jumlah = value[2];
			harga = value[3];
			cartText = cartText + " {'id':'" + id + "', 'produk':'" + produk + "', 'jumlah':'" + jumlah + "', 'harga':'" + harga + "'} ";
		});
		cartText = cartText + " ] ";
		// alert(cartText);
		saveCookieJSON(cartText);
	}
	//--------------------------------------------------

	//Check if cookie exists.  If it does and there are entries, then read cookie and do cartTable.row.add(...).
	//When add to cart, create cookie and add product to cookie.
	//When remvoe from cart, recreate the cookie.		
	var savedCookie = getCookieJSON();
	if (savedCookie == "") {
		//alert("none");
	} else {
		var json = eval("(" + savedCookie + ")"); //eval not correct way
		// var json = JSON.parse(savedCookie);
		$.each(json, function () {
			var id = "";
			var produk = "";
			var jumlah = "";
			var harga = "";
			$.each(this, function (name, value) {
				if (name === 'id') {
					id = value;
				}
				if (name === 'produk') {
					produk = value;
				}
				if (name === 'jumlah') {
					jumlah = value;
				}
				if (name === 'harga') {
					harga = value;
				}
				// alert(name + '=' + value);
			});
			//recid = value;			
			cartTable.row.add([id, produk, jumlah, harga, '<button id="btnRemoveCart" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>']).draw(false);
		});
	}
	//--------------------------------------------------

	//--------------------------------------------------
	//Get the cookie called 'itemCart' and return as JSON
	function getCookieJSON() {
		var result;
		result = Cookies.getJSON('itemCart');
		return result;
	}
	//--------------------------------------------------	
});
