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

	$('#add_emp').on('click', add_employee);

	$('input#employment_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-57-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		load_position();
		load_employee_type();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function load_employee_type() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employment_types',
		type: 'POST',
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['type_id'] +
					'">' +
					response['data'][i]['type_name'] +
					'</option>';
			});
			$('#employee_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// alert('Connection error');
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function load_position() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_positions',
		type: 'POST',
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['position_id'] +
					'">' +
					response['data'][i]['position_name'] +
					'</option>';
			});
			$('#position').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

$('#DOB').datepicker({
	dateFormat: 'yy-mm-dd',
});

function add_employee() {
	// var employee_type = $('#employee_type').val();
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var middlename = $('#middlename').val();
	var phone = $('#phone').val();
	var gender = $('#gender').val();
	var dob = $('#DOB').val();
	var marital_status = $('#marital_status').val();
	var religion = $('#religion').val();
	var address = $('#address').val();
	// var employment_date = $('#employment_date').val();
	var email = $('#email').val();
	var employee_code = $('#employee_code').val();
	// var position = $('#position').val();
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');

	var blank;

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
		$('#emp_error').html('You have a blank field');

		return;
	}

	$('#add_emp').hide();
	$('#emp_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_employee',
		data: {
			// employee_type: employee_type,
			firstname: firstname,
			lastname: lastname,
			middlename: middlename,
			phone: phone,
			gender: gender,
			date_of_birth: dob,
			marital_status: marital_status,
			religion: religion,
			address: address,
			// employment_date: employment_date,
			email: email,
			empl_code: employee_code,
			// position: position,

			user_id: user_id,
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
				if ($('#remain_check').is(':checked')) {
					window.location.reload();
				} else {
					window.location.href = 'employees';
				}
			} else if (response.status == '400') {
				// coder error message

				$('#emp_error').html(response.msg);
			} else if (response.status == '401') {
				//user error message

				$('#emp_error').html(response.msg);
			}

			$('#add_emp').show();
			$('#emp_loader').hide();
		},
		error: function(response) {
			$('#add_emp').show();
			$('#emp_loader').hide();
			$('#emp_error').html(response.msg);
		},
	});
}

function validateEmail(emailaddress) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	if (!emailReg.test(emailaddress)) {
		return false;
	} else {
		return true;
	}
}

function isValidDate(dateString) {
	var regEx = /^\d{4}-\d{2}-\d{2}$/;

	if (!regEx.test(dateString)) {
		return false;
	} else {
		return true;
	}
}
