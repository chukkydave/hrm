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

	$('#add_termination').on('click', termination);

	$('input#dot').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('#add_terminate').on('click', add_company_termination);

	$(document).on('click', '.delete_termination', function() {
		var termination_id = $(this).attr('id').replace(/ter_/, ''); // table row ID
		delete_termination(termination_id);
	});
	$(`#add_comment_btn`).on('click', sendSchedule);
	$(`#update_comment_btn`).on('click', updateSchedule);
	$(`#add_quest_btn`).on('click', sendInterviewQuestions);

	$('#collapseEg2_btn').on('click', toggleContent2);
	$('#collapseEg_btn').on('click', toggleContent);

	$(document).on('change', '#checkall', function() {
		var checked = $(this).is(':checked');
		if (checked) {
			$('.check_ques').each(function() {
				$(this).prop('checked', true);
			});
		} else {
			$('.check_ques').each(function() {
				$(this).prop('checked', false);
			});
		}
	});

	// Changing state of CheckAll checkbox
	$(document).on('change', '.check_ques', function() {
		if ($('.check_ques').length == $('.check_ques:checked').length) {
			$('#checkall').prop('checked', true);
		} else {
			$('#checkall').prop('checked', false);
		}
	});

	$('#sel_employee').on('change', () => {
		if ($('#sel_employee').val() !== '') {
			FetchData($('#sel_employee').val());
		} else {
			$('#list_empo_details').hide();
		}
	});

	$(document).on('change', '.updateStatusClass', function(e) {
		let role_id = $(this).attr('id').replace(/updateStatus/, '');
		let emp_id = $(this).attr('data');

		// onChange="updateStatus(${v.exited_id}, ${v.employee_id})"

		var ans = confirm("Are you sure you want to Update this Record's Status?");
		if (ans) {
			updateStatus(role_id, emp_id);
		} else {
			e.preventDefault();
			$(`#updateStatus${role_id}`).val(totalID);
			return false;
		}
	});

	$(document).on('click', '.termClicky', function(e) {
		let role_id = $(this).attr('id').replace(/term_row/, '');

		totalID = $(`#updateStatus${role_id} :selected`).val();
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	if (pack_list.indexOf('-38-') >= 0) {
		if (
			role_list.indexOf('-77-') >= 0 ||
			role_list.indexOf('-78-') >= 0 ||
			role_list.indexOf('-79-') >= 0 ||
			role_list.indexOf('-80-') >= 0 ||
			role_list.indexOf('-81-') >= 0
		) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			listExitType();
			listInterviewQuestion();
			listTerminations('');
			load_employee();
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}

		if (role_list.indexOf('-78-') >= 0) {
			$('#add_termination').show();
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function list_of_terminations(page) {
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 25;

	$('#load').fadeIn(3000);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_employees_termination',
		data: {
			// company_id: company_id,
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
				$('#load').hide();

				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['termination_id'] + '">';
						strTable +=
							'<td valign="top">' + response['data'][i]['termination_code'] + '</td>';
						strTable +=
							'<td width="8%" valign="top"><div class="profile_pic"><img src="' +
							site_url +
							'/files/images/employee_images/sml_' +
							response['data'][i]['profile_picture'] +
							'" alt="..." width="50"></div></td>';
						strTable +=
							'<td width="20%" valign="top"><b>' +
							response['data'][i]['lastname'] +
							'</b>' +
							', ' +
							response['data'][i]['firstname'] +
							' ' +
							response['data'][i]['middlename'] +
							'</td>';
						strTable += '<td valign="top">' + response['data'][i]['reason'] + '</td>';
						// strTable += '<td valign="top">'+response['data'][i]['inserted_by']+'</td>';
						strTable +=
							'<td valign="top">' + response['data'][i]['notice_date'] + '</td>';
						strTable +=
							'<td valign="top">' +
							format_a_date(response['data'][i]['resignation_date']) +
							'</td>';
						strTable +=
							'<td valign="top">' +
							response['data'][i]['total_pending_termination_approvals'] +
							'/' +
							response['data'][i]['total_termination_sent_for_approvals'] +
							'</td>';
						strTable +=
							'<td valign="top"><a href="' +
							base_url +
							'view_employee_termination_details?id=' +
							response['data'][i]['termination_id'] +
							'"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style=" color: gray; font-size: 20px;" title="View Employee Leave Details"></i></a> &nbsp;&nbsp;<a  class="delete_termination" style="cursor: pointer;" id="ter_' +
							response['data'][i]['termination_id'] +
							'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Termination"></i></a></td>';
						strTable += '</tr>';

						strTable +=
							'<tr style="display: none;" id="loader_row_' +
							response['data'][i]['termination_id'] +
							'">';
						strTable +=
							'<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						strTable += '</td>';
						strTable += '</tr>';

						k++;
					});

					// <a href="'+base_url+'/erp/hrm/employee_info"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;<a href="'+base_url+'/erp/hrm/edit_employee"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee"></i></a>&nbsp;&nbsp;
				} else {
					strTable = '<tr><td colspan="9">No result</td></tr>';
				}

				// alert(response.total_rows);
				// alert(limit);

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_terminations(page);
					},
				});

				$('#terminationData').html(strTable);
				$('#terminationData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#load').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="9">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#terminationData').html(strTable);
				$('#terminationData').show();
			}
		},

		error: function(response) {
			var strTable = '';
			$('#load').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="9"><strong class="text-danger">Connection error</strong></td>';
			strTable += '</tr>';

			$('#terminationData').html(strTable);
			$('#terminationData').show();
		},
	});
}

