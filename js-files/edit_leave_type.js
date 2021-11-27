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

	$('#edit_lv_type').on('click', edit_company_leave_type);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		fetch_leave_type_details();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function fetch_leave_type_details() {
	// var pathArray = window.location.pathname.split( '/' );
	var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_leave_byID',
		data: {
			leave_id: leave_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$.each(response['data'], function(i, v) {
					$('#leave_type').val(response['data'][i]['leave_type']);
					$('#leave_type_description').val(response['data'][i]['leave_description']);
					// $('#allowable_days').val(response['data'][i]['allowable_days']);

					if (response['data'][i]['paid_status'] == 'no') {
						$('#paid_status').val('no');
					} else {
						$('#paid_status').val('yes');
					}

					if (response['data'][i]['exclude_weekends'] == 'no') {
						$('#exclude_weekends').attr('checked', false);
					} else {
						$('#exclude_weekends').attr('checked', true);
					}

					if (response['data'][i]['exclude_holidays'] == 'no') {
						$('#exclude_holidays').attr('checked', false);
					} else {
						$('#exclude_holidays').attr('checked', true);
					}
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}

function edit_company_leave_type() {
	if ($('#exclude_weekends').is(':checked')) {
		$('#exclude_weekends').val('yes');
	} else {
		$('#exclude_weekends').val('no');
	}

	if ($('#exclude_holidays').is(':checked')) {
		$('#exclude_holidays').val('yes');
	} else {
		$('#exclude_holidays').val('no');
	}

	var leave_type = $('#leave_type').val();
	var leave_description = $('#leave_type_description').val();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var paid_status = $('#paid_status').val();
	// var allowable_days = $('#allowable_days').val();
	var exclude_weekends = $('#exclude_weekends').val();
	var exclude_holidays = $('#exclude_holidays').val();

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
		$('#error_leave_type').html('You have a blank field');

		return;
	}

	$('#edit_lv_type').hide();
	$('#edit_lv_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_leave',
		data: {
			leave_type: leave_type,
			leave_description: leave_description,

			leave_id: leave_id,
			allowable_days: '',
			paid_status: paid_status,
			exclude_holidays: exclude_holidays,
			exclude_weekends: exclude_weekends,
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
					onClose: (window.location.href = 'leave_types'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_leave_type').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_leave_type').html(response.msg);
			}

			$('#edit_lv_type').show();
			$('#edit_lv_loader').hide();
		},

		error: function(response) {
			$('#edit_lv_type').show();
			$('#edit_lv_loader').hide();
			$('#error_leave_type').html('Connection Error.');
		},
	});
}
