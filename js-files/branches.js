$(document).ready(function() {
	// list_of_positions();
	$('#add_branch').on('click', company_branch);
	list_of_company_branches();

	$('#add_comp_branch').on('click', add_company_branch);

	$(document).on('click', '.delete_branch', function() {
		var branch_id = $(this).attr('id').replace(/bra_/, ''); // table row ID
		delete_branch(branch_id);
	});
});

function delete_branch(branch_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this branch?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + branch_id).hide();
	$('#loader_row_' + branch_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_branch',
		data: {
			branch_id: branch_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + branch_id).hide();
			$('#row_' + branch_id).show();

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
					onClose: list_of_company_branches(),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#loader_row_' + branch_id).hide();
		},
	});
}

function company_branch() {
	$('#branch_display').toggle();
	$('#branch_description').val('');
	$('#branch_name').val('');

	$('#error_branch').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function add_company_branch() {
	var branch_name = $('#branch_name').val();
	var branch_description = $('#branch_description').val();
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');

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
		$('#error_branch').html('You have a blank field');

		return;
	}

	$('#add_comp_branch').hide();
	$('#branch_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_branch',
		data: {
			branch_name: branch_name,
			branch_description: branch_description,

			user_id: user_id,
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
			} else if (response.status == '400') {
				// coder error message

				$('#error_branch').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_branch').html(response.msg);
			}

			$('#add_comp_branch').show();
			$('#branch_loader').hide();
		},

		error: function(response) {
			$('#add_comp_branch').show();
			$('#branch_loader').hide();
			$('#error_branch').html('Connection Error.');
		},
	});
}

function list_of_company_branches() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_branches',
		data: {},
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
						strTable += '<tr id="row_' + response['data'][i]['branch_id'] + '">';
						strTable += '<td>' + response['data'][i]['branch_name'] + '</td>';

						// strTable += '<td>'+response['data'][i]['$total_no_employees']+'</td>';

						strTable +=
							'<td><a href="' +
							base_url +
							'edit_branch?id=' +
							response['data'][i]['branch_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Company Branch"></i></a>&nbsp;&nbsp; <a class="delete_branch" style="cursor: pointer;" id="bra_' +
							response['data'][i]['branch_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Company Branch"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['branch_id'] +
							'">';
						strTable +=
							'<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="3">No record</td></tr>';
				}

				$('#branchData').html(strTable);
				$('#branchData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#branchData').html(strTable);
				$('#branchData').show();
			}
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}
