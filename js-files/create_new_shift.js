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

	$(document).on('click', '#add_work_shift', function() {
		add_work_shift();
	});
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-82-') >= 0) {
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		populate_weeks();
	} else {
		$('#loader_mssg').html('You do not have access to this page');
		$('#ldnuy').hide();
		// $("#modal_no_access").modal('show');
	}
}

function add_work_shift() {
	var workshift_dtl = [];
	let weekdays = [
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday',
		'Saturday',
		'Sunday',
	];

	$('.day_line').each(function() {
		var id = $(this).attr('id').replace(/the_day_/, '');
		var start_time = $('#stst_' + id).val();
		var end_time = $('#endst_' + id).val();

		// if (start_time != '' && end_time != '') {
		workshift_dtl.push({
			day_id: id,
			start_time: start_time,
			end_time: end_time,
			weekday_name: weekdays[id - 1],
		});
		// }
	});

	let duration = $('#duration').val();
	let hrs = $('#duration_hrs').val();
	let joint = `${duration} ${hrs}`;

	var data = new Array();
	data['work_shift_name'] = $('#shift_name').val();
	data['date_settings'] = workshift_dtl;
	data['duration'] = joint;

	// console.log(data);

	$('#create_loader').show();
	$('#add_work_shift').hide();
	datat = {
		company_id: localStorage.getItem('company_id'),
		shift_name: data['work_shift_name'],
		day_of_the_week: data['date_settings'],
		duration: data['duration'],
	};

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/create',
		data: {
			shift_name: data['work_shift_name'],
			day_of_the_week: data['date_settings'],
			duration: data['duration'],
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
					// onClose: (window.location.href = 'work_shift'),
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_dept').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_dept').html(response.msg);
			}

			$('#create_loader').hide();
			$('#add_work_shift').show();
		},

		error: function(response) {
			$('#create_loader').hide();
			$('#add_work_shift').show();
			Swal.fire({
				title: 'Error!',
				text: `${response.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
	});
}

function populate_weeks() {
	var weekdays = [
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday',
		'Saturday',
		'Sunday',
	];

	var weekdayslength = weekdays.length;
	var loopcontent = '';
	for (var i = 0; i < weekdayslength; i++) {
		var day_id = i + 1;

		loopcontent +=
			'<tr class="headings">       <!-- <th class="column-title"><input type="checkbox"></th> -->                                               <th class="column-title flat day_line"  id="the_day_' +
			day_id +
			'">' +
			weekdays[i] +
			' &nbsp; &nbsp; </th>                              <th class="column-title"> <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control start_time" value="" id="stst_' +
			day_id +
			'" /> </div> </th>                              <th class="column-title">  <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control end_time" value="" id="endst_' +
			day_id +
			'" /> </div>   </th>                               </tr> ';
	}

	$('#wkdz').html(loopcontent);
}

$(function() {
	$('.start_time').datetimepicker({
		format: 'h:mm A',
	});
});

$(function() {
	$('.end_time').datetimepicker({
		format: 'h:mm A',
	});
});
