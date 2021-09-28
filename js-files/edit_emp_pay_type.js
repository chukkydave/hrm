$(document).ready(function() {
	fetch_payment_type_details();

	$('#add_pay_type').on('click', edit_payment_type);

	$('#payment_type_credit_or_debit').on('change', () => {
		if ($('#payment_type_credit_or_debit').val() == 'debit') {
			$('#taxSays').show();
		} else {
			$('#taxSays').hide();
			$('#taxSays_text').attr('checked', false);
		}
	});
});
function fetch_payment_type_details() {
	var pathArray = window.location.pathname.split('/');
	// var payment_type_id = pathArray[4].replace(/%20/g, ' ');
	var payment_type_id = window.location.search.split('=')[1];
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_payment_type_byID',
		data: { payment_type_id: payment_type_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// $.each(response['data'], function(i, v) {
				// 	$('#payment_type_name').val(response['data'][i]['payment_type_name']);
				// 	$('#payment_type_description').val(
				// 		response['data'][i]['payment_type_description'],
				// 	);

				// 	$('#payment_type_credit_or_debit').val(
				// 		response['data'][i]['payment_type_credit_or_debit'],
				// 	);
				// 	$('#formula').val(response['data'][i]['formula']);
				// });

				$(response.data).each((i, v) => {
					$('#payment_type_name').val(v.payment_type_name);
					$('#payment_type_description').val(v.payment_type_description);

					$('#payment_type_credit_or_debit').val(
						v.payment_type_credit_or_debit.toLowerCase(),
					);
					if (v.is_taxable == '1') {
						$('#taxSays').show();
						$('#taxSays_text').attr('checked', true);
					}
					$('#formula').val(v.formula);
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}

function edit_payment_type() {
	var payment_type_name = $('#payment_type_name').val();
	var payment_type_description = $('#payment_type_description').val();
	var payment_type_credit_or_debit = $('#payment_type_credit_or_debit').val();
	var company_id = localStorage.getItem('company_id');
	var pathArray = window.location.pathname.split('/');
	var payment_type_id = window.location.search.split('=')[1];
	let formula = $('#formula').val();

	var blank;
	let is_taxable;

	if ($('#taxSays_text').is(':checked')) {
		is_taxable = 1;
	} else {
		is_taxable = 0;
	}

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
	$('#pay_type_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_payment_type',
		data: {
			payment_type_name: payment_type_name,
			payment_type_description: payment_type_description,

			payment_type_id: payment_type_id,
			payment_type_credit_or_debit: payment_type_credit_or_debit,
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
					onClose: (window.location.href = 'employment_payment_types'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_pay_type').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_pay_type').html(response.msg);
			}

			$('#add_pay_type').show();
			$('#pay_type_loader').hide();
		},

		error: function(response) {
			$('#add_pay_type').show();
			$('#pay_type_loader').hide();
			$('#error_pay_type').html('Connection Error.');
		},
	});
}
