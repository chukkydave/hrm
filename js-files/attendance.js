$(document).ready(function() {
	load_employee();
	attendance();
	load_department();
	// list_of_positions();
	$('#add_attendence').on('click', show_add);
	$('#filter_attendence').on('click', show_filter);
	$('#upload_attendence').on('click', show_upload);

	$('#clock_in').datetimepicker({
		format: 'HH:mm:ss'
	});

	$('#clock_out').datetimepicker({
		format: 'HH:mm:ss'
	});

	$('input#date').datepicker({
		dateFormat: 'yy-mm-dd'
	});

	$('input#date_range').daterangepicker({
		autoUpdateInput: false
	});

	$('input#date_range').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
	});

	// $('input#date_end').datepicker({
	//   dateFormat: "yy-mm-dd"
	// });

	$('#add').on('click', add_company_attendance);
	$('#filter').on('click', attendance);

	$(document).on('click', '.delete_attendance', function() {
		var attendance_id = $(this).attr('id').replace(/att_/, ''); // table row ID
		delete_attendance(attendance_id);
	});
});

function add_company_attendance() {
	var employee_id = $('#employee_id').val();
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');
	var date = $('#date').val();
	var clock_in = $('#clock_in').val();
	var clock_out = $('#clock_out').val();

	var blank;

	if (employee_id == '' && date == '' && clock_in == '') {
		$('#error_att').html('You have a blank field');

		return;
	}
	// $(".required").each(function(){

	//   var the_val = $.trim($(this).val());

	//   if(the_val == "" || the_val == "0"){

	//     $(this).addClass('has-error');

	//     blank = "yes";

	//   }else{

	//     $(this).removeClass("has-error");

	//   }

	// });

	// if(blank == "yes"){

	//   $('#error_att').html("You have a blank field");

	//   return;

	// }

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
			company_id: company_id,
			user_id: user_id,
			date: date,
			clock_in: clock_in,
			clock_out: clock_out
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_attendance').modal('show');

				$('#modal_attendance').on('hidden.bs.modal', function() {
					// do something…
					$('#add_attendance_display').hide();
					window.location.reload();
					//window.location.href = base_url+"/erp/hrm/employees";
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
		}
	});
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: { company_id: company_id, page: page, limit: limit },
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
			$('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// alert('Connection error');
		}
	});
}

function attendance() {
	var company_id = localStorage.getItem('company_id');
	var employee_id = $('#employee_name').val();
	var date_range = $('#date_range').val();

	var page = 1;
	var limit = 10;

	$('#loading').show();
	$('#attendanceData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_employees_attendance',
		data: { company_id: company_id, page: page, limit: limit, date_range: date_range, employee_id: employee_id },
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

						strTable += '<td>' + response['data'][i]['date'] + '</td>';
						strTable += '<td>' + response['data'][i]['employee_name'] + '</td>';
						strTable += '<td>' + response['data'][i]['clock_in'] + '</td>';
						strTable += '<td>' + response['data'][i]['clock_out'] + '</td>';
						strTable += '<td>' + response['data'][i]['work_hours'] + '</td>';

						strTable +=
							'<td valign="top"><a href="' +
							base_url +
							'edit_employee_attendance?id=' +
							response['data'][i]['attendance_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee Attendance"></i></a>&nbsp;&nbsp; <a class="delete_attendance" style="cursor: pointer;" id="att_' +
							response['data'][i]['attendance_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Attendance"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' + response['data'][i]['attendance_id'] + '">';
						strTable += '<td colspan="7"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="6">' + response.msg + '</td></tr>';
				}

				$('#attendanceData').html(strTable);
				$('#attendanceData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="6">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#attendanceData').html(strTable);
				$('#attendanceData').show();
			}
		},

		error: function(response) {
			// alert('Connection error');
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable += '<td colspan="7"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#attendanceData').html(strTable);
			$('#attendanceData').show();
		}
	});
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
		data: { company_id: company_id, attendance_id: attendance_id },
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + attendance_id).hide();
			$('#row_' + attendance_id).show();

			// alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + attendance_id).hide();
		}
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
		data: { company_id: company_id, page: 1, limit: 100 },
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
		}
	});
}
