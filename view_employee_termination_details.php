<?php
include("_common/header.php");
?>
<div id="page_loader" style="display: ;">

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <i class="fa fa-spinner fa-spin fa-fw fa-4x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- page content -->
<div id="employee_details_display" style="display: none;">
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3 id="profile_name"></h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group" style="float: right" id="button_link">
                            <a href="exits"><button id="send" class="btn btn-primary">Back</button></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Termination Details </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> -->
                                <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li> -->
                                <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img" id="picture">

                                </div>
                                <!-- <h3>Samuel Doe</h3> -->
                                <br>
                                <ul class="list-unstyled user_data" id="profile_links">

                                </ul>

                                <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                                <br />



                            </div>


                            <div class="col-md-9 col-sm-9 col-xs-12">






                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="x_panel" style="background-color: " id="boldbar">

                                        <div class="x_content">

                                            <div style="height: 20px;">
                                                <div class="row">

                                                    <div class="col-md-12 col-sm-12 col-xs-12"
                                                        style="text-align: center; color: white">
                                                        <h2 id="sttus_text">Approved</h2>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>







                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">

                                        <div class="x_content">

                                            <div style="height: 350px;">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Leave ID:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="leave_id"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Leave Type:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="leave_type"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Firstname:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="firstname"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Lastname:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="lastname"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Othernames:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="middlename"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Leave Starts</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="leave_start"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Resumption Date</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="resumption_date"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Days Used:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="days_used"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Non-working Days Excluded:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="working_days"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Holidays Within:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="holidays_within"></p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>List of Approvers</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        role="button" aria-expanded="false"><i
                                                            class="fa fa-wrench"></i></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Settings 1</a>
                                                        </li>
                                                        <li><a href="#">Settings 2</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <div>

                                                <div class="form-row" id="turnbturn" style="display: none">
                                                    <input class="form-check-input" type="radio" name="RadioOptions"
                                                        id="turn" value="chronological">
                                                    <label class="form-check-label" for="turn">Turn by Turn
                                                        Approval</label>
                                                    &nbsp;
                                                    <input class="form-check-input" type="radio" name="RadioOptions"
                                                        id="random" value="random">
                                                    <label class="form-check-label" for="random">Random Approval</label>
                                                </div>
                                                <br><br>

                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>

                                                                <th class="column-title">&nbsp; </th>
                                                                <th class="column-title">&nbsp; </th>
                                                                <th class="column-title">Approval Status </th>
                                                                <th class="column-title">Date of Action</th>

                                                                <th class="bulk-actions" colspan="4">
                                                                    <a class="antoo"
                                                                        style="color:#fff; font-weight:500;">Bulk
                                                                        Actions ( <span class="action-cnt"> </span> ) <i
                                                                            class="fa fa-chevron-down"></i></a>
                                                                </th>
                                                            </tr>
                                                        </thead>


                                                        <tbody id="forwardData">
                                                            <tr>
                                                                <td colspan="4"><i
                                                                        class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                        style="display: ;" id="loading"></i></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <!-- <div class="x_panel"> -->
                                    <!-- <div class="x_title">
                              <h2>List of Approvers</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                  </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div> -->
                                    <!-- <div class="x_content"> -->
                                    <br><br>
                                    <div>


                                        <div class="form-row" id="approve_decline_buttons" style="display: none">
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <button type="submit" class="btn btn-success"
                                                    id="approve">Approve</button>
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                    id="approve_loader"></i>

                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <button type="submit" class="btn btn-danger"
                                                    id="decline">Decline</button>
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                    id="decline_loader"></i>
                                                <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                                            </div>
                                        </div>






                                    </div>

                                    <!-- </div> -->
                                    <!-- </div> -->
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<div id="employee_error_display" style="display: none;">

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-danger alert-dimissible fade-in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true"></span>
                        </button>
                        <strong>Connection error</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="employee_data_display" style="display: none;">

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-info alert-dimissible fade-in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true"></span>
                        </button>
                        <strong>No Employee Info Found</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Success
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <h4>Are you sure</h4>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Success
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <h4>Approval Order Successfully Changed</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Success
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <h4>Employee Leave Approved!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal_decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Success
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <h4>Employee Leave Declined!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    fetch_leave_info();
    list_of_forward_leaves_applicant();
    // fetch_employee_details();
    $('#approve').on('click', hr_approve);

    $('#decline').on('click', hr_decline);

    $(document).on('click', '.delete_approver', function() {
        var approval_id = $(this).attr('id').replace(/app_/, ''); // table row ID 
        delete_approver(approval_id);

    });

    $('#random').click(function() {
        if ($('#random').is(':checked')) {

            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' '); 
            var order_type = $('#random').val();

            // alert(order_type);
            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "hrm/hr_set_approval_leave_order",
                data: {
                    "company_id": company_id,
                    "leave_id": leave_id,
                    "order_type": order_type
                },
                timeout: 60000,

                success: function(response) {
                    // $('#page_loader').hide();
                    // $('#employee_details_display').show();

                    console.log(response);

                    if (response.status == '200') {
                        $('#modal_order').modal('show');

                        // $('#modal_order').on('hidden.bs.modal', function () {
                        //     // do something…
                        //     window.location.reload();
                        //     //window.location.href = base_url+"/erp/hrm/employees";
                        // })

                        // alert(response.msg);

                    }

                },
                // objAJAXRequest, strError
                error: function(response) {
                    alert("Connection error");
                    // $('#page_loader').hide();
                    // $('#employee_details_display').hide();
                    // $('#employee_error_display').show();

                }

            });

        }
    });

    $('#turn').click(function() {
        if ($('#turn').is(':checked')) {
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' '); 
            var order_type = $('#turn').val();

            // alert(order_type);
            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "hrm/hr_set_approval_leave_order",
                data: {
                    "company_id": company_id,
                    "leave_id": leave_id,
                    "order_type": order_type
                },
                timeout: 60000,

                success: function(response) {
                    // $('#page_loader').hide();
                    // $('#employee_details_display').show();

                    console.log(response);

                    if (response.status == '200') {
                        $('#modal_order').modal('show');

                        // $('#modal_order').on('hidden.bs.modal', function () {
                        //     // do something…
                        //     window.location.reload();
                        //     //window.location.href = base_url+"/erp/hrm/employees";
                        // })

                        // alert(response.msg);

                    }

                },
                // objAJAXRequest, strError
                error: function(response) {
                    alert("Connection error");
                    // $('#page_loader').hide();
                    // $('#employee_details_display').hide();
                    // $('#employee_error_display').show();

                }

            });


        }
    });

})


