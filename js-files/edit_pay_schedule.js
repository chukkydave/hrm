$(document).ready(() => {
	var $select = $('#no_of_days');
	for (i = 1; i <= 30; i++) {
		$select.append($('<option></option>').val(i).html(i));
	}

	$('#recurring').on('click', () => {
		if ($('#recurring').is(':checked')) {
			$('#date_div').fadeIn();
			$('#start_date').addClass('schedule_fields');
			$('#no_of_days').addClass('schedule_fields');
		} else {
			$('#date_div').fadeOut();
			$('#start_date').removeClass('schedule_fields');
			$('#no_of_days').removeClass('schedule_fields');
		}
	});

	$(document).on('click', '#filter', function() {
		$('#pagination').twbsPagination('destroy');
		list_of_companies_employees('');
	});
	list_of_companies_employees('', '');
	load_position();
	load_department();
	load_employee();
	// listPayrollType();
	$('#saveEmp').on('click', handleSelect);

	$('#add_schedule_btn').on('click', () => {
		if (isEmptyInput('.schedule_fields') && $('#empListTable tr').length > 1) {
			addPaySchedule();
		} else {
			alert('No Employee Selected');
		}
	});
	$('#refresh_schedule_btn').on('click', refresh);
	$('#selectBultEmp').on('click', checkAlreadySelectedIDs);
});

async function list_of_companies_employees(page, serial, order_by) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}

	var limit = 100000;

	// alert(page);

	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var gender = $('#gender').val();
	var position = $('#position').val();
	// var status = $('#status').val();
	// var phone = $('#phone').val();
	var employee_department = $('#employee_department').val();
	// var email = $('#email').val();
	var employee_code = $('#employee_code').val();

	$('#loading').show();
	$('#employeeData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_employees',
		data: {
			company_id: company_id,
			page: page,
			limit: limit,
			// email: email,
			firstname: firstname,
			lastname: lastname,
			gender: gender,
			position: position,
			// status: status,
			order: order_by,
			employee_department: employee_department,
			employee_code: employee_code,
		},
		timeout: 60000,

		success: await function(response) {
			console.log(response);
			$('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					// var k = 1;
					// var SerialNo = serial;

					if (page == 1 || page == '') {
						var k = 1;
					} else {
						var k = page * limit - limit + 1;
					}

					$(response.data).map((i, v) => {
						function status(string) {
							return string.charAt(0).toUpperCase() + string.slice(1);
						}
						let empType;
						let jobTitle;
						if (v.position === null) {
							jobTitle = '';
						} else {
							jobTitle = v.position;
						}
						if (v.employment_type === false) {
							empType = '';
						} else {
							empType = v.employment_type;
						}
						let allNames = `${v.lastname} ${v.firstname} ${v.middlename}`;
						strTable += '<tr id="row_' + v.employee_id + '">';
						strTable += `<td class="a-center "><input type="checkbox" value="${allNames}_${v.employee_id}_${v.department_name}_${jobTitle}" class="flat input" id="employeeID_${v.employee_id}" name="table_records"></td>`;

						strTable +=
							'<td  valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="' +
							window.location.origin +
							'/files/images/employee_images/' +
							v.profile_picture +
							'" alt="..." width="50" class="pfl_ctna"></div></td>';

						strTable +=
							'<td valign="top"><b>' +
							v.lastname +
							'</b>' +
							' ' +
							v.firstname +
							' ' +
							v.middlename +
							'</td>';

						strTable += '<td valign="top">' + v.department_name + '</td>';
						strTable += '<td valign="top">' + empType + '</td>';
						strTable += '<td valign="top">' + jobTitle + '</td>';
						strTable += '</tr>';
						strTable +=
							'<tr style="display: none;" id="loader_row_' + v.employee_id + '">';
						strTable +=
							'<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="6">No record.</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						var serial;
						if (page == 1) {
							serial = 1;
						} else {
							serial = 1 + (page - 1) * limit;
						}

						list_of_companies_employees(page, serial);
						$('html, body').animate({ scrollTop: 0 }, 'slow');
					},
				});

				$('#employeeData').html(strTable);
				$('#employeeData').show();
			} else if (response.status == '400') {
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="6">No result</td>';
				strTable += '</tr>';

				$('#employeeData').html(strTable);
				$('#employeeData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="6">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#employeeData').html(strTable);
				$('#employeeData').show();
			}

			$('#loading').hide();
			listPayrollType();
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="6"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#employeeData').html(strTable);
			$('#employeeData').show();
			$('#loading').hide();
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
			// console.log(response);

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
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
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
		},
	});
}

function checkAll(bx) {
	var cbs = document.getElementsByClassName('input');
	for (var i = 0; i < cbs.length; i++) {
		if (cbs[i].type == 'checkbox') {
			cbs[i].checked = bx.checked;
		}
	}
}

