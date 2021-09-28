$(document).ready(function() {
	fetch_department_details();
	$('#edit_dept').on('click', edit_company_department);

	$('#hod_name').on('keyup', () => {
		let input = $('#hod_name').val();
		if (input.length >= 2) {
			getEmployeeList(input, '#emp_list');
		}
	});

	$('#edit_HOD_name').on('keyup', () => {
		let input = $('#edit_HOD_name').val();
		if (input.length >= 2) {
			getEmployeeList(input, '#emp_list2');
		}
	});

	$('#add_hod').on('click', () => {
		$('#hod_display').toggle();
	});

	$('#add_hode_btn').on('click', () => {
		if (isEmptyInput('.required_hod')) {
			addHODE();
		}
	});
	$('#edit_HOD_btn').on('click', () => {
		editHOD();
	});

	list_Hods();
});

$('#hod_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#hod_to').datepicker({
	dateFormat: 'yy-mm-dd',
});
$('#edit_HOD_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#edit_HOD_to').datepicker({
	dateFormat: 'yy-mm-dd',
});

function fetch_department_details() {
	// var pathArray = window.location.pathname.split( '/' );
	var department_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/fetch_company_department_byID',
		data: { department_id: department_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$.each(response['data'], function(i, v) {
					$('#department_name').val(response['data'][i]['department_name']);
					$('#department_description').val(response['data'][i]['department_description']);
					$('#hod').val(response['data'][i]['hod']);
				});
			}
		},

		error: function(response) {
			alert('Connection Error.');
		},
	});
}

function edit_company_department() {
	var department_name = $('#department_name').val();
	var department_description = $('#department_description').val();
	let hod = $('#hod').val();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var department_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
		$('#error_edit_department').html('You have a blank field');

		return;
	}

	$('#edit_dept').hide();
	$('#edit_dept_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_department',
		data: {
			department_name: department_name,
			department_description: department_description,

			department_id: department_id,
			hod: hod,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// $('#modal_department_edit').modal('show');

				// $('#modal_department_edit').on('hidden.bs.modal', function() {
				// 	$('#department_name').val();
				// 	$('#department_description').val();
				// 	// window.location.reload();
				// 	window.location.href = base_url + 'departments';
				// });
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: (window.location.href = base_url + 'departments'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_edit_department').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_edit_department').html(response.msg);
			}

			$('#edit_dept').show();
			$('#edit_dept_loader').hide();
		},

		error: function(response) {
			$('#edit_dept').show();
			$('#edit_dept_loader').hide();
			$('#error_edit_department').html('Connection Error.');
		},
	});
}

function getEmployeeList(param, placement) {
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
			$(placement).html(emList);
			$(placement).addClass('show');
		})
		.catch(function(error) {
			console.log(error);
			$(placement).html(`<em>Error loading data</em>`);
		})
		.then(function() {
			// always executed
		});
}

function pickOption(name, id) {
	if ($('#edit_HOD_modal').hasClass('show')) {
		$('#edit_HOD_name').val(name);
		$('#edit_HOD_name').attr('data', id);
		$('#emp_list2').removeClass('show');
	} else {
		$('#hod_name').val(name);
		$('#hod_name').attr('data', id);
		$('#emp_list').removeClass('show');
	}
}

let root = document.querySelector('#emp_list');
document.addEventListener('click', (event) => {
	if (!root.contains(event.target)) {
		$('#emp_list').removeClass('show');
	}
});

let root2 = document.querySelector('#emp_list2');
document.addEventListener('click', (event) => {
	if (!root.contains(event.target)) {
		$('#emp_list2').removeClass('show');
	}
});

