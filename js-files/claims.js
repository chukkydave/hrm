$(document).ready(function() {
	//this time interval check if the user roles have been fetched before running anything on this page
	var totalID;
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

	$('#add_claim_btn').on('click', () => {
		if (isEmptyInput('.claim_require')) {
			$('#error').html('');
			addClaim();
		} else {
			$('#error').html('blank field(s)');
		}
	});

	$('#edit_claim_btn').on('click', () => {
		if (isEmptyInput('.edit_claim_require')) {
			$('#edit_claim_error').html('');
			EditClaim();
		} else {
			$('#edit_claim_error').html('blank field(s)');
		}
	});

	$('#filter_claim').on('click', () => {
		listClaim('');
	});
	$('#add_draft_btn').on('click', () => {
		if (isEmptyInput('.claim_require')) {
			$('#error').html('');
			draftClaim();
		} else {
			$('#error').html('blank field(s)');
		}
	});

	$('#edit_draft_btn').on('click', () => {
		if (isEmptyInput('.edit_claim_require')) {
			$('#edit_claim_error').html('');
			draftEditClaim();
		} else {
			$('#edit_claim_error').html('blank field(s)');
		}
	});

	// lightbox.option({
	// 	resizeDuration: 200,
	// 	wrapAround: true,
	// 	maxWidth: '20px',
	// 	maxHeight: '20px',
	// });

	// $('#gallery a img').lightBox({
	// 	maxHeight: '700px',
	// 	maxWidth: '700px',
	// });

	$(document).on('change', '.updateStatusClass', function(e) {
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
		let role_id = $(this).attr('id').replace(/claim_row/, '');

		totalID = $(`#updateStatus${role_id} :selected`).val();
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	if (pack_list.indexOf('-6-') >= 0) {
		if (
			role_list.indexOf('-145-') >= 0 ||
			role_list.indexOf('-146-') >= 0 ||
			role_list.indexOf('-147-') >= 0 ||
			role_list.indexOf('-148-') >= 0 ||
			role_list.indexOf('-149-') >= 0
		) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			$('.js-example-basic-single').select2();
			load_employee();
			listClaim('');
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}

		if (role_list.indexOf('-147-') >= 0) {
			$('#download_btn').show();
		}
		if (role_list.indexOf('-146-') >= 0) {
			$('#add_claimC').show();
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

let fileInput = document.querySelector('#upload_doc');
let edit_fileInput = document.querySelector('#edit_upload_doc');
let fileList = [];
let edit_fileList = [];

fileInput.addEventListener('change', function(evnt) {
	// fileList = [];
	for (let i = 0; i < fileInput.files.length; i++) {
		console.log(i);
		// var reader = new FileReader();
		// reader.readAsDataURL(fileInput.files[i]);
		// reader.onload = function() {
		// 	fileList.push(reader.result); //base64encoded string
		// };
		// fileList.push(toBase64(fileInput.files[i]));
		// fileList.push(fileInput.files[i]);
		Main(fileInput.files[i]);
	}
});
edit_fileInput.addEventListener('change', function(evnt) {
	for (let i = 0; i < edit_fileInput.files.length; i++) {
		edit_Main(edit_fileInput.files[i]);
	}
});

const toBase64 = (file) =>
	new Promise((resolve, reject) => {
		const reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onload = () => resolve(reader.result);
		reader.onerror = (error) => reject(error);
	});

async function Main(file) {
	// const file = document.querySelector('#myfile').files[0];
	fileList.push(await toBase64(file));
}
async function edit_Main(file) {
	// const file = document.querySelector('#myfile').files[0];
	edit_fileList.push(await toBase64(file));
}

// Main();

function addClaim() {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	// console.log(fileList);

	$('#add_claim_btn').hide();
	$('#add_claim_loader').show();

	let claimant = $('#claimant').val();
	let claim_name = $('#claim_name').val();
	let reason = $('#reason').val();
	let amount = parseInt($('#amount').val().replace(/[^0-9\.-]+/g, ''));
	let upload_doc = fileList;
	// console.log(typeof fileList);
	let date = new Date().getFullYear() + '-' + new Date().getMonth() + '-' + new Date().getDate();

	let data = new FormData();
	data.append('claimant', claimant);
	data.append('claim_name', claim_name);
	data.append('sending_status', 1);
	data.append('reason', reason);
	data.append('amount_claiming', amount);
	data.append('date_of_claim', date);
	data.append('status', 'Pending');
	// data.append('file', JSON.stringify(upload_doc));
	$.each($('#upload_doc')[0].files, function(i, file) {
		data.append('file[' + i + ']', file);
	});
	console.log(data);
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_claim`,
		data: data,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		// timeout: 60000,

		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_claim_loader').hide();
			$('#add_claim_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_claim_loader').hide();
				$('#add_claim_btn').show();

				$('#claimant').val(null).trigger('change');
				$('#claim_name').val('');
				$('#reason').val('');
				$('#amount').val('');
				$('#upload_doc').val('');
				$('#collapseExample23').removeClass('in');

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

function draftClaim() {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	// console.log(fileList);
	$('#add_draft_btn').hide();
	$('#add_draft_loader').show();

	let claimant = $('#claimant').val();
	let claim_name = $('#claim_name').val();
	let reason = $('#reason').val();
	let amount = parseInt($('#amount').val().replace(/[^0-9\.-]+/g, ''));
	let upload_doc = fileList;
	let date = new Date().getFullYear() + '-' + new Date().getMonth() + '-' + new Date().getDate();
	// console.log(fileList);

	// let data = {
	// 	claimant: claimant,
	// 	claim_name: claim_name,
	// 	sending_status: 1,
	// 	reason: reason,
	// 	amount_claiming: amount,
	// 	date_of_claim: date,
	// 	status: 'Draft',
	// 	file: upload_doc,
	// };
	let data = new FormData();
	data.append('claimant', claimant);
	data.append('claim_name', claim_name);
	data.append('sending_status', 1);
	data.append('reason', reason);
	data.append('amount_claiming', amount);
	data.append('date_of_claim', date);
	data.append('status', 'Draft');
	// data.append('file', JSON.stringify(upload_doc));
	$.each($('#upload_doc')[0].files, function(i, file) {
		data.append('file[' + i + ']', file);
	});
	console.log(data);
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_claim`,
		data: data,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		// timeout: 60000,

		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_draft_loader').hide();
			$('#add_draft_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_draft_loader').hide();
				$('#add_draft_btn').show();

				$('#claimant').val(null).trigger('change');
				$('#claim_name').val('');
				$('#reason').val('');
				$('#amount').val('');
				$('#upload_doc').val('');
				$('#collapseExample23').removeClass('in');

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

function listClaim(page) {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];

	$('#list_claim_table').hide();
	$('#list_claim_loader').show();
	let status = $('#status_filter').val();
	let claimant = $('#claimant_filter').val();
	let claimFil = '';
	if (claimant) {
		claimFil = claimant.join(',');
	}

	console.log(claimant, claimFil);
	if (page == '') {
		var page = 1;
	}
	var limit = 10;
	if (status === '--Status--') {
		status = '';
	}

	axios
		.get(`${api_path}hrm/all_company_claims`, {
			params: {
				status: status,
				claimant: claimFil,
				page: page,
				limit: limit,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let claim_list;
			const claim = response.data.data;
			if (claim.length > 0) {
				$('#download_btn').attr('href', response.data.download_link);

				$(claim).map((i, v) => {
					// if (v.id === "3") {

					// }
					if (v.status === 'Draft') {
						claim_list += `<tr class="even pointer updateRow" id="claim_row${v.id}" style="background:lightgrey;">`;
						claim_list += `<td>${v.claimant_code}</td>`;
						// claim_list += `<td>${v.nxt_kin_relationship}</td>`;
						claim_list += `<td>${v.fullname}</td>`;
						claim_list += `<td>${formatToCurrency(parseInt(v.amount_claim))}</td>`;
						let role_list = $('#does_user_have_roles').html();

						claim_list += `<td>${v.status}</td>`;
						// }
						if (v.status === 'Draft') {
							claim_list += `<td><div class="dropdown">
                                    <button
                                        class="btn btn-secondary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton1"
                                        data-toggle="dropdown"
                                        aria-expanded="false">
                                        Actions</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">`;
							if (role_list.indexOf('-145-') >= 0) {
								claim_list += `<li onClick="viewClaim(${v.id}, 'Draft')">
                                            <a class="dropdown-item">
                                                <i class="fa fa-eye" /> View
                                            </a>
                                        </li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
                                            <a class="dropdown-item">
                                                <i class="fa fa-eye" /> View
                                            </a>
                                        </li>`;
							}
							if (role_list.indexOf('-149-') >= 0) {
								claim_list += `<li onClick="deleteClaim(${v.id})">
                                            <a class="dropdown-item">
                                                <i class="fa fa-trash" /> Delete
                                            </a>
                                        </li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
                                            <a class="dropdown-item">
                                                <i class="fa fa-trash" /> Delete
                                            </a>
                                        </li>`;
							}
							claim_list += `</ul></div></td>`;
						} else if (v.status === 'Pending' || v.status === 'Unpaid') {
							claim_list += `<td>
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
							if (role_list.indexOf('-145-') >= 0) {
								claim_list += `<li onClick="viewOnlyClaim(${v.id}, 'Pending')">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							}

							claim_list += `</ul></div></td>`;
						} else if (v.status === 'Paid') {
							claim_list += `<td>
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
							if (role_list.indexOf('-145-') >= 0) {
								claim_list += `<li onClick="viewOnlyClaim(${v.id}, 'Pending')">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							}

							claim_list += `</ul></div></td>`;
						}

						claim_list += `</tr>`;
					} else {
						claim_list += `<tr class="even pointer updateRow" id="claim_row${v.id}">`;
						claim_list += `<td>${v.claimant_code}</td>`;
						// claim_list += `<td>${v.nxt_kin_relationship}</td>`;
						claim_list += `<td>${v.fullname}</td>`;
						claim_list += `<td>${formatToCurrency(parseInt(v.amount_claim))}</td>`;
						let role_list = $('#does_user_have_roles').html();
						if (role_list.indexOf('-148-') >= 0) {
							// onChange="updateStatus(${v.id})"
							claim_list += `<td>
                                        <select style="border:none; padding:5px;" id="updateStatus${v.id}" class="updateStatusClass">
                                            <option value="">--Status--</option>
                                            <option value="Pending" ${
												v.status === 'Pending' ? 'selected' :
												''}>Pending</option>
                                           <!-- <option value="Draft" ${
												v.status === 'Draft' ? 'selected' :
												''}>Draft</option>-->
                                            <option value="Unpaid" ${
												v.status === 'Unpaid' ? 'selected' :
												''}>Unpaid</option>
                                            <option value="Paid" ${
												v.status === 'Paid' ? 'selected' :
												''}>Paid</option>
                                        </select>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;"
                                                id="updateStatus_loader${v.id}"></i>
                                    </td>`;
						} else {
							claim_list += `<td>${v.status}</td>`;
						}
						if (v.status === 'Draft') {
							claim_list += `<td><div class="dropdown">
                                    <button
                                        class="btn btn-secondary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton1"
                                        data-toggle="dropdown"
                                        aria-expanded="false">
                                        Actions</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">`;
							if (role_list.indexOf('-145-') >= 0) {
								claim_list += `<li onClick="viewClaim(${v.id}, 'Draft')">
                                            <a class="dropdown-item">
                                                <i class="fa fa-eye" /> View
                                            </a>
                                        </li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
                                            <a class="dropdown-item">
                                                <i class="fa fa-eye" /> View
                                            </a>
                                        </li>`;
							}
							if (role_list.indexOf('-149-') >= 0) {
								claim_list += `<li onClick="deleteClaim(${v.id})">
                                            <a class="dropdown-item">
                                                <i class="fa fa-trash" /> Delete
                                            </a>
                                        </li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
                                            <a class="dropdown-item">
                                                <i class="fa fa-trash" /> Delete
                                            </a>
                                        </li>`;
							}
							claim_list += `</ul></div></td>`;
						} else if (v.status === 'Pending' || v.status === 'Unpaid') {
							claim_list += `<td>
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
							if (role_list.indexOf('-145-') >= 0) {
								claim_list += `<li onClick="viewOnlyClaim(${v.id}, 'Pending')">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							}

							claim_list += `</ul></div></td>`;
						} else if (v.status === 'Paid') {
							claim_list += `<td>
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
							if (role_list.indexOf('-145-') >= 0) {
								claim_list += `<li onClick="viewOnlyClaim(${v.id}, 'Pending')">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							} else {
								claim_list += `<li class="disabledC" onClick="denied()">
												<a class="dropdown-item">
													<i class="fa fa-eye" /> View
												</a>
											</li>`;
							}

							claim_list += `</ul></div></td>`;
						}
						claim_list += `</tr>`;
					}
					claim_list += `<tr id="claim_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_claim_body').html(claim_list);
				$('#list_claim_loader').hide();
				$('#list_claim_table').show();
				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.data.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						listClaim(page);
					},
				});
			} else {
				$('#list_claim_body').html(`<tr><td colspan="5">No record found</td></tr>`);
				$('#list_claim_loader').hide();
				$('#list_claim_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_claim_loader').hide();
			$('#list_claim_table').show();
			$('#list_claim_body').html(`<tr><td colspan="5" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function denied() {
	toastr.error('Access Denied');
}

function updateStatus(id) {
	// let old_value = $(`updateStatus${id}`).val();
	// onChange="updateStatus(${v.id})"
	// let ans = confirm("Are you sure you want to Update this Record's Status?");
	// if (ans) {
	let company_id = localStorage.getItem('company_id');

	$(`#updateStatus${id}`).hide();
	$(`#updateStatus_loader${id}`).show();

	let status = $(`#updateStatus${id}`).val();

	let data = {
		claim_id: id,
		status: status,
	};

	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_claim_status`,
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
			$(`#updateStatus_loader${id}`).hide();
			$(`#updateStatus${id}`).show();

			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$(`#updateStatus_loader${id}`).hide();
				$(`#updateStatus${id}`).show();

				listClaim('');
			}
		},
	});
	// }
}

function viewClaim(id, viewType) {
	$('#edit_claim_error').html('');
	$('#edit_claim_modal').modal('show');
	$('#edit_claim_btn').hide();
	$('#edit_claim_loader').show();

	axios
		.get(`${api_path}hrm/view_single_claim`, {
			params: {
				claim_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#edit_claim_loader').hide();
			$('#edit_claim_btn').show();

			let {
				fullname,
				claim_name,
				reason,
				amount_claim,
				status,
				document,
				claimant,
			} = response.data.data;

			$('#edit_claimant').val(claimant).select2();
			// $('#sel_users').val(value);
			// $('#edit_claimant').select2().trigger('change');
			$('#edit_claim_name').val(claim_name);
			$('#edit_reason').val(reason);
			$('#edit_amount').val(parseInt(amount_claim));
			$('#edit_amount').trigger('keyup');
			$('#edit_amount').trigger('blur');
			// $('#edit_claim_address').val(nxt_kin_address);
			// $('#edit_claim_relationship').val(nxt_kin_relationship);
			$('#edit_claim_btn').attr('data-id', id);
			if (document.length !== 0) {
				let files = '';
				$(document).map((i, v) => {
					// let filetype = v.document_name.split('.');
					let filetype = v.document_file_type;
					console.log(filetype);
					if (
						filetype === 'png' ||
						filetype === 'jpg' ||
						filetype === 'jpeg' ||
						filetype === 'JPG'
					) {
						// alert(filetype[1]);
						files += `<div class="image-area" data="${v.document_id}=${v.document_name}" id="doc_div${v.document_id}">
                                    <a class="example-image-link" href="${v.document_path}"
                                        data-lightbox="roadtrip"><img src="${v.document_path}" /></a>
                                    <a class="remove-image" onclick="removeImage(${v.document_id}, ${id})" style="display: inline;"><i
                                            class="fa fa-times-circle"></i></a>
                                </div>`;
					} else {
						// alert('pdf');
						files += `<div class="image-area" data="${v.document_id}=${v.document_name}" id="doc_div${v.document_id}">
                                    <a class="example-image-link" target="_blank" href="${v.document_path}"><i
                                            class="fas fa-file-alt"></i></a>
                                    <a class="remove-image" onclick="removeImage(${v.document_id},${id})" style="display: inline;"><i
                                            class="fa fa-times-circle"></i></a>
                                </div>`;
					}
					files += `<span id="doc_loader${v.document_id}" style="display:none;"><i class="fa fa-spinner fa-spin fa-fw"></i></span>`;
				});

				$('#gallery').html(files);
			} else {
				$('#gallery').html('');
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_claim_loader').hide();
			$('#edit_claim_btn').show();

			$('#edit_claim_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewOnlyClaim(id, viewType) {
	$('#view_claim_error').html('');
	$('#view_claim_modal').modal('show');
	$('#view_claim_div').hide();
	$('#view_claim_loader').show();

	axios
		.get(`${api_path}hrm/view_single_claim`, {
			params: {
				claim_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#view_claim_loader').hide();
			$('#view_claim_div').show();

			let {
				fullname,
				claim_name,
				reason,
				amount_claim,
				status,
				document,
				claimant,
				date_paid_claimed,
			} = response.data.data;

			$('#view_claimant').html(fullname);
			// $('#sel_users').html(htmlue);
			// $('#view_claimant').select2().trigger('change');
			$('#view_claim_name').html(claim_name);
			$('#view_reason').html(reason);
			if (viewType === 'Paid') {
				let datePaid = moment(date_paid_claimed, 'YYYY-MM-DD HH:mm:ss').format('LL');
				$('#paid_div').show();
				$('#view_date_paid').html(datePaid);
			} else {
				$('#paid_div').hide();
			}
			$('#view_amount').html(formatToCurrency(parseInt(amount_claim)));

			$('#view_status').html(status);
			// $('#view_claim_relationship').val(nxt_kin_relationship);
			// $('#view_claim_div').attr('data-id', id);
			if (document.length !== 0) {
				let files = '';
				$(document).map((i, v) => {
					// let filetype = v.document_name.split('.');
					let filetype = v.document_file_type;

					console.log(filetype);
					if (
						filetype === 'png' ||
						filetype === 'jpg' ||
						filetype === 'jpeg' ||
						filetype === 'JPG'
					) {
						files += `<div class="image-area" data="${v.document_id}=${v.document_name}">
                                    <a class="example-image-link" href="${v.document_path}"
                                        data-lightbox="roadtrip"><img src="${v.document_path}" /></a>
                                    
                                </div>`;
					} else {
						files += `<div class="image-area" data="${v.document_id}=${v.document_name}">
                                    <a class="example-image-link" target="_blank" href="${v.document_path}"><i
                                            class="fas fa-file-alt"></i></a>
                                    
                                </div>`;
					}
				});

				$('#gallery_view').html(files);
			} else {
				$('#gallery_view').html('');
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#view_claim_loader').hide();
			$('#view_claim_div').show();

			$('#view_claim_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function EditClaim() {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	// console.log(fileList);

	$('#edit_claim_btn').hide();
	$('#edit_claim_loader').show();

	let claimant = $('#edit_claimant').val();
	let claim_name = $('#edit_claim_name').val();
	let reason = $('#edit_reason').val();
	let amount = parseInt($('#edit_amount').val().replace(/[^0-9\.-]+/g, ''));
	let upload_doc = edit_fileList;
	// console.log(typeof fileList);
	let date = new Date().getFullYear() + '-' + new Date().getMonth() + '-' + new Date().getDate();
	let claim_id = $('#edit_claim_btn').attr('data-id');

	let documents = [];
	$('.image-area').each((i, v) => {
		let single = $(v).attr('data').split('=');
		documents.push({ document_id: single[0], document_name: single[1] });
	});
	console.log(documents, upload_doc);

	let data = new FormData();
	data.append('claimant', claimant);
	data.append('claim_id', claim_id);
	data.append('claim_name', claim_name);
	data.append('sending_status', 1);
	data.append('reason', reason);
	data.append('amount_claiming', amount);
	data.append('date_of_claim', date);
	data.append('documents', JSON.stringify(documents));
	data.append('status', 'Pending');
	// data.append('file', JSON.stringify(upload_doc));
	$.each($('#edit_upload_doc')[0].files, function(i, file) {
		data.append('file[' + i + ']', file);
	});
	console.log(data);
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_claim`,
		data: data,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		// timeout: 60000,

		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#edit_claim_loader').hide();
			$('#edit_claim_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_claim_loader').hide();
				$('#edit_claim_btn').show();

				$('#edit_claimant').val(null).trigger('change');
				$('#edit_claim_name').val('');
				$('#edit_reason').val('');
				$('#edit_amount').val('');
				$('#edit_upload_doc').val('');
				$('#edit_claim_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listClaim(''),
				});
			}
		},
	});
}

function draftEditClaim() {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	// console.log(fileList);
	$('#edit_draft_btn').hide();
	$('#edit_draft_loader').show();

	let claimant = $('#edit_claimant').val();
	let claim_name = $('#edit_claim_name').val();
	let reason = $('#edit_reason').val();
	let amount = parseInt($('#edit_amount').val().replace(/[^0-9\.-]+/g, ''));
	let upload_doc = edit_fileList;
	let date = new Date().getFullYear() + '-' + new Date().getMonth() + '-' + new Date().getDate();
	let claim_id = $('#edit_claim_btn').attr('data-id');

	let documents = [];
	$('.image-area').each((i, v) => {
		let single = $(v).attr('data').split('=');
		documents.push({ document_id: single[0], document_name: single[1] });
	});
	console.log(documents);

	let data = new FormData();
	data.append('claimant', claimant);
	data.append('claim_id', claim_id);
	data.append('claim_name', claim_name);
	data.append('sending_status', 1);
	data.append('reason', reason);
	data.append('amount_claiming', amount);
	data.append('date_of_claim', date);
	data.append('documents', JSON.stringify(documents));
	data.append('status', 'Draft');
	// data.append('file', JSON.stringify(upload_doc));
	$.each($('#edit_upload_doc')[0].files, function(i, file) {
		data.append('file[' + i + ']', file);
	});
	console.log(data);
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_claim`,
		data: data,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		// timeout: 60000,

		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#edit_draft_loader').hide();
			$('#edit_draft_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_draft_loader').hide();
				$('#edit_draft_btn').show();

				$('#edit_claimant').val(null).trigger('change');
				$('#edit_claim_name').val('');
				$('#edit_reason').val('');
				$('#edit_amount').val('');
				$('#edit_upload_doc').val('');
				$('#edit_claim_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listClaim(''),
				});
			}
		},
	});
}

function deleteClaim(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#claim_row${id}`).hide();
		$(`#claim_loader${id}`).show();

		let data = {
			claim_id: id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/remove_claim`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#claim_loader${id}`).hide();
				$(`#claim_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#claim_row${id}`).remove();
					$(`#claim_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
					});
				}
			},
		});
	}
}
function removeImage(doc_id, id) {
	let ans = confirm('Are you sure you want to delete this image?');
	if (ans) {
		$(`#doc_div${doc_id}`).hide();
		$(`#doc_loader${doc_id}`).show();

		let data = {
			claim_id: id,
			document_id: doc_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/remove_claim_document`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#doc_loader${doc_id}`).hide();
				$(`#doc_div${doc_id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#doc_div${doc_id}`).remove();
					$(`#doc_loader${doc_id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
					});
				}
			},
		});
	}
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
			var options = `<option value="">--Select Claimant--</option>`;

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});
			$('#claimant').html(options);
			$('#claimant_filter').html(options);
			$('#edit_claimant').html(options);
			// $('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error: function(response) {
			alert('Error loading Employee list');
		},
	});
}

function formatToCurrency(amount) {
	if (amount === 0 || amount === 0.0) {
		return amount;
	} else {
		return '₦' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	}
}

function isEmptyInput(first) {
	let isEmpty = false;
	$(first).each(function() {
		var input = $.trim($(this).val());
		if (input.length === 0 || input === '0') {
			$(this).addClass('has-error');
			isEmpty = true;
			$('#error').html('Empty fields');
		} else {
			$(this).removeClass('has-error');
			$('#error').html('');

			// isEmpty = false;
		}
	});
	if (isEmpty === true) {
		return false;
	} else {
		return true;
	}
}

$("input[data-type='currency']").on({
	keyup: function() {
		formatCurrency($(this));
	},
	blur: function() {
		formatCurrency($(this), 'blur');
	},
});

function formatNumber(n) {
	// format number 1000000 to 1,234,567
	return n.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function formatCurrency(input, blur) {
	// appends $ to value, validates decimal side
	// and puts cursor back in right position.

	// get input value
	var input_val = input.val();

	// don't validate empty input
	if (input_val === '') {
		return;
	}

	// original length
	var original_len = input_val.length;

	// initial caret position
	var caret_pos = input.prop('selectionStart');

	// check for decimal
	if (input_val.indexOf('.') >= 0) {
		// get position of first decimal
		// this prevents multiple decimals from
		// being entered
		var decimal_pos = input_val.indexOf('.');

		// split number by decimal point
		var left_side = input_val.substring(0, decimal_pos);
		var right_side = input_val.substring(decimal_pos);

		// add commas to left side of number
		left_side = formatNumber(left_side);

		// validate right side
		right_side = formatNumber(right_side);

		// On blur make sure 2 numbers after decimal
		if (blur === 'blur') {
			right_side += '00';
		}

		// Limit decimal to only 2 digits
		right_side = right_side.substring(0, 2);

		// join number by .
		input_val = '₦' + left_side + '.' + right_side;
	} else {
		// no decimal entered
		// add commas to number
		// remove all non-digits
		input_val = formatNumber(input_val);
		input_val = '₦' + input_val;

		// final formatting
		if (blur === 'blur') {
			input_val += '.00';
		}
	}

	// send updated string to input
	input.val(input_val);

	// put caret back in the right position
	var updated_len = input_val.length;
	caret_pos = updated_len - original_len + caret_pos;
	input[0].setSelectionRange(caret_pos, caret_pos);
}