function listTerminations(page) {
	let company_id = localStorage.getItem('company_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 25;
	$('#list_term_table').hide();
	$('#list_term_loader').show();
	axios
		.get(`${api_path}hrm/company_exited_staff`, {
			params: {
				// company_id: company_id,
				page: page,
				limit: limit,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let term_list;
			// const { employee_next_kin } = response.data.data;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					term_list += `<tr class="termClicky even pointer" id="term_row${v.exited_id}">`;
					term_list += `<td width="8%" valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="${site_url}/files/images/employee_images/sml_${v.profile_profile}" alt="..." width="50"></div></td>`;
					term_list += `<td>${v.fullname}<p style="font-size:0.75em;">${
						v.job_title !== null ? v.job_title :
						'.....'}</p></td>`;
					// term_list += `<td>${v.nxt_kin_relationship}</td>`;
					term_list += `<td>${capitalizeFirstLetter(v.exit_type_name)}</td>`;
					// term_list += `<td>${
					// 	v.employee_status === 'terminated' ? 'Exited' :
					// 	capitalizeFirstLetter(v.employee_status)}</td>`;
					let role_list = $('#does_user_have_roles').html();
					if (role_list.indexOf('-79-') >= 0) {
						term_list += `<td><select style="border:none; padding:5px;" id="updateStatus${v.exited_id}" data="${v.employee_id}" class="updateStatusClass">
                                            <option value="">--Status--</option>
                                            <option value="inactive" ${
												v.employee_status.toLowerCase() ===
												'inactive' ? 'selected' :
												''}>Inactive</option>
                                            <option value="active" ${
												v.employee_status.toLowerCase() ===
												'active' ? 'selected' :
												''}>Active</option>
                                            <option value="terminated" ${
												v.employee_status.toLowerCase() ===
												'terminated' ? 'selected' :
												''}>Exited</option>
                                            
                                        </select>
										<i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;"
                                                id="updateStatus_loader${v.exited_id}"></i>
										</td>`;
					} else {
						term_list += `<td><select disabled style="border:none; padding:5px;" id="" onChange="denied()" class="disabledC">
                                            <option value="">--Status--</option>
                                            <option value="inactive" ${
												v.employee_status.toLowerCase() ===
												'inactive' ? 'selected' :
												''}>Inactive</option>
                                            <option value="active" ${
												v.employee_status.toLowerCase() ===
												'active' ? 'selected' :
												''}>Active</option>
                                            <option value="terminated" ${
												v.employee_status.toLowerCase() ===
												'terminated' ? 'selected' :
												''}>Exited</option>
                                            
                                        </select>
										<i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;"
                                                id="updateStatus_loader${v.exited_id}"></i>
										</td>`;
					}
					term_list += `<td>${v.pre_approved}</td>`;

					if (v.employee_status.toLowerCase() === 'inactive') {
						if (v.exit_status === 'pending') {
							term_list += `<td><i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}

							// <!--<li>
							// 	<a href="correspondence?exitId=${v.exited_id}" class="dropdown-item">
							// 		<i class="fa fa-comment" /> Correspondence
							// 	</a>
							// </li>-->
							term_list += `</ul>
						</div></td>`;
						} else if (v.exit_status === 'decline') {
							term_list += `<td><i class="fa fa-times fa-2x" style="color: red"></i></td>`;
							term_list += `<td>
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

							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							// <!--<li >
							// 	<a href="correspondence?exitId=${v.exited_id}" class="dropdown-item">
							// 		<i class="fa fa-comment" /> Correspondence
							// 	</a>
							// </li>-->
							term_list += `</ul>
						</div></td>`;
						} else if (v.exit_status === 'approve') {
							term_list += `<td><i class="fa fa-check fa-2x" style="color: green"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							// <!--<li >
							// 	<a href="correspondence?exitId=${v.exited_id}" class="dropdown-item">
							// 		<i class="fa fa-comment" /> Correspondence
							// 	</a>
							// </li>-->
							term_list += `</ul>
										</div></td>`;
						}
					} else if (v.employee_status.toLowerCase() === 'active') {
						if (v.exit_status === 'pending') {
							term_list += `<td><i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								term_list += `<li >
									<a href="correspondence?exitId=${v.exited_id}&emp_id=${v.employee_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							}

							term_list += `</ul>
						</div></td>`;
						} else if (v.exit_status === 'decline') {
							term_list += `<td><i class="fa fa-times fa-2x" style="color: red"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								term_list += `<li >
									<a href="correspondence?exitId=${v.exited_id}&emp_id=${v.employee_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							}
							term_list += `</ul>
						</div></td>`;
						} else if (v.exit_status === 'approve') {
							term_list += `<td><i class="fa fa-check fa-2x" style="color: green"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								term_list += `<li >
									<a href="correspondence?exitId=${v.exited_id}&emp_id=${v.employee_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								if (v.sending_status === '0') {
									term_list += `<li onClick="bringUpModal(${v.exited_id}, ${v.employee_id})">
														<a class="dropdown-item">
															<i class="fa fa-question-circle"></i> Interview ask
														</a>
													</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '1') {
									term_list += `<li>
													<a href="view_response?ex=${v.exited_id}&em=${v.employee_id}" class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Response
													</a>
												</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '2') {
									term_list += `<li onClick="bringUpModal2(${v.exited_id}, ${v.employee_id})">
													<a class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Schedule
													</a>
												</li>
												
											</ul>
										</div></td>`;
								}
							} else {
								if (v.sending_status === '0') {
									term_list += `<li class="disabledC" onClick="denied()">
														<a class="dropdown-item">
															<i class="fa fa-question-circle"></i> Interview ask
														</a>
													</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '1') {
									term_list += `<li class="disabledC" onClick="denied()">
													<a class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Response
													</a>
												</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '2') {
									term_list += `<li class="disabledC" onClick="denied()">
													<a class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Schedule
													</a>
												</li>
												
											</ul>
										</div></td>`;
								}
							}
						}
					} else if (v.employee_status.toLowerCase() === 'terminated') {
						if (v.exit_status === 'pending') {
							term_list += `<td><i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								term_list += `<li >
									<a href="correspondence?exitId=${v.exited_id}&emp_id=${v.employee_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							}
							term_list += `</ul>
						</div></td>`;
						} else if (v.exit_status === 'decline') {
							term_list += `<td><i class="fa fa-times fa-2x" style="color: red"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								term_list += `<li >
									<a href="correspondence?exitId=${v.exited_id}&emp_id=${v.employee_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							}
							term_list += `</ul>
						</div></td>`;
						} else if (v.exit_status === 'approve') {
							term_list += `<td><i class="fa fa-check fa-2x" style="color: green"></i></td>`;
							term_list += `<td>
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
							if (
								role_list.indexOf('-79-') >= 0 ||
								role_list.indexOf('-77-') >= 0 ||
								role_list.indexOf('-81-') >= 0
							) {
								term_list += `<li onClick="viewterm(${v.exited_id})">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a href="view_exit?emp=${v.employee_id}&ex=${v.exited_id}&us=${v.user_id}&status=${v.exit_status}" class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								term_list += `<li >
									<a href="correspondence?exitId=${v.exited_id}&emp_id=${v.employee_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							} else {
								term_list += `<li class="disabledC" onClick="denied()">
									<a class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>`;
							}
							if (role_list.indexOf('-77-') >= 0 || role_list.indexOf('-81-') >= 0) {
								if (v.sending_status === '0') {
									term_list += `<li onClick="bringUpModal(${v.exited_id}, ${v.employee_id})">
														<a class="dropdown-item">
															<i class="fa fa-question-circle"></i> Interview ask
														</a>
													</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '1') {
									term_list += `<li>
													<a href="view_response?ex=${v.exited_id}&em=${v.employee_id}" class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Response
													</a>
												</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '2') {
									term_list += `<li onClick="bringUpModal2(${v.exited_id}, ${v.employee_id})">
													<a class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Schedule
													</a>
												</li>
												
											</ul>
										</div></td>`;
								}
							} else {
								if (v.sending_status === '0') {
									term_list += `<li class="disabledC" onClick="denied()">
														<a class="dropdown-item">
															<i class="fa fa-question-circle"></i> Interview ask
														</a>
													</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '1') {
									term_list += `<li class="disabledC" onClick="denied()">
													<a class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Response
													</a>
												</li>
												</ul>
											</div></td>`;
								} else if (v.sending_status === '2') {
									term_list += `<li class="disabledC" onClick="denied()">
													<a class="dropdown-item">
														<i class="fa fa-question-circle"></i> View Interview Schedule
													</a>
												</li>
												
											</ul>
										</div></td>`;
								}
							}
						}
					}

					term_list += `</tr>`;
					term_list += `<tr id="term_loader${v.exited_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_term_body').html(term_list);
				$('#list_term_loader').hide();
				$('#list_term_table').show();
			} else {
				$('#list_term_body').html(`<tr><td colspan="6">No record found</td></tr>`);
				$('#list_term_loader').hide();
				$('#list_term_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_term_loader').hide();
			$('#list_term_table').show();
			$('#list_term_body').html(`<tr><td colspan="6" style="color:red;">Error</td></tr>`);
		})
		.then(function() {
			// always executed
		});
}
function denied() {
	toastr.error('Access Denied');
}
function updateStatus(exit_id, employee_id) {
	// let ans = confirm('Are you sure you want to Update this Record Status?');
	// if (ans) {
	let company_id = localStorage.getItem('company_id');

	$(`#updateStatus${exit_id}`).hide();
	$(`#updateStatus_loader${exit_id}`).show();

	let exit_status = $(`#updateStatus${exit_id}`).val();

	let data = {
		// company_id: company_id,
		exit_id: exit_id,
		active_status: exit_status,
		employee_id: employee_id,
	};

	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/hr_sanction_exit`,
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
			$(`#updateStatus_loader${exit_id}`).hide();
			$(`#updateStatus${exit_id}`).show();

			Swal.fire({
				title: 'Error!',
				text: `${error.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$(`#updateStatus_loader${exit_id}`).hide();
				$(`#updateStatus${exit_id}`).show();
				Swal.fire({
					title: 'Success!',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
				});
				listTerminations('');
			}
		},
	});
	// }
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function add_company_termination() {
	var employee_id = $('#sel_employee').val();
	var company_id = localStorage.getItem('company_id');
	var added_by = localStorage.getItem('user_id');
	// var dot = $('#dot').val();
	var reason = $('#reason').val();
	let exit_type_id = $('#exit_ty').val();

	// alert(employee_id);
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
		$('#error').html('You have a blank field');

		return;
	}

	$('#add_terminate').hide();
	$('#termination_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/hr_exit_staff',
		data: {
			employee_id: employee_id,
			// company_id: company_id,
			// added_by: added_by,
			date_exited: null,
			exit_status: 'pending',
			exit_type_id: exit_type_id,
			reason: reason,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			// console.log(response);

			if (response.status == '200') {
				// $('#modal_termination').modal('show');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: window.location.reload(),
				});

				// $('#modal_termination').on('hidden.bs.modal', function() {
				// 	// do something…
				// 	$('#termination_display').hide();
				// 	window.location.reload();
				// 	//window.location.href = base_url+"/erp/hrm/employees";
				// });
			} else if (response.status == '400') {
				// coder error message

				$('#error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error').html('No result');
			}

			$('#add_terminate').show();
			$('#termination_loader').hide();
		},

		error: function(response) {
			$('#add_terminate').show();
			$('#termmination_loader').hide();
			$('#error').html('Connection Error.');
		},
	});
}

function delete_termination(termination_id) {
	// alert('user deleted');
	// var email = $.session.get('email');
	var company_id = localStorage.getItem('company_id');
	// alert(employee_id);

	var ans = confirm('Are you sure you want to delete this user');
	if (!ans) {
		return;
	}

	$('#row_' + termination_id).hide();
	$('#loader_row_' + termination_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/delete_employee_termination',
		data: {
			// company_id: company_id,
			termination_id: termination_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + termination_id).hide();
			$('#row_' + termination_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + termination_id).hide();
		},
	});
}