function addHODE() {
	let company_id = localStorage.getItem('company_id');
	let department_id = $.urlParam('id');

	let start_date = $('#hod_from').val();
	let end_date = $('#hod_to').val();
	if (document.querySelector('#hod_name').attributes.data === undefined) {
		Swal.fire({
			title: 'Caution!',
			text: `HOD Name selected does not exist on the system`,
			icon: 'warning',
			confirmButtonText: 'Close',
			onClose: $('#hod_name').val(''),
		});
		return;
	}
	let employee_id = document.querySelector('#hod_name').attributes.data.value;

	$('#add_hode_btn').hide();
	$('#add_hode_loader').show();

	let data = {
		employee_id: employee_id,
		department_id: department_id,
		start_date: start_date,
		end_date: end_date,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_department_hod`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_hode_loader').hide();
			$('#add_hode_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_hode_loader').hide();
				$('#add_hode_btn').show();

				$('#mod_body').html('HOD creation successful');
				$('#successModal').modal('show');
				$('#hod_name').val('');
				$('#hod_from').val('');
				$('#hod_to').val('');
				$('#hod_display').toggle();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_Hods(),
				});
			}
		},
	});
}

function list_Hods() {
	let dept_id = $.urlParam('id');
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
			console.log('res status', response.data.msg);
			if (response.data.msg == 'No Record(s)') {
				$('#hod_list').html('<tr><td colspan="4">No record</td></tr>');
				$('#hod_list_loader').hide();
				$('#hodTable').show();
			} else {
				let hodTable;
				$(response.data.data).map((i, v) => {
					let start;
					let end;
					if (v.end_date === '0000-00-00 00:00:00') {
						end = '';
					} else {
						end = moment(v.end_date, 'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY');
					}

					if (v.start_date === '0000-00-00 00:00:00') {
						start = '';
					} else {
						start = moment(v.start_date, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}
					hodTable += `<tr id="HOD_row${v.dept_hod_id}">`;
					hodTable += `<td>${v.employee_name} <span class="greent_${i}_trial"></span></td>`;
					hodTable += `<td>${start}</td>`;
					hodTable += `<td>${end}</td>`;
					hodTable += `<td><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Position" onClick="viewHOD(${v.dept_hod_id}, ${v.employee_id})"></i>  <i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Position" onClick="deleteHOD(${v.dept_hod_id}, ${v.employee_id})"></i></td>`;

					hodTable += `</tr>`;
					hodTable += `<tr id="HOD_loader${v.dept_hod_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#hod_list').html(hodTable);
				$('#hod_list_loader').hide();
				$('#hodTable').show();
			}
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

function viewHOD(id, employee_id) {
	$('#edit_HOD_error').html('');
	$('#edit_HOD_modal').modal('show');
	$('#edit_HOD_btn').hide();
	$('#edit_HOD_loader').show();

	let company_id = localStorage.getItem('company_id');
	let department_id = $.urlParam('id');

	axios
		.get(`${api_path}hrm/view_single_tenure`, {
			params: {
				dept_hod_id: id,
				employee_id: employee_id,

				department_id: department_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_HOD_loader').hide();
			$('#edit_HOD_btn').show();

			let { employee_id, employee_name, start_date, end_date } = response.data.data;
			let start;
			let end;
			if (start_date == '0000-00-00 00:00:00') {
				start = '';
			} else {
				start = moment(start_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
			}

			if (end_date == '0000-00-00 00:00:00') {
				end = '';
			} else {
				end = moment(end_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
			}

			$('#edit_HOD_name').val(employee_name);
			$('#edit_HOD_name').attr('data', employee_id);
			$('#edit_HOD_from').val(start);
			$('#edit_HOD_to').val(end);
			$('#edit_HOD_btn').attr('data-id', employee_id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_HOD_loader').hide();
			$('#edit_HOD_btn').show();

			$('#edit_HOD_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editHOD() {
	let id = $('#edit_HOD_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let department_id = $.urlParam('id');
	$('#edit_HOD_btn').hide();
	$('#edit_HOD_loader').show();

	let name = $('#edit_HOD_name').val();
	let from = $('#edit_HOD_from').val();
	let to = $('#edit_HOD_to').val();

	let data = {
		employee_id: id,
		department_id: department_id,
		enddate: to,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/hod_end_tenure`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_HOD_loader').hide();
			$('#edit_HOD_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_HOD_loader').hide();
				$('#edit_HOD_btn').show();

				$('#edit_HOD_modal').modal('hide');

				// $('#mod_body').html('Head Of Department Edit Successful');
				// $('#modal_department_edit').modal('show');
				// list_Hods();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_Hods(),
				});
			}
		},
	});
}

function deleteHOD(id, employee_id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#HOD_row${id}`).hide();
		$(`#HOD_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		// let employee_id = $.urlParam('id');

		let data = {
			dept_hod_id: id,
			employee_id: employee_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/remove_hod`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#HOD_loader${id}`).hide();
				$(`#HOD_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#HOD_row${id}`).remove();
					$(`#HOD_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
						// onClose: list_Hods(),
					});
				}
			},
		});
	}
}

function isEmptyInput(first) {
	let isEmpty = false;
	$(first).each(function() {
		var input = $.trim($(this).val());
		if (input.length === 0 || input === '0') {
			$(this).addClass('has-error');
			isEmpty = true;
		} else {
			$(this).removeClass('has-error');
			// isEmpty = false;
		}
	});
	if (isEmpty === true) {
		return false;
	} else {
		return true;
	}
}
