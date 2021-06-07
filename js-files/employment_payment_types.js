$(document).ready(function() {
	list_employment_payment_type();

	$('#add_payment_type').on('click', payment_type);

	$(document).on('click', '.delete_employment_payment', function() {
		var payment_type_id = $(this).attr('id').replace(/pay_/, ''); // table row ID
		delete_payment_type(payment_type_id);
	});

	$('#add_pay_type').on('click', add_pay_type);

	$('#payment_creditdebit').on('change', () => {
		if ($('#payment_creditdebit').val() == 'Debit') {
			$('#taxSays').show();
		} else {
			$('#taxSays').hide();
			$('#taxSays_text').attr('checked', false);
		}
	});
});

function payment_type() {
	$('#payment_type_display').toggle();
	$('#payment_description').val('');
	$('#payment_name').val('');
	$('#payment_creditdebit').val('');

	$('#error_pay_type').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function list_employment_payment_type() {
	var company_id = localStorage.getItem('company_id');
	// var page = 1;
	// var limit = 10;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_payment_types',
		data: {
			company_id: company_id,
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();

				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['payment_type_id'] + '">';
						strTable += '<td>' + response['data'][i]['payment_type_name'] + '</td>';

						strTable +=
							'<td>' + response['data'][i]['payment_type_credit_or_debit'] + '</td>';

						strTable +=
							'<td><a href="' +
							site_url +
							'/' +
							'hrm' +
							'/' +
							'edit_emp_pay_type?id=' +
							response['data'][i]['payment_type_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employment Payment Type"></i></a>&nbsp;&nbsp; <a  class="delete_employment_payment" style="cursor: pointer;" id="pay_' +
							response['data'][i]['payment_type_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employment Type"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['payment_type_id'] +
							'">';
						strTable +=
							'<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="3">' + response.msg + '</td></tr>';
				}

				$('#paymentData').html(strTable);
				$('#paymentData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#paymentData').html(strTable);
				$('#paymentData').show();
			}
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}

function delete_payment_type(payment_type_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this user');
	if (!ans) {
		return;
	}

	$('#row_' + payment_type_id).hide();
	$('#loader_row_' + payment_type_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_payment_type',
		data: {
			company_id: company_id,
			payment_type_id: payment_type_id,
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + payment_type_id).hide();
			$('#row_' + payment_type_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + payment_type_id).hide();
		},
	});
}

function add_pay_type() {
	var payment_name = $('#payment_name').val();
	var payment_description = $('#payment_description').val();
	var payment_creditdebit = $('#payment_creditdebit').val();
	let formula = $('#formula').val();

	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');

	var blank;
	let is_taxable;

	if ($('#taxSays_text').is(':checked')) {
		is_taxable = 1;
	} else {
		is_taxable = 0;
	}

	// alert(is_taxable);

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#error_pay_type').html('You have a blank field');

		return;
	}

	$('#add_pay_type').hide();
	$('#add_pay_loading').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_payment_type',
		data: {
			payment_name: payment_name,
			payment_description: payment_description,
			company_id: company_id,
			payment_creditdebit: payment_creditdebit,
			user_id: user_id,
			formula: formula,
			is_taxable: is_taxable,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_pay').modal('show');

				$('#modal_pay').on('hidden.bs.modal', function() {
					// do something…
					window.location.reload();
					//window.location.href = base_url+"/erp/hrm/employees";
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_pay_type').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_pay_type').html(response.msg);
			}

			$('#add_pay_type').show();
			$('#add_pay_loading').hide();
		},
		error: function(response) {
			$('#add_pay_type').show();
			$('#add_pay_loading').hide();
			$('#error_pay_type').html('Connection Error.');
		},
	});
}
