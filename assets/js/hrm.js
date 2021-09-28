$(document).ready(function() {
	$('#logout').on('click', logout);
	setTimeout(() => {
		wait_to_load();
	}, 2000);
});

function wait_to_load(warehouse_id) {
	var def = $.Deferred();
	$.when(
		get_employee_cat(),
		fetch_employee_cost_graph(),
		fetch_total_emp_by_month(),
	).done(function() {
		setTimeout(function() {
			def.resolve();
		}, 60000);
	});
}

$.urlParam = function(name) {
	var results = new RegExp('[?&]' + name + '=([^]*)').exec(window.location.href);
	if (results == null) {
		return null;
	} else {
		return results[1] || 0;
	}
};

function fetch_total_emp_by_month() {
	var chartDom = document.getElementById('total_employees_by_months');
	var myChart = echarts.init(chartDom);
	var option;

	option = {
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: [
				'Jan',
				'Feb',
				'Mar',
				'Apr',
				'May',
				'Jun',
				'Jul',
			],
		},
		yAxis: {
			type: 'value',
		},
		series: [
			{
				data: [
					820,
					932,
					901,
					934,
					1290,
					1330,
					1320,
				],
				type: 'line',
				areaStyle: {},
			},
		],
	};

	option && myChart.setOption(option);
}

function fetch_employee_cost_graph() {
	// var echartDonut = echarts.init(document.getElementById("yearly_sales_report"));

	var chartDom = document.getElementById('yearly_sales_report');
	var myChart = echarts.init(chartDom);
	var option;

	option = {
		title: {},
		tooltip: {
			trigger: 'axis',
		},
		legend: {
			data: [
				'蒸发量',
			],
		},
		toolbox: {
			show: true,
			feature: {
				dataView: { show: true, readOnly: false },
				magicType: {
					show: true,
					type: [
						'line',
						'bar',
					],
				},
				restore: { show: true },
				saveAsImage: { show: true },
			},
		},
		calculable: true,
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
				name: '蒸发量',
				type: 'bar',
				data: [
					2.0,
					4.9,
					7.0,
					23.2,
					25.6,
					76.7,
					135.6,
					162.2,
					32.6,
					20.0,
					6.4,
					3.3,
				],
				markPoint: {
					data: [
						{ type: 'max', name: '最大值' },
						{ type: 'min', name: '最小值' },
					],
				},
				markLine: {
					data: [
						{ type: 'average', name: '平均值' },
					],
				},
			},
		],
	};

	option && myChart.setOption(option);
}

function get_employee_cat() {
	if ($('#echart_pie').length) {
		var company_id = localStorage.getItem('company_id');
		var echartPie = echarts.init(document.getElementById('echart_pie'));

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: api_path + 'company/count_total_employee_for_each_company_employment_type',
			data: {},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
			timeout: 60000,

			success: function(response) {
				console.log(response);

				if (response.status == '200') {
					if (response.data.length != 0) {
						var list_of_names = [];
						var list_of_values = [];
						$(response.data).each(function(index, value) {
							list_of_names.push(value.name);
							list_of_values.push({
								value: Number(value.employee_count),
								name: value.name,
							});
						});

						$('#ddsh_loading').hide(); //hidel loader

						var echartDonut = echarts.init(document.getElementById('echart_pie'));

						echartDonut.setOption({
							tooltip: {
								trigger: 'item',
								formatter: '{a} <br/>{b} : {c} ({d}%)',
							},
							calculable: true,
							legend: {
								x: 'center',
								y: 'bottom',
								data: list_of_names,
							},
							toolbox: {
								show: true,
								feature: {
									magicType: {
										show: true,
										type: [
											'pie',
											'funnel',
										],
										option: {
											funnel: {
												x: '25%',
												width: '50%',
												funnelAlign: 'center',
												max: 1548,
											},
										},
									},
									restore: {
										show: true,
										title: 'Restore',
									},
									saveAsImage: {
										show: true,
										title: 'Save Image',
									},
								},
							},
							series: [
								{
									name: 'Total',
									type: 'pie',
									radius: [
										'35%',
										'55%',
									],
									itemStyle: {
										normal: {
											label: {
												show: true,
											},
											labelLine: {
												show: true,
											},
										},
										emphasis: {
											label: {
												show: true,
												position: 'center',
												textStyle: {
													fontSize: '14',
													fontWeight: 'normal',
												},
											},
										},
									},
									data: list_of_values,
								},
							],
						});
					} else {
						//no data available
					}
				} else if (response.status == '400') {
				}
			},
			// objAJAXRequest, strError
			error: function(response) {
				alert('connection error');
				// $('#employee_details_display').hide();
				// $('#employee_error_display').show();
			},
		});
	}
}

