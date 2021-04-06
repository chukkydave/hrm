function fetch_employee_details() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = window.location.search.split('=')[1]; //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	// $('#page_loader').hide();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { company_id: company_id, employee_id: employee_id },
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();
			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				$('#firstname').html(response.data.firstname);
				$('#lastname').html(response.data.lastname);
				$('#gender').html(response.data.gender);
				$('#middlename').html(response.data.middlename);
				$('#dob').html(response.data.dob);
				$('#marital_status').html(response.data.marital_status);
				$('#phone').html(response.data.phone);
				$('#residential_address').html(response.data.residential_address);
				$('#email').html(response.data.email);
				$('#religion').html(response.data.religion);
				$('#next_of_kin').html(response.data.next_of_kin);

				$('#profile_name').html(
					'<b>' + response.data.firstname + ' ' + response.data.lastname + '</b>',
				);

				str2 +=
					'<a href="' +
					base_url +
					'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'edit_employee?id=' +
					response.data.employee_id +
					'"><button id="send" class="btn btn-primary">Edit</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_id +
					'">Leave History</a></li>';

				// str += '<li><i class="fa fa-external-link user-profile-icon"></i>&nbsp;&nbsp;';
				// str += '<a href="<?= base_url() ?>hrm/view_supervisor/'+response.data.employee_id+'">Supervisor/Manager</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_id +
					'">Attendance</a></li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}
