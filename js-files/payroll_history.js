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

	$('input#payperiod_filter').daterangepicker({
		autoUpdateInput: false,
	});

	$('input#payperiod_filter').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(
			picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'),
		);
	});

	$('#filter_run').on('click', () => {
		listPayHistory(1);
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();
	if (pack_list.indexOf('-5-') >= 0) {
		if (
			role_list.indexOf('-69-') >= 0 ||
			role_list.indexOf('-68-') >= 0 ||
			role_list.indexOf('-70-') >= 0 ||
			role_list.indexOf('-72-') >= 0 ||
			role_list.indexOf('-71-') >= 0
		) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			listPayHistory(1);
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
	}
}

function listPayHistory(page) {
	let company_id = localStorage.getItem('company_id');
	$('#list_sche_table').hide();
	$('#list_sche_loader').show();
	let limit = 10;
	let status = $('#status_filter').val();
	let payPeriod = $('#payperiod_filter').val();
	let name = $('#name_filter').val();

	axios
		.get(`${api_path}hrm/get_all_pay_run`, {
			params: {
				only_active: status,
				limit: limit,
				date_range: payPeriod,
				name: name,
				page: page,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let sche_list = '';
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					let start;
					let end;
					if (v.pay_period_start == null) {
						start = '0000-00-00';
					} else {
						start = v.pay_period_start;
					}
					if (v.pay_period_end == null) {
						end = '0000-00-00';
					} else {
						end = v.pay_period_end;
					}
					let status;
					if (v.is_pay_run_active === 'active') {
						status = 'Active';
					} else if (v.is_pay_run_active === 'approve') {
						status = 'Approved';
					} else if (v.is_pay_run_active === 'inactive') {
						status = 'Inactive';
					}
					sche_list += `<tr class="even pointer" data-type="${v.pay_schedule_id}" id="pay_row${v.pay_run_id}">`;
					sche_list += `<td><a href="payrun?id=${v.pay_run_id}" style="color:green !important;">${v.schedule_name}</a><p style="color:#73879C;font-size:0.8em; font-weight:lighter;">${
						!v.pay_run_name ? 'No Entry' :
						v.pay_run_name} (${v.no_of_employee})</p> </td>`;
					// sche_list += `<td>${v.nxt_kin_relationship}</td>`;
					sche_list += `<td>${start} - ${end}</td>`;
					sche_list += `<td>${status}</td>`;
					let role_list = $('#does_user_have_roles').html();
					if (v.is_pay_run_active === 'approve') {
						sche_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">`;
						if (role_list.indexOf('-71-') >= 0) {
							sche_list += `<li onClick="deletePayRun(${v.pay_run_id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>`;
						} else {
							sche_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>`;
						}

						if (role_list.indexOf('-68-') >= 0 || role_list.indexOf('-72-') >= 0) {
							sche_list += `<li onClick="downloadPayhistory(${v.pay_run_id})">
									<a class="dropdown-item">
										<i class="fa fa-download"></i> Download
									</a>
								</li>`;
						} else {
							sche_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-download"></i> Download
									</a>
								</li>`;
						}

						sche_list += `</ul></div></td>`;
					} else {
						sche_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">`;
						if (role_list.indexOf('-71-') >= 0) {
							sche_list += `<li onClick="deletePayRun(${v.pay_run_id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>`;
						} else {
							sche_list += `<li onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>`;
						}

						sche_list += `</ul></div></td>`;
					}
					// if (role_list.indexOf('-71-') >= 0) {
					// 	if (v.is_pay_run_active === 'approve') {
					// 		sche_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<!--<li onClick="listSPayrun(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>-->
					// 			<li onClick="deletePayRun(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-trash" /> Delete
					// 				</a>
					// 			</li>
					// 			<li onClick="downloadPayhistory(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-download"></i> Download
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					// 	} else {
					// 		sche_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<!--<li onClick="listSPayrun(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>-->
					// 			<li onClick="deletePayRun(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-trash" /> Delete
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					// 	}
					// } else {
					// 	if (v.is_pay_run_active === 'approve') {
					// 		sche_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<!--<li onClick="listSPayrun(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>-->

					// 			<li onClick="downloadPayhistory(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-download"></i> Download
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					// 	} else {
					// 		sche_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<!--<li onClick="listSPayrun(${v.pay_run_id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>-->

					// 		</ul>
					// 	</div></td>`;
					// 	}
					// }

					sche_list += `</tr>`;
					sche_list += `<tr id="pay_loader${v.pay_run_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_sche_body').html(sche_list);
				$('#list_sche_loader').hide();
				$('#list_sche_table').show();
			} else {
				$('#list_sche_body').html(`<tr><td colspan="4">No record found</td></tr>`);
				$('#list_sche_loader').hide();
				$('#list_sche_table').show();
			}

			if (response.data.total_rows && response.data.total_rows !== '0') {
				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.data.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						listPayHistory(page);
					},
				});
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_sche_loader').hide();
			$('#list_sche_table').show();
			$('#list_sche_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function denied() {
	toastr.error('Access Denied');
}

function deletePayRun(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#pay_row${id}`).hide();
		$(`#pay_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let idt = $(`#pay_row${id}`).attr('data-type');

		let data = {
			pay_run_id: id,
			pay_schedule_id: idt,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_pay_record`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#pay_loader${id}`).hide();
				$(`#pay_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#pay_row${id}`).remove();
					$(`#pay_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
						onClose: listPayHistory(1),
					});
				}
			},
		});
	}
}

function listSPayrun(id) {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	$('#edit_sPayrun_modal').modal('show');

	$('#list_sPayrun_table').hide();
	$('#list_sPayrun_loader').show();
	axios
		.get(`${api_path}hrm/single_pay_run`, {
			params: {
				pay_run_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let nok_list;
			const { employee } = response.data.data;
			if (employee.length > 0) {
				$(employee).map((i, v) => {
					nok_list += `<tr class="even pointer" id="spay_row${v.employee_id}">`;
					nok_list += `<td class="a-center "><input type="checkbox" checked value="${v.employee_id}" class="flat inputr" name="table_records"></td>`;
					// nok_list += `<td>${v.nxt_kin_relationship}</td>`;
					nok_list += `<td>${v.fullname}</td>`;
					nok_list += `<td>${v.department}</td>`;
					nok_list += `<td>${v.job_title}</td>`;
					nok_list += `</tr>`;
					nok_list += `<tr id="spay_loader${v.employee_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_sPayrun_body').html(nok_list);
				$('#list_sPayrun_loader').hide();
				$('#list_sPayrun_table').show();
			} else {
				$('#list_sPayrun_body').html(`<tr><td colspan="4">No record found</td></tr>`);
				$('#list_sPayrun_loader').hide();
				$('#list_sPayrun_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#list_sPayrun_loader').hide();
			$('#list_sPayrun_table').show();
			$('#list_sPayrun_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);
		})
		.then(function() {
			// always executed
		});
}

function downloadPayhistory(id) {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];

	axios
		.get(`${api_path}hrm/download_payrun`, {
			params: {
				pay_run_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			if (response.data.status === 200) {
				window.open(response.data.download_link, '_blank');
			} else {
				Swal.fire({
					title: 'Error!',
					text: `${response.data.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}
		})
		.catch(function(error) {
			console.log(error);
			Swal.fire({
				title: 'Error!',
				text: `Error downloading file`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		})
		.then(function() {
			// always executed
		});
}
