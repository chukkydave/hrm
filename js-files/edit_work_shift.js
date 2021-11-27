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
	$('#edit_work_shift').on('click', edit_work_shift);
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		get_shift_details();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}
function edit_work_shift() {
	var workshift_dtl = [];

	$('.day_line').each(function() {
		var id = $(this).attr('dir').replace(/row_/, '');
		var weekday_id = $(this).attr('id').replace(/the_day_/, '');
		var start_time = $('#stst_' + id).val();
		var end_time = $('#endst_' + id).val();

		workshift_dtl.push({
			row_id: id,
			week_day_id: weekday_id,
			start_time: start_time,
			end_time: end_time,
		});
	});

	let duration = $('#duration').val();
	let hrs = $('#duration_hrs').val();
	let joint = `${duration} ${hrs}`;

	//get current id
	// var pathArray = window.location.pathname.split( '/' );
	var shift_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
	var shift_name = $('#shift_name').val();

	$('#edit_work_shift').hide();
	$('#edit_work_shift_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/update_workshift',
		data: {
			shift_id: shift_id,
			shift_name: shift_name,
			day_list: workshift_dtl,
			duration: joint,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					// onClose: leave_types(''),
				});

				$('#edit_work_shift').show();
				$('#edit_work_shift_loader').hide();
			} else if (response.status == '400') {
				// coder error message
				$('#edit_work_shift').show();
				$('#edit_work_shift_loader').hide();
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			} else if (response.status == '401') {
				//user error message
				$('#edit_work_shift').show();
				$('#edit_work_shift_loader').hide();
				Swal.fire({
					title: 'Error!',
					text: `${response.statusText}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}
		},

		error: function(response) {
			$('#edit_work_shift').show();
			$('#edit_work_shift_loader').hide();
			Swal.fire({
				title: 'Error!',
				text: `${response.statusText}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
	});
}

function get_shift_details() {
	// var pathArray = window.location.pathname.split( '/' );
	var shift_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/get_workshift',
		data: { shift_id: shift_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#shift_name').val(response.data.shift_name);
				var the_list = '';
				// let dura = $(response.data.duration).split(' ');
				$('#duration').val(response.data.duration);
				$(response.data.shift_days).each(function(index, value) {
					the_list +=
						'<tr class="headings">   <th class="column-title flat day_line"  id="the_day_' +
						value.week_day_id +
						'" dir="row_' +
						value.id +
						'">' +
						value.week_day_name +
						' &nbsp; &nbsp; </th> <th class="column-title"> <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control start_time" value="' +
						value.start_time +
						'" id="stst_' +
						value.id +
						'" /> </div> </th>                              <th class="column-title">  <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control end_time" value="' +
						value.end_time +
						'" id="endst_' +
						value.id +
						'" /> </div>  </th> </tr>';
				});

				$('#loading_dv').hide();
				$('#wkdz').html(the_list);
			} else if (response.status == '400') {
				// coder error message
			} else if (response.status == '401') {
				//user error message
			}
		},

		error: function(response) {
			console.log(response);
		},
	});
}

$(document).on('focus', '.start_time', function() {
	$(this).datetimepicker({
		format: 'h:mm A',
	});
});

$(document).on('focus', '.end_time', function() {
	$(this).datetimepicker({
		format: 'h:mm A',
	});
});
