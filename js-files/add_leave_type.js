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
	$('#add_leave').on('click', add_leave_type);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function add_leave_type() {
	// $('#exclude_weekends').change(function(){
	//      if($(this).attr('checked')){
	//           $(this).val('true');
	//      }else{
	//           $(this).val('false');
	//      }
	// });

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

	// $('#exclude_holidays').change(function(){
	//      if($(this).attr('checked')){
	//           $(this).val('true');
	//      }else{
	//           $(this).val('false');
	//      }
	// });

	var leave_type = $('#leave_type').val();
	var leave_description = $('#leave_description').val();
	var paid_status = $('#paid_status').val();
	// var allowable_days = $('#allowable_days').val();
	var company_id = localStorage.getItem('company_id');
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
		$('#leave_error').html('You have a blank field');

		return;
	}

	if (paid_status == '-- Select --') {
		$('#leave_error').html('Please select an option');

		return;
	}

	// alert(exclude_holidays);
	// alert(exclude_weekends);

	$('#add_leave').hide();
	$('#add_leave_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_leave_type',
		data: {
			leave_type: leave_type,
			leave_description: leave_description,
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

				$('#leave_error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#leave_error').html(response.msg);
			}

			$('#add_leave').show();
			$('#add_leave_loader').hide();
		},
		error: function(response) {
			$('#add_leave').show();
			$('#add_leave_loader').hide();
			$('#leave_error').html('Connection Error.');
		},
	});
}
