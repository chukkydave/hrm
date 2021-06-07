$(document).ready(() => {
	listPaySchedules();

	// list_of_companies_employees('', '');
	// load_position();
	// load_department();
	// load_employee();
	// // $('.allEmp').select2();
	// $('#saveEmp').on('click', handleSelect);
});

function list_of_companies_employees(page, serial, order_by) {
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
	var status = $('#status').val();
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
			status: status,
			order: order_by,
			employee_department: employee_department,
			employee_code: employee_code,
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
						let allNames = `${v.lastname}-${v.firstname}-${v.middlename}`;
						strTable += '<tr id="row_' + v.employee_id + '">';
						strTable += `<td class="a-center "><input type="checkbox" value="${allNames}_${v.employee_id}" class="flat input" name="table_records"></td>`;

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

$('#selectEmployees').on('hide.bs.modal', function() {
	//   $('#myInput').trigger('focus')
	$('.filters').val('');
	if ($('#check-all').is(':checked')) {
		$('#check-all').trigger('click');
	}
});

function handleSelect() {
	let allIn = [];
	$('.input').map((i, v) => {
		if ($(v).is(':checked')) {
			allIn.push($(v).val());
		}
	});
	console.log(allIn);
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

function listPaySchedules() {
	let company_id = localStorage.getItem('company_id');
	$('#list_sche_body').hide();
	$('#list_sche_loader').show();
	axios
		.get(`${api_path}hrm/get_payment_schedule`, {
			params: {
				company_id: company_id,
			},
		})
		.then(function(response) {
			let sche_list = '';
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					let status;
					if (v.mode_type === 'one_off') {
						status = 'One Off';
					} else if (v.mode_type === 'recurring') {
						status =
							'<i class="fa fa-check-square" style="color:green; font-size:1.5em;"></i>';
					}
					sche_list += `<div class="col-md-4 col-sm-6 col-xs-12" id="pay_div${v.pay_schedule_id}">
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="pay_loader${v.pay_schedule_id}"></i>
                                    <div class="x_panel boxShadow" id="pay_row${v.pay_schedule_id}">

                                        <div class="x_content">
                                            <div class="card" style="width: 100%;">
                                                <div class="card-body">
                                                    
                                                    <span id="" class="form-horizontal form-label-left">
                                                        <div class="row flex">
                                                                <p><strong>Schedule Name:</strong></p>

                                                                <p id="schedule_name" class="ml1">${v.schedule_name}</p>
                                                        </div>
                                                        <div class="row flex">
                                                                <p><strong>Payment Type:</strong></p>

                                                                <p id="pay_type" class="ml1">${v.pay_calender_name}</p>
                                                        </div>
                                                        <div class="row flex">
                                                                <p><strong>No. of Employees:</strong></p>

                                                                <p id="no_of_emp" class="ml1">${v.no_of_employee}</p>
                                                        </div>
                                                        <div class="row flex">
                                                                <p><strong>Recurring Status:</strong></p>

                                                                <p id="recurring_status" class="ml1">${status}</p>
                                                        </div>
                                                    </span>`;
					if (v.is_pay_schedule_active === 'inactive') {
						sche_list += `<div class="">
                                                        <div>
                                                            <a href="edit_pay_schedule?id=${v.pay_schedule_id}"><i class="fa fa-pencil" style="color:blue;" id=""></i></a>
                                                            <i class="fa fa-trash ml1" style="color:red;" id="del_icon${v.pay_schedule_id}" onClick="deletePaySchedule(${v.pay_schedule_id})"></i>
                                                            <button type="button" class="btn btn-sm btn-success" id="start_btn${v.pay_schedule_id}" onClick="startPayRun(${v.pay_schedule_id})" style="float:right;">Start Payroll</button>
                                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Active Payrun for this Schedule in Payment History" class="btn btn-sm greyed-out" id="not_btn${v.pay_schedule_id}" style="float:right; display:none;">Start Payroll</button>
                                                            <i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none; float:right;" id="start_loader${v.pay_schedule_id}"></i>
                                                        </div>
                                                       
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
					} else if (v.is_pay_schedule_active === 'active') {
						sche_list += `<div class="">
                                                        <div>
                                                            <a href="edit_pay_schedule?id=${v.pay_schedule_id}"><i class="fa fa-pencil" style="color:blue;" id=""></i></a>
                                                            <!--<i class="fa fa-trash ml1" style="color:red;" id="del_icon${v.pay_schedule_id}" onClick="deletePaySchedule(${v.pay_schedule_id})"></i>-->
                                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Active Payrun for this Schedule in Payment History" class="btn btn-sm greyed-out" id="not_btn${v.pay_schedule_id}" style="float:right;">Start Payroll</button>
                                                            <i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none; float:right;" id="start_loader${v.pay_schedule_id}"></i>
                                                        </div>
                                                       
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
					}
				});
				$('#list_sche_body').html(sche_list);
				$('#list_sche_loader').hide();
				$('#list_sche_body').css({
					display: 'flex',
					'flex-direction': 'row',
					'flex-wrap': 'wrap',
				});
			} else {
				$('#list_sche_body').html(
					`<div class="x_panel" style='width:20rem;'><div class="x_content"><p>No Pay Schedule Currently</p></div></div>`,
				);
				$('#list_sche_loader').hide();
				$('#list_sche_body').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_sche_loader').hide();
			$('#list_sche_body').show();
			$('#list_sche_body').html(
				`<div class="x_panel" style='width:20rem;'><div class="x_content"><p style="color:red;">Error</p></div></div>`,
			);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function deletePaySchedule(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#pay_row${id}`).hide();
		$(`#pay_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			pay_schedule_id: id,
			company_id: company_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_payment_schedule`,
			data: data,

			error: function(res) {
				console.log(res);
				$(`#pay_loader${id}`).hide();
				$(`#pay_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#pay_div${id}`).remove();
					// $(`#pay_loader${id}`).remove();
				}
			},
		});
	}
}

function startPayRun(id) {
	let ans = confirm('Are you sure you want to activate this Pay Roll?');
	if (ans) {
		$(`#start_btn${id}`).hide();
		$(`#start_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			pay_schedule_id: id,
			company_id: company_id,
			set_to_active: 'active',
		};

		$.ajax({
			type: 'Put',
			dataType: 'json',
			url: `${api_path}hrm/start_pay_run`,
			data: data,

			error: function(res) {
				console.log(res);
				$(`#start_loader${id}`).hide();
				$(`#start_btn${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#start_btn${id}`).show();
					$(`#start_loader${id}`).hide();
					$(`#start_btn${id}`).removeClass('btn-success');
					$(`#start_btn${id}`).hide();
					$(`#not_btn${id}`).show();
					$(`#del_icon${id}`).remove();
				}
			},
		});
	}
}
