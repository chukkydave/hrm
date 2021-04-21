$(document).ready(function() {
	load_department();
	// list_of_positions();
	// $('#add_attendence').on('click', show_add);
	// $('#filter_attendence').on('click', show_filter);
	// $('#upload_attendence').on('click', show_upload);

	$('#clock_in').datetimepicker({
		format: 'HH:mm:ss'
	});

	$('#clock_out').datetimepicker({
		format: 'HH:mm:ss'
	});

	$('input#date').datepicker({
		dateFormat: 'yy-mm-dd'
	});

	$('input#date_range').daterangepicker({
		autoUpdateInput: false
	});

	$('input#date_range').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
	});
});
function load_department() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_departments',
		type: 'POST',
		data: { company_id: company_id, page: 1, limit: 100 },
		dataType: 'json',

		success: function(response) {
			// console.log(response);
			$('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['department_id'] +
					'">' +
					response['data'][i]['department_name'] +
					'</option>';
			});
			$('#employee_department').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		}
	});
}
