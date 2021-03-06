$(document).ready(function() {
	let totalID;
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

	$('.js-example-basic-single').select2();
	$('#add_party').on('click', addParty);
	$(document).on('click', '#filter_g', function() {
		list_of_grievance(1);
	});

	$(document).on('change', '.updateClass', function(e) {
		let role_id = $(this).attr('id').replace(/updateStatus/, '');

		var ans = confirm("Are you sure you want to Update this Record's Status?");
		if (ans) {
			updateStatus(role_id);
		} else {
			e.preventDefault();
			$(`#updateStatus${role_id}`).val(totalID);
			return false;
		}
	});

	$(document).on('click', '.updateRow', function(e) {
		let role_id = $(this).attr('id').replace(/griev_row/, '');

		totalID = $(`#updateStatus${role_id} :selected`).val();
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	if (pack_list.indexOf('-3-') >= 0) {
		if (
			role_list.indexOf('-73-') >= 0 ||
			role_list.indexOf('-74-') >= 0 ||
			role_list.indexOf('-75-') >= 0 ||
			role_list.indexOf('-76-') >= 0
		) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			list_of_grievance(1);
			load_employee();
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function list_of_grievance(page) {
	var company_id = localStorage.getItem('company_id');
	// var page = 1;
	var limit = 10;

	let greviance_code = $('#gId_filter').val();
	let status;
	if ($('#status_filter').val() == '--Status--') {
		status = '';
	} else {
		status = $('#status_filter').val();
	}
	let gr_by = $('#gBy_filter').val();
	$('#g_table').hide();
	$('#g_table_loader').show();
	$('#load').show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_employee_grievance',
		data: {
			page: page,
			limit: limit,
			greviance_status: status,
			g_code: greviance_code,
			g_by: gr_by,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#load').hide();
				if (response.data.length > 0) {
					var k = 1;
					$(response.data).each((i, v) => {
						strTable += `<tr class="updateRow" id="griev_row${v.grievance_id}">`;
						strTable += `<td>${v.g_code}</td>`;
						strTable += `<td width="8%" valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="${site_url}/files/images/employee_images/sml_
							${v.grievance_person_picture}" alt="..." width="50"></div></td>`;
						strTable += `<td>${v.grievance_person_fullname}<br>(${v.grievance_person_job_title})</td>`;

						if (
							v.g_against_employer_or_others &&
							v.g_against_employer_or_others.toLowerCase() === 'employer'
						) {
							strTable += `<td width="8%" valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="${site_url}/files/images/company_images/sml_
							${v.grievance_person_against_picture}" alt="..." width="50"></div></td>`;
							strTable += `<td>${v.grievance_person_against_fullname}<br>(Employer)</td>`;
						} else {
							strTable += `<td width="8%" valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="${site_url}/files/images/employee_images/sml_
							${v.grievance_person_against_picture}" alt="..." width="50"></div></td>`;
							strTable += `<td>${v.grievance_person_against_fullname}<br>(${v.grievance_person_against_job_title})</td>`;
						}
						strTable += `<td>${capitalizeFirstLetter(v.grievance_type)}</td>`;
						let role_list = $('#does_user_have_roles').html();
						if (role_list.indexOf('-76-') >= 0) {
							if (v.greviance_status.toLowerCase() === 'resolved') {
								strTable += `<td>${capitalizeFirstLetter(v.greviance_status)}</td>`;
							} else {
								strTable += `<td>
                                        <select class="updateClass" style="border:none; padding:5px;" id="updateStatus${v.grievance_id}">
                                            <option value="">--Status--</option>
                                            <option value="pending" ${
												v.greviance_status === 'pending' ? 'selected' :
												''}>Pending</option>
                                            <option value="in-progress" ${
												v.greviance_status === 'in-progress' ? 'selected' :
												''}>In Progress</option>
                                            <option value="on-hold" ${
												v.greviance_status === 'on-hold' ? 'selected' :
												''}>On Hold</option>
                                            <option value="resolved" ${
												v.greviance_status === 'resolved' ? 'selected' :
												''}>Resolved</option>
                                        </select>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;"
                                                id="updateStatus_loader${v.grievance_id}"></i>
                                    </td>`;
							}
						} else {
							if (v.greviance_status.toLowerCase() === 'resolved') {
								strTable += `<td>${capitalizeFirstLetter(v.greviance_status)}</td>`;
							} else {
								strTable += `<td>
                                        <select disabled style="border:none; padding:5px;" id="" onChange="denied()">
                                            <option value="">--Status--</option>
                                            <option value="pending" ${
												v.greviance_status === 'pending' ? 'selected' :
												''}>Pending</option>
                                            <option value="in-progress" ${
												v.greviance_status === 'in-progress' ? 'selected' :
												''}>In Progress</option>
                                            <option value="on-hold" ${
												v.greviance_status === 'on-hold' ? 'selected' :
												''}>On Hold</option>
                                            <option value="resolved" ${
												v.greviance_status === 'resolved' ? 'selected' :
												''}>Resolved</option>
                                        </select>
                                        
                                    </td>`;
							}
						}

						if (v.greviance_status === 'resolved') {
							strTable += `<td><div class="dropdown">
                                            <button
                                                class="btn btn-secondary dropdown-toggle"
                                                type="button"
                                                id="dropdownMenuButton1"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">`;
							if (
								role_list.indexOf('-73-') >= 0 ||
								role_list.indexOf('-74-') >= 0 ||
								role_list.indexOf('-75-') >= 0
							) {
								strTable += `<li>
                                                    <a class="dropdown-item" href="view_grievance?id=${v.grievance_id}" id="">
                                                        <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Grievance info" /> View
                                                    </a>
                                                </li>`;
							} else {
								strTable += `<li>
												<a class="dropdown-item disabledC" onClick="denied()" >
													<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Grievance info" /> View
												</a>
											</li>`;
							}
							strTable += `</ul>
                                        </div>
                                    </td>`;
						} else {
							strTable += `<td><div class="dropdown">
                                            <button
                                                class="btn btn-secondary dropdown-toggle"
                                                type="button"
                                                id="dropdownMenuButton1"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">`;

							if (
								role_list.indexOf('-73-') >= 0 ||
								role_list.indexOf('-74-') >= 0 ||
								role_list.indexOf('-76-') >= 0
							) {
								strTable += `<li>
                                                    <a class="dropdown-item" href="view_grievance?id=${v.grievance_id}" id="">
                                                        <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Grievance info" /> View
                                                    </a>
                                                </li>`;
							} else {
								strTable += `<li>
												<a class="dropdown-item disabledC" onClick="denied()" >
													<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Grievance info" /> View
												</a>
											</li>`;
							}
							if (role_list.indexOf('-73-') >= 0 || role_list.indexOf('-74-') >= 0) {
								strTable += `<li onClick="listParties(${v.grievance_id})">
                                                    <a class="dropdown-item" id="">
                                                        <i class="fa fa-pencil" data-toggle="modal" data-target="#addParty" title="Add/Remove Party"/>Add/Remove Party
                                                    </a>
                                                </li>`;
							} else {
								strTable += `<li class="disabledC" onClick="denied()">
                                                    <a class="dropdown-item" id="">
                                                        <i class="fa fa-pencil" data-toggle="modal" data-target="#addParty" title="Add/Remove Party"/>Add/Remove Party
                                                    </a>
                                                </li>`;
							}
							strTable += `</ul>
                                        </div>
                                    </td>`;
						}

						strTable += `</tr>`;
						k++;
					});
				} else {
					strTable = '<tr><td colspan="9">No record found</td></tr>';
				}

				$('#grievanceData').html(strTable);
				$('#grievanceData').show();
				$('#g_table_loader').hide();
				$('#g_table').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#load').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="8">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#grievanceData').html(strTable);
				$('#grievanceData').show();
				$('#g_table_loader').hide();
				$('#g_table').show();
			}

			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					list_of_grievance(page);
				},
			});
		},

		error: function(response) {
			var strTable = '';
			$('#load').hide();
			strTable += '<tr>';
			strTable += '<td colspan="8" class="text-danger">Connection error</td>';
			strTable += '</tr>';
			$('#grievanceData').html(strTable);
			$('#grievanceData').show();
			$('#g_table_loader').hide();
			$('#g_table').show();
		},
	});
}

