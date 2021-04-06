$(document).ready(function() {
	fetch_employee_details();

	$('#payslip-tab').on('click', () => {
		if ($('#payslip-tab').hasClass('no')) {
			list_of_salary_history('');
			init_echarts();
			$('#payslip-tab').removeClass('no');
		}

		// init_echarts();
	});
	$('#salary-tab').on('click', () => {
		if ($('#salary-tab').hasClass('no')) {
			fetch_employee_view_details_salary_info();
			$('#salary-tab').removeClass('no');
		}
	});
	$('#leaves-tab').on('click', () => {
		// fetch_employee_view_details_leave_history();

		if ($('#leaves-tab').hasClass('no')) {
			list_employee_leave_history();
			init_echartsleave();
			$('#leaves-tab').removeClass('no');
		}
	});
	// $('#job-title-history-tab').on('click', () => {
	// 	if ($('#job-title-history-tab').hasClass('no')) {
	// 		list_employee_position_history();
	// 		$('#job-title-history-tab').removeClass('no');
	// 	}
	// });
	$('#attendance-tab').on('click', () => {
		if ($('#attendance-tab').hasClass('no')) {
			list_employee_attendance();
			$('#attendance-tab').removeClass('no');
		}
	});
	$('#profile-tab').on('click', () => {
		if ($('#profile-tab').hasClass('no')) {
			list_employee_position_history();
			load_branch();
			load_employee_type();
			$('#profile-tab').removeClass('no');
		}
	});
	$('#document-tab').on('click', () => {
		if ($('#document-tab').hasClass('no')) {
			list_employee_documents();
			$('#document-tab').removeClass('no');
		}
	});

	$('#add_QC').on('click', () => {
		$('#QC_display').toggle();
	});
	$('#add_work-exp').on('click', () => {
		$('#work-exp_display').toggle();
	});
	$('#add_NOK').on('click', () => {
		$('#NOK_display').toggle();
	});
});

$('#edit_emp_date').datepicker({
	dateFormat: 'yy-mm-dd',
});

// salary info start
function fetch_employee_view_details_salary_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { company_id: company_id, employee_id: employee_id },
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
					'edit_salary_info?id=' +
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

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

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
// salary info end

