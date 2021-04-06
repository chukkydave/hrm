$(document).ready(function() {
	// $(function() {
	$('#forwardData').sortable();
	// Getter
	var items = $('#forwardData').sortable('option', 'items');

	// Setter
	$('#forwardData').sortable('option', 'items', '> .sortMe');

	$('#forwardData').on('sortupdate', function(event, ui) {
		// alert('hello');
	});
	$('#forwardData').sortable({
		update: function(event, ui) {
			// alert('hi');

			var sortedIDs = $('#forwardData').sortable('toArray');
			console.log('sortedIDs', sortedIDs);
			let arr = [];
			sortedIDs.map((v, i) => {
				let eac = v.split('_');
				arr.push(eac[1]);
			});
			// console.log(arr);
			addDraggedList(arr);
		},
	});
	// });
	fetch_leave_info();
	list_of_forward_leaves_applicant();
	// fetch_employee_details();
	$('#approve').on('click', hr_approve);

	$('#decline').on('click', hr_decline);

	$('#add_appv').on('click', () => {
		$('#appv_display').toggle();
	});

	$(document).on('click', '.delete_approver', function() {
		var approval_id = $(this).attr('id').replace(/app_/, ''); // table row ID
		delete_approver(approval_id);
	});

	$('#add_app').click(function() {
		$('#modal_emp_approval').modal('show');
	});

	$('#modal_emp_approval #name').autocomplete({
		source: function(request, response) {
			// Fetch data
			$.ajax({
				url: api_path + 'hrm/employee_autocomplete',
				type: 'post',
				dataType: 'json',
				data: {
					term: request.term,
					company_id: localStorage.getItem('company_id'),
				},
				success: function(data) {
					response(data);
					console.log(data);
				},
			});
		},
		minLength: 2,
		select: function(event, ui) {
			console.log(ui.item.employee_id);
			// Set selection
			//$('#item_name').val(''); // display the selected text
			$('#modal_emp_approval #name').val(ui.item.label); // save selected id to input
			$('#name_id').val(ui.item.employee_id);
			return false;
		},
	});

	$('#add').on('click', add_leave_approver);

	$('#random').click(function() {
		if ($('#random').is(':checked')) {
			var company_id = localStorage.getItem('company_id');
			// var pathArray = window.location.pathname.split( '/' );
			var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
			var order_type = $('#random').val();

			// alert(order_type);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: api_path + 'hrm/hr_set_approval_leave_order',
				data: { company_id: company_id, leave_id: leave_id, order_type: order_type },
				timeout: 60000,

				success: function(response) {
					// $('#page_loader').hide();
					// $('#employee_details_display').show();

					console.log(response);

					if (response.status == '200') {
						$('#modal_order').modal('show');

						// $('#modal_order').on('hidden.bs.modal', function () {
						//     // do something…
						//     window.location.reload();
						//     //window.location.href = base_url+"/erp/hrm/employees";
						// })

						// alert(response.msg);
					}
				},
				// objAJAXRequest, strError
				error: function(response) {
					alert('Connection error');
					// $('#page_loader').hide();
					// $('#employee_details_display').hide();
					// $('#employee_error_display').show();
				},
			});
		}
	});

	$('#turn').click(function() {
		if ($('#turn').is(':checked')) {
			var company_id = localStorage.getItem('company_id');
			// var pathArray = window.location.pathname.split( '/' );
			var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
			var order_type = $('#turn').val();

			// alert(order_type);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: api_path + 'hrm/hr_set_approval_leave_order',
				data: { company_id: company_id, leave_id: leave_id, order_type: order_type },
				timeout: 60000,

				success: function(response) {
					// $('#page_loader').hide();
					// $('#employee_details_display').show();

					console.log(response);

					if (response.status == '200') {
						$('#modal_order').modal('show');

						// $('#modal_order').on('hidden.bs.modal', function () {
						//     // do something…
						//     window.location.reload();
						//     //window.location.href = base_url+"/erp/hrm/employees";
						// })

						// alert(response.msg);
					}
				},
				// objAJAXRequest, strError
				error: function(response) {
					alert('Connection error');
					// $('#page_loader').hide();
					// $('#employee_details_display').hide();
					// $('#employee_error_display').show();
				},
			});
		}
	});

	$('#name').on('keyup', () => {
		let input = $('#name').val();
		if (input.length >= 2) {
			getEmployeeList(input);
		}
	});

	$('#send_for_appv').on('click', () => {
		// if (document.querySelector('#requiredGroup').checked) {
		if (document.querySelector('.radioOption').checked) {
			// $('#requiredGroup').prop('checked', true);
			alert('checked');
		} else {
			alert('nothing Selected');
			// $('#requiredGroup').prop('checked', false);
			// alert('Kindly select an Approval Type');
			// }
		}
	});
});

