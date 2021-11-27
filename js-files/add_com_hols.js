$(document).ready(() => {
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

	$('#smartwizard').smartWizard({
		selected: 0, // Initial selected step, 0 = first step
		theme: 'dots', // theme for the wizard, related css need to include for other than default theme
		justified: true, // Nav menu justification. true/false
		darkMode: false, // Enable/disable Dark Mode if the theme supports. true/false
		autoAdjustHeight: false, // Automatically adjust content height
		cycleSteps: false, // Allows to cycle the navigation of steps
		backButtonSupport: true, // Enable the back button support
		enableURLhash: false, // Enable selection of the step based on url hash
		transition: {
			animation: 'none', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
			speed: '400', // Transion animation speed
			easing: '', // Transition animation easing. Not supported without a jQuery easing plugin
		},
		toolbarSettings: {
			toolbarPosition: 'bottom', // none, top, bottom, both
			toolbarButtonPosition: 'right', // left, right, center
			showNextButton: true, // show/hide a Next button
			showPreviousButton: true, // show/hide a Previous button
			toolbarExtraButtons: [], // Extra buttons to show on toolbar, array of jQuery input/buttons elements
		},
		anchorSettings: {
			anchorClickable: true, // Enable/Disable anchor navigation
			enableAllAnchors: false, // Activates all anchors clickable all times
			markDoneStep: true, // Add done state on navigation
			markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
			removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
			enableAnchorOnDoneStep: true, // Enable/Disable the done steps navigation
		},
		keyboardSettings: {
			keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
			keyLeft: [
				37,
			], // Left key code
			keyRight: [
				39,
			], // Right key code
		},
		lang: {
			// Language variables for button
			next: 'Next',
			previous: 'Previous',
		},
		disabledSteps: [], // Array Steps disabled
		errorSteps: [], // Highlight step with errors
		hiddenSteps: [], // Hidden steps
		toolbarSettings: {
			toolbarExtraButtons: [
				$('<button></button>')
					.text('Done')
					.addClass('btn btn-success done_button_ada')
					.on('click', function() {
						window.location.href = 'company_holidays';
					}),
			],
		},
	});
	$(document).on('click', '#filter', function() {
		$('#pagination').twbsPagination('destroy');
		let hol_id = $('#holiday_its').attr('dir');
		list_of_companies_employeesy('', hol_id);
	});
	// list_of_companies_employees('', '');

	$('#add_holiday').on('click', add_company_holiday);
	$('input#holiday_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		load_position();
		load_department();
		setTimeout(() => {
			$('.sw-btn-next').attr('disabled', true);
			$('.done_button_ada').attr('disabled', true);
		}, 2000);
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function list_of_companies_employeesy(page, holiday_id) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}

	var limit = 10;

	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var gender = $('#gender').val();
	var position = $('#position').val();
	// let holiday_id = localStorage.getItem('holiday_id');
	// var status = $('#status').val();
	// var phone = $('#phone').val();
	var employee_department = $('#employee_department').val();
	// var email = $('#email').val();
	var employee_code = $('#employee_code').val();
	// ?company_id=69&holiday_id=29&page=1&limit=100&firstname&lastname&gender&department&position

	$('#list_workShift_table').hide();
	$('#list_workShift_loader').show();
	$('#employeeData').html('');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/list_employee_holidays',
		data: {
			// company_id: company_id,
			page: page,
			holiday_id: holiday_id,
			limit: limit,
			// email: email,
			firstname: firstname,
			lastname: lastname,
			gender: gender,
			position: position,
			// status: status,
			// order: order_by,
			department: employee_department,
			// employee_code: employee_code,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// alert(holiday_id);

			// $('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					// var k = 1;
					// var SerialNo = serial;

					if (page == 1 || page == '') {
						var k = 1;
					} else {
						var k = page * limit - limit + 1;
					}

					$(response.data).map((i, v) => {
						// strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+base_url+'/erp/assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';

						function status(string) {
							return string.charAt(0).toUpperCase() + string.slice(1);
						}
						let empType;
						let jobTitle;
						let checked;
						if (v.position === null) {
							jobTitle = '';
						} else {
							jobTitle = v.job_title;
						}
						if (v.employment_type === false) {
							empType = '';
						} else {
							empType = v.employment_type;
						}
						let allNames = `${v.lastname} ${v.firstname} ${v.middlename}`;
						if (v.is_checked === '0') {
							checked = false;
						} else if (v.is_checked === '1') {
							checked = true;
						}
						strTable += '<tr id="row_' + v.employee_id + '">';
						strTable += `<td class="a-center"><input onClick="update_holiday_employee(${v.employee_id},${v.staff_holiday_id})" checked=${checked} type="checkbox" value="${v.employee_id}-${v.staff_holiday_id}" class="flat input" name="table_records" id="staffCheck_${v.employee_id}"><i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display:none;"  id="loading_check_${v.employee_id}"></i></td>`;

						strTable +=
							'<td  valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="' +
							window.location.origin +
							'/files/images/employee_images/' +
							v.picture +
							'" alt="..." width="50" class="pfl_ctna"></div></td>';
						// strTable +=
						// 	'<td width="9%" valign="top">' +
						// 	response['data'][i]['employee_code'] +
						// 	'</td>';
						strTable += '<td valign="top"><b>' + v.fullname;
						('</td>');

						strTable += '<td valign="top">' + v.department + '</td>';
						strTable += '<td valign="top">' + empType + '</td>';
						strTable += '<td valign="top">' + jobTitle + '</td>';
						// strTable += '<td valign="top">' + status(v.status) + '</td>';
						// strTable +=
						// 	'<td valign="top"><a href="' +
						// 	base_url +
						// 	'employee_info?id=' +
						// 	v.employee_id +
						// 	'"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;<!--<a href="' +
						// 	base_url +
						// 	'edit_employee?id=' +
						// 	v.employee_id +
						// 	'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee"></i></a>-->&nbsp;&nbsp; <a class="delete_employee" style="cursor: pointer;" id="emp_' +
						// 	v.employee_id +
						// 	'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee info"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' + v.employee_id + '">';
						strTable +=
							'<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="6">No record found</td></tr>';
				}

				$('#employeeData').html(strTable);
				$('#employeeData').show();
				$('#list_workShift_loader').hide();
				$('#list_workShift_table').show();
				$('#check-all').attr('checked', true);

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						var serial;
						if (page == 1) {
							serial = 1;
						} else {
							serial = 1 + (page - 1) * limit;
						}

						list_of_companies_employeesy(page, holiday_id);
						$('html, body').animate({ scrollTop: 0 }, 'slow');
					},
				});
			} else if (response.status == '400') {
				// $('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="6">No result</td>';
				strTable += '</tr>';

				$('#employeeData').html(strTable);
				$('#employeeData').show();
				$('#list_workShift_loader').hide();
				$('#list_workShift_table').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				// $('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="6">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#employeeData').html(strTable);
				$('#employeeData').show();
				$('#list_workShift_loader').hide();
				$('#list_workShift_table').show();
			}

			$('#loading').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="6"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#employeeData').html(strTable);
			$('#employeeData').show();
			// $('#loading').hide();
			$('#list_workShift_loader').hide();
			$('#list_workShift_table').show();
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
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['position_id'] +
					'">' +
					response['data'][i]['position_name'] +
					'</option>';
			});
			$('#position').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

