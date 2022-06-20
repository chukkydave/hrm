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
	$(document).on('click', '.do_connections_exist', function() {
		var id = $(this).attr('id').replace(/id_/, '');
		$('#loadin_tr_' + id).show();
		$('#data_tr_' + id).hide();
		do_connections_exist(id);
	});

	$(document).on('click', '.view_shift_info', function() {
		var id = $(this).attr('id').replace(/id_/, '');
		var shift_name = $('#s_name_' + id).html();
		get_shift_details(id, shift_name);
	});

	//view_shift_info
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		fetch_list();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function get_shift_details(id, shift_name) {
	$('#msggg').html('<i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: ;" id=""></i>');

	$('#exampleModalLabel').html(shift_name);

	$('#modal_msg').modal('show');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/get_workshift',
		data: { shift_id: id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// let dura = $(response.data.duration).split(' ');
				// $('#duration_view').html(dura[0]);
				let the_list = `<span class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Duration:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p>${response.data.duration} hours</p>
                        </div>
                    </div>





                </span>`;
				the_list +=
					'<table class="table table-bordered" style="font-size: 13px"> <thead>   <th>Day </th>      <th>Start Time</th>            <th>End Time</th>    </tr>      </thead>   <tbody>';

				$(response.data.shift_days).each(function(index, value) {
					the_list +=
						'<tr>    <td>' +
						value.week_day_name +
						'</td>   <td>' +
						value.start_time +
						'</td>      <td>' +
						value.end_time +
						'</td>  </tr>';
				});

				the_list += '</tbody> </table>';

				$('#msggg').html(the_list);
			} else if (response.status == '400') {
				// coder error message
			} else if (response.status == '401') {
				//user error message
			}
		},

		error: function(response) {
			console.log(response);
		},
	});
}

function do_connections_exist(id) {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/count_connections',
		data: { shift_id: id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				if (parseInt(response.data) > 0) {
					$('#msggg').html(
						`<font size=3>Some employees are currently on this shift. Deleting this shift will leave them without shifts. <br><br>Do you still wish to delete it?</font> <br><br><button type="button" class="btn btn-success" onClick="delete_shift(${id})">Yes</button>&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>`,
					);

					// $('#exampleModalLabel').html('Warning');
					// document.getElementById('exampleModalLabel').innerText = 'Warning';

					$('#modal_msg').modal('show');

					$('#loadin_tr_' + id).hide();
					$('#data_tr_' + id).show();
				} else {
					$('#loadin_tr_' + id).hide();
					$('#data_tr_' + id).show();
					delete_shift(id);
				}
			} else if (response.status == '400') {
				// coder error message
				$('#loadin_tr_' + id).hide();
				$('#data_tr_' + id).show();
				alert('Error.');
			} else if (response.status == '401') {
				//user error message
				$('#loadin_tr_' + id).hide();
				$('#data_tr_' + id).show();
				alert('Error');
			}
		},

		error: function(response) {
			alert('Error.');
		},
	});
}

function delete_shift(id) {
	var ans = confirm('Are you sure you want to delete this shift');
	if (ans) {
		$('#loadin_tr_' + id).show();
		$('#data_tr_' + id).hide();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			cache: false,
			url: api_path + 'workshifts/delete_workshift',
			data: { shift_id: id },
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
						onClose: fetch_list(),
					});
					$('#data_tr_' + id).remove();
					$('#modal_msg').modal('hide');
				} else if (response.status == '400') {
					//coder error message
					Swal.fire({
						title: 'Error!',
						text: `${response.statusText}`,
						icon: 'error',
						confirmButtonText: 'Close',
					});
					$('#data_tr_' + id).show();
				} else if (response.status == '401') {
					//user error message
					Swal.fire({
						title: 'Error!',
						text: `${response.statusText}`,
						icon: 'error',
						confirmButtonText: 'Close',
					});
					$('#data_tr_' + id).show();
				}

				$('#loadin_tr_' + id).hide();
			},

			error: function(response) {
				console.log(response);
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
				$('#loadin_tr_' + id).hide();
				$('#data_tr_' + id).show();
			},
		});
	} else {
	}
}

function fetch_list() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/list_shifts',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				var the_list = '';
				if (response.data.length > 0) {
					$(response.data).each(function(index, value) {
						the_list +=
							'<tr id="data_tr_' +
							value.id +
							'">  <td valign="top" id="s_name_' +
							value.id +
							'">' +
							value.name +
							'</td>  <td valign="top">' +
							value.employee_count +
							'</td>    <td valign="top"><i  class="fa fa-info-circle view_shift_info" id="id_' +
							value.id +
							'"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" ></i> &nbsp;&nbsp;<a href="' +
							base_url +
							'edit_work_shift?id=' +
							value.id +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit"></i></a>&nbsp;&nbsp; <i  class="fa fa-trash do_connections_exist"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee info" id="id_' +
							value.id +
							'"></i></td>     </tr>  <tr id="loadin_tr_' +
							value.id +
							'" style="display: none"><td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ;"></i></td></tr>';
					});
				} else {
					the_list = '<tr><td colspan="3">No record found</td></tr>';
				}

				$('#workshift_list').html(the_list);
			} else if (response.status == '400') {
				// coder error message

				the_list += '<tr>  <td valign="top" colspan="3">No record</td>     </tr>';
				$('#workshift_list').html(the_list);
			} else if (response.status == '401') {
				//user error message

				$('#error_dept').html(response.msg);
			}

			$('#loading_td').hide();
		},

		error: function(response) {
			console.log(response);
			$('#add_dept').show();
			$('#dept_loading').hide();
			$('#error_dept').html('Connection Error.');
		},
	});
}
