$(document).ready(() => {
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
});

function user_page_access() {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();

	if (pack_list.indexOf('-38-') >= 0) {
		if (role_list.indexOf('-83-') >= 0 || role_list.indexOf('-77-') >= 0) {
			//Settings
			$('#main_display_loader_page').hide();
			$('#main_display').show();
			listInterviewQuestionAndAnswer();
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

const url = window.location.href;
const params = new URL(url).searchParams;
const exit_id = params.get('ex');
const employee_id = params.get('em');
const company_id = localStorage.getItem('company_id');

function listInterviewQuestionAndAnswer() {
	$('#list_interview_div').hide();
	$('#list_interview_loader').show();
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
					interview_list += `<div class='col-md-9 col-sm-9 col-xs-9'>
                                <span style="font-size:1.3em;">${v.exit_question}</span>
                                <div class="form-group">
                                    <div>
                                        <textarea disabled type='text' data="${v.exit_question_id}" id="res_${v.exit_question_id}" class="form-control check_ques"
                                            style="border-radius:7px;">${v.response}</textarea>
                                    </div>
                                </div>
                            </div>`;
				});
				$('#interview_list').html(interview_list);
				// $('#list_interview_body').html(interview_list);
				$('#list_interview_loader').hide();
				$('#list_interview_div').show();
			} else {
				$('#interview_list').html(
					`<div class='col-md-9 col-sm-9 col-xs-9'>No Interview Question yet</div>`,
				);
				$('#list_interview_loader').hide();
				$('#list_interview_div').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_interview_loader').hide();
			$('#list_interview_div').show();
			$('#interview_list').html(
				`<div class='col-md-9 col-sm-9 col-xs-9'>Error loading Interview Questions</div>`,
			);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}
