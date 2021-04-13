$(document).ready(function() {
	list_of_leaves_applicant('');

	$(document).on('click', '.delete_leave', function() {
		var leave_id = $(this).attr('id').replace(/lev_/, ''); // table row ID
		delete_leave(leave_id);
	});

	$(document).on('click', '#leave_filter', function() {
		$('#pagination').twbsPagination('destroy');
		$('#loading').show();
		list_of_leaves_applicant('');
	});

	$('#filter_leave').on('click', show_leave_filter_form);
	load_employee();
	load_leave_type();

	$('input#date_range').daterangepicker({
		autoUpdateInput: false,
	});

	$('input#date_range').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(
			picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'),
		);
	});
});

function show_leave_filter_form() {
	$('#filter_leave_display').toggle();
}

function delete_leave(leave_id) {
	var company_id = localStorage.getItem('company_id');

	// alert(leave_id);
	var ans = confirm('Are you sure you want to delete?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + leave_id).hide();
	$('#loader_row_' + leave_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_employee_leave',
		data: {
			company_id: company_id,
			leave_id: leave_id,
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			// alert('Connection error');
			$('#loader_row_' + leave_id).hide();
			$('#row_' + leave_id).show();

			// alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
				// alert(leave_id);
			} else if (response.status == '401') {
			}

			$('#loader_row_' + leave_id).hide();
		},
	});
}

function list_of_leaves_applicant(page) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 20;

	var employee_id = $('#employee_id').val();
	var leave_type = $('#leave_type').val();
	var leave_code = $('#leave_code').val();
	var date_range = $('#date_range').val();

	$('#loading').show();
	$('#leavesData').html('');
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_leaves_applicant',
		data: {
			company_id: company_id,
			page: page,
			limit: limit,
			employee_id: employee_id,
			leave_type: leave_type,
			leave_code: leave_code,
			date_range: date_range,
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';
			var aprvv_status = '';

			$('#loading').hide();
			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						var date = new Date(response['data'][i]['leave_start_from']);
						// var dateParts = date.split("-");

						// var dateObject = new Date(dateParts[2]+"/"+dateParts[1] - 1+"/"+dateParts[0]);

						var resumption_date = new Date(response['data'][i]['resumption_date']);
						var leave_start = new Date(response['data'][i]['leave_start']);
						// resumption_date.format();
						// var date2 = dateFormat(now, "dddd, mmmm dS, yyyy, h:MM:ss TT");

						if (response['data'][i]['leave_status'] == 'Pending') {
							aprvv_status =
								'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
						} else if (response['data'][i]['leave_status'] == 'Accepted') {
							aprvv_status = '<i class="fa fa-check fa-2x" style="color: green"></i>';
						} else if (response['data'][i]['leave_status'] == 'Declined') {
							aprvv_status = '<i class="fa fa-times fa-2x" style="color: red"></i>';
						}

						strTable += '<tr id="row_' + response['data'][i]['leave_id'] + '">';
						strTable +=
							'<td valign="top">' + response['data'][i]['leave_code'] + '</td>';
						strTable +=
							'<td width="8%" valign="top"><div class="profile_pic"><img src="' +
							window.location.origin +
							'/files/images/employee_images/sml_' +
							response['data'][i]['profile_picture'] +
							'" alt="..." width="50"></div></td>';
						strTable +=
							'<td width="20%" valign="top"><b>' +
							response['data'][i]['lastname'] +
							'</b>' +
							', ' +
							response['data'][i]['firstname'] +
							' ' +
							response['data'][i]['middlename'] +
							'<br>on: ' +
							date.toDateString() +
							'</td>';
						strTable +=
							'<td valign="top">' + response['data'][i]['leave_type'] + '</td>';
						strTable += '<td valign="top">' + leave_start.toDateString() + '</td>';
						strTable += '<td valign="top">' + resumption_date.toDateString() + '</td>';
						strTable +=
							'<td valign="top">' + response['data'][i]['days_requested'] + '</td>';

						// if(response['data'][i]['total_leave_sent_for_approval'] == response['data'][i]['total_pending_leave_approvals']){
						strTable +=
							'<td valign="top">' +
							response['data'][i]['total_approvals_handled'] +
							'/' +
							response['data'][i]['total_leave_sent_for_approval'] +
							'</td>';
						// }else{
						//   strTable += '<td valign="top"><a href="'+base_url+'/erp/hrm/forward_application/'+response['data'][i]['leave_id']+'"><i  class="fa fa-forward"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="Forward Leave Applicant"></i></a> &nbsp;&nbsp;'+response['data'][i]['total_pending_leave_approvals']+"/"+response['data'][i]['total_leave_sent_for_approval']+'</td>';
						// }

						strTable += '<td valign="top">' + aprvv_status + '</td>';

						strTable +=
							'<td valign="top"><a href="' +
							base_url +
							'view_employee_leave_details?id=' +
							response['data'][i]['leave_id'] +
							'"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style=" color: gray; font-size: 20px;" title="View Employee Leave Details"></i></a> &nbsp;&nbsp;<a style="cursor: pointer;" class="delete_leave" id="lev_' +
							response['data'][i]['leave_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Leave Info"></i></a></td>';
						strTable += '</tr>';

						// <a href="'+base_url+'/erp/hrm//'+response['data'][i]['employee_id']+'"><i  class="fa fa-list"  data-toggle="tooltip" data-placement="top" font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['leave_id'] +
							'">';
						strTable +=
							'<td colspan="9"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="9">No record.</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_leaves_applicant(page);
						$('html, body').animate(
							{
								scrollTop: 0,
							},
							'slow',
						);
					},
				});

				$('#leavesData').html(strTable);
				$('#leavesData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="10">No leave found for this Employee</td>';
				strTable += '</tr>';

				$('#leavesData').html(strTable);
				$('#leavesData').show();
			} else if (response.status == '401') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="10">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#leavesData').html(strTable);
				$('#leavesData').show();
			}
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="10"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#leavesData').html(strTable);
			$('#leavesData').show();
		},
	});
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

function load_leave_type() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_leaves_type',
		type: 'POST',
		data: {
			company_id: company_id,
			page: 1,
			limit: 20,
		},
		dataType: 'json',

		success: function(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['leave_id'] +
					'">' +
					response['data'][i]['leave_type'] +
					'</option>';
			});
			$('#leave_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
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
				normal: {
					color: '#408829',
				},
				emphasis: {
					color: '#408829',
				},
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