// payslip start
function list_of_salary_history(page) {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	if (page == '') {
		var page = 1;
	}
	var limit = 5;

	$('#loading').show();
	$('#salaryHistoryData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/view_company_employee_salary_history',
		data: { company_id: company_id, page: page, limit: limit, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length != 0) {
					var k = 1;
					$.each(response['data']['payment_history'], function(i, v) {
						strTable += '<tr>';

						strTable +=
							'<td>' +
							response['data']['payment_history'][i]['payment_code'] +
							'</td>';

						strTable +=
							'<td>' + response['data']['payment_history'][i]['date'] + '</td>';
						strTable +=
							'<td>' +
							response['data']['payment_history'][i]['payment_type'] +
							'</td>';
						strTable +=
							'<td>' +
							response['data']['payment_history'][i]['credit_debit'] +
							'</td>';
						strTable +=
							'<td>₦' + response['data']['payment_history'][i]['amount'] + '</td>';

						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="5">No record.</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_salary_history(page);
					},
				});

				$('#salaryHistoryData').html(strTable);
				$('#salaryHistoryData').show();
			} else if (response.status == '400') {
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#salaryHistoryData').html(strTable);
				$('#salaryHistoryData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">Technical Error</td>';
				strTable += '</tr>';

				$('#salaryHistoryData').html(strTable);
				$('#salaryHistoryData').show();
			}

			$('#loading').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
			strTable += '</tr>';

			$('#salaryHistoryData').html(strTable);
			$('#salaryHistoryData').show();
			$('#loading').hide();
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
		var company_id = localStorage.getItem('company_id');
		// var pathArray = window.location.pathname.split( '/' );
		var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
		var echartBar = echarts.init(document.getElementById('mainb'), theme);

		// $('#employee_details_display').hide();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: api_path + 'hrm/view_employee_salary_history_for_graph',
			data: { company_id: company_id, employee_id: employee_id },
			timeout: 60000,

			success: function(response) {
				$('#employee_details_display').show();

				console.log(response);
				if (response.status == '200') {
					$('#graph_loader').hide();

					if (response.data.length != 0) {
						var list_of_names = [];
						var list_of_values = [];
						$(response.data.payment_history).each(function(index, value) {
							if (value.credit_debit == 'debit') {
								var the_amount = -value.amount;
							} else {
								var the_amount = value.amount;
							}

							list_of_names.push(value.name);
							list_of_values.push({ value: Number(the_amount), label: 'name' });
						});

						echartBar.setOption({
							title: {
								text: 'Employee',
								subtext: 'Salary History',
							},
							tooltip: {
								trigger: 'axis',
								axisPointer: {
									type: 'shadow',
								},
							},
							legend: {
								data: [
									'Income',
								],
							},
							toolbox: {
								show: false,
							},
							calculable: false,
							grid: {
								top: 80,
								bottom: 30,
							},
							xAxis: {
								type: 'value',
								position: 'top',
								splitLine: { lineStyle: { type: 'dashed' } },
							},
							yAxis: {
								type: 'category',
								axisLine: { show: false },
								axisLabel: { show: false },
								axisTick: { show: false },
								splitLine: { show: false },
								data: list_of_names,
							},
							series: [
								{
									name: 'name',
									type: 'bar',
									stack: 'name',
									label: {
										normal: {
											show: true,
											formatter: '{b}',
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
					$('#graph_loader').hide();
					$('#no_recordpay').show();
				}
			},
			// objAJAXRequest, strError
			error: function(response) {
				$('#graph_loader').hide();
			},
		});
	}
}
// payslip end

// leave-history start

function fetch_employee_view_details_leave_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { company_id: company_id, employee_id: employee_id },
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
					'edit_job_titles?id=' +
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

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

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

function list_employee_leave_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	var page = 1;
	var limit = 10;

	$('#loading').show();
	$('#summaryData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_company_employee_leaves_history',
		data: { company_id: company_id, employee_id: employee_id, page: page, limit: limit },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr>';

						strTable += '<td>' + response['data'][i]['leave_name'] + '</td>';

						strTable += '<td>' + response['data'][i]['leave_start_date'] + '</td>';

						strTable += '<td>' + response['data'][i]['resumption_date'] + '</td>';
						strTable += '<td>' + response['data'][i]['real_days_used'] + '</td>';

						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="4">No record.</td></tr>';
				}

				$('#summaryData').html(strTable);
				$('#summaryData').show();
			} else if (response.status == '400') {
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#summaryData').html(strTable);
				$('#summaryData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">Technical Error</td>';
				strTable += '</tr>';

				$('#summaryData').html(strTable);
				$('#summaryData').show();
			}

			$('#loading').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="4"><strong class="text-danger">Connection error</strong></td>';
			strTable += '</tr>';

			$('#summaryData').html(strTable);
			$('#summaryData').show();
			$('#loading').hide();
		},
	});
}

function init_echartsleave() {
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

	if ($('#leave-history').length) {
		var company_id = localStorage.getItem('company_id');
		// var pathArray = window.location.pathname.split( '/' );
		var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
		var echartBar = echarts.init(document.getElementById('leave-history'), theme);

		// $('#employee_details_display').hide();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: api_path + 'hrm/view_employee_leave_history_for_graph',
			data: { company_id: company_id, employee_id: employee_id },
			timeout: 60000,

			success: function(response) {
				$('#graph_loading').hide();
				$('#employee_details_display').show();

				console.log(response);
				if (response.status == '200') {
					if (response.data.length != 0) {
						var list_of_names = [];
						var list_of_value_used = [];
						var list_of_values_remaining = [];
						$(response.data.leave_history).each(function(index, value) {
							list_of_names.push(value.name);
							list_of_value_used.push({
								value: Number(value.real_days_used),
								label: 'name',
							});
							list_of_values_remaining.push({
								value: Number(value.remaining_days),
								label: 'name',
							});
						});

						echartBar.setOption({
							title: {
								text: 'Employee',
								subtext: 'Leave History',
							},
							tooltip: {
								trigger: 'axis',
								axisPointer: {
									type: 'shadow',
								},
							},
							legend: {
								data: [
									'Used Days',
									'Remaining Days',
								],
							},
							grid: {
								left: '3%',
								right: '4%',
								bottom: '3%',
								containLabel: true,
							},
							xAxis: {
								type: 'value',
							},
							yAxis: {
								type: 'category',
								data: list_of_names,
							},
							series: [
								{
									name: 'Used Days',
									type: 'bar',
									stack: 'name',
									label: {
										normal: {
											show: true,
											position: 'insideRight',
										},
									},
									data: list_of_value_used,
								},
								{
									name: 'Remaining Days',
									type: 'bar',
									stack: 'name',
									label: {
										normal: {
											show: true,
											position: 'insideRight',
										},
									},
									data: list_of_values_remaining,
								},
							],
						});
					}
				} else if (response.status == '400') {
					// alert('error');
					$('#graph_loading').hide();
					$('#no_record').show();
				}
			},
			// objAJAXRequest, strError
			error: function(response) {
				// alert('error');
				$('#graph_loading').hide();
				// $('#employee_details_display').hide();
				// $('#employee_error_display').show();
			},
		});
	}
}
// leave history end

