$(document).ready(function() {
	$('#add_employee').on('click', emp_type);
	list_of_employment_type();

	$(document).on('click', '.delete_employment_type', function() {
		var type_id = $(this).attr('id').replace(/type_/, ''); // table row ID
		delete_employment_type(type_id);
	});

	$('#add_emp_type').on('click', add_emp_type);
});

function emp_type() {
	$('#employee_display').toggle();
	$('#employee_type').val('');
	$('#description').val('');

	$('#error').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function list_of_employment_type() {
	var company_id = localStorage.getItem('company_id');
	// var page = 1;
	// var limit = 10;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_employment_types',
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
						strTable += '<tr id="row_' + response['data'][i]['type_id'] + '">';
						strTable += '<td>' + response['data'][i]['type_name'] + '</td>';

						// strTable += '<td>'+response['data'][i]['total_no_employees']+'</td>';

						strTable +=
							'<td><a href="' +
							base_url +
							'edit_employment_type?id=' +
							response['data'][i]['type_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employment Type"></i></a>&nbsp;&nbsp; <a  class="delete_employment_type" style="cursor: pointer;" id="type_' +
							response['data'][i]['type_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employment Type"></i></a>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['type_id'] +
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

				$('#typeData').html(strTable);
				$('#typeData').show();
			} else {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#typeData').html(strTable);
				$('#typeData').show();
			}
		},

		error: function(response) {
			$('#loading').hide();
			alert('Connection error');
		},
	});
}

function delete_employment_type(type_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete?');
	if (!ans) {
		return;
	}

	$('#row_' + type_id).hide();
	$('#loader_row_' + type_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_employment_type',
		data: {
			type_id: type_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + type_id).hide();
			$('#row_' + type_id).show();

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
					onClose: list_of_employment_type(),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#loader_row_' + type_id).hide();
		},
	});
}

function add_emp_type() {
	var employment_type = $('#employment_type').val();
	var employment_description = $('#employment_description').val();

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
		$('#type_error').html('You have a blank field');

		return;
	}

	$('#add_emp_type').hide();
	$('#type_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_employment_type',
		data: {
			employment_type: employment_type,
			employment_description: employment_description,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#employment_type').val('');
				$('#employment_description').val('');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: window.location.reload(),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#type_error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#type_error').html(response.msg);
			}

			$('#add_emp_type').show();
			$('#type_loader').hide();
		},
		error: function(response) {
			$('#add_emp_type').show();
			$('#type_loader').hide();
			$('#type_error').html('Connection Error.');
		},
	});
}
