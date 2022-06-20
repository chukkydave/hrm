$(document).ready(function() {
	// $('#reservation').val('');
	// get_audit_trail_list('');

	$('input#reservationtt').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(
			picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'),
		);
		$('#pagination').twbsPagination('destroy');
		get_audit_trail_list('');
	});
	$('input#reservationtt').daterangepicker({
		autoUpdateInput: true,
		showDropdowns: true,
		linkedCalendars: false,
		locale: {
			format: 'YYYY/MM/DD',
		},
		// autoApply: true,
	});

	get_audit_trail_list('');

	// $(document).on('change', '#activity', function() {
	// 	$('#pagination').twbsPagination('destroy');
	// 	get_audit_trail_list('');
	// });

	// $(document).on('change', '#reportrange', function() {
	// 	// $('#pagination').twbsPagination('destroy');
	// 	// get_audit_trail_list('');
	// 	alert($('#reportrange').val());
	// });

	$(document).on('click', '#go', function() {
		if ($('#name_audit').val() == '') {
			alert('blank field!');
			return;
		} else {
			$('#pagination').twbsPagination('destroy');
			get_audit_trail_list('');
		}
	});
});

function convert_date_to_dashes(the_date) {
	var array = the_date.split('/');
	var month = array[0];
	var date = array[1];
	var year = array[2];

	var rearranged = year + '-' + month + '-' + date;
	return rearranged;
}

// function validateEmail(emailaddress) {
// 	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2, 4})?$/;

// 	if (!emailReg.test(emailaddress)) {
// 		return false;
// 	} else {
// 		return true;
// 	}
// }

function IsEmailt(email) {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!regex.test(email)) {
		return false;
	} else {
		return true;
	}
}

// function get_audit_trail_listOLD(page) {
// 	// var activity = $('#activity').val();
// 	var name = $('#name_audit').val();
// 	var date_range = $('#reservationtt').val();

// 	// if (date_range != '') {
// 	// 	var sds = date_range.split(' - ');
// 	// 	var sdate = convert_date_to_dashes(sds[0]);
// 	// 	var edate = convert_date_to_dashes(sds[1]);
// 	// } else {
// 	// 	var sdate = '';
// 	// 	var edate = '';
// 	// }
// 	if (page == '') {
// 		var page = 1;
// 	}

// 	var page_limit = 10;
// 	let module_id = $('#page_app_id').html();

// 	$('#loading').show();
// 	$('#audit').html('');

// 	// activity / fetch_logs ? module_id = 13 & page=1 & limit=10

// 	// url: api_path + 'hrm/list_of_company_employees',
// 	// &name=mazi&date_range="2022/02/23 - 2022/02/28"

// 	$.ajax({
// 		type: 'GET',
// 		dataType: 'json',
// 		url:
// 			api_path +
// 			'activity/fetch_logs?limit=' +
// 			page_limit +
// 			'&page=' +
// 			page +
// 			'&module_id=' +
// 			module_id +
// 			'&name=' +
// 			name +
// 			'&date_range=' +
// 			date_range,
// 		// '&edate=' +
// 		// edate +
// 		// '&category=' +
// 		// activity,
// 		headers: {
// 			Authorization: localStorage.getItem('token'),
// 		},

// 		success: function(response) {
// 			console.log(response);
// 			$('#loading').hide();
// 			var str = '';

// 			if (response.status == '200') {
// 				if (response.data.length > 0) {
// 					var k = 1;

// 					var monthNames = [
// 						'January',
// 						'Febuary',
// 						'March',
// 						'April',
// 						'May',
// 						'June',
// 						'July',
// 						'August',
// 						'September',
// 						'October',
// 						'November',
// 						'December',
// 					];

// 					var dayNames = [
// 						'Sunday',
// 						'Monday',
// 						'Tuesday',
// 						'Wednesday',
// 						'Thursday',
// 						'Friday',
// 						'Saturday',
// 					];

// 					var d = new Date();
// 					var dayIndex = d.getDay();
// 					var monthIndex = d.getMonth();
// 					var datestring =
// 						dayNames[dayIndex] +
// 						', ' +
// 						monthNames[monthIndex] +
// 						' ' +
// 						d.getDate() +
// 						', ' +
// 						d.getFullYear();

// 					$('#current_day').html(datestring);

// 					var time = '';

// 					$(response.data).each(function(index, value) {
// 						// time = $.timeago(new Date(value.datecreated));
// 						time = moment(value.created_date).format('dddd, MMMM Do, YYYY hh:mm a');

// 						// var time = moment(response['data'][i]['datecreated']).fromNow()

// 						str += '<ul id="bullet">';

// 						str +=
// 							'<div style=" border-left: 2px solid #add8e6; height: 15px; margin-left: 9px;"></div>';