function hr_approve() {

    var company_id = localStorage.getItem('company_id');
    // var pathArray = window.location.pathname.split( '/' );
    var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' '); 
    var approval_status = "yes";

    var ans = confirm("Are you sure you want to approve this leave?");

    if (!ans) {
        return;
    }
    // $('#modal_order').modal('show');


    $('#approve').hide();
    $('#approve_loader').show();

    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "hrm/hr_decline_accept_leave",
        data: {
            "company_id": company_id,
            "leave_id": leave_id,
            "approval_status": approval_status
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            $('#approve').show();
            $('#approve_loader').hide();
            // alert('connection error');
        },

        success: function(response) {
            // console.log(response);

            if (response.status == '200') {
                // $('#row_'+user_id).hide();
                $('#modal_approve').modal('show');
                $('#approve_decline_buttons').hide();
                $('#approve_msg').show();

                // $('#modal_approve').on('hidden.bs.modal', function () {
                //     // do something…
                //     window.location.reload();
                //     //window.location.href = base_url+"/erp/hrm/employees";
                // })

            } else if (response.status == '401') {


            }
            $('#approve').show();
            $('#approve_loader').hide();

        }
    });
}

function hr_decline() {

    var company_id = localStorage.getItem('company_id');
    // var pathArray = window.location.pathname.split( '/' );
    var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' '); 
    var approval_status = "declined";

    alert(company_id + " " + leave_id + " " + approval_status);


    var ans = confirm("Are you sure you want to decline this leave?");
    if (!ans) {
        return;
    }
    // $('#modal_confirm').modal('show');



    $('#decline').hide();
    $('#decline_loader').show();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "hrm/hr_decline_accept_leave",
        data: {
            "company_id": company_id,
            "leave_id": leave_id,
            "approval_status": approval_status
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            $('#decline').show();
            $('#decline_loader').hide();
            // alert('connection error');
        },

        success: function(response) {
            console.log(response);
            if (response.status == '200') {
                // $('#row_'+user_id).hide();
                $('#modal_decline').modal('show');
                $('#approve_decline_buttons').hide();
                $('#decline_msg').show();

                // $('#modal_approve').on('hidden.bs.modal', function () {
                //     // do something…
                //     window.location.reload();
                //     //window.location.href = base_url+"/erp/hrm/employees";
                // })

            } else if (response.status == '401') {


            }
            $('#decline').show();
            $('#decline_loader').hide();

        }
    });
}