function termination() {
	$('#termination_display').toggle();
	$('#dot').val('');
	$('#employee').val('');
	$('#reason').val('');
	$('#error').html('');

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		$(this).removeClass('has-error');
	});
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
			$('#sel_employee').html(options);
			// $('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error: function(response) {
			alert('Connection error');
		},
	});
}

function init_echarts() {
	if (typeof echarts === 'undefined') {
		return;
	}

	console.log('init_echarts');

	var theme = {
		color: [
			'#26B99A',
			'#34495E',
			'#BDC3C7',
			'#3498DB',
			'#9B59B6',
			'#8abb6f',
			'#759c6a',
			'#bfd3b7',
		],

		title: {
			itemGap: 8,
			textStyle: {
				fontWeight: 'normal',
				color: '#408829',
			},
		},

		dataRange: {
			color: [
				'#1f610a',
				'#97b58d',
			],
		},

		toolbox: {
			color: [
				'#408829',
				'#408829',
				'#408829',
				'#408829',
			],
		},

		tooltip: {
			backgroundColor: 'rgba(0,0,0,0.5)',
			axisPointer: {
				type: 'line',
				lineStyle: {
					color: '#408829',
					type: 'dashed',
				},
				crossStyle: {
					color: '#408829',
				},
				shadowStyle: {
					color: 'rgba(200,200,200,0.3)',
				},
			},
		},

		dataZoom: {
			dataBackgroundColor: '#eee',
			fillerColor: 'rgba(64,136,41,0.2)',
			handleColor: '#408829',
		},
		grid: {
			borderWidth: 0,
		},

		categoryAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},

		valueAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: [
						'rgba(250,250,250,0.1)',
						'rgba(200,200,200,0.1)',
					],
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},
		timeline: {
			lineStyle: {
				color: '#408829',
			},
			controlStyle: {
				normal: {
					color: '#408829',
				},
				emphasis: {
					color: '#408829',
				},
			},
		},

		k: {
			itemStyle: {
				normal: {
					color: '#68a54a',
					color0: '#a9cba2',
					lineStyle: {
						width: 1,
						color: '#408829',
						color0: '#86b379',
					},
				},
			},
		},
		map: {
			itemStyle: {
				normal: {
					areaStyle: {
						color: '#ddd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
				emphasis: {
					areaStyle: {
						color: '#99d2dd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
			},
		},
		force: {
			itemStyle: {
				normal: {
					linkStyle: {
						strokeColor: '#408829',
					},
				},
			},
		},
		chord: {
			padding: 4,
			itemStyle: {
				normal: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
				emphasis: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
			},
		},
		gauge: {
			startAngle: 225,
			endAngle: -45,
			axisLine: {
				show: true,
				lineStyle: {
					color: [
						[
							0.2,
							'#86b379',
						],
						[
							0.8,
							'#68a54a',
						],
						[
							1,
							'#408829',
						],
					],
					width: 8,
				},
			},
			axisTick: {
				splitNumber: 10,
				length: 12,
				lineStyle: {
					color: 'auto',
				},
			},
			axisLabel: {
				textStyle: {
					color: 'auto',
				},
			},
			splitLine: {
				length: 18,
				lineStyle: {
					color: 'auto',
				},
			},
			pointer: {
				length: '90%',
				color: 'auto',
			},
			title: {
				textStyle: {
					color: '#333',
				},
			},
			detail: {
				textStyle: {
					color: 'auto',
				},
			},
		},
		textStyle: {
			fontFamily: 'Arial, Verdana, sans-serif',
		},
	};

	//echart Bar

	if ($('#mainb').length) {
		var echartBar = echarts.init(document.getElementById('mainb'), theme);

		echartBar.setOption({
			title: {
				text: 'Naira',
				subtext: '...',
			},
			tooltip: {
				trigger: 'axis',
			},
			legend: {
				data: [
					'Salary',
				],
			},
			toolbox: {
				show: false,
			},
			calculable: false,
			xAxis: [
				{
					type: 'category',
					data: [
						'Jan',
						'Feb',
						'Mar',
						'Apr',
						'May',
						'Jun',
						'Jul',
						'Aug',
						'Sep',
						'Oct',
						'Nov',
						'Dec',
					],
				},
			],
			yAxis: [
				{
					type: 'value',
				},
			],
			series: [
				{
					name: 'Salary',
					type: 'bar',
					data: [
						700000.0,
						2250000.0,
						1130000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
						2000000.0,
					],
					markPoint: {
						data: [
							{
								type: 'max',
								name: '???',
							},
							{
								type: 'min',
								name: '???',
							},
						],
					},
					markLine: {
						data: [
							{
								type: 'average',
								name: '???',
							},
						],
					},
				},
			],
		});
	}
}

function textAreaAdjust(element) {
	element.style.height = '1px';
	element.style.height = 25 + element.scrollHeight + 'px';
}

function sendSchedule() {
	$('#comment_error').html('');

	let comment = $(`#message`).val().trim();
	if (comment.length < 1) {
		$(`#comment_error`).html('Empty field');
		return;
	} else {
		$(`#add_comment_btn`).hide();
		$(`#add_comment_loader`).show();

		let exit_id = $('#add_comment_btn').attr('data');
		let employee_id = $('#add_comment_btn').attr('data-ti');
		let company_id = localStorage.getItem('company_id');

		let upImage = document.querySelector(`#message_file`).files[0];

		let data = new FormData();
		data.append('file', upImage);
		data.append('exit_id', exit_id);
		data.append('employee_id', employee_id);
		// data.append('company_id', company_id);
		data.append('note', comment);
		data.append('sending_status', 2);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			cache: false,
			url: `${api_path}hrm/create_exit_interview_schedule`,
			processData: false,
			contentType: false,
			headers: {
				enctype: 'multipart/form-data',
				Authorization: localStorage.getItem('token'),
			},
			data: data,

			error: function(error) {
				console.log(error);
				$(`#add_comment_loader`).hide();
				$(`#add_comment_btn`).show();
				Swal.fire({
					title: 'Error!',
					text: `${error.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#add_comment_loader`).hide();
					$(`#add_comment_btn`).show();
					$(`#message`).val('');
					$(`#message_file`).val('');
					$(`#collapseEg`).removeClass('in');
					Swal.fire({
						title: 'Success',
						text: `Sent Successfully`,
						icon: 'success',
						confirmButtonText: 'Okay',
					});
				}
			},
		});
	}
}