// 						str +=
// 							'<p style="color: #146027; font-size: 8px;" class="pull-left">&nbsp;</p>';
// 						str += '<li class="passed">';
// 						str +=
// 							'<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 0; padding-left: 0; padding-right: 8px; margin-right; 8px;">';
// 						str += '<div class="tile-stats">';
// 						// str +=
// 						// 	'<p style="color: #146027; font-size: 12px;"><strong>IP Address:<small>' +
// 						// 	value.ip_address +
// 						// 	'</small></strong></p>';
// 						str +=
// 							'<p style="color: #146027; font-size: 14px;"><strong>' +
// 							value.action_performed +
// 							'.</strong><br><small>' +
// 							time +
// 							'</small></p>';

// 						str += '</div>';
// 						str += '</div>';

// 						str += '</li>';

// 						str +=
// 							'<div style=" border-left: 2px solid #add8e6; height: 15px; margin-left: 9px;"></div>';

// 						str += '</ul>';

// 						k++;
// 					});

// 					$('#audit').html(str);
// 					$('#loading').hide();
// 					$('#audit').show();
// 				} else {
// 					$('#loading').hide();
// 					$('#audit').html('<strong><h4>No record for today!</h4></strong>');
// 					$('#audit').show();
// 					$('#pagination').twbsPagination('destroy');
// 				}

// 				// response.total_rows
// 				let totalts = Number(response.total_rows);
// 				// alert(totalts);
// 				if (totalts > 0) {
// 					$('#pagination').twbsPagination({
// 						totalPages: Math.ceil(totalts / page_limit),
// 						visiblePages: 5,
// 						onPageClick: function(event, page) {
// 							get_audit_trail_list(page);
// 						},
// 					});
// 				}

// 				// $("#audit").html(str);
// 				// $("#audit").show();
// 			} else if (response.status == '400') {
// 				$('#loading').hide();
// 				$('#audit').html();
// 				$('#audit').show();
// 			} else if (response.status == '401') {
// 				//missing parameters

// 				$('#loading').hide();
// 				$('#audit').html();
// 				$('#audit').show();
// 			}

// 			$('#loading').hide();
// 		},

// 		error: function(response) {
// 			// alert("error");
// 			console.log('ii ' + response);

// 			$('#loading').hide();
// 			$('#audit').html('<strong class="text-danger">Connection error!</strong>');
// 			$('#audit').show();
// 		},
// 	});
// }

function get_audit_trail_list(page) {
	// var activity = $('#activity').val();
	$('#list_audit_table').hide();
	$('#list_audit_loader').show();
	var name = $('#name_audit').val();
	var date_range = $('#reservationtt').val();

	if (page == '') {
		var page = 1;
	}

	var page_limit = 10;
	let module_id = $('#page_app_id').html();

	$('#loading').show();
	$('#audit').html('');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url:
			api_path +
			'activity/fetch_logs?limit=' +
			page_limit +
			'&page=' +
			page +
			'&module_id=' +
			module_id +
			'&name=' +
			name +
			'&date_range=' +
			date_range,

		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			let audit_list = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;

					$(response.data).each(function(index, value) {
						let createdTime = moment(value.created_date, 'YYYY-MM-DD HH:mm:ss').format(
							'LLL',
						);
						const mySentence = value.description;

						let finalSentence = mySentence.replace(/(^\w{1})|(\s+\w{1})/g, (letter) =>
							letter.toUpperCase(),
						);

						audit_list += `<tr class="" id="row_${value.id}">`;
						audit_list += `<td>${createdTime}</td>`;
						audit_list += `<td>${value.action}</td>`;
						audit_list += `<td>${value.performed_by}</td>`;
						audit_list += `<td>${value.performed_against}</td>`;
						audit_list += `<td>${value.section}</td>`;
						audit_list += `<td>${finalSentence}</td>`;
						audit_list += `</tr>`;
						k++;
					});

					$('#list_audit_body').html(audit_list);
					$('#list_audit_loader').hide();
					$('#list_audit_table').show();
				} else {
					$('#list_audit_body').html(`<tr><td colspan="6">No record</td></tr>`);
					$('#list_audit_loader').hide();
					$('#list_audit_table').show();
					$('#pagination').twbsPagination('destroy');
				}

				// response.total_rows
				let totalts = Number(response.total_rows);
				// alert(totalts);
				if (totalts > 0) {
					$('#pagination').twbsPagination({
						totalPages: Math.ceil(totalts / page_limit),
						visiblePages: 5,
						onPageClick: function(event, page) {
							get_audit_trail_list(page);
						},
					});
				}

				// $("#audit").html(str);
				// $("#audit").show();
			} else if (response.status == '400') {
				$('#list_audit_loader').hide();
				$('#list_audit_table').show();
				$('#list_audit_body').html(
					`<tr><td colspan="6" style="color:red;">${response.msg}</td></tr>`,
				);
			} else if (response.status == '401') {
				//missing parameters

				$('#list_audit_loader').hide();
				$('#list_audit_table').show();
				$('#list_audit_body').html(
					`<tr><td colspan="6" style="color:red;">${response.msg}</td></tr>`,
				);
			}

			// $('#loading').hide();
		},

		error: function(response) {
			// alert("error");
			$('#list_audit_loader').hide();
			$('#list_audit_table').show();
			$('#list_audit_body').html(
				`<tr><td colspan="6" style="color:red;">${response.msg}</td></tr>`,
			);
		},
	});
}
