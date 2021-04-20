$(document).ready(() => {
	$('#add_leave_days').on('click', () => {
		$('#leave_days_display').toggle();
	});
	$('#add_allot_btn').on('click', () => {
		if (isEmptyInput('.add_allot_fields')) {
			addAllotDays();
		}
	});
	$('#inc-btn').on('click', ()=>{
		let oldVal = parseInt($('#extra-allot-inp').val())
		let newVal = oldVal + 1
		$('#extra-allot-inp').val(newVal)
		$('#allot-btns').fadeIn()
	})
	$('#dec-btn').on('click', ()=>{
		let oldVal = parseInt($('#extra-allot-inp').val())
		let newVal
		if (oldVal > 0) {
			newVal = oldVal - 1;
		  } else {
			newVal = 0;
		  }
		$('#extra-allot-inp').val(newVal)
		$('#allot-btns').fadeIn()
	})

	$('#cancel_allot_btn').on('click', ()=>{
		$('#allot-btns').fadeOut()
	})

	$('#extra-allot-inp').on('change',()=>{
		$('#allot-btns').fadeIn()
	})
});

function addAllotDays() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = window.location.search.split('=')[1];

	$('#add_allot_btn').hide();
	$('#add_allot_loader').show();

	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	today = yyyy + '-' + mm + '-' + dd;

	let allot_no = $('#allot_no').val();
	let allot_reason = $('#allot_reason').val();
	let allot_date = today;

	let data = {
		company_id: company_id,
		employee_id: employee_id,
		no_of_days_allotted: allot_no,
		reason: allot_reason,
		date_when_leave_given: allot_date,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/createEmployeeExtraLeave`,
		data: data,

		error: function(res) {
			console.log(res);
			$('#add_allot_loader').hide();
			$('#add_allot_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_allot_loader').hide();
				$('#add_allot_btn').show();

				$('#mod_body').html('Extra days alloted successfully');
				$('#successModal').modal('show');
				$('#allot_no').val('');
				$('#allot_reason').val('');
				$('#leave_days_display').toggle();
				listAllotDays();
			}
		},
	});
}

function listAllotDays() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = window.location.search.split('=')[1];
	$('#list_allot_table').hide();
	$('#list_allot_loader').show();

	axios
		.get(`${api_path}hrm/listEmployeeLeave`, {
			params: {
				company_id: company_id,
				employee_id: employee_id,
			},
		})
		.then(function(response) {
			console.log(response.data);
			let allot_list;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					let end;
					if (v.date_when_leave_given === '0000-00-00') {
						end = '';
					} else {
						end = moment(v.date_when_leave_given, 'YYYY-MM-DD').format('LL');
					}

					allot_list += `<tr class="even pointer" id="allot_row${v.id}">`;
					allot_list += `<td>${v.no_of_days_allotted}</td>`;
					allot_list += `<td>${end}</td>`;
					allot_list += `<td>${v.reason}</td>`;

					// allot_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<li onClick="viewallot(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>
					// 			<li onClick="deleteallot(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-trash" /> Delete
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					allot_list += `</tr>`;
					allot_list += `<tr id="allot_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_allot_body').html(allot_list);
				$('#list_allot_loader').hide();
				$('#list_allot_table').show();
			} else {
				$('#list_allot_body').html(`<tr><td colspan="3">No record</td></tr>`);
				$('#list_allot_loader').hide();
				$('#list_allot_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_allot_loader').hide();
			$('#list_allot_table').show();
			$('#list_allot_body').html(`<tr><td colspan="3" style="color:red;">No Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function listLeaveGraph() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = window.location.search.split('=')[1];
	$('#list_graph_table').hide();
	$('#list_graph_loader').show();

	let data = {
		company_id: company_id,
		employee_id: employee_id,
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/employeeUsedStatPie`,
		data: data,

		error: function(res) {
			console.log(res);
			// $('#add_allot_loader').hide();
			// $('#add_allot_btn').show();
			// alert('error');
		},
		success: function(res) {
			if (res.status == 200 || res.status == 201) {
				var chartDom = document.getElementById('leave-historys');
				var myChart = echarts.init(chartDom);
				var option;
				option = {
					title: {
						text: 'Leave Graph',
						// subtext: '纯属虚构',
						left: 'center',
					},
					tooltip: {
						trigger: 'item',
					},
					legend: {
						orient: 'vertical',
						left: 'left',
					},

					series: [
						{
							type: 'pie',
							radius: '50%',
							data: [
								// {
								// 	value: res.data.total_leaves_within_a_year,
								// 	name: 'Total Leaves',
								// },
								{ value: res.data.used_leaves, name: 'Used Leaves' },
								{ value: res.data.remaining_leaves, name: 'Remaining Leaves' },
							],
							emphasis: {
								itemStyle: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)',
								},
							},
						},
					],
				};
				option && myChart.setOption(option);
				$('#graph_loading').hide();
				// $('#add_allot_loader').hide();
				// $('#add_allot_btn').show();
				// $('#mod_body').html('Extra days alloted successfully');
				// $('#successModal').modal('show');
				// $('#allot_no').val('');
				// $('#allot_reason').val('');
				// $('#leave_days_display').toggle();
				// listAllotDays();
			}
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
		type: 'GET',
		dataType: 'json',
		url: `${api_path}hrm/new_employee_info?company_id=${company_id}&employee_id=${employee_id}`,
		// data: { company_id: company_id, employee_id: employee_id, page: page, limit: limit },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.employee_leave_history.length > 0) {
					var k = 1;
					
					$(response.data.employee_leave_history).each((i,v)=>{
						let resume = moment(v.resumption_date, 'YYYY-MM-DD').format('LL');
						let start = moment(v.leave_start, 'YYYY-MM-DD').format('LL');
						strTable += '<tr>';

						strTable += `<td>${v.leave_type}</td>`;

						strTable += `<td>${start}</td>`;

						strTable += `<td>${resume}</td>`;
						strTable += `<td>${v.days_used}</td>`;

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
