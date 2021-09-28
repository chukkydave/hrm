$(document).ready(function() {
	leave_types('');

	$(document).on('click', '.delete_leave_type', function() {
		var leave_id = $(this).attr('id').replace(/lev_/, ''); // table row ID
		delete_leave_type(leave_id);
	});

	$(document).on('click', '.lev_deactivate', function() {
		var leave_id = $(this).attr('id').replace(/lv_/, '');
		deactivate_leave(leave_id);
	});

	$(document).on('click', '.lev_activate', function() {
		var leave_id = $(this).attr('id').replace(/lv2_/, '');
		activate_leave(leave_id);
	});
});

function leave_types(page) {
	var company_id = localStorage.getItem('company_id');

	if (page == '') {
		var page = 1;
	}
	var limit = 10;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_leaves_type',
		data: {
			page: page,
			limit: limit,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data && response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['leave_id'] + '">';
						strTable += '<td>' + response['data'][i]['leave_type'] + '</td>';

						// strTable += '<td>' + response['data'][i]['allowable_days'] + '</td>';

						if (response['data'][i]['paid_status'] == 'no') {
							strTable +=
								'<td><a><i  class="fa fa-close"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px; color: red;" title="Edit Leave Type"></i></a>';
						} else {
							strTable +=
								'<td><a><i  class="fa fa-check"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px; color: green;" title="Edit Leave Type"></i></a>';
						}

						if (response['data'][i]['exclude_holidays'] == 'no') {
							strTable +=
								'<td><a><i class="fa fa-close"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px; color: red;" title="Edit Leave Type"></i></a>';
						} else {
							strTable +=
								'<td><a><i  class="fa fa-check"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px; color: green;" title="Edit Leave Type"></i></a>';
						}

						if (response['data'][i]['exclude_weekends'] == 'no') {
							strTable +=
								'<td><a><i  class="fa fa-close"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px; color: red;" title="Edit Leave Type"></i></a>';
						} else {
							strTable +=
								'<td><a><i  class="fa fa-check"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px; color: green;" title="Edit Leave Type"></i></a>';
						}

						strTable +=
							'<td><a href="' +
							base_url +
							'edit_leave_type?id=' +
							response['data'][i]['leave_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Leave Type"></i></a>&nbsp;&nbsp; <a  class="delete_leave_type" style="cursor: pointer;" id="lev_' +
							response['data'][i]['leave_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Leave Type"></i></a>&nbsp;&nbsp;';

						if (response['data'][i]['active_status'] == 'no') {
							strTable +=
								'<i class="lev_activate fa fa-toggle-off fa-2x gray" style="cursor: pointer; " id="lv2_' +
								response['data'][i]['leave_id'] +
								'" ></i>';
						} else if (response['data'][i]['active_status'] == 'yes') {
							strTable +=
								'<i class="lev_deactivate fa fa-toggle-on fa-2x green" id="lv_' +
								response['data'][i]['leave_id'] +
								'" style=" cursor: pointer; "></i>';
						}

						strTable +=
							'<i class="fa fa-cog fa-spin fa-1x fa-fw" aria-hidden="true" id="loading_' +
							response['data'][i]['leave_id'] +
							'" style="display: none"></i>';

						strTable += '</td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['leave_id'] +
							'">';
						strTable +=
							'<td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="6">No record found</td></tr>';
				}

				$('#leaveData').html(strTable);
				$('#leaveData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="6">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#leaveData').html(strTable);
				$('#leaveData').show();
			}

			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					leave_types(page);
				},
			});
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}

function delete_leave_type(leave_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this user');
	if (!ans) {
		return;
	}

	$('#row_' + leave_id).hide();
	$('#loader_row_' + leave_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_leave',
		data: {
			leave_id: leave_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + leave_id).hide();
			$('#row_' + leave_id).show();

			Swal.fire({
				title: 'Error!',
				text: `${response.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: leave_types(''),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#loader_row_' + leave_id).hide();
		},
	});
}

function activate_leave(leave_id) {
	var company_id = localStorage.getItem('company_id');
	var active_status = 'yes';

	$('#lv2_' + leave_id).hide();

	$('#loading_' + leave_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/activate_company_leave',
		data: {
			leave_id: leave_id,
			active_status: active_status,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#lv2_' + leave_id).show();
			$('#loading_' + leave_id).hide();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loading_' + leave_id).hide();
			$('#lv2_' + leave_id).removeClass('fa fa-toggle-off');
			$('#lv2_' + leave_id).addClass('fa fa-toggle-on');
			$('#lv2_' + leave_id).css('color', 'green');
			$('#lv2_' + leave_id).show();

			window.location.reload();
		},
	});
}

function deactivate_leave(leave_id) {
	var company_id = localStorage.getItem('company_id');
	var active_status = 'no';

	$('#lv_' + leave_id).hide();

	$('#loading_' + leave_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/activate_company_leave',
		data: {
			leave_id: leave_id,
			active_status: active_status,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loading_' + leave_id).hide();
			$('#lv_' + leave_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
			} else if (response.status == '401') {
			}

			$('#loading_' + leave_id).hide();
			// $('#lv2_'+leave_id).show();
			//
			$('#lv_' + leave_id).removeClass('fa fa-toggle-on');
			$('#lv_' + leave_id).addClass('fa fa-toggle-off');
			$('#lv_' + leave_id).css('color', 'gray');
			$('#lv_' + leave_id).show();
			window.location.reload();
		},
	});
}