function fetch_employee_view_details() {
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
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				str2 +=
					'<a href="' +
					base_url +
					'employees"><button class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'edit_employment_info?id=' +
					response.data.employee_id +
					'"><button class="btn btn-primary">Edit</button></a>';

				$('#profile_name').html(
					'<b>' + response.data.firstname + ' ' + response.data.lastname + '</b>',
				);

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

				// str += '<li><i class="fa fa-external-link user-profile-icon"></i>&nbsp;&nbsp;';
				// str += '<a href="<?= base_url() ?>hrm/view_supervisor/'+response.data.employee_id+'">Supervisor/Manager</a></li>';

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

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_error_display').show();
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

function fetch_employee_details() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	// $('#page_loader').hide();
	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/new_employee_info',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();
			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				let dobs;
				if (
					response.data.employee_data.dob === '' ||
					response.data.employee_data.dob === '0000-00-00'
				) {
					dobs = '...';
				} else {
					dobs = moment(response.data.employee_data.dob, 'YYYY-MM-DD').format('LL');
				}
				$('#firstname').html(response.data.employee_data.firstname);
				$('#lastname').html(response.data.employee_data.lastname);
				$('#gender').html(response.data.employee_data.gender);
				$('#middlename').html(response.data.employee_data.middlename);
				$('#dob').html(dobs);
				$('#marital_status').html(response.data.employee_data.marital_status);
				$('#phone').html(response.data.employee_data.phone);
				$('#residential_address').html(response.data.employee_data.residential_address);
				$('#email').html(response.data.employee_data.email);
				$('#religion').html(response.data.employee_data.religion);
				$('#next_of_kin').html(response.data.employee_data.next_of_kin);
				$('#status').html(
					`${
						response.data.employee_data.active_status.toLowerCase() ===
						'terminated' ? 'Exited' :
						capitalizeFirstLetter(response.data.employee_data.active_status)}`,
				);

				$('#profile_name').html(
					'<b>' +
						response.data.employee_data.firstname +
						' ' +
						response.data.employee_data.lastname +
						'</b>',
				);

				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a onClick="viewBasicInfo()"><button id="editBasicInfo" data-toggle="modal" data-target="#edit_basic_modal" class="btn btn-primary">Edit</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.employee_data.profile_picture +
					'" alt="..."><div style="text-decoration:underline;text-align:center;margin-top:5px;" data-toggle="modal" data-target="#edit_proPic_modal" class="pointer">Update Image</div>';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_data.employee_id +
					'">Leave History</a></li>';

				// str += '<li><i class="fa fa-external-link user-profile-icon"></i>&nbsp;&nbsp;';
				// str += '<a href="<?= base_url() ?>hrm/view_supervisor/'+response.data.employee_data.employee_id+'">Supervisor/Manager</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_data.employee_id +
					'">Attendance</a></li>';

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

function fetch_employee_edit_details() {
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
				// alert(response.data.firstname);
				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a onClick="viewBasicInfo()"><button id="editBasicInfo" data-toggle="modal" data-target="#edit_basic_modal" class="btn btn-primary">Edit</button></a>';

				$('#profile_name').html(
					'<b>' +
						response.data.firstname +
						' ' +
						response.data.lastname +
						'</b> | <font color="red">Edit</font>',
				);

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="..." style="width: 230px">';
				str3 += '</div>';

				str += '<li>';
				str += '<i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_employee?id=' +
					employee_id +
					'">Basic Profile</a>';

				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_employment_info?id=' +
					employee_id +
					'">Employment Profile</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_job_titles?id=' +
					employee_id +
					'">Edit Position History</a>';
				str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_salary_info?id' +
					employee_id +
					'">Edit Salary/Welfare Info</a>';
				str += '</li>';

				// str += '<li>';
				// str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=  '<a href="<?= base_url() ?>hrm/edit_supervisor/'+employee_id+'">Edit Supervisor</a>';

				// str += '</li>';

				str += '<li>';
				str += '<i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_employee_docs?id=' +
					employee_id +
					'">Documents</a>';
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

function isValidDate(dateString) {
	var regEx = /^\d{4}-\d{2}-\d{2}$/;

	if (!regEx.test(dateString)) {
		return false;
	} else {
		return true;
	}
}

function logout() {
	localStorage.clear();
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
