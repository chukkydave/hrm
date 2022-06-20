$(document).ready(function() {
	//this time interval check if the user roles have been fetched before running anything on this page
	var myVar = setInterval(function() {
		if ($('#does_user_have_roles').html() != '') {
			//stop the loop
			myStopFunction();
			hide_show_tabs();
		} else {
			// document.querySelector('.hidata').style.display = 'none';
			$('.hidata').hide();

			// console.log('No profile');
		}
	}, 1000);

	function myStopFunction() {
		clearInterval(myVar);
	}
});

function hide_show_tabs() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	let menuList = '';
	if (
		role_list.indexOf('-152-') >= 0 ||
		role_list.indexOf('-83-') >= 0 ||
		role_list.indexOf('-151-') >= 0
	) {
		$('#dash_perm').show();
	}
	if (
		role_list.indexOf('-152-') >= 0 &&
		role_list.indexOf('-83-') < 0 &&
		role_list.indexOf('-151-') < 0
	) {
		$('#dash_perm').html('<a href="/hrm/"><i class="fa fa-home"></i> Home</a>');
		// menuList += `<li id=""><a href="/hrm/"><i class="fa fa-home"></i> Home</a></li>`;
	} else {
		// menuList += `<li id=""><a href="/hrm/"><i class="fa fa-home"></i> Dashboard</a></li>`;
	}

	if (
		role_list.indexOf('-56-') >= 0 ||
		role_list.indexOf('-57-') >= 0 ||
		role_list.indexOf('-58-') >= 0 ||
		role_list.indexOf('-59-') >= 0
	) {
		$('.emp_perm').show();
		// menuList += `<li class=""><a href="employees"><i class="fa fa-users"></i> Employees </a></li>`;
	}

	if (pack_list.indexOf('-4-') >= 0) {
		if (role_list.indexOf('-60-') >= 0 || role_list.indexOf('-61-') >= 0) {
			$('.att_perm').show();
			// menuList += `<li class=""><a><i class="fa fa-user"></i> Attendance<span
			//                                     class="fa fa-chevron-down"></span></a>

			//                             <ul class="nav child_menu">
			//                                 <li><a href="attendance">Daily Attendance</a></li>
			//                                 <li><a href="attendance_report">Attendance Report</a></li>

			//                             </ul>

			//                         </li>`;
		}
	}

	if (pack_list.indexOf('-2-') >= 0) {
		if (
			role_list.indexOf('-64-') >= 0 ||
			role_list.indexOf('-65-') >= 0 ||
			role_list.indexOf('-66-') >= 0 ||
			role_list.indexOf('-67-') >= 0
		) {
			$('.leaves_perm').show();
			// menuList += `<li class=""><a href="leaves"><i class="fa fa-edit"></i> Leaves </a></li>`;
		}
	}

	if (pack_list.indexOf('-5-') >= 0) {
		if (
			role_list.indexOf('-68-') >= 0 ||
			role_list.indexOf('-69-') >= 0 ||
			role_list.indexOf('-70-') >= 0 ||
			role_list.indexOf('-71-') >= 0 ||
			role_list.indexOf('-72-') >= 0
		) {
			$('.pay_permsi').show();

			// menuList += `<li class="" id="pay_permsi"><a><i class="fa fa-money"></i> Payroll <span
			//                                     class="fa fa-chevron-down"></span></a>

			//                             <ul class="nav child_menu">
			//                                 <li><a href="pay_schedule">Pay Schedule</a></li>
			//                                 <li><a href="payroll_history">Payroll History</a></li>
			//                             </ul>
			//                         </li>`;
		}
	} else {
		$('.feat_5').remove();
		$('.feat_5_css').removeClass('col-lg-3 col-md-3 col-sm-6 col-xs-12');
		$('.feat_5_css').addClass('col-lg-4 col-md-4 col-sm-6 col-xs-12');
		$('.feat_5_notice').removeClass('col-md-6 col-sm-6 col-xs-12');
		$('.feat_5_notice').addClass('col-md-12 col-sm-12 col-xs-12');
		$('.feat_5_notice').insertAfter('.feat_5_exits');
	}

	if (pack_list.indexOf('-6-') >= 0) {
		if (
			role_list.indexOf('-145-') >= 0 ||
			role_list.indexOf('-146-') >= 0 ||
			role_list.indexOf('-147-') >= 0 ||
			role_list.indexOf('-148-') >= 0
		) {
			$('.claims_perm').show();
			// menuList += `<li class=""><a href="claims"><i class="fa fa-exclamation-triangle"></i> Employee Claims </a></li>`;
		}
	}

	if (pack_list.indexOf('-3-') >= 0) {
		if (
			role_list.indexOf('-73-') >= 0 ||
			role_list.indexOf('-74-') >= 0 ||
			role_list.indexOf('-75-') >= 0 ||
			role_list.indexOf('-76-') >= 0
		) {
			$('.grie_perm').show();
			// menuList += `<li class=""><a href="grievances"><i class="fa fa-edit"></i> Grievances </a></li>`;
		}
	}

	if (pack_list.indexOf('-38-') >= 0) {
		if (
			role_list.indexOf('-77-') >= 0 ||
			role_list.indexOf('-78-') >= 0 ||
			role_list.indexOf('-79-') >= 0 ||
			role_list.indexOf('-80-') >= 0 ||
			role_list.indexOf('-81-') >= 0
		) {
			$('.exit_perm').show();
			// menuList += `<li class=""><a><i class="fa fa-power-off"></i> Exits<span
			//                                     class="fa fa-chevron-down"></span></a>

			//                             <ul class="nav child_menu">
			//                                 <li><a href="terminations">All Exit</a></li>
			//                                 <li><a href="exit_config">Exit Configuration</a></li>
			//                             </ul>

			//                         </li>`;
		}
	}

	if (role_list.indexOf('-83-') >= 0) {
		$('.set_perm').show();
		// menuList += `<li  id="settings"  class=""><a><i class="fa fa-user"></i> HR Settings <span
		//                                         class="fa fa-chevron-down"></span></a>

		//                                 <ul class="nav child_menu">
		//                                     <li><a href="users">Users</a></li>
		//                                     <li><a href="profilesandroles">Permissions</a></li>
		//                                     <li><a href="company_positions">Job Titles</a></li>
		//                                     <li><a href="departments">Departments</a></li>
		//                                     <li class="feat_2"><a href="leave_types">Leave Types</a></li>
		//                                     <li><a href="branches">Company Branches</a></li>
		//                                     <li><a href="employement_type">Employment Types</a></li>
		//                                     <li><a href="employment_payment_types">Salary Component</a></li>
		//                                     <li><a href="emp_doc_type">Employee Doc Types</a></li>
		//                                     <li><a href="company_holidays">Company Holidays</a></li>
		//                                     <li><a href="work_shift">Work Shifts</a></li>
		//                                     <li><a href="notice_board">Notice Board</a></li>
		//                                 </ul>

		//                             </li>`;
	}

	if (role_list.indexOf('-150-') >= 0) {
		$('.audit_perm').show();
		// menuList += ` <li class=""><a href="audit_trail"><i class="fa fa-folder"></i> Audit Trail </a> </li>`;
	}

	if (role_list.indexOf('-153-') >= 0) {
		$('.help_perm').show();
		// menuList += `<li class=""><a href="resources"><i class="fa fa-question"></i> Help </a> </li>`;
	}

	// if (pack_list.indexOf('-2-') < 0) {
	// 	$('.feat_2').remove();
	// }
	// if (pack_list.indexOf('-3-') < 0) {
	// 	$('.feat_3').remove();
	// }
	// if (pack_list.indexOf('-4-') < 0) {
	// 	$('.feat_4').remove();
	// }
	// if (pack_list.indexOf('-5-') < 0) {
	// 	$('.feat_5').remove();
	// 	$('.feat_5_css').removeClass('col-lg-3 col-md-3 col-sm-6 col-xs-12');
	// 	$('.feat_5_css').addClass('col-lg-4 col-md-4 col-sm-6 col-xs-12');
	// 	$('.feat_5_notice').removeClass('col-md-6 col-sm-6 col-xs-12');
	// 	$('.feat_5_notice').addClass('col-md-12 col-sm-12 col-xs-12');
	// 	$('.feat_5_notice').insertAfter('.feat_5_exits');
	// }
	// if (pack_list.indexOf('-6-') < 0) {
	// 	$('.feat_6').remove();
	// }
	// if (pack_list.indexOf('-38-') < 0) {
	// 	$('.feat_38').remove();
	// }

	// if (role_list.indexOf('-83-') >= 0) {
	// 	//Settings
	// 	$('.hidata').show();
	// } else {
	// 	$('.hidata').hide();
	// }

	// if (
	// 	role_list.indexOf('-56-') >= 0 ||
	// 	role_list.indexOf('-57-') >= 0 ||
	// 	role_list.indexOf('-58-') >= 0 ||
	// 	role_list.indexOf('-59-') >= 0
	// ) {
	// 	$('.emp_perm').show();
	// } else {
	// 	$('.emp_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-77-') >= 0 ||
	// 	role_list.indexOf('-78-') >= 0 ||
	// 	role_list.indexOf('-79-') >= 0 ||
	// 	role_list.indexOf('-80-') >= 0 ||
	// 	role_list.indexOf('-81-') >= 0
	// ) {
	// 	$('.exit_perm').show();
	// } else {
	// 	$('.exit_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-145-') >= 0 ||
	// 	role_list.indexOf('-146-') >= 0 ||
	// 	role_list.indexOf('-147-') >= 0 ||
	// 	role_list.indexOf('-148-') >= 0
	// ) {
	// 	$('.claims_perm').show();
	// } else {
	// 	$('.claims_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-64-') >= 0 ||
	// 	role_list.indexOf('-65-') >= 0 ||
	// 	role_list.indexOf('-66-') >= 0 ||
	// 	role_list.indexOf('-67-') >= 0
	// ) {
	// 	$('.leaves_perm').show();
	// } else {
	// 	$('.leaves_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-73-') >= 0 ||
	// 	role_list.indexOf('-74-') >= 0 ||
	// 	role_list.indexOf('-75-') >= 0 ||
	// 	role_list.indexOf('-76-') >= 0
	// ) {
	// 	$('.grie_perm').show();
	// } else {
	// 	$('.grie_perm').hide();
	// }

	// if (role_list.indexOf('-150-') >= 0) {
	// 	$('.audit_perm').show();
	// } else {
	// 	$('.audit_perm').hide();
	// }

	// if (role_list.indexOf('-60-') >= 0 || role_list.indexOf('-61-') >= 0) {
	// 	$('.att_perm').show();
	// } else {
	// 	$('.att_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-68-') >= 0 ||
	// 	role_list.indexOf('-69-') >= 0 ||
	// 	role_list.indexOf('-70-') >= 0 ||
	// 	role_list.indexOf('-71-') >= 0 ||
	// 	role_list.indexOf('-72-') >= 0
	// ) {
	// 	$('#pay_permsi').show();
	// } else {
	// 	$('#pay_permsi').hide();
	// }

	// if (
	// 	role_list.indexOf('-152-') >= 0 &&
	// 	role_list.indexOf('-83-') < 0 &&
	// 	role_list.indexOf('-151-') < 0
	// ) {
	// 	$('#dash_perm').html('<a href="/hrm/"><i class="fa fa-home"></i> Home</a>');
	// }

	// $('.menu_placement_hrm').html(menuList);
}