function fetch_leave_info() {

    var company_id = localStorage.getItem('company_id');
    // var pathArray = window.location.pathname.split( '/' );
    var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

    // alert(employee_id);
    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "hrm/fetch_employee_leave_details",
        data: {
            "company_id": company_id,
            "leave_id": leave_id
        },
        timeout: 60000,

        success: function(response) {
            $('#page_loader').hide();
            $('#employee_details_display').show();

            console.log(response);
            var str = "";
            if (response.status == '200') {

                $('#profile_name').html('<b>' + response.data.firstname + " " + response.data.lastname +
                    '</b>');

                str += '<div id="crop-avatar">';

                str += '<img src="' + site_url + '/files/images/employee_images/mid_' + response.data
                    .profile_picture + '" alt="...">';
                str += '</div>';


                $('#leave_id').html("LV" + response.data.leave_id);
                $('#leave_type').html(response.data.leave_type);
                $('#firstname').html(response.data.firstname);
                $('#lastname').html(response.data.lastname);
                $('#middlename').html(response.data.middlename);
                $('#resumption_date').html(response.data.resumption_date);
                $('#days_used').html(response.data.real_days_used);
                $('#leave_start').html(response.data.leave_start);
                $('#working_days').html(response.data.exclude_weekends);
                $('#holidays_within').html(response.data.exclude_holidays);
                $('#hr_approval').html(response.data.hr_approval);

                if (response.data.approval_order == 'period') {

                    $('#turn').attr('checked', 'checked');
                    $('#random').removeAttr('checked');
                    // $('#monday').val('yes');

                } else if (response.data.approval_order == 'random') {

                    $('#random').attr('checked', 'checked');
                    $('#turn').removeAttr('checked');

                    // $('#monday').val('no');

                }


                $('#picture').html(str);


                if (response.data.hr_approval == "no") {
                    $("#approve_decline_buttons").show();
                    $("#turnbturn").show();
                    $("#sttus_text").html('Pending');
                    $("#boldbar").css("background-color", "orange");
                } else if (response.data.hr_approval == "declined") {
                    $("#sttus_text").html('Declined');
                    $("#boldbar").css("background-color", "#d82732");
                } else if (response.data.hr_approval == "yes") {
                    $("#sttus_text").html('Approved');
                    $("#boldbar").css("background-color", "green");
                }


            } else if (response.status == '400') {
                $('#page_loader').hide();
                $('#employee_details_display').hide();
                $('#employee_data_display').show();
            }

        },
        // objAJAXRequest, strError
        error: function(response) {
            alert("Connection error");
            $('#page_loader').hide();
            $('#employee_details_display').hide();
            $('#employee_error_display').show();

        }

    });
}

