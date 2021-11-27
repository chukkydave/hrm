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

	$('#logout').on('click', logout);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		setTimeout(() => {
			wait_to_load();
		}, 2000);
		fetch_notice_board();
		listUpcomingEvents();
		fetch_total_salary();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}
// 0: {title: "All Day Event", start: "2021-07-01"}
// 1: {title: "Long Event", start: "2021-07-07", end: "2021-07-10"}
// 2: {groupId: "999", title: "Repeating Event", start: "2021-07-09T16:00:00+00:00"}
// 3: {groupId: "999", title: "Repeating Event", start: "2021-07-16T16:00:00+00:00"}
// 4: {title: "Conference", start: "2021-07-12", end: "2021-07-14"}
// 5: {title: "Meeting", start: "2021-07-13T10:30:00+00:00", end: "2021-07-13T12:30:00+00:00"}
// 6: {title: "Lunch", start: "2021-07-13T12:00:00+00:00"}
// 7: {title: "Birthday Party", start: "2021-07-14T07:00:00+00:00"}
// 8: {url: "http://google.com/", title: "Click for Google", start: "2021-07-28"}

function wait_to_load(warehouse_id) {
	var def = $.Deferred();
	$.when(
		no_of_leaves(),
		no_of_terminations(),
		total_employees_not_terminated(),
		get_employee_cat(),
		fetch_employee_cost_graph(),
		fetch_total_emp_by_month(),
		fetch_exits_graph(),
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

function total_employees_not_terminated() {
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
			$('#load_employees').hide();

			$('#no_employees').html('?');
		},

		success: function(response) {
			if (response.status == '200') {
				$('#load_employees').hide();

				$('#no_employees').html(response['data']['total_count']);
			} else if (response.status == '401') {
				$('#load_employees').hide();

				$('#no_employees').html('?');
			}
		},
	});
}

function no_of_leaves() {
	// alert('success');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/pending_leaves_count',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError
		error: function(response) {
			$('#load_leaves').hide();

			$('#no_leaves').html('?');
		},

		success: function(response) {
			if (response.status == '200') {
				$('#load_leaves').hide();

				$('#no_leaves').html(response['data']['pending_leaves_count']);
			} else if (response.status == '401') {
				$('#load_leaves').hide();

				$('#no_leaves').html('?');
			}
		},
	});
}

function no_of_terminations() {
	// alert('success');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/terminations_count',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError
		error: function(response) {
			$('#load_terminations').hide();

			$('#no_terminations').html('?');
		},

		success: function(response) {
			// alert(response);

			if (response.status == '200') {
				$('#load_terminations').hide();

				$('#no_terminations').html(response['data']['terminations_count']);
			} else if (response.status == '401') {
				$('#load_terminations').hide();

				$('#no_terminations').html('?');
			}
		},
	});
}

