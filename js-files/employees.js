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

	$('input#dob_start').datepicker({
		dateFormat: 'yy-mm-dd',
	});
	$('input#dob_end').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	//  $("#status").keyup(function () {
	//     $('#status').css('textTransform', 'capitalize');
	// });

	$('#filter_employee').on('click', display);

	$(document).on('click', '#filter', function() {
		$('#pagination').twbsPagination('destroy');
		list_of_companies_employees('');
	});

	$(document).on('click', '.delete_employee', function() {
		var employee_id = $(this).attr('id').replace(/emp_/, ''); // table row ID
		delete_employee(employee_id);
	});
	$(document).on('change', '#order_by', () => {
		let order = $('#order_by').val();
		list_of_companies_employees('', '', order);
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (
		role_list.indexOf('-57-') >= 0 ||
		role_list.indexOf('-56-') >= 0 ||
		role_list.indexOf('-58-') >= 0 ||
		role_list.indexOf('-59-') >= 0
	) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		total_no_of_employees();
		list_of_companies_employees('', '');
		load_position();
		load_department();
		load_employmentType();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}

	if (role_list.indexOf('-57-') >= 0) {
		$('#add_employee').show();
	}
}

function total_no_of_employees() {
	// alert('success');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/count_total_company_employees_not_terminated',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError
		error: function(response) {
			$('#employee_no').html('?');
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// $('#load_employees').hide();

				$('#employee_no').html('Employees (' + response['data']['total_count'] + ')');
			} else if (response.status == '401') {
				// $('#load_employees').hide();

				$('#employee_no').html('?');
			}
		},
	});
}

function display() {
	$('#filter_display').toggle();
	$('#firstname').val('');
	$('#lastname').val('');
	$('#gender').val('');
	$('#position').val('');
	$('#status').val('');
	$('#phone').val('');
	$('#dob_start').val('');
	$('#dob_end').val('');
	$('#email').val('');
	$('#employee_code').val('');
}

function list_of_companies_employees(page, serial, order_by) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}

	var limit = 10;

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
						strTable += '<tr id="row_' + v.employee_id + '">';
						strTable += '<td valign="top">' + k + '</td>';
						strTable += `<td valign="top">${v.employee_code}</td>`;
						strTable +=
							'<td  valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="' +
							window.location.origin +
							'/files/images/employee_images/' +
							'mid_' +
							v.profile_picture +
							'" alt="..." style="object-fit:cover; width:100%; height:100%;" class="pfl_ctna"></div></td>';
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

						// strTable += '<td valign="top">' + v.department_name + '</td>';
						strTable += '<td valign="top">' + empType + '</td>';
						strTable += `<td valign="top">${jobTitle}<p style="font-style: italic;color: blue;font-size: 0.9em;">${v.department_name}</p></td>`;
						strTable += `<td valign="top">${
							v.status.toLowerCase() === 'terminated' ? 'Exited' :
							status(v.status)}</td>`;
						strTable += '<td valign="top">';
						let role_list = $('#does_user_have_roles').html();
						if (role_list.indexOf('-56-') >= 0 || role_list.indexOf('-58-') >= 0) {
							strTable +=
								'<a href="' +
								base_url +
								'employee_info?id=' +
								v.employee_id +
								'"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;<!--<a href="' +
								base_url +
								'edit_employee?id=' +
								v.employee_id +
								'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee"></i></a>-->&nbsp;&nbsp;';
						} else {
							strTable +=
								'<a class="disabledC" onClick="denied()"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp';
						}

						if (role_list.indexOf('-59-') >= 0) {
							strTable +=
								'<a class="delete_employee" style="cursor: pointer;" id="emp_' +
								v.employee_id +
								'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee info"></i></a>';
						} else {
							strTable +=
								'<a class="disabledC" onClick="denied()" style="cursor: pointer;"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee info"></i></a>';
						}

						strTable += '</td>';
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
					strTable = '<tr><td colspan="6">No record found</td></tr>';
				}
				if (response.total_rows) {
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
				}

				$('#employeeData').html(strTable);
				$('#employeeData').show();
			} else if (response.status == '400') {
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="8">No record</td>';
				strTable += '</tr>';

				$('#employeeData').html(strTable);
				$('#employeeData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="8">' + response.msg + '</td>';
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
				'<td colspan="8"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#employeeData').html(strTable);
			$('#employeeData').show();
			$('#loading').hide();
		},
	});
}

function denied() {
	toastr.error('Access Denied');
}

