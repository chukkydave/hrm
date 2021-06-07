$(document).ready(function() {
	$('#add_emp').on('click', add_employee);

	load_position();
	load_employee_type();

	$('input#employment_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});
});

function load_employee_type() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employment_types',
		type: 'POST',
		data: { company_id: company_id, page: page, limit: limit },
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
		data: { company_id: company_id, page: page, limit: limit },
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
			// position: position,
			company_id: company_id,
			user_id: user_id,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_emp').modal('show');

				$('#modal_emp').on('hidden.bs.modal', function() {
					// do something…
					window.location.reload();
					//window.location.href = base_url+"/erp/hrm/employees";
				});
			} else if (response.status == '400') {
				// coder error message

				$('#emp_error').html('Technical Error. Please try again later.');
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
			$('#emp_error').html('Connection Error.');
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

{
	/* <li><a href="/hrm/"><i class="fa fa-home"></i> Dashboard</a></li>

                <!-- <li ><a><i class="fa fa-user"></i> Organization <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="company_profile">Company Profile</a></li>
                        <li><a href="company_departments">Departments</a></li>
                        
                    </ul>

                </li> -->

                <li><a href="employees"><i class="fa fa-users"></i> Employees </a></li>

                <li><a href="leaves" style="background-color: rgb(0,0,0,0)"><i class="fa fa-edit"></i> Leaves </a></li>

                <li><a href="terminations"><i class="fa fa-user"></i> Terminations </a></li>

                <li><a href="grievances"><i class="fa fa-edit"></i> Grievances </a></li>

                <li><a href="attendance"><i class="fa fa-bell-o"></i>Attendance</a></li>

                <!-- <li><a href="hrm/payroll"><i class="fa fa-edit"></i> Payroll </a></li> -->


                <li id="dropMe"><a><i class="fa fa-user"></i> HR Settings <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="company_positions">Job Titles</a></li>
                        <li><a href="departments">Departments</a></li>
                        <li><a href="set_work_days">Set Work Days</a></li>
                        <li><a href="leave_types">Leave Types</a></li>
                        <li><a href="branches">Company Branches</a></li>
                        <li><a href="employement_type">Employment Types</a></li>
                        <li><a href="employment_payment_types">Employee Payment Types</a></li>
                        <li><a href="#">Company Profile Settings</a></li>
                        <li><a href="emp_doc_type">Employee Doc Types</a></li>
                        <li><a href="company_holidays">Company Holidays</a></li>
                        <li><a href="work_shift">Work Shifts</a></li>
                    </ul>

                </li> */
}
