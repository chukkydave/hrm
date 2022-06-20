$(document).ready(() => {
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

	// $('.allEmp').select2();
	$('#saveEmp').on('click', handleSelect);
	// $('#add_schedule_btn').on('click', () => {
	// 	if ($('#empListTable tr').length > 1) {
	// 		addPaySchedule();
	// 	} else {
	// 		alert('No Employee Selected');
	// 	}
	// });

	$('#add_schedule_btn').on('click', () => {
		if (
			isEmptyInput('.schedule_fields') &&
			$('#empListTable tr').html() !== '<td colspan="4">No Employee(s) Selected</td>'
		) {
			// alert('enter');
			addPaySchedule();
		} else {
			alert('No Employee Selected');
		}
	});
	$('#refresh_schedule_btn').on('click', refresh);
	// load_employmentType();
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	if (pack_list.indexOf('-5-') >= 0) {
		if (role_list.indexOf('-69-') >= 0) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			list_of_companies_employees('', '');
			load_position();
			load_department();
			load_employee();
			listPaymentType();
			listPayrollType();
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
	}
}

function list_of_companies_employees(page, serial, order_by) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}

	var limit = 1000000;

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
			page: page,
			limit: 1000000,
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
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
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
						// strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+base_url+'/erp/assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';

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
						strTable += `<td class="a-center "><input type="checkbox" value="${allNames}_${v.employee_id}_${v.department_name}_${jobTitle}" class="flat input" name="table_records"></td>`;

						strTable +=
							'<td  valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="' +
							window.location.origin +
							'/files/images/employee_images/' +
							v.profile_picture +
							'" alt="..." width="50" class="pfl_ctna"></div></td>';
						// strTable +=
						// 	'<td width="9%" valign="top">' +
						// 	response['data'][i]['employee_code'] +
						// 	'</td>';
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
						// strTable += '<td valign="top">' + status(v.status) + '</td>';
						// strTable +=
						// 	'<td valign="top"><a href="' +
						// 	base_url +
						// 	'employee_info?id=' +
						// 	v.employee_id +
						// 	'"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;<!--<a href="' +
						// 	base_url +
						// 	'edit_employee?id=' +
						// 	v.employee_id +
						// 	'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee"></i></a>-->&nbsp;&nbsp; <a class="delete_employee" style="cursor: pointer;" id="emp_' +
						// 	v.employee_id +
						// 	'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee info"></i></a></td>';

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

				$('#paginationEm').twbsPagination({
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
		data: { page: page, limit: limit },
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
function load_employmentType() {
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
			// console.log(response);
			// $('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['type_id'] +
					'">' +
					response['data'][i]['type_name'] +
					'</option>';
			});
			$('#employmentType').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
			$('#employmentType').append('<option style="color:red;">Error</option>');
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

$('#selectEmployees').on('hide.bs.modal', function() {
	//   $('#myInput').trigger('focus')
	$('.filters').val('');
	if ($('#check-all').is(':checked')) {
		$('#check-all').trigger('click');
	}
	$('.input').attr('checked', false);
	load_employee();
});

function handleSelect() {
	let allIn = [];
	$('.input').map((i, v) => {
		if ($(v).is(':checked')) {
			let eachOfThem = $(v).val().split('_');
			allIn.push({
				name: eachOfThem[0],
				id: eachOfThem[1],
				department: eachOfThem[2],
				jobTitle: eachOfThem[3],
			});
		}
	});
	populateEmployee(allIn);
	$('#selectEmployees').modal('hide');
}

function populateEmployee(arr) {
	let table = '';
	if (arr.length === 0) {
		// table += `<tr>`;
		// table += `<td colspan="4">No Employee(s) Selected</td>`;
		// table += `</tr>`;
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
				// if ($('#empListTable tr').length > 0) {
				if (alreadyExists.includes(data.id)) {
					// console.log('no', alreadyExists);
				} else {
					table += `<tr class="checkId" data="${data.id}">`;
					table += `<td class=""><input type="checkbox" checked value="${data.id}" class="flat finalEmps" name="table_records"></td>`;
					table += `<td>${data.name}</td>`;
					table += `<td>${data.department}</td>`;
					table += `<td>${data.jobTitle}</td>`;
					table += `</tr>`;
				}
				// }
			});
		} else {
			arr.map((data) => {
				table += `<tr class="checkId" data="${data.id}">`;
				table += `<td class=""><input type="checkbox" checked value="${data.id}" class="flat finalEmps" name="table_records"></td>`;
				table += `<td>${data.name}</td>`;
				table += `<td>${data.department}</td>`;
				table += `<td>${data.jobTitle}</td>`;
				table += `</tr>`;
			});
		}

		// arr.map((data) => {
		// 	if ($('#empListTable tr').length > 0) {
		// 		$('.checkId').map((i, v) => {
		// 			console.log($(v).attr('data'), data.id);
		// 			if ($(v).attr('data') !== `${data.id}`) {
		// 				table += `<tr class="checkId" data="${data.id}">`;
		// 				table += `<td class="a-center"><input type="checkbox" value="${data.id}" class="flat input" name="table_records"></td>`;
		// 				table += `<td>${data.name}</td>`;
		// 				table += `<td>${data.department}</td>`;
		// 				table += `<td>${data.jobTitle}</td>`;
		// 				table += `</tr>`;
		// 			}
		// 		});
		// 	} else {
		// 		table += `<tr class="checkId" data="${data.id}">`;
		// 		table += `<td class="a-center"><input type="checkbox" value="${data.id}" class="flat input" name="table_records"></td>`;
		// 		table += `<td>${data.name}</td>`;
		// 		table += `<td>${data.department}</td>`;
		// 		table += `<td>${data.jobTitle}</td>`;
		// 		table += `</tr>`;
		// 	}
		// });

		$('#empListTable').append(table);
		var count = $('#empListTable tr').length;
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
	// let payType = $('#list_payment_option').val();
	let payrollType = $('#list_payroll_option').val();

	if (employee.length === 0) {
		alert('No employee(s) selected');
		$('#add_schedule_loader').hide();
		$('#add_schedule_btn').show();
		return;
	}

	let data = {
		employees: employee,
		pay_calender_type: 0,
		schedule_name: name,
		pay_setting_type: payrollType,

		pay_start_date: date,
		duration: days,
		mode_type: recurring,
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_payment_schedule`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
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
			params: {},
			headers: {
				Authorization: localStorage.getItem('token'),
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
				addDefaultPayrollType();
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#list_payroll_loader').hide();
			$('#list_payroll_option').show();
			$('#list_payroll_option').append(`<option>Error</option>`);
			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function listPaymentType() {
	let company_id = localStorage.getItem('company_id');
	$('#list_payment_option').hide();
	$('#list_payment_loader').show();
	axios
		.get(`${api_path}hrm/get_company_payroll_payment_type`, {
			params: {},
			headers: {
				Authorization: localStorage.getItem('token'),
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

function addDefaultPayrollType() {
	let company_id = localStorage.getItem('company_id');

	$('#list_payroll_option').hide();
	$('#list_payroll_loader').show();

	let name = 'Salary';
	let desc = 'Salary';

	let data = {
		payroll_name: name,
		payroll_desc: desc,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_payroll_settings`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#list_payroll_loader').hide();
			$('#list_payroll_option').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#list_payroll_loader').hide();
				$('#list_payroll_option').show();
				// $('#mod_body').html('Payroll Type creation successful');
				// $('#successModal').modal('show');
				// $('#payroll_name').val('');
				// $('#payroll_desc').val('');

				// $('#collapseExample3').removeClass('in');
				listPayrollType();
			}
		},
	});
}