// jobtitle history start
// function list_employee_position_history() {
// 	var company_id = localStorage.getItem('company_id');
// 	// var pathArray = window.location.pathname.split( '/' );
// 	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

// 	$('#loading_job').show();
// 	// $("#positionHistoryData").html('');

// 	$.ajax({
// 		type: 'POST',
// 		dataType: 'json',
// 		url: api_path + 'hrm/list_company_employee_positions_history',
// 		data: { company_id: company_id, employee_id: employee_id },
// 		timeout: 60000,

// 		success: function(response) {
// 			console.log(response);
// 			$('#loading_job').hide();
// 			var strTable = '';

// 			if (response.status == '200') {
// 				if (response.data.length > 0) {
// 					var k = 1;
// 					$.each(response['data'], function(i, v) {
// 						strTable += '<tr>';

// 						strTable += '<td>' + response['data'][i]['position_name'] + '</td>';

// 						strTable += '<td>' + response['data'][i]['from_date'] + '</td>';
// 						strTable += '<td>' + response['data'][i]['to_date'] + '</td>';

// 						strTable += '</tr>';

// 						k++;
// 					});
// 				} else {
// 					strTable = '<tr><td colspan="3">No record.</td></tr>';
// 				}

// 				$('#positionHistoryData').html(strTable);
// 				$('#positionHistoryData').show();
// 			} else if (response.status == '400') {
// 				$('#loading_job').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="3">' + response.msg + '</td>';
// 				strTable += '</tr>';

// 				$('#positionHistoryData').html(strTable);
// 				$('#positionHistoryData').show();
// 			} else if (response.status == '401') {
// 				//missing parameters
// 				var strTable = '';
// 				$('#loading_job').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="3">Technical Error</td>';
// 				strTable += '</tr>';

// 				$('#positionHistoryData').html(strTable);
// 				$('#positionHistoryData').show();
// 			}

// 			$('#loading_job').hide();
// 		},

// 		error: function(response) {
// 			var strTable = '';
// 			$('#loading_job').hide();
// 			// alert(response.msg);
// 			strTable += '<tr>';
// 			strTable += '<td colspan="3">Connection error</td>';
// 			strTable += '</tr>';

