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

	// var socket = io.connect('https://api.empl-dev.site', { forceNew: true });

	// list_of_positions();
	$('#add_attendence').on('click', show_add);
	$('#filter_attendence').on('click', show_filter);
	$('#upload_attendence').on('click', show_upload);

	$('#clock_in').datetimepicker({
		format: 'HH:mm:ss',
	});

	$('#clock_out').datetimepicker({
		format: 'HH:mm:ss',
	});

	$('input#date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	// $('input#date_range').daterangepicker({
	// 	autoUpdateInput: false
	// });

	$('input#date_range').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(
			picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'),
		);
	});

	// $('input#date_end').datepicker({
	//   dateFormat: "yy-mm-dd"
	// });

	$('#add').on('click', add_company_attendance);
	$('#add_csv_btn').on('click', () => {
		if (isEmptyInput('.dotty')) {
			addCSVFile();
		}
	});
	$('#filter').on('click', () => {
		attendance('');
	});

	$(document).on('click', '.delete_attendance', function() {
		var attendance_id = $(this).attr('id').replace(/att_/, ''); // table row ID
		delete_attendance(attendance_id);
	});

	$('#order_by').on('change', () => {
		let arr = [];
		const highlightedItems = document.querySelectorAll('.sortAll');

		highlightedItems.forEach(function(userItem) {
			arr.push(userItem.attributes.id.value);
		});
		console.log(arr);
		attendance('');
	});
	$('.js-example-basic-single').select2();
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();
	if (pack_list.indexOf('-4-') >= 0) {
		if (
			role_list.indexOf('-60-') >= 0 ||
			role_list.indexOf('-61-') >= 0 ||
			role_list.indexOf('-62-') >= 0 ||
			role_list.indexOf('-63-') >= 0
		) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			load_employee();
			attendance('');
			load_department();
			fetch_list();
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}
		if (role_list.indexOf('-61-') >= 0) {
			$('#add_attendence').show();
			$('#add_position').show();
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function add_company_attendance() {
	var employee_id = $('#employee_id').val();
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');
	var date = $('#date').val();
	var clock_in = $('#clock_in').val();
	var clock_out = $('#clock_out').val();
	// let shift = $('#shift').val();
	let status = $('#status').val();
	// let attendance_type = $('#attendance_type').val();

	var blank;

	if (employee_id == '' && date == '' && clock_in == '') {
		$('#error_att').html('You have a blank field');

		return;
	}

	$('#error_att').html('');
	$('#add').hide();
	$('#attendance_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_employee_attendance',
		data: {
			employee_id: employee_id,
			user_id: user_id,
			date: date,
			clock_in: clock_in,
			clock_out: clock_out,
			// workshift: shift,
			status: status,
			// attendance_type: attendance_type
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

				$('#error_att').html(response.msg);
			} else if (response.status == '401') {
				//user error message

				$('#error_att').html(response.msg);
			}

			$('#add').show();
			$('#attendance_loader').hide();
		},

		error: function(response) {
			$('#add').show();
			$('#attendance_loader').hide();
			$('#error_att').html('Connection Error.');
		},
	});
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);

			var options = '';

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});

			$('#employee_id').append(options);
			$('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// alert('Connection error');
		},
	});
}

function attendance(page) {
	var company_id = localStorage.getItem('company_id');
	var employee_dept = $('#employee_department').val();
	var date_range;
	var order = $('#order_by').val();
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	today = yyyy + '-' + mm + '-' + dd;

	if ($('#date_range').val() == '') {
		date_range = today;
	} else {
		date_range = $('#date_range').val();
	}

	// var page = 1;
	if (page == '') {
		var page = 1;
	}
	var limit = 10;

	$('#loading').show();
	$('#attendanceData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_employees_attendance',
		data: {
			page: page,
			limit: limit,
			date_range: date_range,
			department: employee_dept,
			order: order,
		},
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
						strTable += '<tr id="row_' + response['data'][i]['attendance_id'] + '">';
						let date = moment(response['data'][i]['date'], 'YYYY-MM-DD').format('LL');

						strTable += `<td>${date}</td>`;
						strTable += `<td class="sortAll" id="${v.employee_id}">${v.employee_name}</td>`;
						strTable += '<td>' + response['data'][i]['clock_in'] + '</td>';
						strTable += '<td>' + response['data'][i]['clock_out'] + '</td>';
						// strTable += '<td>' + response['data'][i]['work_hours'] + '</td>';
						strTable += '<td>' + response['data'][i]['workshift'] + '</td>';
						// strTable += '<td>' + response['data'][i]['attendance_type'] + '</td>';
						strTable += '<td>' + response['data'][i]['status'] + '</td>';
						strTable += '<td valign="top">';
						let role_list = $('#does_user_have_roles').html();

						if (role_list.indexOf('-62-') >= 0) {
							strTable +=
								'<a href="' +
								base_url +
								'edit_employee_attendance?id=' +
								response['data'][i]['attendance_id'] +
								'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee Attendance"></i></a>&nbsp;&nbsp;';
						} else {
							strTable += `<a onClick="denied()" class="disabledC"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee Attendance"></i></a>&nbsp;&nbsp;`;
						}

						if (role_list.indexOf('-63-') >= 0) {
							strTable +=
								'<a class="delete_attendance" style="cursor: pointer;" id="att_' +
								response['data'][i]['attendance_id'] +
								'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Attendance"></i></a>';
						} else {
							strTable += `<a onClick="denied()" class="disabledC" style="cursor: pointer;"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Attendance"></i></a>`;
						}

						strTable += '</td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['attendance_id'] +
							'">';
						strTable +=
							'<td colspan="7"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="7">' + response.msg + '</td></tr>';
				}

				$('#attendanceData').html(strTable);
				$('#attendanceData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="7">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#attendanceData').html(strTable);
				$('#attendanceData').show();
			}

			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					attendance(page);
				},
			});
		},

		error: function(response) {
			// alert('Connection error');
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="7"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#attendanceData').html(strTable);
			$('#attendanceData').show();
		},
	});
}

