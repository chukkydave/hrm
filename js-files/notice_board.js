$(document).ready(function() {
	list_notification();
	$('#edit_not_btn').on('click', editNotice);
	$('#add_not').on('click', add_notification);

	$(document).on('click', '.delete_position', function() {
		var position_id = $(this).attr('id').replace(/pos_/, ''); // table row ID
		delete_position(position_id);
	});
});

function list_notification() {
	// $('#sche_msg_error').html('');
	$('#list_notification_table').hide();
	$('#list_notification_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/get_notice_board`, {
			params: {},
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

				board_notice.map((item) => {
					let timer = moment(item.created_at, 'YYYY-MM-DD HH:mm:ss').fromNow();
					allNotice += `<tr id="row_${item.id}">`;
					allNotice += `<td>${item.notice_board}</td>`;
					allNotice += `<td>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-secondary dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton1"
                                            data-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li onClick="viewNotice(${item.id})">
                                                <a class="dropdown-item">
                                                    <i class="fa fa-pencil" /> Edit
                                                </a>
                                            </li>
                                            <li onClick="delete_notice(${item.id})">
                                                <a class="dropdown-item">
                                                    <i class="fa fa-trash" /> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>`;
					allNotice += `</tr>`;
					allNotice += `<tr id="loader_row_${item.id}" style="display:none;"><td colspan="2"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_notification_body').html(allNotice);
				$('#list_notification_loader').hide();
				$('#list_notification_table').show();
			} else {
				$('#list_notification_body').html(`<tr><td colspan="2">No record</td></tr>`);
				$('#list_notification_loader').hide();
				$('#list_notification_table').show();
			}

			// $('#notice_board_loading').hide();
			// $('#notice_board').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#list_notification_loader').hide();
			$('#list_notification_table').show();
			$('#list_notification_body').html(
				`<tr><td colspan="2" style="color:red;">${error.statusText}</td></tr>`,
			);

			// $('#notice_board').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});

	// var echartDonut = echarts.init(document.getElementById("yearly_sales_report"));
}

function add_notification() {
	var notification = $('#notification_text').val();
	// var status = $('#notification_status').val();
	var company_id = localStorage.getItem('company_id');

	var blank;

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
		$('#error_position').html('You have a blank field');

		return;
	}

	$('#add_not').hide();
	$('#notification_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/create_notice_board',
		data: {
			notice: notification,
			notice_status: 'publish',
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: window.location.reload(),
				});
				// $('#modal_position').modal('show');

				// $('#modal_position').on('hidden.bs.modal', function() {
				// 	// do something…
				// 	$('#position_display').hide();
				// 	window.location.reload();
				// 	//window.location.href = base_url+"/erp/hrm/employees";
				// });
			} else if (response.status == '400') {
				// coder error message

				$('#error_position').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_position').html(response.msg);
			}

			$('#add_not').show();
			$('#notification_loader').hide();
		},

		error: function(response) {
			$('#add_not').show();
			$('#notification_loader').hide();
			$('#error_position').html('Connection Error.');
		},
	});
}

function delete_notice(notice_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this record?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_notice').modal('show');

	$('#row_' + notice_id).hide();
	$('#loader_row_' + notice_id).show();
	$.ajax({
		type: 'DELETE',
		dataType: 'json',
		url: api_path + 'hrm/delete_notice_board',
		data: {
			notice_id: notice_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + notice_id).hide();
			$('#row_' + notice_id).show();

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
					// onClose: window.location.reload,
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#loader_row_' + notice_id).hide();
		},
	});
}

function viewNotice(id) {
	$('#edit_error').html('');
	$('#edit_not_modal').modal('show');
	$('#edit_not_btn').hide();
	$('#edit_not_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/single_notice_board`, {
			params: {
				notice_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_not_loader').hide();
			$('#edit_not_btn').show();

			let { notice_board_status, notice_board } = response.data.data;
			$('#edit_notification').val(notice_board);
			// $('#edit_status').val(notice_board_status);
			$('#edit_not_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_not_loader').hide();
			$('#edit_not_btn').show();

			$('#edit_error').html('Error loading content');
		})
		.then(function() {
			// always executed
		});
}

function editNotice() {
	let id = $('#edit_not_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	$('#edit_error').html('');

	var blank;

	$('.edit_fields').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#edit_error').html('You have a blank field');

		return;
	}

	$('#edit_not_btn').hide();
	$('#edit_not_loader').show();

	let notice = $('#edit_notification').val();
	// let status = $('#edit_status').val();

	let data = {
		notice_id: id,
		notice: notice,
		notice_status: 'publish',
	};

	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_notice_board`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_not_loader').hide();
			$('#edit_not_btn').show();
			$('#edit_error').html('Error sending request');
			// alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_not_loader').hide();
				$('#edit_not_btn').show();

				$('#edit_not_modal').modal('hide');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_notification(),
				});
			} else {
				$('#edit_not_loader').hide();
				$('#edit_not_btn').show();
				$('#edit_error').html('Error sending request');
			}
		},
	});
}