// $('#selectEmployees').on('hide.bs.modal', function() {
// 	$('.filters').val('');
// 	if ($('#check-all').is(':checked')) {
// 		$('#check-all').trigger('click');
// 	}
// 	$('.input').attr('checked', false);
// 	load_employee();
// });

function handleSelect() {
	let allIn = [];
	$('.input').map((i, v) => {
		if ($(v).is(':checked')) {
			let eachOfThem = $(v).val().split('_');
			allIn.push({
				fullname: eachOfThem[0],
				employee_id: eachOfThem[1],
				department: eachOfThem[2],
				job_title: eachOfThem[3],
			});
		}
	});

	populateEmployee(allIn);
	$('#selectEmployees').modal('hide');
}

function populateEmployee(arr) {
	console.log(arr);
	let table = '';
	if (arr.length === 0) {
		table += `<tr>`;
		table += `<td colspan="4">No Employee(s) Selected</td>`;
		table += `</tr>`;
		$('#empListTable').html(table);
		$('#numCounter').html('0');
	} else {
		if ($('#empListTable tr td').html() == 'No Employee(s) Selected') {
			$('#empListTable').html('');
		}
		let alreadyExists = [];

		if ($('#empListTable tr').length > 0) {
			$('.checkId').map((i, v) => {
				alreadyExists.push($(v).attr('data'));
			});
			arr.map((data) => {
				if (alreadyExists.includes(data.employee_id)) {
				} else {
					table += `<tr class="checkId" data="${data.employee_id}">`;
					table += `<td class=""><input id="selectedEMP_${data.employee_id}" type="checkbox" checked value="${data.employee_id}" class="flat finalEmps" onClick="uncheckSelected(${data.employee_id})" name="table_records"></td>`;
					table += `<td>${data.fullname}</td>`;
					table += `<td>${data.department}</td>`;
					table += `<td>${data.job_title}</td>`;
					table += `</tr>`;
					$(`#employeeID_${data.employee_id}`).attr('checked', true);
				}
			});
		} else {
			arr.map((data) => {
				table += `<tr class="checkId" data="${data.employee_id}">`;
				table += `<td class=""><input type="checkbox" id="selectedEMP_${data.employee_id}" checked value="${data.employee_id}" onClick="uncheckSelected(${data.employee_id})" class="flat finalEmps" name="table_records"></td>`;
				table += `<td>${data.fullname}</td>`;
				table += `<td>${data.department}</td>`;
				table += `<td>${data.job_title}</td>`;
				table += `</tr>`;
				$(`#employeeID_${data.employee_id}`).attr('checked', true);
			});
		}
		$('#empListTable').append(table);
		// let count = $('#empListTable tr').length;
		let count = 0;

		$('.finalEmps').map((i, v) => {
			if ($(v).is(':checked')) {
				count++;
			}
		});
		$('#numCounter').html(count);
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
			company_id: company_id,
			page: page,
			limit: limit,
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
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function addPaySchedule() {
	let company_id = localStorage.getItem('company_id');
	let employee = [];

	$('#add_schedule_btn').hide();
	$('#add_schedule_loader').show();

	$('.finalEmps').map((i, v) => {
		if ($(v).is(':checked')) {
			employee.push({ employee_id: $(v).val() });
		}
	});

	let name = $('#schedule_name').val();
	let date;
	let days;
	let recurring;
	if ($('#recurring').is(':checked')) {
		date = $('#start_date').val();
		days = $('#no_of_days').val();
		recurring = 'recurring';
	} else {
		date = 0;
		days = 0;
		recurring = 'one_off';
	}
	let payType = $('#list_payment_option').val();
	let payrollType = $('#list_payroll_option').val();
	let idtee = window.location.search.split('=')[1];

	let data = {
		company_id: company_id,
		employees: employee,
		pay_calender_type: payType,
		schedule_name: name,
		pay_setting_type: payrollType,

		pay_start_date: date,
		duration: days,
		mode_type: recurring,
		pay_schedule_id: idtee,
	};

	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/edit_payment_schedule`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#add_schedule_loader').hide();
			$('#add_schedule_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_schedule_loader').hide();
				$('#add_schedule_btn').show();
				window.location.href = 'pay_schedule';

				// $('#mod_body').html('Q&C creation successful');
				// $('#successModal').modal('show');
			}
		},
	});
}

function listPayrollType() {
	let company_id = localStorage.getItem('company_id');
	$('#list_payroll_option').hide();
	$('#list_payroll_loader').show();
	axios
		.get(`${api_path}hrm/get_payroll_settings`, {
			params: {
				company_id: company_id,
			},
		})
		.then(function(response) {
			let options;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					options += `<option value="${v.payroll_setting_id}">${v.payroll_setting_name}</option>`;
				});
				$('#list_payroll_option').append(options);
				$('#list_payroll_loader').hide();
				$('#list_payroll_option').show();
			} else {
				$('#list_payroll_option').append(`<option>No record found</option>`);
				$('#list_payroll_loader').hide();
				$('#list_payroll_option').show();
			}
			listPaymentType();
		})
		.catch(function(error) {
			console.log(error);
			$('#list_payroll_loader').hide();
			$('#list_payroll_option').show();
			$('#list_payroll_option').append(`<option>Error</option>`);
			// $('#edit_QC_error').html(error);
		});
	// 	.then(function() {
	// 		// always
	// 		listPaymentType();
	// 	})
	// .then(function() {
	// 	// always
	// 	fetchScheduleData();
	// });
}

function listPaymentType() {
	let company_id = localStorage.getItem('company_id');
	$('#list_payment_option').hide();
	$('#list_payment_loader').show();
	axios
		.get(`${api_path}hrm/get_company_payroll_payment_type`, {
			params: {
				company_id: company_id,
			},
		})
		.then(function(response) {
			let options;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					options += `<option value="${v.pay_type_id}">${v.payment_type}</option>`;
				});
				$('#list_payment_option').append(options);
				$('#list_payment_loader').hide();
				$('#list_payment_option').show();
			} else {
				$('#list_payment_option').append(`<option>No record found</option>`);
				$('#list_payment_loader').hide();
				$('#list_payment_option').show();
			}
			fetchScheduleData();
		})
		.catch(function(error) {
			console.log(error);
			$('#list_payment_loader').hide();
			$('#list_payment_option').show();
			$('#list_payment_option').append(`<option>Error</option>`);
			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function refresh() {
	$('#empListTable').html('<tr><td colspan="4">No Employee(s) Selected</td></tr>');
	$('#schedule_name').val('');
	$('#list_payment_option').val('');
	$('#list_payroll_option').val('');
	$('#recurring').attr('checked', false);
	$('#date_div').fadeOut();
	$('#start_date').val('');
	$('#no_of_days').val('');
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

function fetchScheduleData() {
	let company_id = localStorage.getItem('company_id');
	let idt = window.location.search.split('=')[1];
	axios
		.get(`${api_path}hrm/single_payment_schedule`, {
			params: {
				company_id: company_id,
				pay_schedule_id: idt,
			},
		})
		.then((res) => {
			if (res.data.data) {
				let {
					duration,
					employee,
					is_pay_run_active,
					mode_type,
					no_of_employee,
					pay_calender_name,
					pay_calender_type,
					pay_period_start_from,
					pay_schedule_id,
					pay_setting_id,
					pay_setting_name,
					schedule_name,
				} = res.data.data;

				$('#schedule_name').val(schedule_name);
				$('#list_payment_option').val(pay_calender_type);
				$('#list_payroll_option').val(pay_setting_id);

				if (mode_type === 'recurring') {
					$('#start_date').val(pay_period_start_from);
					$('#no_of_days').val(duration);
					$('#recurring').attr('checked', true);
					$('#date_div').fadeIn();
					$('#start_date').addClass('schedule_fields');
					$('#no_of_days').addClass('schedule_fields');
				}

				populateEmployee(employee);

				$('#loader_div').hide();
				$('#main_div').show();
			}
		})
		.catch((error) => {
			console.log(error);
		});
}

function checkAlreadySelectedIDs() {
	$('#selectEmployees').modal('show');
	// let arr = [];
	// if ($('#empListTable tr td').html() == 'No Employee(s) Selected') {
	// 	$('#empListTable').html('');
	// }

	// // if ($('#empListTable tr').length > 0) {
	// $('.finalEmps').map((i, v) => {
	// 	if ($(v).is(':checked')) {
	// 		arr.push($(v).val());
	// 	}
	// });
	// console.log('arrrrrrrrr', arr);

	// // setTimeout(() => {
	// // $('.input').each((i, v) => {
	// arr.map((single) => {
	// 	console.log(single);
	// 	$(`.employeeID_${single}`).attr('checked', true);

	// 	// });
	// });
	// }, 2000);
	// }
}

function uncheckSelected(id) {
	let count = $('#numCounter').html();
	if ($(`#selectedEMP_${id}`).prop('checked') == false) {
		$(`#employeeID_${id}`).attr('checked', false);
		count--;
		$('#numCounter').html(count);
	} else {
		$(`#employeeID_${id}`).prop('checked', true);
		count++;
		$('#numCounter').html(count);
	}
	// $(`#employeeID_${id}`).attr('checked', false)
}
