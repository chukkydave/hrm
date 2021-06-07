$(document).ready(function() {
	load_department();
	// list_of_positions();
	// $('#add_attendence').on('click', show_add);
	// $('#filter_attendence').on('click', show_filter);
	// $('#upload_attendence').on('click', show_upload);

	$('#clock_in').datetimepicker({
		format: 'HH:mm:ss',
	});

	let date = new Date();
	let monther = date.getMonth();

	$('#month_filter').val(monther);

	var dt = new Date();
	var month = dt.getMonth() + 1;
	var year = dt.getFullYear();
	var daysInMonth = new Date(year, month, 0).getDate();

	for (let i = 1; i <= daysInMonth; i++) {
		$('#headins').append(`<th class="column-title">${i}</th>`);
	}

	$('#clock_out').datetimepicker({
		format: 'HH:mm:ss',
	});

	$('input#date').datepicker({
		dateFormat: 'yy',
	});

	$('#yeary').datepicker({
		dateFormat: 'yy',
	});

	$('#filter').on('click', () => {
		attendance_report('');
	});

	$('#order_by').on('change', () => {
		attendance_report('');
	});

	// $('input#date_range').daterangepicker({
	// 	autoUpdateInput: false
	// });

	// $('input#date_range').on('apply.daterangepicker', function(ev, picker) {
	// 	$(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
	// });
	attendance_report('');
});
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
		},
	});
}

function attendance_report(page) {
	var company_id = localStorage.getItem('company_id');
	let user_id = localStorage.getItem('user_id');
	// var employee_dept = $('#employee_department').val();
	let months = $('#month_filter').val();
	let monthy = parseInt(months) + 1;
	let year = $('#year_filter').val();
	let order = $('#order_by').val();

	if (page == '') {
		var page = 1;
	}
	let limit = 10;

	$('#loading').show();
	$('#attendanceData').html('');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: `${api_path}hrm/attendance_report?company_id=${company_id}&page=${page}&limit=${limit}&filter_month=${monthy}&filter_year=${year}&order=${order}&user_id=${user_id}`,
		// data: {
		// 	company_id: company_id,
		// 	page: page,
		// 	limit: limit,
		// 	date_range: date_range,
		// 	department: employee_dept,
		// 	order: order
		// },
		timeout: 60000,

		success: function(response) {
			let strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data) {
					var k = 1;

					$(response.data).map((i, v) => {
						strTable += `<tr>`;
						strTable += `<td class="td-title">${v.fullname}</td>`;
						strTable += `<td class="td-title">${v.workshift}</td>`;
						strTable += `<td class="td-title">${v.summary_of_days_worked}/${v.monthly_workdays}</td>`;
						$(v.days_of_work).map((i, v) => {
							let status;
							if (v.status == 'nill') {
								status = `"`;
							} else if (v.status == 'Absent') {
								status =
									'<i data-toggle="tooltip" title="Absent" style="color:red;" class="fa fa-times"></i>';
							} else if (v.status == 'Present') {
								status =
									'<i data-toggle="tooltip" title="Present" style="color:green" class="fa fa-check"></i>';
							} else if (v.status == 'Holiday') {
								status =
									'<i data-toggle="tooltip" title="Holiday" class="fab fa-houzz"></i>';
							} else {
								status = v.status;
							}

							strTable += `<td class="td-title">${status}</td>`;
						});
						strTable += `</tr>`;
						k++;
					});
					// $.each(response['data'], function(i, v) {
					// 	strTable += '<tr id="row_' + response['data'][i]['attendance_id'] + '">';

					// 	strTable += '<td>' + response['data'][i]['date'] + '</td>';
					// 	strTable += `<td class="sortAll" id="${v.employee_id}">${v.employee_name}</td>`;
					// 	strTable += '<td>' + response['data'][i]['clock_in'] + '</td>';
					// 	strTable += '<td>' + response['data'][i]['clock_out'] + '</td>';
					// 	// strTable += '<td>' + response['data'][i]['work_hours'] + '</td>';
					// 	strTable += '<td>' + response['data'][i]['workshift'] + '</td>';
					// 	// strTable += '<td>' + response['data'][i]['attendance_type'] + '</td>';
					// 	strTable += '<td>' + response['data'][i]['status'] + '</td>';

					// 	strTable +=
					// 		'<td valign="top"><a href="' +
					// 		base_url +
					// 		'edit_employee_attendance?id=' +
					// 		response['data'][i]['attendance_id'] +
					// 		'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee Attendance"></i></a>&nbsp;&nbsp; <a class="delete_attendance" style="cursor: pointer;" id="att_' +
					// 		response['data'][i]['attendance_id'] +
					// 		'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Attendance"></i></a></td>';

					// 	strTable += '</tr>';

					// 	strTable +=
					// 		'<tr style="display: none;" id="loader_row_' + response['data'][i]['attendance_id'] + '">';
					// 	strTable += '<td colspan="7"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
					// 	strTable += '</td>';
					// 	strTable += '</tr>';

					// 	k++;
					// });
				} else {
					strTable = '<tr><td colspan="34">' + response.msg + '</td></tr>';
				}

				$('#attendanceData').html(strTable);
				$('#attendanceData').show();
			} else if (response.status == '400') {
				// var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="34">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#attendanceData').html(strTable);
				$('#attendanceData').show();
			}

			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					attendance_report(page);
				},
			});
		},

		error: function(response) {
			alert('Connection error');
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="34"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';
			$('#attendanceData').html(strTable);
			$('#attendanceData').show();
		},
	});
}

function getDaysInMonth(month, year) {
	var date = new Date(year, month, 1);
	var days = [];
	while (date.getMonth() === month) {
		days.push(new Date(date));
		date.setDate(date.getDate() + 1);
	}
	return days;
}