function add_leave_approver() {
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');
	var application_id = $.urlParam('id');
	var application_type = 'leave';
	// var employee_name = $('#name').val();
	var employee_name = $('#name').attr('data');
	var request_from = $('#emp_id').val();

	var employee_split = employee_name.split(' ');

	var request_to = $('#name_id').val();

	var blank;

	// console.log(employee_split);
	// console.log("company_id :"+ company_id)
	// console.log("user_id :"+ user_id)
	// console.log("application_id :"+ application_id)
	// console.log("request_to :"+ request_to)
	// console.log("request_from :"+ request_from)
	// console.log("application_type :"+ application_type)

	// return;
	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#error').html('You have a blank field');

		return;
	}

	$('#add').hide();
	$('#add_loader').show();

	$('#error').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/forward_approval',
		data: {
			company_id: company_id,
			user_id: user_id,
			application_id: application_id,
			request_from: request_from,
			request_to: request_to,
			application_type: application_type,
		},

		success: function(response) {
			// console.log(response);

			if (response.status == '200') {
				$('#error').html('');
				$('#name').val('');
				$('#appv_display').toggle();
				$('#edit_form').hide();
				$('#edit_msg').show();
				$('#modal_emp_approval').modal('show');
				list_of_forward_leaves_applicant();

				// $('#modal_emp_approval').on('hidden.bs.modal', function() {
				// 	window.location.reload();
				// });
			} else if (response.status == '400') {
				// coder error message

				$('#error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error').html(response.msg);
			}

			$('#add').show();
			$('#add_loader').hide();
		},

		error: function(response) {
			$('#add').show();
			$('#add_loader').hide();
			$('#error').html('Connection Error.');
		},
	});
}

function hr_approve() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var approval_status = 'yes';

	var ans = confirm('Are you sure you want to approve this leave?');

	if (!ans) {
		return;
	}
	// $('#modal_order').modal('show');

	$('#approve').hide();
	$('#approve_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/hr_decline_accept_leave',
		data: { company_id: company_id, leave_id: leave_id, approval_status: approval_status },
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#approve').show();
			$('#approve_loader').hide();
			// alert('connection error');
		},

		success: function(response) {
			// console.log(response);

			if (response.status == '200') {
				// $('#row_'+user_id).hide();
				$('#modal_approve').modal('show');
				$('#approve_decline_buttons').hide();
				$('#approve_msg').show();

				$('#modal_approve').on('hidden.bs.modal', function() {
					// do something…
					window.location.reload();
					//window.location.href = base_url+"/erp/hrm/employees";
				});
			} else if (response.status == '401') {
			}
			$('#approve').show();
			$('#approve_loader').hide();
		},
	});
}

function hr_decline() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var approval_status = 'declined';

	// alert(company_id + ' ' + leave_id + ' ' + approval_status);

	var ans = confirm('Are you sure you want to decline this leave?');
	if (!ans) {
		return;
	}
	// $('#modal_confirm').modal('show');

	$('#decline').hide();
	$('#decline_loader').show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/hr_decline_accept_leave',
		data: { company_id: company_id, leave_id: leave_id, approval_status: approval_status },
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#decline').show();
			$('#decline_loader').hide();
			// alert('connection error');
		},

		success: function(response) {
			console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
				$('#modal_decline').modal('show');
				$('#approve_decline_buttons').hide();
				$('#decline_msg').show();

				$('#modal_decline').on('hidden.bs.modal', function() {
					// do something…
					window.location.reload();
					//window.location.href = base_url+"/erp/hrm/employees";
				});
			} else if (response.status == '401') {
			}
			$('#decline').show();
			$('#decline_loader').hide();
		},
	});
}