function delete_employee(employee_id) {
	// alert('user deleted');
	// var email = $.session.get('email');
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this user');
	if (!ans) {
		return;
	}

	$('#row_' + employee_id).hide();
	$('#loader_row_' + employee_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_employee',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + employee_id).hide();
			$('#row_' + employee_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + employee_id).hide();
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
			// $('#employee_details_display').show();

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

function init_echarts() {
	if (typeof echarts === 'undefined') {
		return;
	}

	console.log('init_echarts');

	var theme = {
		color: [
			'#26B99A',
			'#34495E',
			'#BDC3C7',
			'#3498DB',
			'#9B59B6',
			'#8abb6f',
			'#759c6a',
			'#bfd3b7',
		],

		title: {
			itemGap: 8,
			textStyle: {
				fontWeight: 'normal',
				color: '#408829',
			},
		},

		dataRange: {
			color: [
				'#1f610a',
				'#97b58d',
			],
		},

		toolbox: {
			color: [
				'#408829',
				'#408829',
				'#408829',
				'#408829',
			],
		},

		tooltip: {
			backgroundColor: 'rgba(0,0,0,0.5)',
			axisPointer: {
				type: 'line',
				lineStyle: {
					color: '#408829',
					type: 'dashed',
				},
				crossStyle: {
					color: '#408829',
				},
				shadowStyle: {
					color: 'rgba(200,200,200,0.3)',
				},
			},
		},

		dataZoom: {
			dataBackgroundColor: '#eee',
			fillerColor: 'rgba(64,136,41,0.2)',
			handleColor: '#408829',
		},
		grid: {
			borderWidth: 0,
		},

		categoryAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},

		valueAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: [
						'rgba(250,250,250,0.1)',
						'rgba(200,200,200,0.1)',
					],
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},
		timeline: {
			lineStyle: {
				color: '#408829',
			},
			controlStyle: {
				normal: { color: '#408829' },
				emphasis: { color: '#408829' },
			},
		},

		k: {
			itemStyle: {
				normal: {
					color: '#68a54a',
					color0: '#a9cba2',
					lineStyle: {
						width: 1,
						color: '#408829',
						color0: '#86b379',
					},
				},
			},
		},
		map: {
			itemStyle: {
				normal: {
					areaStyle: {
						color: '#ddd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
				emphasis: {
					areaStyle: {
						color: '#99d2dd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
			},
		},
		force: {
			itemStyle: {
				normal: {
					linkStyle: {
						strokeColor: '#408829',
					},
				},
			},
		},
		chord: {
			padding: 4,
			itemStyle: {
				normal: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
				emphasis: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
			},
		},
		gauge: {
			startAngle: 225,
			endAngle: -45,
			axisLine: {
				show: true,
				lineStyle: {
					color: [
						[
							0.2,
							'#86b379',
						],
						[
							0.8,
							'#68a54a',
						],
						[
							1,
							'#408829',
						],
					],
					width: 8,
				},
			},
			axisTick: {
				splitNumber: 10,
				length: 12,
				lineStyle: {
					color: 'auto',
				},
			},
			axisLabel: {
				textStyle: {
					color: 'auto',
				},
			},
			splitLine: {
				length: 18,
				lineStyle: {
					color: 'auto',
				},
			},
			pointer: {
				length: '90%',
				color: 'auto',
			},
			title: {
				textStyle: {
					color: '#333',
				},
			},
			detail: {
				textStyle: {
					color: 'auto',
				},
			},
		},
		textStyle: {
			fontFamily: 'Arial, Verdana, sans-serif',
		},
	};

	//echart Bar

	if ($('#mainb').length) {
		var echartBar = echarts.init(document.getElementById('mainb'), theme);

		echartBar.setOption({
			title: {
				text: 'Naira',
				subtext: '...',
			},
			tooltip: {
				trigger: 'axis',
			},
			legend: {
				data: [
					'Salary',
				],
			},
			toolbox: {
				show: false,
			},
			calculable: false,
			xAxis: [
				{
					type: 'category',
					data: [
						'Jan',
						'Feb',
						'Mar',
						'Apr',
						'May',
						'Jun',
						'Jul',
						'Aug',
						'Sep',
						'Oct',
						'Nov',
						'Dec',
					],
				},
			],
			yAxis: [
				{
					type: 'value',
				},
			],
			series: [
				{
					name: 'Salary',
					type: 'bar',
					data: [
						700000.0,
						2250000.0,
						1130000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
					],
					markPoint: {
						data: [
							{
								type: 'max',
								name: '???',
							},
							{
								type: 'min',
								name: '???',
							},
						],
					},
					markLine: {
						data: [
							{
								type: 'average',
								name: '???',
							},
						],
					},
				},
			],
		});
	}
}
