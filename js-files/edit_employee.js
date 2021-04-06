$(document).ready(function() {
	// fetch_employee_details_for_edit_employee();
	fetch_employee_details_for_edit();

	$('#update_emp').on('click', edit_employee);

	$('input#dob').datepicker({
		dateFormat: 'yy-mm-dd',
	});
});

function fetch_employee_details_for_edit() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	// $('#page_loader').hide();
	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/new_employee_info',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();
			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				$('#profile_name').html(
					'<b>' +
						response.data.employee_data.firstname +
						' ' +
						response.data.employee_data.lastname +
						' </b> | <font color="red">Edit</span>',
				);
				$('#firstname').val(response.data.employee_data.firstname);
				$('#lastname').val(response.data.employee_data.lastname);
				$('#middlename').val(response.data.employee_data.middlename);
				$('#gender').val(response.data.employee_data.gender);
				$('#dob').val(response.data.employee_data.dob);
				$('#marital_status').val(response.data.employee_data.marital_status);
				$('#phone').val(response.data.employee_data.phone);
				$('#email').val(response.data.employee_data.email);
				$('#next_of_kin').val(response.data.employee_data.next_of_kin);
				$('#residential_address').val(response.data.employee_data.residential_address);
				$('#religion').val(response.data.employee_data.religion);

				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_data.employee_id +
					'"><button id="send" class="btn btn-primary">View</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.employee_data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_data.employee_id +
					'">Leave History</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_data.employee_id +
					'">Attendance</a></li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_data.employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function fetch_employee_details_for_edit_employee() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[3].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				// alert(response.data.firstname);
				$('#profile_name').html(
					'<b>' +
						response.data.firstname +
						' ' +
						response.data.lastname +
						' </b> | <font color="red">Edit</span>',
				);
				$('#firstname').val(response.data.firstname);
				$('#lastname').val(response.data.lastname);
				$('#middlename').val(response.data.middlename);
				$('#gender').val(response.data.gender);
				$('#dob').val(response.data.dob);
				$('#marital_status').val(response.data.marital_status);
				$('#phone').val(response.data.phone);
				$('#email').val(response.data.email);
				$('#next_of_kin').val(response.data.next_of_kin);
				$('#residential_address').val(response.data.residential_address);
				$('#religion').val(response.data.religion);

				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_id +
					'"><button id="send"  class="btn btn-primary">View Profile</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				str += '<li>';
				str += '<i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_employee?id=' +
					response.data.employee_id +
					'">Basic Profile</a>';

				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_employment_info?id=' +
					response.data.employee_id +
					'">Employment Profile</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_job_titles?id=' +
					response.data.employee_id +
					'">Edit Position History</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_salary_info?id=' +
					response.data.employee_id +
					'">Edit Salary/Welfare Info</a>';
				str += '</li>';

				// str += '<li>';
				// str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=  '<a href="hrm/edit_supervisor/'+response.data.employee_id+'">Edit Supervisor</a>';

				// str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_employee_docs?id=' +
					response.data.employee_id +
					'">Documents</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'connect_email?id=' +
					response.data.employee_id +
					'">Connect Email</a>';
				str += '</li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#employee_details_display').show();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#employee_details_display').show();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function edit_employee() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[3].replace(/%20/g,' ');
	// var employment_type = $('#employment_type').val();
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var middlename = $('#middlename').val();
	// var employment_date = $('#employment_date').val();
	var email = $('#email').val();
	// var position = $('#position').val();
	var dob = $('#dob').val();
	var gender = $('#gender').val();
	var religion = $('#religion').val();
	var phone = $('#phone').val();
	var marital_status = $('#marital_status').val();
	var residential_address = $('#residential_address').val();
	var next_of_kin = $('#next_of_kin').val();
	var status = $('#status').val();
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
		$('#update_error').html('You have a blank field');

		return;
	}

	if (!validateEmail(email)) {
		$('#update_error').html('invalid Email');

		return;
	}

	$('#update_emp').hide();
	$('#update_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_employee_profile',
		data: {
			firstname: firstname,
			lastname: lastname,
			middlename: middlename,
			email: email,
			company_id: company_id,
			employee_id: employee_id,
			gender: gender,
			religion: religion,
			phone: phone,
			residential_address: residential_address,
			marital_status: marital_status,
			next_of_kin: next_of_kin,
			dob: dob,
			status: status,
			user_id: user_id,
		},

		success: function(response) {
			$('#employee_details_display').show();
			if (response.status == '200') {
				$('#modal_update').modal('show');

				$('#modal_update').on('hidden.bs.modal', function() {
					// do something…
					// window.location.reload();
					// window.location.href = base_url+"/erp/hrm/employees";

					$('#firstname').val();
					$('#lastname').val();
					$('#middlename').val();
					$('#email').val();
					$('#dob').val();
					$('#gender').val();
					$('#religion').val();
					$('#phone').val();
					$('#marital_status').val();
					$('#residential_address').val();
					$('#next_of_kin').val();
				});
			} else if (response.status == '400') {
				// coder error message

				$('#update_error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#update_error').html(response.msg);
			}

			$('#update_emp').show();
			$('#update_loader').hide();
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
			// $('#update_emp').show();
			// $('#update_loader').hide();
			// $('#update_error').html("Connection Error.");
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
