$(document).ready(() => {
	$('#summernote').summernote();
	listExitType();
	$('#add_exitType_btn').on('click', addExitType);
	$('#add_interview_btn').on('click', addInterviewQuestion);
	$('#add_policy_btn').on('click', addPolicy);
	$('#edit_exitType_btn').on('click', editExitType);
	$('#edit_interview_btn').on('click', editInterviewQuestion);
	listInterviewQuestion();
	listPolicy();
});

//Exit Type start
function addExitType() {
	let company_id = localStorage.getItem('company_id');

	$('#add_exitType_btn').hide();
	$('#add_exitType_loader').show();

	let name = $('#exitType_name').val();

	let data = {
		exit_type: name,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_exit_type`,
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
			$('#add_exitType_loader').hide();
			$('#add_exitType_btn').show();

			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_exitType_loader').hide();
				$('#add_exitType_btn').show();

				$('#exitType_name').val('');
				$(`#collapseExample`).removeClass('in');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listExitType(),
				});
			}
		},
	});
}

function addDefaultExitType() {
	let company_id = localStorage.getItem('company_id');

	// $('#add_exitType_btn').hide();
	// $('#add_exitType_loader').show();

	// let name = $('#exitType_name').val();

	let data = {
		// exit_type: name,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_default_exit_type`,
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
			// $('#add_exitType_loader').hide();
			// $('#add_exitType_btn').show();
			// alert(error.responseJSON.msg);
			$('#Exp_list').html(`<li style="color:red;">${error.responseJSON.msg}</li>`);
			$('#list_exitType_loader').hide();
			$('#list_exitType_table').show();
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				// $('#add_exitType_loader').hide();
				// $('#add_exitType_btn').show();

				// $('#mod_bodi').html('<h4>Exit Type creation successful</h4>');
				// $('#successModal').modal('show');
				// $('#exitType_name').val('');

				// $(`#collapseExample`).removeClass('in');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listExitType(),
				});
			}
		},
	});
}

