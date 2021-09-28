$(document).ready(function() {
	fetch_doctype_details();

	$('#edit_doctype').on('click', edit_company_doctype);
});

function edit_company_doctype() {
	var doctype_name = $('#doctype_name').val();
	var doctype_description = $('#doctype_description').val();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var doctype_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
		$('#error_comp_doctype').html('You have a blank field');

		return;
	}

	$('#edit_doctype').hide();
	$('#edit_doctype_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_doctype',
		data: {
			doctype_name: doctype_name,
			doctype_description: doctype_description,

			doctype_id: doctype_id,
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
					onClose: (window.location.href = 'emp_doc_type'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_comp_doctype').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_comp_doctype').html(response.msg);
			}

			$('#edit_doctype').show();
			$('#edit_doctype_loader').hide();
		},

		error: function(response) {
			$('#edit_doctype').show();
			$('#edit_doctype_loader').hide();
			$('#error_comp_doctype').html('Connection Error.');
		},
	});
}

function fetch_doctype_details() {
	// var pathArray = window.location.pathname.split( '/' );
	var doctype_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_doctype_byID',
		data: { doctype_id: doctype_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$.each(response['data'], function(i, v) {
					$('#doctype_name').val(response['data'][i]['doctype_name']);
					$('#doctype_description').val(response['data'][i]['doctype_description']);
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}
