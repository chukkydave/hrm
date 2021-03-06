$(document).ready(function() {
	//this time interval check if the user roles have been fetched before running anything on this page
	var myVar2 = setInterval(function() {
		if ($('#does_user_have_roles').html() != '') {
			//stop the loop
			myStopFunction();

			//does user have access to this module
			user_page_access();
		} else {
			console.log('No profile');
		}
	}, 1000);

	function myStopFunction() {
		clearInterval(myVar2);
	}
	//end of interval set

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

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		list_employment_payment_type();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

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
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
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
							'edit_salary_component?id=' +
							response['data'][i]['payment_type_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Salary Component"></i></a>&nbsp;&nbsp; <a  class="delete_employment_payment" style="cursor: pointer;" id="pay_' +
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
					strTable = '<tr><td colspan="3">No record found</td></tr>';
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
			$('#paymentData').html('<tr><td colspan="3" style="color:red;">Error</td></tr>');
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
			payment_type_id: payment_type_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + payment_type_id).hide();
			$('#row_' + payment_type_id).show();

			Swal.fire({
				title: 'Error!',
				text: `${response.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_employment_payment_type(),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
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

			payment_creditdebit: payment_creditdebit,
			user_id: user_id,
			formula: formula,
			is_taxable: is_taxable,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: window.location.reload(),
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