function fetch_total_emp_by_month() {
	// $('#sche_msg_error').html('');
	$(`#total_employees_by_months`).hide();
	$(`#total_employees_by_months_loading`).show();

	let company_id = localStorage.getItem('company_id');
	let current_month = new Date().getMonth() + 1;
	let current_year = new Date().getFullYear();
	axios
		.get(`${api_path}hrm/graph_total_employee`, {
			params: {
				current_month: current_month,
				current_year: current_year,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#total_employees_by_months_loading').hide();
			$('#total_employees_by_months').show();
			if (response.data.data.length > 0) {
				let years = [];
				let amt = [];
				response.data.data.map((item) => {
					years.push(capitalizeFirstLetter(item.name));
					amt.push(parseFloat(item.amount));
				});

				var chartDom = document.getElementById('total_employees_by_months');
				var myChart = echarts.init(chartDom);
				var option;

				option = {
					xAxis: {
						type: 'category',
						boundaryGap: false,
						data: years,
					},
					yAxis: {
						type: 'value',
					},
					series: [
						{
							data: amt,
							type: 'line',
							areaStyle: {},
						},
					],
				};

				option && myChart.setOption(option);
			} else {
				$('#total_employees_by_months').html('No record');
			}

			// $('#total_employees_by_months_loading').hide();
			// $('#total_employees_by_months').show();
		})
		.catch(function(error) {
			console.log('error', error);

			$('#total_employees_by_months_loading').hide();
			$('#total_employees_by_months').show();

			$('#total_employees_by_months').html(error.statusText);
		})
		.then(function() {
			// always executed
		});
}
function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
function formatToCurrency(amount) {
	if (amount === 0 || amount === 0.0) {
		return amount;
	} else {
		return '₦' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	}
}
function numberWithCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}
function fetch_employee_cost_graph() {
	// $('#sche_msg_error').html('');
	$(`#yearly_sales_report`).hide();
	$(`#yearly_sales_report_loading`).show();

	let company_id = localStorage.getItem('company_id');
	let current_year = new Date().getFullYear();
	axios
		.get(`${api_path}hrm/graph_employee_cost`, {
			params: {
				current_year: current_year,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#yearly_sales_report_loading').hide();
			$('#yearly_sales_report').show();
			if (response.data.data.length > 0) {
				let years = [];
				let amt = [];
				response.data.data.map((item) => {
					years.push(capitalizeFirstLetter(item.name));
					amt.push(parseFloat(item.amount));
				});
				let chartDom = document.getElementById('yearly_sales_report');
				let myChart = echarts.init(chartDom);
				let option;

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
							data: years,
						},
					],
					yAxis: [
						{
							type: 'value',
						},
					],
					series: [
						{
							name: '₦',
							type: 'bar',
							data: amt,
							markPoint: {
								data: [
									{ type: 'max', name: 'All time maximum' },
									{ type: 'min', name: 'All time minimum' },
								],
							},
							// markLine: {
							// 	data: [
							// 		{ type: 'average', name: '平均值' },
							// 	],
							// },
						},
					],
				};

				option && myChart.setOption(option);
			} else {
				$('#yearly_sales_report').html('No record');
			}

			$('#yearly_sales_report_loading').hide();
			$('#yearly_sales_report').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#yearly_sales_report_loading').hide();
			$('#yearly_sales_report').show();

			$('#yearly_sales_report').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});

	// var echartDonut = echarts.init(document.getElementById("yearly_sales_report"));
}

