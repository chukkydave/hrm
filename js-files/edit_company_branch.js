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

	$('#edit_branch').on('click', edit_company_branch);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		fetch_branch_details();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function edit_company_branch() {
	var branch_name = $('#branch_name').val();
	var branch_description = $('#branch_description').val();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var branch_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
		$('#error_comp_branch').html('You have a blank field');

		return;
	}

	$('#edit_branch').hide();
	$('#edit_branch_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_branch',
		data: {
			branch_name: branch_name,
			branch_description: branch_description,

			branch_id: branch_id,
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
					onClose: (window.location.href = base_url + 'company_branches'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_comp_branch').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_comp_branch').html(response.msg);
			}

			$('#edit_branch').show();
			$('#edit_branch_loader').hide();
		},

		error: function(response) {
			$('#edit_branch').show();
			$('#edit_branch_loader').hide();
			$('#error_comp_branch').html('Connection Error.');
		},
	});
}

function fetch_branch_details() {
	// var pathArray = window.location.pathname.split( '/' );
	var branch_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_branch_byID',
		data: {
			branch_id: branch_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$.each(response['data'], function(i, v) {
					$('#branch_name').val(response['data'][i]['branch_name']);
					$('#branch_description').val(response['data'][i]['branch_description']);
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}