// 			$('#documentData').html(strTable);
// 			$('#documentData').show();
// 			$('#loading_job').hide();
// 		},
// 	});
// }
// job title history end

// attendance start

function list_employee_attendance() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	var page = 1;
	var limit = 10;

	$('#loading_atten').show();
	$('#attData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_employee_attendances',
		data: { company_id: company_id, employee_id: employee_id, page: page, limit: limit },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading_atten').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr>';

						strTable += '<td width="25%">' + response['data'][i]['date'] + '</td>';
						strTable += '<td>' + response['data'][i]['clock_in'] + '</td>';
						strTable += '<td>' + response['data'][i]['clock_out'] + '</td>';
						strTable += '<td>' + response['data'][i]['work_hours'] + '</td>';

						strTable += '<td></td>';

						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="5">No record.</td></tr>';
				}

				$('#attData').html(strTable);
				$('#attData').show();
			} else if (response.status == '400') {
				$('#loading_atten').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#attData').html(strTable);
				$('#attData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading_atten').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">Technical Error</td>';
				strTable += '</tr>';

				$('#attData').html(strTable);
				$('#attData').show();
			}

			$('#loading_atten').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading_atten').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#attData').html(strTable);
			$('#attData').show();
			$('#loading_atten').hide();
		},
	});
}
// attendance end

// documents start

function list_employee_documents() {
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');

	var page = 1;
	var limit = 10;

	$('#loading_docv').show();
	$('#documentData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_user_docs',
		data: { company_id: company_id, user_id: user_id, page: page, limit: limit },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading_docv').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['document_id'] + '">';

						strTable += '<td>D' + response['data'][i]['document_id'] + '</td>';

						strTable += '<td>' + response['data'][i]['original_filename'] + '</td>';

						strTable += '<td>' + response['data'][i]['file_size'] + '</td>';
						strTable += '<td>' + response['data'][i]['date_uploaded'] + '</td>';
						// strTable += '<td valign="top"> <a class="delete_document" style="cursor: pointer;" id="doc_'+response['data'][i]['document_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Document"></i></a></td>';
						strTable += `<td> <div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle"
											type="button" id="dropdownMenuButton1"
											data-toggle="dropdown" aria-expanded="false">
											Actions
										</button>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuButton1">
											<li><a class="dropdown-item"><i
														class="fa fa-pencil"></i> Edit</a></li>
											<li><a class="dropdown-item"><i
														class="fa fa-trash"></i> Delete</a></li>
										</ul>
									</div></td>`;

						strTable += '</tr>';

						// strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['document_id']+'">';
						// strTable += '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						// strTable +=  '</td>';
						// strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="4">No record.</td></tr>';
				}

				$('#documentData').html(strTable);
				$('#documentData').show();
			} else if (response.status == '400') {
				$('#loading_docv').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#documentData').html(strTable);
				$('#documentData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading_docv').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">Technical Error</td>';
				strTable += '</tr>';

				$('#documentData').html(strTable);
				$('#documentData').show();
			}

			$('#loading_docv').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading_docv').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#documentData').html(strTable);
			$('#documentData').show();
			$('#loading_docv').hide();
		},
	});
}

// documents end
function load_employee_type() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_employment_types',
		type: 'POST',
		data: { company_id: company_id },
		dataType: 'json',

		success: function(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['type_id'] +
					'">' +
					response['data'][i]['type_name'] +
					'</option>';

				emp_type = response['data'][i]['type_id'];
			});
			$('#edit_emp_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

function load_branch() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_branches',
		type: 'POST',
		data: { company_id: company_id },
		dataType: 'json',

		success: function(response) {
			// $('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['branch_id'] +
					'">' +
					response['data'][i]['branch_name'] +
					'</option>';

				bra_type = response['data'][i]['branch_id'];
			});
			$('#edit_emp_branch').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

