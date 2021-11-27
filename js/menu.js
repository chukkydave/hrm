$(document).ready(function() {

	//this time interval check if the user roles have been fetched before running anything on this page
	var myVar = setInterval(
		function(){

			if($("#does_user_have_roles").html() != ""){

				//stop the loop
				myStopFunction();
				hide_show_tabs();
				
			}else{
				console.log("No profile");
			}
			 
		},
		1000
	);

	function myStopFunction() {
	  clearInterval(myVar);
	}

});

function hide_show_tabs(){

	var role_list = $("#does_user_have_roles").html();

	if (role_list.indexOf("-83-") >= 0) {

		//Settings
		$('#settings').show();

	}


	// if (role_list.indexOf("-47-") >= 0 || role_list.indexOf("-48-") >= 0 || role_list.indexOf("-49-") >= 0) {

	// 	//Settings
	// 	$('#leads').show();

	// }

	// if (role_list.indexOf("-1-") >= 0 || role_list.indexOf("-2-") >= 0) {

	// 	//Settings
	// 	$('#clients').show();

	// }

	// if (role_list.indexOf("-55-") >= 0) {

	// 	//Settings
	// 	$('#reports').show();

	// }

}