function load_department() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_departments',
		type: 'POST',
		data: { page: 1, limit: 100 },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
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
		},
	});
}

function checkAll(bx) {
	var cbs = document.getElementsByClassName('input');
	for (var i = 0; i < cbs.length; i++) {
		if (cbs[i].type == 'checkbox') {
			cbs[i].checked = bx.checked;
		}
	}
}

function onCLose() {
	$('.sw-btn-next').attr('disabled', false);
	$('.done_button_ada').attr('disabled', false);
	// $('#holiday_name').val('');
	// $('#holiday_date').val('');
	$('#add_holiday').attr('disabled', true);
}

function add_company_holiday() {
	var holiday_name = $('#holiday_name').val();
	var holiday_date = $('#holiday_date').val();
	var company_id = localStorage.getItem('company_id');
	// let allIn = [];

	// $('.input').map((i, v) => {
	// 	if ($(v).is(':checked')) {
	// 		let eachOfThem = $(v).val();
	// 		allIn.push({
	// 			employee_id: eachOfThem,
	// 		});
	// 	}
	// });

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
				localStorage.setItem('holiday_id', response.holiday_id);
				list_of_companies_employeesy('', response.holiday_id);
				$('#holiday_its').attr('dir', response.holiday_id);
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					// onClose: window.location.reload(),
					onClose: onCLose(),
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

function update_holiday_employee(emp_id, staff_id) {
	var company_id = localStorage.getItem('company_id');
	let is_checked;

	if ($(`#staffCheck_${emp_id}`).is(':checked')) {
		// alert('checked');
		is_checked = 1;
	} else {
		// alert('not checked');
		is_checked = 0;
	}

	$(`#staffCheck_${emp_id}`).hide();
	$(`#loading_check_${emp_id}`).show();

	$.ajax({
		type: 'PUT',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/remove_staff_from_list',
		data: {
			employee_id: emp_id,
			is_checked: is_checked,
			staff_holiday_id: staff_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// localStorage.setItem('holiday_id', response.holiday_id);
				// list_of_companies_employeesy('', '', '', response.holiday_id);
				// Swal.fire({
				// 	title: 'Success',
				// 	text: `Success`,
				// 	icon: 'success',
				// 	confirmButtonText: 'Okay',
				// 	// onClose: window.location.reload(),
				// 	onClose: onCLose(),
				// });
			} else if (response.status == '400') {
				// coder error message

				// $('#error_holiday').html('Technical Error. Please try again later.');
				if (is_checked === 1) {
					$(`#staffCheck_${emp_id}`).attr('checked', false);
				} else {
					$(`#staffCheck_${emp_id}`).attr('checked', true);
				}
			} else if (response.status == '401') {
				//user error message

				// $('#error_holiday').html(response.msg);
				if (is_checked === 1) {
					$(`#staffCheck_${emp_id}`).attr('checked', false);
				} else {
					$(`#staffCheck_${emp_id}`).attr('checked', true);
				}
			}
			$(`#loading_check_${emp_id}`).hide();
			$(`#staffCheck_${emp_id}`).show();
		},

		error: function(response) {
			$(`#loading_check_${emp_id}`).hide();
			$(`#staffCheck_${emp_id}`).show();
			// alert(is_checked);
			// $('#error_holiday').html('Connection Error.');
			if (is_checked === 1) {
				$(`#staffCheck_${emp_id}`).attr('checked', false);
			}
			if (is_checked === 0) {
				$(`#staffCheck_${emp_id}`).attr('checked', true);
			}
		},
	});
}
