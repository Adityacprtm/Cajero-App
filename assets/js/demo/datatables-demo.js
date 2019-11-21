// Call the dataTables jQuery plugin
$(document).ready(function () {

	//-------------------------------------------------------
	//data table
	$('#dataTable').DataTable({
		"order": [
			[1, "asc"]
		],
	});
	var dataTable = $('#dataTable').DataTable(); //define the cart table
	dataTable.column(0).visible(false);
	//-------------------------------------------------------


	//-------------------------------------------------------
	//cart table
	$('#cartTable').DataTable({
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

			// Remove the formatting to get integer data for summation
			var intVal = function (i) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '') * 1 :
					typeof i === 'number' ?
					i : 0;
			};

			// Total over all pages
			var total = api
				.column(2)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(0).footer()).html('');
			$(api.column(1).footer()).html('');
			$(api.column(2).footer()).html('<div class="a_checkout_outer">' + Number(total) + '</div>');
			$(api.column(3).footer()).html('<div class="a_checkout_outer"><button id="btncheckout" class="btn btn-sm btn-warning text-dark a_checkout">Checkout</button></div>');
		}
	});
	var cartTable = $('#cartTable').DataTable(); //define the cart table
	cartTable.column(0).visible(false);
	//-------------------------------------------------------

	//--------------------------------------------------			 
	//Action click event data table - add to cart
	$('#dataTable tbody').on('click', '#btnAddCart', function () {
		var data = dataTable.row($(this).parents('tr')).data();
		// console.log(data)
		//Add to cart table
		cartTable.row.add([data[0], data[1], data[4], '<button id="btnRemoveCart" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>']).draw(false);
		createCookie();
		// cartTable.draw();
	});
	//--------------------------------------------------

	//--------------------------------------------------
	//Action click event row().remove() - remove from cart
	$('#cartTable tbody').on('click', '#btnRemoveCart', function () { //remove the row
		var row = cartTable.row($(this).parents('tr'));
		//var rowNode = row.node();
		row.remove();
		//Cookies.remove('itemCart');	//Delete all cookies				
		cartTable.draw();
		createCookie(); //Create new cookie		
	});
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
	function createCookie() {
		// var data = table.row($(this).parents('tr')).data();
		var recid = "";
		var item_number = "";
		var cost = "";
		var cartText = " [ ";
		var tableCookie = $('#cart').DataTable();
		var cartTableCookie = tableCookie.rows().data();
		var j = 0;
		cartTableCookie.each(function (value, index) {
			if (j > 0) {
				cartText = cartText + ",";
			}
			j++;
			recid = value[0];
			item_number = value[1];
			cost = value[2];
			cartText = cartText + " {'recid':'" + recid + "', 'item_number':'" + item_number + "', 'cost':'" + cost + "' } ";
			//cartText = cartText + "{\"recid\":\"" + recid + "\", \"item_number\":\"" + item_number + "\", \"currency\":\"" + currency + "\", \"cost\":\"" + cost + "\" } ";
		});
		cartText = cartText + " ] ";
		// alert(cartText);
		saveCookieJSON(cartText);
	}
	//--------------------------------------------------	
});
