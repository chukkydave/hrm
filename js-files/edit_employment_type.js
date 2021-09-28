$(document).ready(function() {
	fetch_employment_type_details();

	$('#add_emp_type').on('click', edit_employment_type);
});

function fetch_employment_type_details() {
	// var pathArray = window.location.pathname.split( '/' );
	var employment_type_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_employment_type_byID',
		data: {
			employment_type_id: employment_type_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$.each(response['data'], function(i, v) {
					$('#employment_type').val(response['data'][i]['employment_type_name']);
					$('#employment_description').val(
						response['data'][i]['employment_type_description'],
					);
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}

function edit_employment_type() {
	var employment_type = $('#employment_type').val();
	var employment_description = $('#employment_description').val();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employment_type_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
		$('#error_emp_type').html('You have a blank field');

		return;
	}

	$('#add_emp_type').hide();
	$('#emp_type_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_employment_type',
		data: {
			employment_type: employment_type,
			employment_description: employment_description,

			employment_type_id: employment_type_id,
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
					onClose: (window.location.href = base_url + 'employement_type'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_emp_type').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_emp_type').html(response.msg);
			}

			$('#add_emp_type').show();
			$('#emp_type_loader').hide();
		},

		error: function(response) {
			$('#add_emp_type').show();
			$('#emp_type_loader').hide();
			$('#error_emp_type').html('Connection Error.');
		},
	});
}