function updateSchedule() {
	$('#sche_msg_error').html('');
	// $('#viewModalSche').modal('show');

	let comment = $(`#sche_msg`).val().trim();
	if (comment.length < 1) {
		$(`#sche_msg_error`).html('Empty field');
		return;
	} else {
		$(`#update_comment_btn`).hide();
		$(`#update_comment_loader`).show();

		let exit_id = $('#update_comment_btn').attr('data');
		let employee_id = $('#update_comment_btn').attr('data-ti');
		let exit_schedule_id = $('#update_comment_btn').attr('data-tii');
		let company_id = localStorage.getItem('company_id');

		let upImage;

		if (document.querySelector(`#sche_msg_file`).files.length == 0) {
			upImage = '';
		} else {
			upImage = document.querySelector(`#sche_msg_file`).files[0];
		}

		let data = new FormData();
		data.append('file', upImage);
		data.append('exit_id', exit_id);
		data.append('employee_id', employee_id);
		data.append('exit_schedule_id', exit_schedule_id);
		data.append('note', comment);
		data.append('sending_status', 2);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			cache: false,
			url: `${api_path}hrm/update_exit_interview_schedule`,
			processData: false,
			contentType: false,
			headers: {
				enctype: 'multipart/form-data',
				Authorization: localStorage.getItem('token'),
			},
			data: data,

			error: function(error) {
				console.log(error);
				$(`#update_comment_loader`).hide();
				$(`#update_comment_btn`).show();
				Swal.fire({
					title: 'Error!',
					text: `${error.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
				// alert(error.responseJSON.msg);
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#update_comment_loader`).hide();
					$(`#update_comment_btn`).show();
					Swal.fire({
						title: 'Success!',
						text: `Update Successful`,
						icon: 'success',
						confirmButtonText: 'Okay',
					});
					// $(`#sche_msg`).val('');
					// $(`#sche_msg_file`).val('');
					// $(`#collapseEg`).removeClass('in');
				}
			},
		});
	}
}