function listExitType() {
	let company_id = localStorage.getItem('company_id');
	$('#list_exitType_table').hide();
	$('#list_exitType_loader').show();
	axios
		.get(`${api_path}hrm/company_exit_type`, {
			params: {},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let exitType_list = '';
			// const { employee_cv_work_history } = response.data.data;

			if (response.data.data.length > 0) {
				// $(response.data.data).map((i, v) => {
				// 	exitType_list += `<tr class="even pointer" id="exitType_row${v.exit_type_id}" style="background:none;border:none;">`;
				// 	exitType_list += `<td>${v.exit_type}</td>`;
				// 	exitType_list += `<td>
				// 		<div class="dropdown">
				// 			<button
				// 				class="btn btn-secondary dropdown-toggle"
				// 				type="button"
				// 				id="dropdownMenuButton1"
				// 				data-toggle="dropdown"
				// 				aria-expanded="false">
				// 				Actions
				// 			</button>
				// 			<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
				// 				<li onClick="viewExitType(${v.exit_type_id})">
				// 					<a class="dropdown-item">
				// 						<i class="fa fa-pencil" /> Edit
				// 					</a>
				// 				</li>
				// 				<li onClick="deleteExitType(${v.exit_type_id})">
				// 					<a class="dropdown-item">
				// 						<i class="fa fa-trash" /> Delete
				// 					</a>
				// 				</li>
				// 			</ul>
				// 		</div></td>`;
				// 	exitType_list += `</tr>`;
				// 	exitType_list += `<tr id="exitType_loader${v.exit_type_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				// });

				$(response.data.data).map((i, v) => {
					exitType_list += `<div style="display:flex; justify-content:space-between;" id="exitType_row${v.exit_type_id}">
                                        <li style="list-style-type: disclosure-closed !important; background: none;">
                                        ${capitalizeFirstLetter(v.exit_type)}
                                            

                                        </li>
                                        <div class="dropdown" style="">
                                            <button
                                                class="btn btn-secondary dropdown-toggle"
                                                type="button"
                                                id="dropdownMenuButton1"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li onClick="viewExitType(${v.exit_type_id})">
                                                    <a class="dropdown-item">
                                                        <i class="fa fa-pencil" /> Edit
                                                    </a>
                                                </li>
                                                <li onClick="deleteExitType(${v.exit_type_id})">
                                                    <a class="dropdown-item">
                                                        <i class="fa fa-trash" /> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>`;
					exitType_list += `<li id="exitType_loader${v.exit_type_id}" style="display:none; background:none;"><i class="fa fa-spinner fa-spin fa-fw"></i></li>`;
				});

				$('#Exp_list').html(exitType_list);
				// $('#list_exitType_body').html(exitType_list);
				$('#list_exitType_loader').hide();
				$('#list_exitType_table').show();
			} else {
				$('#list_exitType_body').html(`<li>No record</li>`);
				$('#list_exitType_loader').hide();
				$('#list_exitType_table').show();
				addDefaultExitType();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_exitType_loader').hide();
			$('#list_exitType_table').show();
			$('#list_exitType_body').html(`<tr><td colspan="2" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function viewExitType(id) {
	$('#edit_exitType_error').html('');
	$('#edit_exitType_modal').modal('show');
	$('#edit_exitType_btn').hide();
	$('#edit_exitType_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/single_exit_type`, {
			params: {
				exit_type_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_exitType_loader').hide();
			$('#edit_exitType_btn').show();

			let { exit_type } = response.data.data;
			$('#edit_exitType_name').val(exit_type);
			$('#edit_exitType_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_exitType_loader').hide();
			$('#edit_exitType_btn').show();

			$('#edit_exitType_error').html('error');
		})
		.then(function() {
			// always executed
		});
}

function editExitType() {
	$('#edit_exitType_error').html('');
	let id = $('#edit_exitType_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	$('#edit_exitType_btn').hide();
	$('#edit_exitType_loader').show();

	let name = $('#edit_exitType_name').val();

	let data = {
		exit_type: name,
		exit_type_id: id,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/edit_exit_type`,
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
			$('#edit_exitType_loader').hide();
			$('#edit_exitType_btn').show();
			$('#edit_exitType_error').html(res.responseJSON.msg);
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_exitType_loader').hide();
				$('#edit_exitType_btn').show();

				$('#edit_exitType_modal').modal('hide');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listExitType(),
				});
			}
		},
	});
}

function deleteExitType(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#exitType_row${id}`).hide();
		$(`#exitType_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			exit_type_id: id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_exit_type`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#exitType_loader${id}`).hide();
				$(`#exitType_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#exitType_row${id}`).remove();
					$(`#exitType_loader${id}`).remove();
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
//Exit Type end

//Interview start
function addInterviewQuestion() {
	let company_id = localStorage.getItem('company_id');

	$('#add_interview_btn').hide();
	$('#add_interview_loader').show();

	let name = $('#interview_question').val();

	let data = {
		question: name,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_interview_question`,
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
			$('#add_interview_loader').hide();
			$('#add_interview_btn').show();
			$('#interview_error').html(error.responseJSON.msg);
			// alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_interview_loader').hide();
				$('#add_interview_btn').show();

				$('#interview_question').val('');
				$(`#collapseExample2`).removeClass('in');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listInterviewQuestion(),
				});
			}
		},
	});
}

function listInterviewQuestion() {
	let company_id = localStorage.getItem('company_id');
	$('#list_interview_table').hide();
	$('#list_interview_loader').show();
	axios
		.get(`${api_path}hrm/get_interview_question`, {
			params: {},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let interview_list = '';
			// const { employee_cv_work_history } = response.data.data;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					interview_list += `<div style="display:flex; justify-content:space-between;" id="interview_row${v.question_id}">
			                            <li style="list-style-type: disclosure-closed !important; background: none;">
			                            ${v.interview_questions}
			                            </li>
			                            <div class="dropdown" style="">
			                                <button
			                                    class="btn btn-secondary dropdown-toggle"
			                                    type="button"
			                                    id="dropdownMenuButton1"
			                                    data-toggle="dropdown"
			                                    aria-expanded="false">
			                                    Actions
			                                </button>
			                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			                                    <li onClick="viewInterviewQuestion(${v.question_id})">
			                                        <a class="dropdown-item">
			                                            <i class="fa fa-pencil" /> Edit
			                                        </a>
			                                    </li>
			                                    <li onClick="deleteInterviewQuestion(${v.question_id})">
			                                        <a class="dropdown-item">
			                                            <i class="fa fa-trash" /> Delete
			                                        </a>
			                                    </li>
			                                </ul>
			                            </div>
			                        </div>`;
					interview_list += `<li id="interview_loader${v.question_id}" style="display:none; background:none;"><i class="fa fa-spinner fa-spin fa-fw"></i></li>`;
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

function viewInterviewQuestion(id) {
	$('#edit_interview_error').html('');
	$('#edit_interview_modal').modal('show');
	$('#edit_interview_btn').hide();
	$('#edit_interview_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/single_interview_question`, {
			params: {
				question_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_interview_loader').hide();
			$('#edit_interview_btn').show();

			let { interview_questions } = response.data.data;
			$('#edit_interview_name').val(interview_questions);
			$('#edit_interview_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_interview_loader').hide();
			$('#edit_interview_btn').show();

			$('#edit_interview_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editInterviewQuestion() {
	$('#edit_interview_error').html('');
	let id = $('#edit_interview_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	$('#edit_interview_btn').hide();
	$('#edit_interview_loader').show();

	let name = $('#edit_interview_name').val();

	let data = {
		question: name,
		question_id: id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_interview_question`,
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
			$('#edit_interview_loader').hide();
			$('#edit_interview_btn').show();
			$('#edit_interview_error').html(res.responseJSON.msg);
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_interview_loader').hide();
				$('#edit_interview_btn').show();

				$('#edit_interview_modal').modal('hide');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listInterviewQuestion(),
				});
			}
		},
	});
}

function deleteInterviewQuestion(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#interview_row${id}`).hide();
		$(`#interview_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			question_id: id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_interview_question`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#interview_loader${id}`).hide();
				$(`#interview_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#interview_row${id}`).remove();
					$(`#interview_loader${id}`).remove();
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
//Interview end

// policy start
function addPolicy() {
	$('#add_policy_error').html('');
	let company_id = localStorage.getItem('company_id');

	$('#add_policy_btn').hide();
	$('#add_policy_loader').show();

	let note = $('#summernote').summernote('code');
	let upImage = document.querySelector(`#policy_file`).files[0];
	let policy_id = $('#add_policy_btn').attr('data');

	let data = new FormData();
	data.append('file', upImage);
	data.append('note', note);
	// data.append('company_id', company_id);
	data.append('policy_id', policy_id);
	console.log(data);

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: `${api_path}hrm/create_exit_policy`,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		data: data,

		error: function(error) {
			console.log(error);
			$('#add_policy_loader').hide();
			$('#add_policy_btn').show();
			$('#add_policy_error').html(error.responseJSON.msg);
			// alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_policy_loader').hide();
				$('#add_policy_btn').show();

				$(`#collapseExample3`).removeClass('in');
				$('#summernote').summernote('code', '');
				document.getElementById('policy_file').value = null;

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listPolicy(),
				});
			}
		},
	});
}

function listPolicy() {
	let company_id = localStorage.getItem('company_id');
	$('#list_policy_table').hide();
	$('#list_policy_loader').show();
	axios
		.get(`${api_path}hrm/get_exit_policy`, {
			params: {},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let policy_list = '';
			console.log(' policy', response.data.data);
			// const { employee_cv_work_history } = response.data.data;

			if (response.data.data !== '') {
				const { policy_document, policy_note, policy_id } = response.data.data;
				$('#add_policy_btn').attr('data', policy_id);

				if (policy_document === '') {
					$('#policy_list').html(policy_note);
				} else if (policy_document !== '' && policy_note !== '') {
					$('#policy_list').html(
						`${policy_note} <div><a target="_blank" href="${window.location
							.origin}/files/images/greviance_document/${policy_document}"><button class="btn btn-sm btn-primary">View Document</button></a></div>`,
					);
				} else if (policy_note === '') {
					$('#policy_list').html(
						`<div><a target="_blank" href="${window.location
							.origin}/files/images/greviance_document/${policy_document}"><button class="btn btn-sm btn-primary">View Document</button></a></div>`,
					);
				}

				// $('#policy_list').html(policy_list);
				// $('#list_policy_body').html(policy_list);
				$('#list_policy_loader').hide();
				$('#list_policy_table').show();
			} else {
				$('#policy_list').html(`<p>No Policy</p>`);
				$('#list_policy_loader').hide();
				$('#list_policy_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#list_policy_loader').hide();
			$('#list_policy_table').show();
			$('#policy_list').html(`<p style="color:red;">Error</p>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}
// policy end