function fetch_leave_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_employee_leave_details',
		data: { company_id: company_id, leave_id: leave_id },
		timeout: 60000,

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			console.log(response);
			var str = '';
			if (response.status == '200') {
				$('#profile_name').html(
					'<b>' + response.data.firstname + ' ' + response.data.lastname + '</b>',
				);

				str +=
					'<div id="crop-avatar" style="border-radius: 10px; height: 250px; background-image: url(' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					')">';

				// str += '<img src="" alt="...">';
				str += '</div>';
				let comments = response.data.comment.replace('↵', '').trim();

				$('#leave_id').html('LV' + response.data.leave_id);
				$('#leave_type').html(response.data.leave_type);
				$('#firstname').html(response.data.firstname);
				$('#lastname').html(response.data.lastname);
				$('#middlename').html(response.data.middlename);
				$('#resumption_date').html(response.data.resumption_date);
				$('#days_used').html(response.data.real_days_used);
				$('#leave_start').html(response.data.leave_start);
				$('#working_days').html(response.data.exclude_weekends);
				$('#holidays_within').html(response.data.exclude_holidays);
				$('#hr_approval').html(response.data.hr_approval);
				$('#emp_id').val(response.data.employee_id);
				$('#commenter').html(comments);

				if (response.data.approval_order == 'chronological') {
					$('#turn').attr('checked', 'checked');
					$('#random').removeAttr('checked');
					$('#send_for_appv').attr('disabled', true);
					// $('#monday').val('yes');
				} else if (response.data.approval_order == 'random') {
					$('#random').attr('checked', 'checked');
					$('#turn').removeAttr('checked');
					$('#send_for_appv').attr('disabled', true);

					// $('#monday').val('no');
				}

				$('#picture').html(str);

				if (response.data.hr_approval == 'no') {
					$('#approve_decline_buttons').show();
					$('#turnbturn').show();
					$('#sttus_text').html('Pending');
					$('#add_app').show();
					$('#boldbar').css('background-color', 'orange');
				} else if (response.data.hr_approval == 'declined') {
					$('#sttus_text').html('Declined');
					$('#boldbar').css('background-color', '#d82732');
				} else if (response.data.hr_approval == 'yes') {
					$('#sttus_text').html('Approved');
					$('#boldbar').css('background-color', 'green');
				}
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			alert('Connection error');
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function delete_approver(approval_id) {
	var company_id = localStorage.getItem('company_id');

	// alert(leave_id);
	var ans = confirm('Are you sure you want to delete this approver?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + approval_id).hide();
	$('#loader_row_' + approval_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/hr_delete_approval_person',
		data: { company_id: company_id, approval_id: approval_id },
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			// alert('Connection error');
			$('#loader_row_' + approval_id).hide();
			$('#row_' + approval_id).show();

			// alert('connection error');
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#row_' + approval_id).remove();
			} else if (response.status == '401') {
				alert(response.msg);
				$('#row_' + approval_id).show();
			}

			$('#loader_row_' + approval_id).hide();
		},
	});
}

function list_of_forward_leaves_applicant() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var application_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_approvals',
		data: { company_id: company_id, application_id: application_id },
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();

				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						// var date = response['data'][i]['date_sent'].datepicker({
						//    dateFormat: "dd-m-yy"
						// })
						if (v.date_sent === '0000-00-00 00:00:00') {
							date_sent = '';
						} else {
							date_sent = moment(v.date_sent, 'YYYY-MM-DD HH:mm:ss').format('LL');
						}

						if (v.time_acted === '0000-00-00 00:00:00') {
							time_acted = 'Pending';
						} else {
							time_acted = moment(v.time_acted, 'YYYY-MM-DD HH:mm:ss').format('LL');
						}

						if (
							response['data'][i]['time_acted'] == '0000-00-00 00:00:00' ||
							response['data'][i]['approval_status'] == 'pending'
						) {
							strTable +=
								'<tr id="row_' +
								response['data'][i]['approval_id'] +
								'" class="sortMe">';

							strTable +=
								'<td width="8%" valign="top"><div class="profile_pic"><img src="' +
								site_url +
								'/files/images/employee_images/sml_' +
								response['data'][i]['approval_picture'] +
								'" alt="..." width="50"></div></td>';

							strTable +=
								'<td width="35%" valign="top"><b>' +
								response['data'][i]['approval_person'] +
								'</b><br>Date Received: ' +
								date_sent +
								'<br>Date Of Action: ' +
								time_acted +
								'</td>';
							// <a style="cursor: pointer;" class="delete_approver" id="app_'+response['data'][i]['approval_id']+'"><strong class="text-danger">Delete Approver</strong></a></td>';

							if (response['data'][i]['approval_status'] == 'pending') {
								strTable +=
									'<td><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" style="color: orange; font-size: 30px;" title="Forward Leave Applicant"></i></td>';
							} else if (response['data'][i]['approval_status'] == 'yes') {
								strTable +=
									'<td><i class="fa fa-check-circle"  data-toggle="tooltip" data-placement="top" style="color: green; font-size: 30px;" title="Forward Leave Applicant"></i></td>';
							}

							// strTable +=
							// 	'<td valign="top">' + response['data'][i]['time_acted'] + '</td>';

							strTable +=
								'<td width="10%"><a class="delete_approver btn btn-danger btn-xs" style="cursor: pointer;" id="app_' +
								response['data'][i]['approval_id'] +
								'"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Approver"></i> Delete Approver</a></td>';

							strTable += '</tr>';

							strTable +=
								'<tr style="display: none;" id="loader_row_' +
								response['data'][i]['approval_id'] +
								'">';
							strTable +=
								'<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
							strTable += '</td>';
							strTable += '</tr>';
						} else {
							strTable += '<tr id="row_' + response['data'][i]['approval_id'] + '">';

							strTable +=
								'<td width="8%" valign="top"><div class="profile_pic"><img src="' +
								base_url +
								'/files/images/employee_images/sml_' +
								response['data'][i]['approval_picture'] +
								'" alt="..." width="50"></div></td>';

							strTable +=
								'<td width="35%" valign="top"><b>' +
								response['data'][i]['approval_person'] +
								'</b><br>Date Received: ' +
								date_sent +
								'<br>Date Of Action: ' +
								time_acted +
								'</td>';

							if (response['data'][i]['approval_status'] == 'pending') {
								strTable +=
									'<td><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" style="color: orange; font-size: 30px;" title="Forward Leave Applicant"></i></td>';
							} else if (response['data'][i]['approval_status'] == 'yes') {
								strTable +=
									'<td><i class="fa fa-check-circle"  data-toggle="tooltip" data-placement="top" style="color: green; font-size: 30px;" title="Forward Leave Applicant"></i></td>';
							}

							// strTable +=
							// '<td valign="top">' + response['data'][i]['time_acted'] + '</td>';

							strTable += '<td width="10%">&nbsp;</td>';

							strTable += '</tr>';
						}

						// strTable += '<td valign="top">'+response['data'][i]['date_sent']+'</td>';

						k++;
					});
					$('#approval_type_div').show();
				} else {
					strTable = '<tr><td colspan="5">No record.</td></tr>';
				}

				//  $('#pagination').twbsPagination({
				//   totalPages: Math.ceil(response.total_rows/limit),
				//   visiblePages: 10,
				//   onPageClick: function (event, page) {
				//     list_of_leaves_applicant(page);
				//   }
				// });

				$('#forwardData').html(strTable);
				$('#forwardData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#forwardData').html(strTable);
				$('#forwardData').show();
			}
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#forwardData').html(strTable);
			$('#forwardData').show();
		},
	});
}

