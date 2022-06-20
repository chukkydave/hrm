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

	var goTimeout;

	function myTimer() {
		goTimeout = setTimeout(function() {
			$('#save_desc_div').fadeOut();
		}, 10000);
	}
	// myTimer();

	// when mouse enter's popup element and/or user types in input
	// should turn off the setTimeout
	$(document).on('touchstart click mouseenter keyup', '#desc_text', function(e) {
		e.stopPropagation();
		e.preventDefault();
		console.log(e);
		clearTimeout(goTimeout);
		$('#save_desc_div').fadeIn();
	});

	// when user mouse leave's the popup the timer starts again, but
	// if user is still focused within input field, don't start until
	// user clicks outside of the element
	$(document).on('mouseleave blur', '#desc_text', function(e) {
		e.stopPropagation();
		e.preventDefault();
		console.log(e);
		clearTimeout(goTimeout);
		myTimer();
	});

	$('#add_header_btn').on('click', addHeader);
	$('#add_desc_btn').on('click', addDESC);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	if (pack_list.indexOf('-3-') >= 0) {
		if (role_list.indexOf('-76-') >= 0 || role_list.indexOf('-73-') >= 0) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			fetch_grievance_info();
			viewProceedings();
		} else {
			$('#loader_mssg').html('You do not have access to this page');
			$('#ldnuy').hide();
			// $("#modal_no_access").modal('show');
		}

		if (role_list.indexOf('-76-') >= 0 || role_list.indexOf('-74-') >= 0) {
			$('#add_header_details').show();

			$('#desc_text').attr('disabled', false);
			$('#add_desc_btn').attr('disabled', false);
		}
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function fetch_grievance_info() {
	let grievance_id = window.location.search.split('=')[1];
	var company_id = localStorage.getItem('company_id');

	// $('#gr_' + grievance_id).hide();
	// $('#loader11_' + grievance_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/view_single_grievance',
		data: {
			// company_id: company_id,
			grievance_id: grievance_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			// $('#loader11_' + grievance_id).hide();
			// $('#gr_' + grievance_id).show();

			if (response.status == '200') {
				var monthNames = [
					'Jan',
					'Feb',
					'Mar',
					'Apr',
					'May',
					'Jun',
					'Jul',
					'August',
					'Sep',
					'Oct',
					'Nov',
					'Dec',
				];

				var s = new Date(response.data.incident_date);
				var month = s.getMonth();
				var datestring = s.getDate() + '/' + monthNames[month] + '/' + s.getFullYear();

				let doc;

				if (response.data.document === null || response.data.document === '') {
					doc = 'No document Uploaded';
				} else {
					doc = `<a target="_blank" href="${window.location
						.origin}/files/images/greviance_document/${response.data
						.document}">View Document</a>`;
				}

				if (response.data.greviance_status === 'resolved') {
					$('#desc_text').hide();
					$('#desc_text_div').css('display', 'grid');
					$('#add_header_details').hide();
				}

				$('#griev_code').html(response.data.g_code);
				$('#griev_type').html(capitalizeFirstLetter(response.data.gri_type));
				$('#griev_from').html(response.data.g_by_full_name);
				$('#griev_aganist').html(response.data.g_against_full_name);
				$('#griev_date').html(datestring);
				$('#griev_report').html(response.data.incident);
				$('#griev_branch').html(response.data.branch_name);
				$('#desc_text').val(response.data.grievance_proceeding_description);
				$('#desc_text2').html(response.data.grievance_proceeding_description);
				$('#griev_doc').html(doc);

				// $('#modal_view_g #g_type').html(response.data.gri_type);
				// $('#modal_view_g #incident_date').html(datestring);
				// $('#modal_view_g #approval').html();
				// $('#modal_view_g #report').html(response.data.incident);
				// $('#modal_view_g #response').html();
				// $('#modal_view_g #branch').html();

				// $('#modal_view_g').modal('show');
			}
		},

		error: function(response) {
			// $('#loader11_' + grievance_id).hide();
			// $('#gr_' + grievance_id).show();
			alert('Connection Error.');
		},
	});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function viewProceedings() {
	// $('#edit_nok_error').html('');
	// $('#edit_nok_modal').modal('show');
	// $('#edit_nok_btn').hide();
	// $('#edit_nok_loader').show();

	let company_id = localStorage.getItem('company_id');
	let id = window.location.search.split('=')[1];
	let page = 1;
	let limit = 10;
	// let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/get_proceeding_header`, {
			params: {
				grievance_id: id,
				// company_id: company_id,
				// page: page,
				// limit: limit,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let comment = '';
			console.log(response.data.data);
			$(response.data.data).each((i, v) => {
				if (v.greviance_status !== 'resolved') {
					if (v.is_comment_allowed === 'allowed') {
						comment += `<div>`;
						comment += `<div style="">
										<div style="display:flex;"  id="header${v.header_id}">
											<h2><strong>${v.header}</strong></h2>
											<i style="padding:12px;" onClick="hideandShow(${v.header_id})" class="fa fa-pencil"></i>
										</div>
										<div style="display:none;" id="headerInput${v.header_id}">
											<input type="text" id="header_name${v.header_id}" value="${v.header}">
											<button class="btn btn-sm btn-primary" style="margin-left:1em;" id="edit_header_btn${v.header_id}" onClick="editHeader(${v.header_id}, '${v.is_comment_allowed}')">Save</button>
											<i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;" id="edit_header_loader${v.header_id}"></i>
											<i class="fa fa-times-circle" style="color:red;margin-left:0.5em;" onClick="hideandShowRev(${v.header_id})"></i>
										</div>
                                	</div>`;

						if (v.comments.length > 0) {
							comment += `<ul class="messages">`;
							$(v.comments).each((i, v) => {
								let date = moment(v.created_at, 'YYYY-MM-DD HH:mm:ss').format(
									'LLL',
								);
								comment += `<li>
                                            <div class="message_wrapper">
                                                <h4 class="heading">${v.fullname}</h4>
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 1em;">
                                                    <blockquote>
                                                        <p>${v.comments}</p>
                                                    </blockquote>
                                                    <p style="font-size:0.7em;margin-top:5px;">${date}</p>
                                                </div>
                                                <br />
                                                ${
													v.documents ? `<p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a target="_blank" href="${window.location
														.origin}/files/images/greviance_document/${v.documents}"><i class="fa fa-paperclip"></i> View File</a>
                                                </p>` :
													''}
                                        
                                            </div>
                                        </li>`;
							});
							comment += `</ul>`;
						}
						comment += `<div class="btn-group">
                                    <button class="btn" data-toggle="collapse"
                                        data-target="#collapseExample${v.proceeding_id}" aria-expanded="false"
                                        aria-controls="collapseExample" type="button"><i class="fa fa-comment"></i>
                                        Comment</button>
                                </div>
                                <br>`;
						comment += `<div class="collapse" id="collapseExample${v.proceeding_id}"
                                    style="padding-left: 0; margin-top: 10px;">
                                    <textarea cols="5" id="comment_text${v.proceeding_id}" class="form-control col-md-7 col-xs-12">

                                    </textarea>
                                    <div>
                                        <input type="file" id="comment_file${v.proceeding_id}" class="form-control col-md-7 col-xs-12"
                                            style="border:none;">
                                    </div>


                                    <div class="text-danger" id="comment_error${v.proceeding_id}"></div>

                                    <div style="margin-top:10px;">
                                        <button class="btn btn-primary btn-sm" id="add_comment_btn${v.proceeding_id}" onClick="addComment(${v.proceeding_id})">Save</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="add_comment_loader${v.proceeding_id}"></i>
                                    </div>
                                </div>`;
						comment += `</div><hr>`;
					} else {
						// comment += `<div>`
						comment += `<div style="display:flex;">
                                    <div style="display:flex;" id="header${v.header_id}">
                                        <h2><strong>${v.header}</strong></h2>
                                        <i style="padding:12px;" onClick="hideandShow(${v.header_id})" class="fa fa-pencil"></i>
                                    </div>
                                    <div style="display:none;" id="headerInput${v.header_id}">
                                        <input type="text" id="header_name${v.header_id}" value="${v.header}">
                                        <button class="btn btn-sm btn-primary" style="margin-left:1em;" id="edit_header_btn${v.header_id}, '${v.is_comment_allowed}'" onClick="editHeader(${v.header_id}, ${v.is_comment_allowed})">Save</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;" id="edit_header_loader${v.header_id}"></i>
                                        <i class="fa fa-times-circle" style="color:red;margin-left:0.5em;" onClick="hideandShowRev(${v.header_id})"></i>
                                    </div>
                                </div>`;

						// comment += `</div>`
					}
				} else {
					if (v.is_comment_allowed === 'allowed') {
						comment += `<div>`;
						comment += `<div style="display:flex;">
										<div style="display:flex;" id="header${v.header_id}">
											<h2><strong>${v.header}</strong></h2>
										</div>
                                    
                                	</div>`;

						if (v.comments.length > 0) {
							comment += `<ul class="messages">`;
							$(v.comments).each((i, v) => {
								let date = moment(v.created_at, 'YYYY-MM-DD HH:mm:ss').format(
									'LLL',
								);
								comment += `<li>
                                            <div class="message_wrapper">
                                                <h4 class="heading">${v.fullname}</h4>
                                                <div class="col-md-12 col-sm-12" style="margin-bottom: 1em;">
                                                    <blockquote>
                                                        <p>${v.comments}</p>
                                                    </blockquote>
                                                    <p style="font-size:0.7em;margin-top:5px;">${date}</p>
                                                </div>
                                                <br />
                                                ${
													v.documents ? `<p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a target="_blank" href="${window.location
														.origin}/files/images/greviance_document/${v.documents}"><i class="fa fa-paperclip"></i> View File</a>
                                                </p>` :
													''}
                                        
                                            </div>
                                        </li>`;
							});
							comment += `</ul>`;
						}

						comment += `</div><hr>`;
					} else {
						// comment += `<div>`
						comment += `<div style="display:flex;">
                                    <div style="display:flex;" id="header${v.header_id}">
                                        <h2><strong>${v.header}</strong></h2>
                                    </div>
                                    
                                </div>`;

						// comment += `</div>`
					}
				}
			});

			$('#proceeding_section').html(comment);
		})
		.catch(function(error) {
			alert(error);

			// $('#edit_nok_loader').hide();
			// $('#edit_nok_btn').show();

			// $('#edit_nok_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function addHeader() {
	$('#header_error').html('');
	let company_id = localStorage.getItem('company_id');
	let grievance_id = window.location.search.split('=')[1];
	let header = $('#header_name').val();

	let allow;

	if ($('#desc_allow').is(':checked')) {
		allow = 'allowed';
	} else {
		allow = 'not_allowed';
	}

	if (!header) {
		$('#header_error').html('Empty field');
		return;
	} else {
		$('#add_header_btn').hide();
		$('#add_header_loader').show();

		let data = {
			header: header,
			// company_id: company_id,
			grievance_id: grievance_id,
			is_comment_allowed: allow,
		};
		$.ajax({
			type: 'Post',
			dataType: 'json',
			url: `${api_path}hrm/create_proceeding_header`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},
			error: function(error) {
				console.log(error);
				$('#add_header_loader').hide();
				$('#add_header_btn').show();
				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$('#add_header_loader').hide();
					$('#add_header_btn').show();
					$('#header_name').val('');

					// $('#NOK_display').toggle();

					viewProceedings();
				}
			},
		});
	}
}