function denied() {
	toastr.error('Access Denied');
}

function delete_attendance(attendance_id) {
	// alert('user deleted');
	// var email = $.session.get('email');
	var company_id = localStorage.getItem('company_id');
	// alert(employee_id);

	var ans = confirm('Are you sure you want to delete?');
	if (!ans) {
		return;
	}

	$('#row_' + attendance_id).hide();
	$('#loader_row_' + attendance_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_employee_attendance',
		data: { attendance_id: attendance_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + attendance_id).hide();
			$('#row_' + attendance_id).show();
			Swal.fire({
				title: 'Error!',
				text: `${response.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});

			// alert('connection error');
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
					// onClose: window.location.reload(),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#loader_row_' + attendance_id).hide();
		},
	});
}

function show_add() {
	$('#add_attendence_display').toggle();
	$('#upload_display').hide();
	$('#filter_attendence_display').hide();
	$('#date').val('');
	$('#employee_id').val('');
	$('#clock_out').val('');
	$('#clock_in').val('');
	$('#error_att').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function show_filter() {
	$('#filter_attendence_display').toggle();
	$('#add_attendence_display').hide();
	$('#upload_display').hide();
	$('#date').val('');
	$('#employee_id').val('');
	$('#clock_out').val('');
	$('#clock_in').val('');
	$('#error_att').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function show_upload() {
	$('#upload_display').toggle();
	$('#add_attendence_display').hide();
	$('#filter_attendence_display').hide();
	$('#date').val('');
	$('#employee_id').val('');
	$('#clock_out').val('');
	$('#clock_in').val('');
	$('#error_att').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
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
			});
			$('#employee_department').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

function fetch_list() {
	var company_id = localStorage.getItem('company_id');

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

			if (response.status == '200') {
				var the_list = '';
				$(response.data).each(function(index, value) {
					the_list += `<option value='${value.id}'>${value.name}</option>`;
				});

				$('#shift').append(the_list);
			} else if (response.status == '400') {
				// coder error message

				the_list += `<option>No record</option>`;
				$('#shift').append(the_list);
			} else if (response.status == '401') {
				//user error message

				$('#shift').append(`<option>Error</option>`);
			}

			// $('#loading_td').hide();
		},

		error: function(response) {
			console.log(response);
			// $('#add_dept').show();
			// $('#dept_loading').hide();
			$('#shift').append(`<option>Error</option>`);
		},
	});
}

function addCSVFile() {
	$('#add_csv_error').html('');
	let company_id = localStorage.getItem('company_id');

	$('#add_csv_btn').hide();
	$('#add_csv_loader').show();

	// let note = $('#summernote').summernote('code');
	let upImage = document.querySelector(`#dot`).files[0];
	// let policy_id = $('#add_csv_btn').attr('data');

	let data = new FormData();
	data.append('file', upImage);

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: `${api_path}hrm/usb_attendance_upload`,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		data: data,

		error: function(error) {
			console.log(error);
			$('#add_csv_loader').hide();
			$('#add_csv_btn').show();
			$('#add_csv_error').html(error.responseJSON.error_message);
			// alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_csv_loader').hide();
				$('#add_csv_btn').show();

				$(`#collapseExample4`).removeClass('in');
				document.getElementById('dot').value = null;

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: attendance(''),
				});
			}
		},
	});
}

function isEmptyInput(first) {
	let isEmpty = false;
	$(first).each(function() {
		var input = $.trim($(this).val());
		if (input.length === 0 || input === '0') {
			$(this).addClass('has-error');
			isEmpty = true;
		} else {
			$(this).removeClass('has-error');
			// isEmpty = false;
		}
	});
	if (isEmpty === true) {
		return false;
	} else {
		return true;
	}
}
