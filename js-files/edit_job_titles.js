$(document).ready(function() {
	// $('#current_or_previous').change(function() {
	// 	if (this.value == 'current') {
	// 		$('#from').show();
	// 		$('#to').hide();
	// 	} else if (this.value == 'previous') {
	// 		$('#from').show();
	// 		$('#to').show();
	// 	} else {
	// 		$('#from').hide();
	// 		$('#to').hide();
	// 	}
	// });

	fetch_employee_edit_details_job_titles();
	// fetch_employment_info();

	$('input#from_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('input#edit_from').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('input#edit_to').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('input#to_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	list_of_position_history();
	load_position();

	$('#add_history').on('click', his_display);

	// list_of_company_holidays();

	$('#add_pos_history').on('click', add_position_history);

	$(document).on('click', '.delete_history', function() {
		var id = $(this).attr('id').replace(/his_/, ''); // table row ID
		delete_history(id);
	});
});

function his_display() {
	$('#history_display').toggle();
	// $('#holiday_date').val('');
	// $('#holiday_name').val('');
	$('#from').hide();
	$('#to').hide();
	$('#error').html('');

	// $(".required").each(function(){

	//   var the_val = $.trim($(this).val());

	//   $(this).removeClass("has-error");

	// });
}

function fetch_employee_edit_details_job_titles() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';
			var str2 = '';
			var str3 = '';
			if (response.status == '200') {
				// alert(response.data.firstname);
				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_id +
					'"><button id="send"  class="btn btn-primary">View</button></a>';

				$('#profile_name').html(
					'<b>' +
						response.data.firstname +
						' ' +
						response.data.lastname +
						'</b> | <font color="red">Edit</font>',
				);

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="..." style="width: 230px">';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					employee_id +
					'">Leave History</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					employee_id +
					'">Attendance</a></li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function fetch_employment_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_employment_info',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';

			if (response.status == '200') {
				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					employee_id +
					'">Leave History</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					employee_id +
					'">Attendance</a></li>';

				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function load_position() {
	var company_id = localStorage.getItem('company_id');

	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_positions',
		type: 'POST',
		data: { company_id: company_id, page: page, limit: limit },
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['position_id'] +
					'">' +
					response['data'][i]['position_name'] +
					'</option>';
			});
			$('#position_id').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function delete_history(id) {
	var company_id = localStorage.getItem('company_id');

	var ans = confirm('Are you sure you want to delete this history?');
	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + id).hide();
	$('#loader_row_' + id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_employee_position_history',
		data: { company_id: company_id, id: id },
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + holiday_id).hide();
			$('#row_' + holiday_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + id).hide();
		},
	});
}

function add_position_history() {
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var position_id = $('#position_id').val();
	var company_id = localStorage.getItem('company_id');

	// var pathArray = window.location.pathname.split( '/' );

	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	var blank;

	// alert(position_id);

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

	// if((current_or_previous == '2') && (position_id == '1')){

	//   $('#error').html('Please select an option');

	//       return;
	// }

	// $('#current_or_previous').change(function(){

	//     if ( this.value == '2')
	//     {
	//       $('#error').html('Please select an option');

	//       return;
	//     }

	// });

	// $('#position_id').change(function(){

	//     if ( this.value == '1')
	//     {
	//       $('#error').html('Please select an option');

	//       return;
	//     }

	// });

	$('#add_pos_history').hide();
	$('#loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_employee_position_history',
		data: {
			from_date: from_date,
			to_date: to_date,
			company_id: company_id,
			employee_id: employee_id,
			position_id: position_id,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_history').modal('show');

				$('#modal_history').on('hidden.bs.modal', function() {
					// do something…
					$('#history_display').hide();
					window.location.reload();
					//window.location.href = base_url+"/erp/hrm/employees";
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error').html(response.msg);
			}

			$('#add_pos_history').show();
			$('#loader').hide();
		},

		error: function(response) {
			$('#add_pos_history').show();
			$('#loader').hide();
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function list_of_position_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_company_employee_positions_history',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data.length > 0) {
					var k = 1;
					let grenner;
					// response.data[0];
					$(response.data).map((i, v) => {
						strTable += `<tr id="row_${v.id}" >`;
						strTable += `<td>${v.position_name} <div class="greent_${i}_trial"></div></td>`;
						strTable += `<td>${v.from_date}</td>`;
						strTable += `<td>${v.to_date}</td>`;
						strTable += `<td> <i data-toggle="modal" data-target="#editJobTitle" class="fa fa-pencil" style="font-style: italic; color: blue; font-size: 20px;"></i> <a class="delete_history" style="cursor: pointer;" id="his_${v.id}"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Position History"></i></a></td>`;
						strTable += `</tr>`;
						strTable += `<tr style="display: none;" id="loader_row_${v.id}">`;
						strTable += `<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i></td>`;
						strTable += `</tr>`;
						k++;
					});

					// $.each(response['data'], function(i, v) {
					// 	strTable += '<tr id="row_' + response['data'][i]['id'] + '">';
					// 	strTable += '<td>' + response['data'][i]['position_name'] + '</td>';

					// 	strTable += '<td>' + response['data'][i]['from_date'] + '</td>';

					// 	strTable += '<td>' + response['data'][i]['to_date'] + '</td>';

					// 	strTable +=
					// 		'<td><a class="delete_history" style="cursor: pointer;" id="his_' +
					// 		response['data'][i]['id'] +
					// 		'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Position History"></i></a></td>';

					// 	strTable += '</tr>';

					// 	strTable +=
					// 		'<tr style="display: none;" id="loader_row_' +
					// 		response['data'][i]['id'] +
					// 		'">';
					// 	strTable +=
					// 		'<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
					// 	strTable += '</td>';
					// 	strTable += '</tr>';

					// 	k++;
					// });
				} else {
					strTable = '<tr><td colspan="4">' + response.msg + '</td></tr>';
				}

				$('#historyData').html(strTable);
				$('#historyData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#historyData').html(strTable);
				$('#historyData').show();
				// setTimeout(() => {
				// 	let helloGreen = document.querySelectorAll('.greent');
				// 	helloGreen[0].classList.add('greenBall');
				// }, 2000);
			}
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable += '<td colspan="4">Connection error</td>';
			strTable += '</tr>';

			$('#historyData').html(strTable);
			$('#historyData').show();
			$('#loading').hide();
		},
	});
}
