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

	$('#add_department').on('click', department);
	$('#add_hod').on('click', HOD);
	$('#add_dept').on('click', add_company_department);

	$(document).on('click', '.delete_deparment', function() {
		var department_id = $(this).attr('id').replace(/dep_/, ''); // table row ID
		delete_deparment(department_id);
	});
	$('#hod_name').on('keyup', () => {
		let input = $('#hod_name').val();
		if (input.length >= 2) {
			getEmployeeList(input);
		}
	});

	$('#editHod').on('hide.bs.modal', function() {
		$('#hod_display').toggle();
		$('.required_hod').val('');
	});
	// const inputT = document.querySelector('#hod_name');
	// inputT.addEventListener('input', debounce(getEmployeeList, 5000));
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		list_of_departments('');
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

$('#hod_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#hod_to').datepicker({
	dateFormat: 'yy-mm-dd',
});

function add_company_department() {
	var department_name = $('#department_name').val();
	var department_description = $('#department_description').val();
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
		$('#error_dept').html('You have a blank field');

		return;
	}

	$('#add_dept').hide();
	$('#dept_loading').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/add_company_department',
		data: {
			department_name: department_name,
			department_description: department_description,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// $('#modal_department').modal('show');

				// $('#modal_department').on('hidden.bs.modal', function() {
				// 	// do something…
				// 	$('#department_display').hide();
				// 	window.location.reload();
				// 	//window.location.href = base_url+"/erp/hrm/employees";
				// });
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: window.location.reload(),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_dept').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_dept').html(response.msg);
			}

			$('#add_dept').show();
			$('#dept_loading').hide();
		},

		error: function(response) {
			$('#add_dept').show();
			$('#dept_loading').hide();
			$('#error_dept').html('Connection Error.');
		},
	});
}

function delete_deparment(department_id) {
	var company_id = localStorage.getItem('company_id');
	var ans = confirm('Are you sure you want to delete this department?');

	if (!ans) {
		return;
	}
	// $('#delete_modal_position').modal('show');

	$('#row_' + department_id).hide();
	$('#loader_row_' + department_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_company_department',
		data: { department_id: department_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + department_id).hide();
			$('#row_' + department_id).show();

			alert('connection error');
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
					onClose: list_of_departments(''),
				});
			} else if (response.status == '401') {
			}

			$('#loader_row_' + department_id).hide();
		},
	});
}

function list_of_departments(page) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 10;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_departments',
		data: { page: page, limit: limit },
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
						strTable += '<tr id="row_' + response['data'][i]['department_id'] + '">';
						// strTable += '<td>'+response['data'][i]['department_code']+'</td>';
						strTable += '<td>' + response['data'][i]['department_name'] + '</td>';
						// strTable += `<td>${v.hod}</td>`;
						// strTable += '<td>Pending</td>';
						strTable +=
							'<td><a href="' +
							base_url +
							'edit_department?id=' +
							response['data'][i]['department_id'] +
							'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Position"></i></a>&nbsp;&nbsp; <a class="delete_deparment" style="cursor: pointer;" id="dep_' +
							response['data'][i]['department_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Position"></i></a></td>';

						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['department_id'] +
							'">';
						strTable +=
							'<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="4">No record found</td></tr>';
				}
				if (response.total_rows) {
					$('#pagination').twbsPagination({
						totalPages: Math.ceil(response.total_rows / limit),
						visiblePages: 10,
						onPageClick: function(event, page) {
							list_of_departments(page);
						},
					});
				}
				$('#departmentData').html(strTable);
				$('#departmentData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#departmentData').html(strTable);
				$('#departmentData').show();
			}
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}

function department() {
	$('#department_display').toggle();
	$('#department_description').val('');
	$('#department_name').val('');
	$('#error_dept').hide();
}

function HOD() {
	$('#hod_display').toggle();
}

// function setId(id) {

// }

function list_Hods(dept_id) {
	let company_id = localStorage.getItem('company_id');
	$('#hod_list_loader').show();
	$('#hodTable').hide();
	axios
		.get(`${api_path}hrm/list_dept_hod`, {
			params: {
				department_id: dept_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// console.log('res', response);
			let hodTable;
			$(response.data.data).map((i, v) => {
				hodTable += `<tr>`;
				hodTable += `<td>${v.employee_name}</td>`;
				hodTable += `<td>${v.start_date}</td>`;
				hodTable += `<td>${v.end_date}</td>`;
				hodTable += `</tr>`;
			});
			$('#hod_list').html(hodTable);
			$('#hod_list_loader').hide();
			$('#hodTable').show();
		})
		.catch(function(error) {
			console.log(error);
			$('#hod_list').html(`<tr><td colspan="3" style="color:red;">Error</td></tr>`);
			$('#hod_list_loader').hide();
			$('#hodTable').show();
		})
		.then(function() {
			// always executed
		});
}

function getEmployeeList(param) {
	// let param = $('#hod_name').val();
	let company_id = localStorage.getItem('company_id');

	axios
		.get(`${api_path}hrm/search_staff_autocomplete`, {
			params: {
				query_param: param,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// console.log('res', response);
			let emList = '';
			$(response.data.data).map((i, v) => {
				emList += `<li><a class="dropdown-item" onClick="pickOption('${v.lastname} ${v.firstname} ${v.middlename}',${v.employee_id})">${v.lastname} ${v.firstname} ${v.middlename}</a></li>`;
			});
			$('#emp_list').html(emList);
			$('#emp_list').addClass('show');
		})
		.catch(function(error) {
			console.log(error);
			$('#emp_list').html(`<em>Error loading data</em>`);
		})
		.then(function() {
			// always executed
		});
}

function pickOption(name, id) {
	$('#hod_name').val(name);
	$('#hod_name').attr('data', id);
	$('#emp_list').removeClass('show');
}

function add_Hod() {
	axios
		.post('/user', {
			firstName: 'Fred',
			lastName: 'Flintstone',
		})
		.then(function(response) {
			console.log(response);
		})
		.catch(function(error) {
			console.log(error);
		});
}

function debounce(func, delay = 1000) {
	let timeoutId;
	return (...args) => {
		if (timeoutId) {
			clearTimeout(timeoutId);
		}
		timeoutId = setTimeout(() => {
			func.apply(null, args);
		}, delay);
	};
}

let root = document.querySelector('#emp_list');
document.addEventListener('click', (event) => {
	if (!root.contains(event.target)) {
		$('#emp_list').removeClass('show');
	}
});
