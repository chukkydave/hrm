$(document).ready(function() {
	list_of_positions('');
	$('#add_position').on('click', position);
	$('#add_pos').on('click', add_company_position);

	$(document).on('click', '.delete_position', function() {
		var position_id = $(this).attr('id').replace(/pos_/, ''); // table row ID
		delete_position(position_id);
	});
});

function list_of_positions(page) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 50;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_positions',
		data: {
			page: page,
			limit: limit,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data && response.data.length > 0) {
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['position_id'] + '">';
						// strTable += '<td>PN'+response['data'][i]['position_id']+'</td>';

						strTable += '<td>' + response['data'][i]['position_name'] + '</td>';
						// strTable += '<td>'+response['data'][i]['total_no_employees']+'</td>';

						strTable +=
							'<td valign="top"><a href="' +
							base_url +
							'edit_position?id=' +
							response['data'][i]['position_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Position"></i></a>&nbsp;&nbsp; <a class="delete_position" style="cursor: pointer;" id="pos_' +
							response['data'][i]['position_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Position"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['position_id'] +
							'">';
						strTable +=
							'<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';
					});
				} else {
					strTable = '<tr><td colspan="4">No record found</td></tr>';
				}

				if (!response.data) {
					strTable = '<tr><td colspan="4">No record found</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_positions(page);
					},
				});

				$('#positionData').html(strTable);
				$('#positionData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#positionData').html(strTable);
				$('#positionData').show();
			}
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}

function add_company_position() {
	var position_name = $('#position_name').val();
	var eligibility = $('#eligibility').val();
	var alloted = $('#alloted_days').val();
	var position_description = $('#position_description').val();
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

	$('#add_pos').hide();
	$('#position_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_position',
		data: {
			position_name: position_name,
			position_description: position_description,

			leave_eligible: eligibility,
			alloted_leave: alloted,
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

			$('#add_pos').show();
			$('#position_loader').hide();
		},

		error: function(response) {
			$('#add_pos').show();
			$('#position_loader').hide();
			$('#error_position').html('Connection Error.');
		},
	});
}

function delete_position(position_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this position?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + position_id).hide();
	$('#loader_row_' + position_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_position',
		data: {
			position_id: position_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + position_id).hide();
			$('#row_' + position_id).show();

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

			$('#loader_row_' + position_id).hide();
		},
	});
}

function position() {
	$('#position_display').toggle();
	$('#position_description').val('');
	$('#position_name').val('');
	$('#error_position').hide();
}