function viewSchedule(exit_id, employee_id) {
	$('#sche_msg_error').html('');
	$(`#update_comment_btn`).hide();
	$(`#update_comment_loader`).show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/fetch_exit_interview_schedule`, {
			params: {
				exit_id: exit_id,
				employee_id: employee_id,
				// company_id: company_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let { exit_document, exit_note, exit_schedule_id } = response.data.data;
			$('#sche_msg').html(exit_note);
			$('#update_comment_btn').attr('data-tii', exit_schedule_id);

			if (exit_document !== '') {
				$('#view_doc_div').show();
				$('#view_sche_file').attr('href', exit_document);
			}

			$('#update_comment_loader').hide();
			$('#update_comment_btn').show();
			let el = document.getElementById('sche_msg');
			textAreaAdjust(el);
		})
		.catch(function(error) {
			console.log(error);

			$('#update_comment_loader').hide();
			$('#update_comment_btn').show();

			$('#sche_msg_error').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});
}

function toggleContent() {
	if ($('#collapseEg2').css('display', 'block')) {
		$('#collapseEg2').toggle();
		$('#collapseEg').toggle('slow');
	} else {
		$('#collapseEg').toggle('slow');
	}
}
function toggleContent2() {
	if ($('#collapseEg').css('display', 'block')) {
		$('#collapseEg').toggle();
		$('#collapseEg2').toggle('slow');
	} else {
		$('#collapseEg2').toggle('slow');
	}
}

function bringUpModal(id, emp) {
	$('#add_comment_btn').attr('data', id);
	$('#add_comment_btn').attr('data-ti', emp);
	$('#add_quest_btn').attr('data', id);
	$('#add_quest_btn').attr('data-ti', emp);
	$('#askModal').modal('show');
}
function bringUpModal2(id, emp) {
	$('#update_comment_btn').attr('data', id);
	$('#update_comment_btn').attr('data-ti', emp);
	viewSchedule(id, emp);
	$('#viewModalSche').modal('show');
}

function listInterviewQuestion() {
	let company_id = localStorage.getItem('company_id');
	$('#list_interview_table').hide();
	$('#list_interview_loader').show();
	axios
		.get(`${api_path}hrm/get_interview_question`, {
			params: {
				// company_id: company_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let interview_list =
				'<li><p><input type="checkbox" id="checkall" class="flat"> <b>Select All</b></p></li>';
			// const { employee_cv_work_history } = response.data.data;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					interview_list += `<li>
										<p>
											<input type="checkbox" class="check_ques" value="${v.question_id}"> ${v.interview_questions}
										</p>
									</li>`;
				});
				$('#interview_list').html(interview_list);
				// $('#list_interview_body').html(interview_list);
				$('#list_interview_loader').hide();
				$('#list_interview_table').show();
			} else {
				$('#interview_list').html(`<li>No record</li>`);
				$('#list_interview_loader').hide();
				$('#list_interview_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_interview_loader').hide();
			$('#list_interview_table').show();
			$('#interview_list').html(`<li style="color:red;">Error</li>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function sendInterviewQuestions() {
	$('#quest_error').html('');
	let company_id = localStorage.getItem('company_id');
	let questions = [];

	$('.check_ques').map((i, v) => {
		if ($(v).is(':checked')) {
			questions.push({ question_id: $(v).val() });
		}
	});
	if (questions.length === 0) {
		$('#quest_error').html('No Interview Questions selected');
		return;
	}
	$('#add_quest_btn').hide();
	$('#add_quest_loader').show();
	let exit_id = $('#add_quest_btn').attr('data');
	let employee_id = $('#add_quest_btn').attr('data-ti');

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		exit_id: exit_id,
		selected: questions,
		sending_status: 1,
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/select_exit_question`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		error: function(res) {
			console.log(res);
			$('#add_quest_loader').hide();
			$('#add_quest_btn').show();
			// alert(res.responseJSON.msg);
			$('#quest_error').html(res.responseJSON.msg);
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_quest_loader').hide();
				$('#add_quest_btn').show();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: window.location.reload(),
				});
			}
		},
	});
}

$('#askModal').on('hidden.bs.modal', function() {
	// do something…
	$('#quest_error').html('');
	$('#comment_error').html('');
	$('#collapseEg').hide();
	$('#collapseEg2').hide();
});

function listInterviewQuestionAndAnswer(exit_id, employee_id) {
	let company_id = localStorage.getItem('company_id');

	$('#viewModalRes').modal('show');

	$('#view_interview_table').hide();
	$('#view_interview_loader').show();
	axios
		.get(`${api_path}hrm/hr_get_interview_response`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
				exit_id: exit_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let interview_list = '';
			// const { employee_cv_work_history } = response.data.data;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					interview_list += `<dt style="font-size:1.2em;">${v.exit_question}</dt>
                            <dd style="font-size:1.2em;">- ${v.response}</dd>`;
				});
				$('#interview_view').html(interview_list);
				// $('#list_interview_body').html(interview_list);
				$('#view_interview_loader').hide();
				$('#view_interview_table').show();
			} else {
				$('#interview_view').html(`<dt>No Interview question or response</dt>`);
				$('#view_interview_loader').hide();
				$('#view_interview_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#view_interview_loader').hide();
			$('#view_interview_table').show();
			$('#interview_view').html(`<dt style="color:red;">Error</dt>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function FetchData(employee_id) {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	$('#list_empo_details').hide();
	$('#list_empo_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// let qc_list;
			if (response.data.data.employee_data) {
				const {
					department_name,
					date_of_employ,
					active_status,
					supervisor_name,
				} = response.data.data.employee_data;
				$('#dpt').html(department_name);
				$('#date_of_join').html(date_of_employ);
				$('#emp_status').html(capitalizeFirstLetter(active_status));
				if (supervisor_name !== 'N/A') {
					$('#supervisor').html(
						`${supervisor_name.firstname} ${supervisor_name.middlename} ${supervisor_name.lastname}`,
					);
				} else {
					$('#supervisor').html('...');
				}

				// $('#').html()
			} else {
				$('#list_empo_details').html("Couldn't fetch data");
			}
			$('#list_empo_loader').hide();
			$('#list_empo_details').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#list_empo_loader').hide();
			$('#list_empo_details').show();
			// $('#list_QC_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function listExitType() {
	let company_id = localStorage.getItem('company_id');

	axios
		.get(`${api_path}hrm/company_exit_type`, {
			params: {
				// company_id: company_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			var options = '';

			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					options += `<option value="${v.exit_type_id}">${capitalizeFirstLetter(
						v.exit_type,
					)}</option>`;
				});
			} else {
				options += `<option value="${v.exit_type_id}">No Record</option>`;
			}
			$('#exit_ty').append(options);
		})
		.catch(function(error) {
			console.log(error);
			$('#exit_ty').append(`<option value="">Error</option>`);
		})
		.then(function() {
			// always executed
		});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