function fetch_notice_board() {
	// $('#sche_msg_error').html('');
	$(`#notice_board`).hide();
	$(`#notice_board_loading`).show();

	let company_id = localStorage.getItem('company_id');
	let year = new Date().getFullYear();
	let month = new Date().getMonth() + 1;
	let day = new Date().getDate();
	let current_date = `${year}-${month}-${day}`;

	axios
		.get(`${api_path}hrm/get_notice_board`, {
			params: {
				check_date: current_date,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#notice_board_loading').hide();
			$('#notice_board').show();
			if (response.data.data !== '') {
				let allNotice = '';
				const { board_notice, schedule_notification } = response.data.data;
				if (board_notice && board_notice.length > 0) {
					board_notice.map((item) => {
						let timer = moment(item.created_at, 'YYYY-MM-DD HH:mm:ss').fromNow();
						allNotice += `<li>
				                    <div class="block" style="margin:0;">

				                        <div class="block_content">
				                            <h2 class="title">
				                                <a>${item.notice_board}</a>
				                            </h2>
				                            <div class="byline">
				                                <span>${timer}</span>
				                            </div>

				                        </div>
				                    </div>
				                </li>`;
					});
				}

				if (schedule_notification && schedule_notification.length > 0) {
					let dates = new Date();
					let year = dates.getFullYear();
					let month = dates.getMonth();
					let day = dates.getDate();
					let today = `${year}-${month}-${day}`;
					schedule_notification.map((items) => {
						let timer = moment(items.created_at, 'YYYY-MM-DD HH:mm:ss').fromNow();
						allNotice += `<li>
				                    <div class="block" style="margin:0;">

				                        <div class="block_content">
				                            <h2 class="title">
				                                <a>${items.notification}</a>
				                            </h2>
				                            <div class="byline">
				                                <span>${timer}</span>
				                            </div>

				                        </div>
				                    </div>
				                </li>`;
						if (items.date_of_notice === today) {
							update_notice_schedule(items.schedule_id, today);
						}
					});
				}

				if (board_notice.length <= 0 && schedule_notification <= 0) {
					allNotice += `<p>No Notification currently</p>`;
				}

				$('#notice_board').html(allNotice);
			} else {
				$('#notice_board').html('No Notification currently');
			}

			$('#notice_board_loading').hide();
			$('#notice_board').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#notice_board_loading').hide();
			$('#notice_board').show();

			$('#notice_board').html(error.statusText);
		})
		.then(function() {
			// always executed
		});

	// var echartDonut = echarts.init(document.getElementById("yearly_sales_report"));
}

function update_notice_schedule(id, date) {
	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/update_recurring_date`, {
			params: {
				schedule_id: id,
				recurring_date: date,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			fetch_notice_board();
		})
		.catch(function(error) {
			console.log(error);
		});
}

function get_employee_cat() {
	// if ($('#echart_pie').length) {
	var company_id = localStorage.getItem('company_id');
	// var echartPie = echarts.init(document.getElementById('echart_pie'));
	$('#echart_pie').hide();
	$('#ddsh_loading').show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/count_total_employee_for_each_company_employment_type',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			if (response.status == '200') {
				if (response.data.length != 0) {
					$('#ddsh_loading').hide();
					$('#echart_pie').show();
					var list_of_names = [];
					var list_of_values = [];
					$(response.data).each(function(index, value) {
						list_of_names.push(value.name);
						list_of_values.push({
							value: Number(value.employee_count),
							name: value.name,
						});
					});

					// $('#ddsh_loading').hide(); //hidel loader

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
					$('#ddsh_loading').hide();
					$('#echart_pie').show();
					$('#echart_pie').html('No data available');
				}
			} else if (response.status == '400') {
				$('#ddsh_loading').hide();
				$('#echart_pie').show();
				$('#echart_pie').html('No record Currently');
			} else if (response.status == '401') {
				$('#ddsh_loading').hide();
				$('#echart_pie').show();
				$('#echart_pie').html('No record Currently');
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			// alert('connection error');
			$('#ddsh_loading').hide();
			$('#echart_pie').show();
			$('#echart_pie').html('No record Currently');
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
	// }
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
			$('#page_loader').hide();
			$('#employee_details_display').show();
			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				$('#firstname').html(response.data.employee_data.firstname);
				$('#lastname').html(response.data.employee_data.lastname);
				$('#gender').html(response.data.employee_data.gender);
				$('#middlename').html(response.data.employee_data.middlename);
				$('#dob').html(response.data.employee_data.dob);
				$('#marital_status').html(response.data.employee_data.marital_status);
				$('#phone').html(response.data.employee_data.phone);
				$('#residential_address').html(response.data.employee_data.residential_address);
				$('#email').html(response.data.employee_data.email);
				$('#religion').html(response.data.employee_data.religion);
				$('#next_of_kin').html(response.data.employee_data.next_of_kin);
				$('#status').html(response.data.employee_data.active_status);

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
					'" alt="..."><div style="text-decoration:underline;text-align:center;margin-top:5px;" data-toggle="modal" data-target="#edit_proPic_modal">Update Image</div>';
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
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_id +
					'"><button id="send"  class="btn btn-primary">View Profile</button></a>';

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

document.addEventListener('DOMContentLoaded', function() {
	let company_id = localStorage.getItem('company_id');
	// $('#list_QC_table').hide();
	// $('#list_QC_loader').show();
	let year = new Date().getFullYear();
	let month = new Date().getMonth() + 1;
	let day = new Date().getDate();
	let current_date = `${year}-${month}-${day}`;

	axios
		.get(`${api_path}hrm/calender_events`, {
			params: {
				current_date: current_date,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// const { employee_cv_edu_history } = response.data.data;

			if (response.data.data.length > 0) {
				// $('#list_QC_body').html(qc_list);
				// $('#list_QC_loader').hide();
				// $('#list_QC_table').show();
				let arr = [];
				response.data.data.map((item) => {
					arr.push({
						title: item.holiday_name,
						start: item.holiday_date,
						end: item.holiday_date,
					});
				});
				var calendarEl = document.getElementById('calendarly');
				var calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					// initialDate: new Date(),
					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						// contentHeight: auto,
						right: 'dayGridMonth,timeGridWeek,timeGridDay',
					},

					events: arr,
				});
				calendar.render();
				setTimeout(() => {
					calendar.updateSize();
				}, 2000);
				// calendar.setOption('height', 700);
			} else {
				var calendarEl = document.getElementById('calendarly');
				var calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					// initialDate: new Date(),
					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						// contentHeight: auto,
						right: 'dayGridMonth,timeGridWeek,timeGridDay',
					},
				});
				calendar.render();
				setTimeout(() => {
					calendar.updateSize();
				}, 2000);
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#calendarly').html('<p>Error loading data</p>');
		})
		.then(function() {});
});

function listUpcomingEvents() {
	// $('#list_QC_table').hide();
	// $('#list_QC_loader').show();
	let year = new Date().getFullYear();
	let month = new Date().getMonth() + 1;
	let day = new Date().getDate();
	let current_date = `${year}-${month}-${day}`;

	$(`#upcoming_event`).hide();
	$(`#upcoming_event_loading`).show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/upcoming_company_events`, {
			params: {
				current_date: current_date,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#upcoming_event_loading').hide();
			$('#upcoming_event').show();
			if (response.data.data.length > 0) {
				let allNotice = '';
				// const { board_notice, schedule_notification } = response.data.data;
				response.data.data.map((item) => {
					let timer = moment(item.date, 'YYYY-MM-DD HH:mm:ss').format('LL');
					let firstSplit = timer.split(',');
					let finalSplit = firstSplit[0].split(' ');
					allNotice += `<article class="media event">
										<a class="pull-left date">
											<p class="month">${finalSplit[0]}</p>
											<p class="day">${finalSplit[1]}</p>
										</a>
										<div class="media-body">
											<p class="title">${item.event_name}</p>
										</div>
									</article>`;
				});

				$('#upcoming_event').html(allNotice);
			} else {
				$('#upcoming_event').html('No Upcoming Event for now');
			}

			$('#upcoming_event_loading').hide();
			$('#upcoming_event').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#upcoming_event_loading').hide();
			$('#upcoming_event').show();

			$('#upcoming_event').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});
}

function fetch_exits_graph() {
	// $('#sche_msg_error').html('');
	$(`#exit_chartert`).hide();
	$(`#exit_chartert_loading`).show();

	let company_id = localStorage.getItem('company_id');
	let current_year = new Date().getFullYear();
	axios
		.get(`${api_path}hrm/graph_total_exit`, {
			params: {
				current_year: current_year,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#exit_chartert_loading').hide();
			$('#exit_chartert').show();
			if (response.data.data.length > 0) {
				let years = [];
				let amt = [];
				response.data.data.map((item) => {
					years.push(capitalizeFirstLetter(item.name));
					amt.push(parseFloat(item.number_exited));
				});

				let chartDom = document.getElementById('exit_chartert');
				let myChart = echarts.init(chartDom);
				let option;

				option = {
					title: {},
					tooltip: {
						trigger: 'axis',
					},
					legend: {
						data: [
							'蒸发',
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
							data: years,
						},
					],
					yAxis: [
						{
							type: 'value',
						},
					],
					series: [
						{
							name: '₦',
							type: 'bar',
							data: amt,
							markPoint: {
								data: [
									{ type: 'max', name: 'All time maximum' },
									{ type: 'min', name: 'All time minimum' },
								],
							},
							// markLine: {
							// 	data: [
							// 		{ type: 'average', name: '平均值' },
							// 	],
							// },
						},
					],
				};

				option && myChart.setOption(option);
			} else {
				$('#exit_chartert').html('No record');
			}

			// $('#exit_chartert_loading').hide();
			// $('#exit_chartert').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#exit_chartert_loading').hide();
			$('#exit_chartert').show();

			$('#exit_chartert').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});

	// var echartDonut = echarts.init(document.getElementById("yearly_sales_report"));
}

function fetch_total_salary() {
	var company_id = localStorage.getItem('company_id');
	let year = new Date().getFullYear();
	let month = new Date().getMonth();
	let day = new Date().getDate();
	let current_date = `${year}-${month}-${day}`;

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: `${api_path}hrm/monthly_staff_expenses?current_date=${current_date}`,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,
		success: function(response) {
			let formatMoney = numeral(parseFloat(response.data).toLocaleString()).format('0.0a');
			$('#no_total_salary').html(`₦${formatMoney}`);
		},
		error: function(response) {
			console.log(response);
			$('#no_total_salary').html(`${response.statusText}`);
		},
	});
}
