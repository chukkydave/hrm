$(document).ready(() => {
	listPayrollType();
	listPaymentType();
	$('#add_payroll_btn').on('click', () => {
		if (isEmptyInput('.add_payroll_fields')) {
			addPayrollType();
		}
	});

	$('#add_payment_btn').on('click', () => {
		if (isEmptyInput('.add_payment_fields')) {
			addPaymentType();
		}
	});

	$('#edit_payroll_btn').on('click', () => {
		editPayrollType();
	});
	$('#edit_payment_btn').on('click', () => {
		editPaymentType();
	});
});

//payroll_type start
function addPayrollType() {
	let company_id = localStorage.getItem('company_id');

	$('#add_payroll_btn').hide();
	$('#add_payroll_loader').show();

	let name = $('#payroll_name').val();
	let desc = $('#payroll_desc').val();

	let data = {
		company_id: company_id,
		payroll_name: name,
		payroll_desc: desc,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_payroll_settings`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_payroll_loader').hide();
			$('#add_payroll_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_payroll_loader').hide();
				$('#add_payroll_btn').show();

				$('#mod_body').html('Payroll Type creation successful');
				$('#successModal').modal('show');
				$('#payroll_name').val('');
				$('#payroll_desc').val('');

				$('#collapseExample3').removeClass('in');
				listPayrollType();
			}
		},
	});
}

function listPayrollType() {
	let company_id = localStorage.getItem('company_id');
	$('#list_payroll_table').hide();
	$('#list_payroll_loader').show();
	axios
		.get(`${api_path}hrm/get_payroll_settings`, {
			params: {
				company_id: company_id,
			},
		})
		.then(function(response) {
			let payroll_list;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					payroll_list += `<tr class="even pointer" id="payroll_row${v.payroll_setting_id}">`;
					payroll_list += `<td>${v.payroll_setting_name}</td>`;
					payroll_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li onClick="viewPayrollType(${v.payroll_setting_id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> Edit
									</a>
								</li>
								<li onClick="deletePayrollType(${v.payroll_setting_id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>
							</ul>
						</div></td>`;
					payroll_list += `</tr>`;
					payroll_list += `<tr id="payroll_loader${v.payroll_setting_id}" style="display:none;"><td colspan="2"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_payroll_body').html(payroll_list);
				$('#list_payroll_loader').hide();
				$('#list_payroll_table').show();
			} else {
				$('#list_payroll_body').html(`<tr><td colspan="2">No record</td></tr>`);
				$('#list_payroll_loader').hide();
				$('#list_payroll_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#list_payroll_loader').hide();
			$('#list_payroll_table').show();
			$('#list_payroll_body').html(`<tr><td colspan="2" style="color:red;">Error</td></tr>`);
			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewPayrollType(id) {
	$('#edit_payroll_error').html('');
	$('#edit_payroll_modal').modal('show');
	$('#edit_payroll_btn').hide();
	$('#edit_payroll_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/get_single_payroll_setting`, {
			params: {
				payroll_setting_id: id,
				company_id: company_id,
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_payroll_loader').hide();
			$('#edit_payroll_btn').show();

			let { payroll_setting_name, payroll_setting_description } = response.data.data;
			$('#edit_payroll_name').val(payroll_setting_name);
			$('#edit_payroll_desc').val(payroll_setting_description);

			$('#edit_payroll_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_payroll_loader').hide();
			$('#edit_payroll_btn').show();

			$('#edit_payroll_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editPayrollType() {
	let id = $('#edit_payroll_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	$('#edit_payroll_btn').hide();
	$('#edit_payroll_loader').show();

	let name = $('#edit_payroll_name').val();
	let desc = $('#edit_payroll_desc').val();

	let data = {
		payroll_name: name,
		payroll_desc: desc,
		company_id: company_id,
		payroll_setting_id: id,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_single_payroll_setting`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_payroll_loader').hide();
			$('#edit_payroll_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_payroll_loader').hide();
				$('#edit_payroll_btn').show();

				$('#edit_payroll_modal').modal('hide');

				$('#mod_body').html('Payroll Type Edit Successful');
				$('#successModal').modal('show');
				listPayrollType();
			}
		},
	});
}

function deletePayrollType(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#payroll_row${id}`).hide();
		$(`#payroll_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			payroll_setting_id: id,
			company_id: company_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_single_payroll_setting`,
			data: data,

			error: function(res) {
				console.log(res);
				$(`#payroll_loader${id}`).hide();
				$(`#payroll_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#payroll_row${id}`).remove();
					$(`#payroll_loader${id}`).remove();
				}
			},
		});
	}
}
//payroll_type end

//payment_type start
function addPaymentType() {
	let company_id = localStorage.getItem('company_id');

	$('#add_payment_btn').hide();
	$('#add_payment_loader').show();

	let name = $('#payment_name').val();

	let data = {
		company_id: company_id,
		payment_type: name,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_payroll_payment_type`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_payment_loader').hide();
			$('#add_payment_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_payment_loader').hide();
				$('#add_payment_btn').show();

				$('#mod_body').html('Payment Type creation successful');
				$('#successModal').modal('show');
				$('#payment_name').val('');

				$('#collapseExample4').removeClass('in');
				listPaymentType();
			}
		},
	});
}

function listPaymentType() {
	let company_id = localStorage.getItem('company_id');
	$('#list_payment_table').hide();
	$('#list_payment_loader').show();
	axios
		.get(`${api_path}hrm/get_company_payroll_payment_type`, {
			params: {
				company_id: company_id,
			},
		})
		.then(function(response) {
			let payment_list;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					payment_list += `<tr class="even pointer" id="payment_row${v.pay_type_id}">`;
					payment_list += `<td>${v.payment_type}</td>`;
					payment_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li onClick="viewPaymentType(${v.pay_type_id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> Edit
									</a>
								</li>
								<li onClick="deletePaymentType(${v.pay_type_id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>
							</ul>
						</div></td>`;
					payment_list += `</tr>`;
					payment_list += `<tr id="payment_loader${v.pay_type_id}" style="display:none;"><td colspan="2"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_payment_body').html(payment_list);
				$('#list_payment_loader').hide();
				$('#list_payment_table').show();
			} else {
				$('#list_payment_body').html(`<tr><td colspan="2">No record</td></tr>`);
				$('#list_payment_loader').hide();
				$('#list_payment_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#list_payment_loader').hide();
			$('#list_payment_table').show();
			$('#list_payment_body').html(`<tr><td colspan="2" style="color:red;">Error</td></tr>`);
			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewPaymentType(id) {
	$('#edit_payment_error').html('');
	$('#edit_payment_modal').modal('show');
	$('#edit_payment_btn').hide();
	$('#edit_payment_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/get_single_payroll_payment_type`, {
			params: {
				pay_type_id: id,
				company_id: company_id,
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_payment_loader').hide();
			$('#edit_payment_btn').show();

			let { payment_type } = response.data.data;
			$('#edit_payment_name').val(payment_type);

			$('#edit_payment_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_payment_loader').hide();
			$('#edit_payment_btn').show();

			$('#edit_payment_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editPaymentType() {
	let id = $('#edit_payment_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	$('#edit_payment_btn').hide();
	$('#edit_payment_loader').show();

	let name = $('#edit_payment_name').val();

	let data = {
		payment_type: name,
		company_id: company_id,
		pay_type_id: id,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/edit_payroll_payment_type`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_payment_loader').hide();
			$('#edit_payment_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_payment_loader').hide();
				$('#edit_payment_btn').show();

				$('#edit_payment_modal').modal('hide');

				$('#mod_body').html('Payment Type Edit Successful');
				$('#successModal').modal('show');
				listPaymentType();
			}
		},
	});
}

function deletePaymentType(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#payment_row${id}`).hide();
		$(`#payment_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			pay_type_id: id,
			company_id: company_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_company_payroll_payment_type`,
			data: data,

			error: function(res) {
				console.log(res);
				$(`#payment_loader${id}`).hide();
				$(`#payment_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#payment_row${id}`).remove();
					$(`#payment_loader${id}`).remove();
				}
			},
		});
	}
}
//payment_type end

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
