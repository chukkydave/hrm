$(document).ready(function() {
	// load_employee();
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

	$('#clock_in').datetimepicker({
		format: 'HH:mm:ss',
	});

	$('#clock_out').datetimepicker({
		format: 'HH:mm:ss',
	});

	$('#update_att').on('click', edit_employee_attendance);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-62-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		fetch_employee_attendance();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: {
			// "company_id": company_id,
			page: page,
			limit: limit,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['employee_id'] +
					'">' +
					response['data'][i]['firstname'] +
					' ' +
					response['data'][i]['lastname'] +
					'</option>';
			});
			$('#employee_id').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// alert('Connection error');
		},
	});
}

function edit_employee_attendance() {
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');
	// var pathArray = window.location.pathname.split( '/' );
	var attendance_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var employee_id = $('#employee_id').val();
	// var employment_position = $('#employment_position').val();
	var date = $('#date').val();
	var clock_out = $('#clock_out').val();
	var clock_in = $('#clock_in').val();
	var status = $('#status').val();
	var additional_info = $('#additional_info').val();

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
		$('#error').html('You have a blank field');

		return;
	}

	$('#error').html('');
	$('#update_att').hide();
	$('#att_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_employee_attendance',
		data: {
			date: date,
			clock_in: clock_in,
			clock_out: clock_out,
			status: status,
			user_id: user_id,
			attendance_id: attendance_id,
			// "company_id": company_id,
			employee_id: employee_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			$('#employee_details_display').show();
			console.log(response);

			if (response.status == '200') {
				// $('#modal_attendance_info').modal('show');

				$('#modal_attendance_info').on('hidden.bs.modal', function() {
					// do something…
					// window.location.reload();
					// window.location.href = base_url+"/erp/hrm/employees";
					employee_id;
					date;
					clock_out;
					clock_in;
				});
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: function() {
						employee_id;
						date;
						clock_out;
						clock_in;
					},
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

			$('#update_att').show();
			$('#att_loader').hide();
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function fetch_employee_attendance() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var attendance_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_employee_attendance',
		data: {
			// "company_id": company_id,
			attendance_id: attendance_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			console.log(response);
			var str3 = '';
			if (response.status == '200') {
				$('#employee_id').val(response.data.employee_id);
				$('#date').val(response.data.insert_date);
				$('#clock_out').val(response.data.clock_out);
				$('#clock_in').val(response.data.clock_in);
				$('#status').val(response.data.status);
				// $('#profile_name').html('<b>Attendance</b> | <font color="red">Edit</font>');
				// $('#additional_info').val(response.data.additional_info);
				// str2 += '<a href="attendance"><button id="send"  class="btn btn-primary">Back</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				$('#picture').html(str3);
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