function delete_approver(approval_id) {

    var company_id = localStorage.getItem('company_id');

    // alert(leave_id);
    var ans = confirm("Are you sure you want to delete this approver?");
    if (!ans) {
        return;
    }
    // $('#delete_modal_position').modal('show');

    $('#row_' + approval_id).hide();
    $('#loader_row_' + approval_id).show();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "hrm/hr_delete_approval_person",
        data: {
            "company_id": company_id,
            "approval_id": approval_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            // alert('Connection error');
            $('#loader_row_' + approval_id).hide();
            $('#row_' + approval_id).show();

            // alert('connection error');
        },

        success: function(response) {
            // console.log(response);
            if (response.status == '200') {
                // $('#row_'+user_id).hide();
                // alert(leave_id);

            } else if (response.status == '401') {
                alert(response.msg);

            }

            $('#loader_row_' + approval_id).hide();
        }
    });
}


function list_of_forward_leaves_applicant() {
    var company_id = localStorage.getItem('company_id');
    // var pathArray = window.location.pathname.split( '/' );
    var application_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');


    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "hrm/list_approvals",
        data: {
            "company_id": company_id,
            "application_id": application_id
        },
        timeout: 60000,

        success: function(response) {
            console.log(response);

            var strTable = "";

            if (response.status == '200') {
                $('#loading').hide();

                if (response.data.length > 0) {

                    var k = 1;
                    $.each(response['data'], function(i, v) {
                        // var date = response['data'][i]['date_sent'].datepicker({
                        //    dateFormat: "dd-m-yy"
                        // })



                        strTable += '<tr id="row_' + response['data'][i]['approval_id'] + '">';

                        strTable +=
                            '<td width="8%" valign="top"><div class="profile_pic"><img src="' +
                            base_url + '/files/images/employee_images/sml_' + response['data'][i][
                                'approval_picture'
                            ] + '" alt="..." width="50"></div></td>';
                        if (response['data'][i]['time_acted'] == "0000-00-00 00:00:00") {
                            strTable += '<td width="35%" valign="top"><b>' + response['data'][i][
                                    'approval_person'
                                ] + '</b><br>Date Received: ' + response['data'][i]['date_sent'] +
                                '<br><a style="cursor: pointer;" class="delete_approver" id="app_' +
                                response['data'][i]['approval_id'] +
                                '"><strong class="text-danger">Delete Approver</strong></a></td>';
                        } else {
                            strTable += '<td width="35%" valign="top"><b>' + response['data'][i][
                                    'approval_person'
                                ] + '</b><br>Date Received: ' + response['data'][i]['date_sent'] +
                                '</td>';
                        }

                        // strTable += '<td valign="top">'+response['data'][i]['date_sent']+'</td>';

                        if (response['data'][i]['approval_status'] == 'pending') {

                            strTable +=
                                '<td><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" style="color: orange; font-size: 30px;" title="Forward Leave Applicant"></i></td>';

                        } else if (response['data'][i]['approval_status'] == 'yes') {

                            strTable +=
                                '<td><i class="fa fa-check-circle"  data-toggle="tooltip" data-placement="top" style="color: green; font-size: 30px;" title="Forward Leave Applicant"></i></td>';

                        }

                        strTable += '<td valign="top">' + response['data'][i]['time_acted'] +
                            '</td>';

                        strTable += '</tr>';


                        strTable += '<tr style="display: none;" id="loader_row_' + response['data'][
                            i
                        ]['approval_id'] + '">';
                        strTable +=
                            '<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                        strTable += '</td>';
                        strTable += '</tr>';


                        k++;

                    });

                } else {

                    strTable = '<tr><td colspan="4">No record.</td></tr>';

                }

                //  $('#pagination').twbsPagination({
                //   totalPages: Math.ceil(response.total_rows/limit),
                //   visiblePages: 10,
                //   onPageClick: function (event, page) {
                //     list_of_leaves_applicant(page);
                //   }
                // });

                $("#forwardData").html(strTable);
                $("#forwardData").show();

            } else if (response.status == '400') {
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="4">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#forwardData").html(strTable);
                $("#forwardData").show();


            }

        },

        error: function(response) {
            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="4"><strong class="text-danger">Connection error!</strong></td>';
            strTable += '</tr>';


            $("#forwardData").html(strTable);
            $("#forwardData").show();

        }

    });
}
</script>
<?php
include("_common/footer.php");
?>