$(document).ready(function() {
	var emp_type;
	var bra_type;
	var dep_type;
	load_department();
	load_branch();
	load_employee_type();
	fetch_workShift_list();

	fetch_employee_edit_details_for_employment_info();

	fetch_employment_info();

	$('input#date_of_employment').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	// load_position();

	$('#update_emp').on('click', edit_employee_info);
});

function fetch_employee_edit_details_for_employment_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';
			var str2 = '';
			var str3 = '';
			if (response.status == '200') {
				$('#profile_name').html(
					'<b>' + response.data.firstname + ' ' + response.data.lastname + '</b>',
				);

				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_id +
					'"><button id="send" class="btn btn-primary">View</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_id +
					'">Leave History</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_id +
					'">Attendance</a></li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_id +
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

function load_employee_type() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_employment_types',
		type: 'POST',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['type_id'] +
					'">' +
					response['data'][i]['type_name'] +
					'</option>';

				emp_type = response['data'][i]['type_id'];
			});
			$('#employment_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function load_branch() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_branches',
		type: 'POST',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			$('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['branch_id'] +
					'">' +
					response['data'][i]['branch_name'] +
					'</option>';

				bra_type = response['data'][i]['branch_id'];
			});
			$('#employment_branch').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function load_department() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_departments',
		type: 'POST',
		data: { page: 1, limit: 100 },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);
			$('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['department_id'] +
					'">' +
					response['data'][i]['department_name'] +
					'</option>';
				dep_type = response['data'][i]['department_id'];
				// alert(dep_type);
			});
			$('#employment_department').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#page_loader').hide();
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
			$('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['position_id'] +
					'">' +
					response['data'][i]['position_name'] +
					'</option>';
			});
			$('#employment_position').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function edit_employee_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var employment_type = $('#employment_type').val();
	// var employment_position = $('#employment_position').val();
	var employment_branch = $('#employment_branch').val();
	var employment_department = $('#employment_department').val();
	var date_of_employment = $('#date_of_employment').val();
	var additional_info = $('#additional_info').val();
	var supervisor = $('#supervisor').val();
	let workshift = $('#workShift_list').val();

	var blank;

	// alert("employment type "+employment_type);
	// alert("employment branch "+employment_branch);
	// alert("employment department "+employment_department);

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
		$('#error').html('You have a blank field');

		return;
	}

	if (employment_type == '-- Select --') {
		$('#error').html('Please select employee employment type');

		return;
	}

	$('#update_emp').hide();
	$('#update_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_employee_employment_info',
		data: {
			employment_type: employment_type,
			employment_department: employment_department,
			employment_branch: employment_branch,
			date_of_employment: date_of_employment,
			additional_info: additional_info,

			employee_id: employee_id,
			supervisor: supervisor,
			workshift: workshift,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			$('#employee_details_display').show();
			console.log(response);

			if (response.status == '200') {
				$('#modal_employee_info').modal('show');

				$('#modal_employee_info').on('hidden.bs.modal', function() {
					// do something…
					// window.location.reload();
					// window.location.href = base_url+"/erp/hrm/employees";

					$('#employment_type').val();

					$('#employment_branch').val();
					$('#employment_department').val();
					$('#date_of_employment').val();
					$('#additional_info').val();
				});
			} else if (response.status == '400') {
				// coder error message
				$('#page_loader').hide();

				$('#error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#page_loader').hide();
				$('#error').html(response.msg);
			}

			$('#update_emp').show();
			$('#update_loader').hide();
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function fetch_employment_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_employment_info',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			console.log(response);

			if (response.status == '200') {
				// $.each(emp_type[data], function(i,v){
				// alert(emp_type);
				// })
				let postVal;
				if (response.data.job_title == null) {
					postVal = 'null';
				} else {
					postVal = response.data.job_title;
				}

				$('#date_of_employment').val(response.data.date_of_employment);
				$('#employment_type').val(response.data.employment_type);
				$('#employment_department').val(response.data.employment_department);
				$('#employment_branch').val(response.data.employment_branch);
				$('#additional_info').val(response.data.additional_info);
				$('#supervisor').val(response.data.supervisor);
				$('#position_val').val(postVal);
				$('#position_link').html(
					`To edit Job Title, use the <a href="edit_job_titles?id=${employee_id}" style="text-decoration:underline">Job Title History Module</a>`,
				);
				// 	'To edit Job Title, use the <a href="edit_job_titles?id=' +
				// 		employee_id +
				// 		'" style="text-decoration:underline">Job Title History Module</a>',
				// );
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

function validateEmail(emailaddress) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	if (!emailReg.test(emailaddress)) {
		return false;
	} else {
		return true;
	}
}

function fetch_workShift_list() {
	var company_id = localStorage.getItem('company_id');
	$('#workShift_list').hide();
	$('#workShift_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/list_shifts',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);
			var the_list = '';
			if (response.status == '200') {
				$(response.data).each(function(index, value) {
					the_list += `<option value="${value.id}">${value.name}</option>`;
				});
			} else if (response.status == '400') {
				// coder error message

				the_list += `<option>no record</option>`;
			} else if (response.status == '401') {
				//user error message

				the_list += `<option>error</option>`;
			}
			$('#workShift_list').append(the_list);
			$('#workShift_loader').hide();
			$('#workShift_list').show();
		},

		error: function(response) {
			console.log(response);

			$('#workShift_loader').hide();
			$('#workShift_list').show();
		},
	});
}
