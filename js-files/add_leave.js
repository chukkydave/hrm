$(document).ready(function() {
	load_employee();
	load_leave_type();

	$('input#leave_start').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('input#resumption_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('#add_leave').on('click', add_company_leave);
});

function add_company_leave() {
	var employee_id = $('#employee_id').val();
	var resumption_date = $('#resumption_date').val();
	let days_req = $('#days_req').val();
	var leave_type = $('#leave_type').val();
	var leave_start = $('#leave_start').val();
	var comment = $('#commentss').val();
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
		$('#error').html('You have a blank field');

		return;
	}

	if (Date.parse(resumption_date) < Date.parse(leave_start)) {
		//start is less than End
		$('#error').html('Wrong date interval!');

		return;
	}

	$('#add_leave').hide();
	$('#leave_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_employee_leave_2',
		data: {
			leave_type: leave_type,
			resumption_date: resumption_date,
			company_id: company_id,
			employee_id: employee_id,
			leave_start: leave_start,
			comment: comment,
			days_requested: days_req,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_leave').modal('show');

				$('#modal_leave').on('hidden.bs.modal', function() {
					// window.location.reload();
					window.location.href = base_url + 'leaves';
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error').html(response.msg);
				// alert(company_id);
			} else if (response.status == '401') {
				//user error message

				$('#error').html(response.msg);
			}

			$('#add_leave').show();
			$('#leave_loader').hide();
		},

		error: function(response) {
			$('#add_leave').show();
			$('#leave_loader').hide();
			$('#error').html('Connection Error.');
		},
	});
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: { company_id: company_id, page: page, limit: limit },
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$(response.data).map((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});

			$('#employee_id').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			alert('Connection error');
		},
	});
}

function load_leave_type() {
	var company_id = localStorage.getItem('company_id');
	// var page = -1;
	// var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_leaves_type',
		type: 'POST',
		data: { company_id: company_id },
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['leave_id'] +
					'">' +
					response['data'][i]['leave_type'] +
					'</option>';
			});
			$('#leave_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			alert('Connection error');
		},
	});
}