function addDESC() {
	$('#desc_error').html('');
	let company_id = localStorage.getItem('company_id');
	let grievance_id = window.location.search.split('=')[1];
	let desc = $('#desc_text').val();

	if (!desc) {
		$('#desc_error').html('Empty field');
		return;
	} else {
		$('#add_desc_btn').hide();
		$('#add_desc_loader').show();

		let data = {
			description: desc,
			// company_id: company_id,
			grievance_id: grievance_id,
		};
		$.ajax({
			type: 'Put',
			dataType: 'json',
			url: `${api_path}hrm/add_proceeding_header`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},
			error: function(error) {
				console.log(error);
				$('#add_desc_loader').hide();
				$('#add_desc_btn').show();
				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$('#add_desc_loader').hide();
					$('#add_desc_btn').show();
					// $('#desc_text').val('');

					// $('#NOK_display').toggle();

					// viewProceedings();
				}
			},
		});
	}
}

function addComment(proceedings_id) {
	$('#comment_error').html('');
	let company_id = localStorage.getItem('company_id');
	let grievance_id = window.location.search.split('=')[1];
	let comment_by = localStorage.getItem('user_id');
	let comment = $(`#comment_text${proceedings_id}`).val().trim();
	console.log(typeof comment);
	if (comment.length < 1) {
		$(`#comment_error${proceedings_id}`).html('Empty field');
		return;
	} else {
		$(`#add_comment_btn${proceedings_id}`).hide();
		$(`#add_comment_loader${proceedings_id}`).show();

		let upImage = document.querySelector(`#comment_file${proceedings_id}`).files[0];

		let data = new FormData();
		data.append('file', upImage);
		data.append('greviance_id', grievance_id);
		data.append('proceedings_id', proceedings_id);
		data.append('comment_by', comment_by);
		// data.append('greviance_against', greviance_against);
		// data.append('company_id', company_id);
		data.append('comments', comment);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			cache: false,
			url: `${api_path}ess/create_or_update_proceedings`,
			processData: false,
			contentType: false,
			headers: {
				enctype: 'multipart/form-data',
				Authorization: localStorage.getItem('token'),
			},
			data: data,

			error: function(error) {
				console.log(error);
				$(`#add_comment_loader${proceedings_id}`).hide();
				$(`#add_comment_btn${proceedings_id}`).show();
				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#add_comment_loader${proceedings_id}`).hide();
					$(`#add_comment_btn${proceedings_id}`).show();
					$(`#comment_text${proceedings_id}`).val('');
					$(`#collapseExample${proceedings_id}`).removeClass('in');
					viewProceedings();
					// $('#desc_text').val('');

					// $('#NOK_display').toggle();

					// viewProceedings();
				}
			},
		});
	}
}

