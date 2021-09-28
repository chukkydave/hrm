$(document).ready(function() {
	init_echarts();
	fetch_employee_view_details_for_employment_info();
	employee_employement_info();
});

function fetch_employee_view_details_for_employment_info() {
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

// function employee_employement_info() {
// 	var company_id = localStorage.getItem('company_id');
// 	var employee_id = $.urlParam('id');

// 	$.ajax({
// 		type: 'POST',
// 		dataType: 'json',
// 		url: api_path + 'hrm/view_company_employee_salary_info',
// 		data: { company_id: company_id, employee_id: employee_id },
// 		timeout: 60000,

// 		success: function(response) {
// 			$('#employee_details_display').show();

// 			console.log(response);
// 			if (response.status == '200') {
// 				$('#net_pay').html(
// 					'<h1><b>₦' + response['data']['net']['total_amount'] + '</b></h1>',
// 				);
// 				$('#job_title').html(response['data']['designations']['job_title']);
// 				$('#employment_type').html(response['data']['designations']['employment_type']);
// 				$('#date_of_employment').html(
// 					response['data']['designations']['date_of_employment'],
// 				);
// 				$('#supervisor').html(response['data']['designations']['supervisor']);
// 				$('#additional_info').html(response['data']['designations']['additional_info']);
// 				$('#branch').html(response['data']['designations']['branch']);
// 				$('#department').html(response['data']['designations']['department']);

// 				$('#ddsh_loading_1').hide(); //hidel loader
// 			} else if (response.status == '400') {
// 				$('#ddsh_loading_1').hide();
// 				$('#no_record').show();
// 				$('#no_record3').show();
// 			}
// 		},
// 		// objAJAXRequest, strError
// 		error: function(response) {
// 			$('#ddsh_loading_1').hide();
// 			alert('error');
// 		},
// 	});
// }

function employee_employement_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_employment_info',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// $('#page_loader').hide();
			$('#employee_details_display').show();

			console.log(response);

			if (response.status == '200') {
				// $.each(emp_type[data], function(i,v){
				// alert(emp_type);
				// })
				let postVal;
				let supervisor;
				let workShift;

				if (response.data.job_title == null) {
					postVal = 'null';
				} else {
					postVal = response.data.job_title;
				}
				if (response.data.supervisor == 0) {
					supervisor = 'No';
				} else {
					supervisor = 'Yes';
				}

				if (response.data.workshift_name == false) {
					workShift = 'none available';
				} else {
					workShift = response.data.workshift_name;
				}

				$('#date_of_employment').html(response.data.date_of_employment);
				$('#employment_type').html(response.data.employment_type_name);
				$('#department').html(response.data.employment_department_name);
				$('#branch').html(response.data.employment_branch_name);
				$('#additional_info').html(response.data.additional_info);
				$('#job_title').html(postVal);

				$('#supervisor').html(supervisor);
				$('#work_shifts').html(workShift);
				// 	'To edit Job Title, use the <a href="edit_job_titles?id=' +
				// 		employee_id +
				// 		'" style="text-decoration:underline">Job Title History Module</a>',
				// );
			} else if (response.status == '400') {
				$('#ddsh_loading_1').hide();
				$('#no_record').show();
				$('#no_record3').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#ddsh_loading_1').hide();
			alert('error');
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

	// }
}