function pickOption(name, id) {
	$('#name').val(name);
	$('#name').attr('data', id);
	$('#name_id').val(id);
	$('#emp_list').removeClass('show');
}

let root = document.querySelector('#emp_list');
document.addEventListener('click', (event) => {
	if (!root.contains(event.target)) {
		$('#emp_list').removeClass('show');
	}
});

function getEmployeeList(param) {
	// let param = $('#edit_emp_supervisor').val();
	let company_id = localStorage.getItem('company_id');

	axios
		.get(`${api_path}hrm/search_staff_autocomplete`, {
			params: {
				company_id: company_id,
				query_param: param,
			},
		})
		.then(function(response) {
			// console.log('res', response);
			let emList = '';
			$(response.data.data).map((i, v) => {
				emList += `<li><a class="dropdown-item" onClick="pickOption('${v.lastname} ${v.firstname} ${v.middlename}',${v.employee_id})">${v.lastname} ${v.firstname} ${v.middlename} (${v.position})</a></li>`;
			});
			$('#emp_list').html(emList);
			$('#emp_list').addClass('show');
		})
		.catch(function(error) {
			console.log(error);
			$('#emp_list').html(`<em>Error loading data</em>`);
		})
		.then(function() {
			// always executed
		});
}

function addDraggedList(arr) {
	console.log(arr);
	var company_id = localStorage.getItem('company_id');
	// $('#list_appv_table').attr('disabled', 'disabled').off('click');

	let height = $('#appv_table').height();
	let width = $('#appv_table').width();

	$('#appv_table').css('opacity', '0.1');
	$('#loader_div').css({
		height: `${height}`,
		width: `${width}`,
	});
	$('#loader_div').addClass('loader-div');
	$('#appv_loader').show();
	// let employee_id = window.location.search.split('=')[1];

	// $('#add_dept_btn').hide();
	// $('#add_dept_loader').show();

	// let name = $('#dept_name').val();
	// let from = $('#dept_from').val();
	// let to = $('#dept_to').val();

	let data = {
		company_id: company_id,
		approvals: arr,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/adjustApprovalPosition`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			// $('#add_dept_loader').hide();
			// $('#add_dept_btn').show();
			alert('error');
			$('#appv_loader').hide();

			$('#loader_div').css({
				height: `0px`,
				width: `0px`,
			});
			$('#loader_div').removeClass('loader-div');
			$('#appv_table').css('opacity', '1');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				alert('success');
				$('#appv_loader').hide();

				$('#loader_div').css({
					height: `0px`,
					width: `0px`,
				});
				$('#loader_div').removeClass('loader-div');
				$('#appv_table').css('opacity', '1');
				// $('#add_dept_loader').hide();
				// $('#add_dept_btn').show();

				// $('#mod_body').html('Department creation successful');
				// $('#successModal').modal('show');
				// $('#dept_name').val('');
				// $('#dept_from').val('');
				// $('#dept_to').val('');
				// $('#dept_display').toggle();
				// listDepartment();
				list_of_forward_leaves_applicant();
			}
		},
	});
}