function list_employee_position_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	$('#job_title_loader').show();
	// $("#positionHistoryData").html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_company_employee_positions_history',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#job_title_loader').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr>';

						strTable += `<td>${v.position_name} <span class="greent_${i}_trial"></span></td>`;

						strTable += '<td>' + response['data'][i]['from_date'] + '</td>';
						strTable += '<td>' + response['data'][i]['to_date'] + '</td>';
						strTable += `<td> <div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle"
											type="button" id="dropdownMenuButton1"
											data-toggle="dropdown" aria-expanded="false">
											Actions
										</button>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuButton1">
											<li><a class="dropdown-item"><i
														class="fa fa-pencil"></i> Edit</a></li>
											<li><a class="dropdown-item"><i
														class="fa fa-trash"></i> Delete</a></li>
										</ul>
									</div></td>`;

						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="3">No record.</td></tr>';
				}

				$('#positionHistoryData').html(strTable);
				$('#positionHistoryData').show();
			} else if (response.status == '400') {
				$('#job_title_loader').hide();
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#positionHistoryData').html(strTable);
				$('#positionHistoryData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#job_title_loader').hide();
				strTable += '<tr>';
				strTable += '<td colspan="3">Technical Error</td>';
				strTable += '</tr>';

				$('#positionHistoryData').html(strTable);
				$('#positionHistoryData').show();
			}

			$('#job_title_loader').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#job_title_loader').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable += '<td colspan="3">Connection error</td>';
			strTable += '</tr>';

			// $('#documentData').html(strTable);
			// $('#documentData').show();
			$('#positionHistoryData').html(strTable);
			$('#positionHistoryData').show();
			$('#job_title_loader').hide();
		},
	});
}

function toggleStuffs(elem) {
	$(elem).toggle();
}

function addQC() {
	$('#add_QC_btn').hide();
	$('#add_QC_loader').show();
	let institution = $('#QC_institute_name').val();
	let degree = $('#QC_degree').val();
	let year_concluded = $('#QC_year_concluded').val();
	axios({
		method: 'put',
		url: '/user/12345',
		params: {},
		data: {
			institution: institution,
			degree: degree,
			year: year_concluded,
		},
	})
		.then(function(response) {
			if (response.data.status == 200 || response.data.status == 201) {
				$('#add_QC_loader').hide();
				$('#add_QC_btn').show();

				$('#mod_body').html('Q&C creation successful');
				$('#successModal').modal('show');
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#add_QC_loader').hide();
			$('#add_QC_btn').show();
			alert('error');
		});
}

function editQC() {
	// $('#edit_QC_modal').modal('show');
	$('#edit_QC_btn').hide();
	$('#edit_QC_loader').show();

	let institution = $('#edit_QC_institute_name').val();
	let degree = $('#edit_QC_degree').val();
	let year_concluded = $('#edit_QC_year_concluded').val();
	axios({
		method: 'put',
		url: '/user/12345',
		params: {},
		data: {
			institution: institution,
			degree: degree,
			year: year_concluded,
		},
	})
		.then(function(response) {
			if (response.data.status == 200 || response.data.status == 201) {
				$('#edit_QC_loader').hide();
				$('#edit_QC_btn').show();

				$('#mod_body').html('Q&C Edit Successful');
				$('#successModal').modal('show');
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#edit_QC_loader').hide();
			$('#edit_QC_btn').show();
			alert('error');
		});
}

function viewQC() {
	$('#edit_QC_error').html('');
	$('#edit_QC_modal').modal('show');
	$('#edit_QC_btn').hide();
	$('#edit_QC_loader').show();
	axios
		.get('/user', {
			params: {},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_QC_loader').hide();
			$('#edit_QC_btn').show();

			let {} = response.data;
			$('#edit_QC_institute_name').val();
			$('#edit_QC_degree').val();
			$('#edit_QC_year_concluded').val();
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_QC_loader').hide();
			$('#edit_QC_btn').show();

			$('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}
