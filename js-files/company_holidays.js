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

	$('input#holiday_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('#add_hols').on('click', doc);

	$('#add_holiday').on('click', add_company_holiday);

	$(document).on('click', '.delete_holiday', function() {
		var holiday_id = $(this).attr('id').replace(/hols_/, ''); // table row ID
		delete_holiday(holiday_id);
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		list_of_company_holidays(1);
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function delete_holiday(holiday_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + holiday_id).hide();
	$('#loader_row_' + holiday_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_holiday',
		data: {
			holiday_id: holiday_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + holiday_id).hide();
			$('#row_' + holiday_id).show();

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
					onClose: list_of_company_holidays(1),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}
			$('#loader_row_' + holiday_id).hide();
		},
	});
}

function doc() {
	$('#holiday_display').toggle();
	$('#holiday_date').val('');
	$('#holiday_name').val('');

	$('#error_holiday').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function add_company_holiday() {
	var holiday_name = $('#holiday_name').val();
	var holiday_date = $('#holiday_date').val();
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
		$('#error_holiday').html('You have a blank field');

		return;
	}

	$('#add_holiday').hide();
	$('#holiday_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_holiday',
		data: {
			holiday_name: holiday_name,
			holiday_date: holiday_date,
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
					onClose: window.location.reload(),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_holiday').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_holiday').html(response.msg);
			}

			$('#add_holiday').show();
			$('#holiday_loader').hide();
		},

		error: function(response) {
			$('#add_holiday').show();
			$('#holiday_loader').hide();
			$('#error_holiday').html('Connection Error.');
		},
	});
}

function list_of_company_holidays(page) {
	let company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	let limit = 10;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_holidays',
		data: {
			page: page,
			limit: limit,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['holiday_id'] + '">';
						strTable += '<td>' + response['data'][i]['holiday_name'] + '</td>';

						strTable += '<td>' + response['data'][i]['holiday_date'] + '</td>';

						strTable +=
							'<td><a href="' +
							base_url +
							'edit_company_holiday?id=' +
							response['data'][i]['holiday_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Company Holiday"></i></a>&nbsp;&nbsp; <a class="delete_holiday" style="cursor: pointer;" id="hols_' +
							response['data'][i]['holiday_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Company Holiday"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['holiday_id'] +
							'">';
						strTable +=
							'<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="3">No record found</td></tr>';
				}

				$('#holidayData').html(strTable);
				$('#holidayData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#holidayData').html(strTable);
				$('#holidayData').show();
			}

			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					list_of_company_holidays(page);
				},
			});
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}