function denied() {
	toastr.error('Access Denied');
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);

			var options = '<option></option>';

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});
			$('#empo_name').html(options);
			$('#gBy_filter').append(options);
			// $('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error: function(response) {
			alert('Connection error');
		},
	});
}

function addParty() {
	$('#party_error').html('');
	let company_id = localStorage.getItem('company_id');
	let id = $('#empo_name').val();
	console.log(id);

	if (id === [] || id === '' || id === '[]' || id === null) {
		$('#party_error').html('Empty fields');
		return;
	} else {
		$('#add_party').hide();
		$('#add_party_loader').show();
		let third_party = [];

		let grievance_id = $('#add_party').attr('data-id');

		id.map((one) => {
			third_party.push({ employee_id: one });
		});

		let data = {
			greviance_id: grievance_id,

			third_party: third_party,
		};
		$.ajax({
			type: 'Post',
			dataType: 'json',
			url: `${api_path}ess/create_greviance_thirdparty`,
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
				$('#add_party_loader').hide();
				$('#add_party').show();
				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$('#add_party_loader').hide();
					$('#add_party').show();
					$('#empo_name').val(null).trigger('change');
					listParties(grievance_id);
				}
			},
		});
	}
}

function listParties(greviance_id) {
	$('#party_error').html('');
	$('#addParty').modal();
	$('#add_party').attr('data-id', greviance_id);
	let company_id = localStorage.getItem('company_id');
	$('#list_party_table').hide();
	$('#list_party_loader').show();
	axios
		.get(`${api_path}ess/get_greviance_thirdparty`, {
			params: {
				greviance_id: greviance_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let party_list;

			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					party_list += `<tr class="even pointer" id="party_row${v.id}">`;
					party_list += `<td>${i + 1}</td>`;
					party_list += `<td>${v.fullname}</td>`;
					party_list += `<td><i class="fa fa-trash" onClick="deleteParty(${v.id}, ${v.greviance_id})"></i></td>`;
					party_list += `</tr>`;
					party_list += `<tr id="party_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_party_body').html(party_list);
				$('#list_party_loader').hide();
				$('#list_party_table').show();
			} else {
				$('#list_party_body').html(`<tr><td colspan="3">No record</td></tr>`);
				$('#list_party_loader').hide();
				$('#list_party_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_party_loader').hide();
			$('#list_party_table').show();
			$('#list_party_body').html(`<tr><td colspan="3" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function updateStatus(grievance_id) {
	// onChange="updateStatus(${v.grievance_id})"
	// let ans = confirm('Are you sure you want to Update this Record Status?');
	// if (ans) {
	let company_id = localStorage.getItem('company_id');

	$(`#updateStatus${grievance_id}`).hide();
	$(`#updateStatus_loader${grievance_id}`).show();

	let grievance_status = $(`#updateStatus${grievance_id}`).val();

	let data = {
		grievance_id: grievance_id,
		grievance_status: grievance_status,
	};

	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_grievance_status`,
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
			$(`#updateStatus_loader${grievance_id}`).hide();
			$(`#updateStatus${grievance_id}`).show();

			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$(`#updateStatus_loader${grievance_id}`).hide();
				$(`#updateStatus${grievance_id}`).show();

				list_of_grievance(1);
			}
		},
	});
	// }
}

function deleteParty(id, g_id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#party_row${id}`).hide();
		$(`#party_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			unique_id: id,
			greviance_id: g_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}ess/remove_greviance_thirdparty`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#party_loader${id}`).hide();
				$(`#party_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#party_row${id}`).remove();
					$(`#party_loader${id}`).remove();
				}
			},
		});
	}
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
