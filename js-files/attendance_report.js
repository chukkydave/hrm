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
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-60-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		load_department();
		attendance_report('');
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
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
		url: `${api_path}hrm/attendance_report?page=${page}&limit=${limit}&filter_month=${monthy}&filter_year=${year}&order=${order}&user_id=${user_id}`,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
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
						$(v.theday).map((i, v) => {
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
							} else if (v.status === 'Leave') {
								status =
									'<img style="max-width:15.781px; max-height:18px;" src="./assets/images/leave.ico"/>';
							} else {
								status = v.status;
							}

							strTable += `<td class="td-title">${status}</td>`;
						});
						strTable += `</tr>`;
						k++;
					});
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
