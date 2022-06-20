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

	$('#doc').on('click', doctype);

	$('#add_doctype').on('click', add_doctype);

	$(document).on('click', '.delete_doctype', function() {
		var doctype_id = $(this).attr('id').replace(/doc_/, ''); // table row ID
		delete_doctype(doctype_id);
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		list_doctype('');
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function doctype() {
	$('#doctype_display').toggle();

	$('#doctype_description').val('');
	$('#doctype_name').val('');

	$('#error_doctype').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
}

function delete_doctype(doctype_id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + doctype_id).hide();
	$('#loader_row_' + doctype_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_doctype',
		data: {
			doctype_id: doctype_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + doctype_id).hide();
			$('#row_' + doctype_id).show();

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
					onClose: list_doctype(''),
				});
			} else if (response.status == '401') {
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#loader_row_' + doctype_id).hide();
		},
	});
}

function add_doctype() {
	var doctype_name = $('#doctype_name').val();
	var doctype_description = $('#doctype_description').val();
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');

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
		$('#error_doctype').html('You have a blank field');

		return;
	}

	$('#add_doctype').hide();
	$('#doctype_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_doctype',
		data: {
			doctype_name: doctype_name,
			doctype_description: doctype_description,
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

				$('#error_doctype').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_doctype').html(response.msg);
			}

			$('#add_doctype').show();
			$('#doctype_loader').hide();
		},

		error: function(response) {
			$('#add_doctype').show();
			$('#doctype_loader').hide();
			$('#error_doctype').html('Connection Error.');
		},
	});
}

function list_doctype(page) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 10;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_doctypes',
		data: {
			page: page,
			limit: limit,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['doctype_id'] + '">';
						strTable += '<td>' + response['data'][i]['doctype_name'] + '</td>';

						strTable += '<td>' + response['data'][i]['doctype_description'] + '</td>';

						strTable +=
							'<td><a href="' +
							base_url +
							'edit_doctype?id=' +
							response['data'][i]['doctype_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Document Type"></i></a>&nbsp;&nbsp; <a class="delete_doctype" style="cursor: pointer;" id="doc_' +
							response['data'][i]['doctype_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Document Type"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['doctype_id'] +
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

				$('#doctypeData').html(strTable);
				$('#doctypeData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#doctypeData').html(strTable);
				$('#doctypeData').show();
			}

			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					list_doctype(page);
				},
			});
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}
