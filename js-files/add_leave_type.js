$(document).ready(function() {
	$('#add_leave').on('click', add_leave_type);
});

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
			company_id: company_id,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_leave_type').modal('show');

				$('#modal_leave_type').on('hidden.bs.modal', function() {
					// do something…
					// window.location.reload();
					window.location.href = 'leave_types';
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
