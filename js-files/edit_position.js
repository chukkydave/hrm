$(document).ready(function() {
	$('#edit_pos').on('click', edit_company_position);

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
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		fetch_employee_position();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function fetch_employee_position() {
	// var pathArray = window.location.pathname.split( '/' );
	var position_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_position_byID',
		data: {
			position_id: position_id,
			company_id: company_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$.each(response['data'], function(i, v) {
					$('#position_name').val(response['data'][i]['position_name']);
					$('#position_description').val(response['data'][i]['position_description']);
					$('#eligibility').val(v.leave_is_eligible);
					$('#alloted_days').val(v.alloted_leave_days);
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}

function edit_company_position() {
	var position_name = $('#position_name').val();
	var position_description = $('#position_description').val();
	let alloted = $('#alloted_days').val();
	let eligibility = $('#eligibility').val();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var position_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
		$('#error_edit_position').html('You have a blank field');

		return;
	}

	$('#edit_pos').hide();
	$('#edit_pos_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_position',
		data: {
			position_name: position_name,
			position_description: position_description,
			company_id: company_id,
			position_id: position_id,
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
					onClose: (window.location.href = base_url + 'company_positions'),
				});

				// $('#modal_position_edit').modal('show');

				// $('#modal_position_edit').on('hidden.bs.modal', function() {
				//     $('#position_name').val();
				//     $('#position_description').val();
				//     // window.location.reload();
				//     window.location.href = base_url + "company_positions";
				// })
			} else if (response.status == '400') {
				// coder error message

				$('#error_edit_position').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_edit_position').html(response.msg);
			}

			$('#edit_pos').show();
			$('#edit_pos_loader').hide();
		},

		error: function(response) {
			$('#edit_pos').show();
			$('#edit_pos_loader').hide();
			$('#error_edit_position').html('Connection Error.');
		},
	});
}