function hideandShow(id) {
	$(`#header${id}`).css('display', 'none');
	$(`#headerInput${id}`).css('display', 'block');
	$(`#headerInput${id}`).attr('autofocus', true);
}

function hideandShowRev(id) {
	$(`#headerInput${id}`).css('display', 'none');
	$(`#header${id}`).css('display', 'flex');
}

function editHeader(id, allow) {
	// $('#header_error').html('');
	let company_id = localStorage.getItem('company_id');
	let grievance_id = window.location.search.split('=')[1];
	let header = $(`#header_name${id}`).val();

	if (!header) {
		// $('#header_error').html('Empty field');
		alert('Empty fields');
		return;
	} else {
		$(`#edit_header_btn${id}`).hide();
		$(`#edit_header_loader${id}`).show();

		let data = {
			header: header,
			// company_id: company_id,
			grievance_id: grievance_id,
			is_comment_allowed: allow,
			header_id: id,
		};
		$.ajax({
			type: 'Post',
			dataType: 'json',
			url: `${api_path}hrm/create_proceeding_header`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},
			error: function(error) {
				console.log(error);
				$(`#edit_header_loader${id}`).hide();
				$(`#edit_header_btn${id}`).show();
				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#edit_header_loader${id}`).hide();
					$(`#edit_header_btn${id}`).show();
					// $('#header_name').val('');

					// $('#NOK_display').toggle();

					viewProceedings();
				}
			},
		});
	}
}
