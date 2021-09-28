$(document).ready(() => {
	$(`#add_comment_btn`).on('click', sendSchedule);
});

const url = window.location.href;
const params = new URL(url).searchParams;
const exit_id = params.get('exitId');
// const user_id = params.get('us');
const company_id = localStorage.getItem('company_id');
const employee_id = params.get('emp');
// const exit_status = params.get('status');

function sendSchedule() {
	$('#comment_error').html('');

	let comment = $(`#message`).val().trim();
	if (comment.length < 1) {
		$(`#comment_error`).html('Empty field');
		return;
	} else {
		$(`#add_comment_btn`).hide();
		$(`#add_comment_loader`).show();

		let upImage = document.querySelector(`#message_file`).files[0];

		let data = new FormData();
		data.append('file', upImage);
		data.append('exit_id', exit_id);
		data.append('employee_id', employee_id);
		// data.append('company_id', company_id);
		data.append('note', comment);

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
				alert(error.responseJSON.msg);
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#add_comment_loader`).hide();
					$(`#add_comment_btn`).show();
					$(`#message`).val('');
					$(`#message_file`).val('');
					$(`#collapseEg`).removeClass('in');
				}
			},
		});
	}
}
