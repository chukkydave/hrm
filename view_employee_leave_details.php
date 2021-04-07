<?php
include("_common/header.php");
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
<style type="text/css">
/* .centre {
    margin-left: auto !important;
    margin-right: auto !important;
    width: 50% !important;
} */

/* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
    /* float: right; */
}

/* Hide default HTML checkbox */
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #2196F3;
}

input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

.loader-div {
    z-index: 999;
    position: absolute;
    left: 45%;
    top: 40%;
}
</style>
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
                            <!-- <button id="add_app" class="btn btn-success" style="display: none;">Add Approver</button> -->
                            <a href="leaves"><button id="send" class="btn btn-primary">Back</button></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Leave Details </h2>
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

                            <input type="hidden" id="emp_id">
                            <input type="hidden" id="name_id">

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
                                        <div class="x_title">
                                            <h2>Leave Details</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                </li> -->
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
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

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Department:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="dept_namey"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Head Of Department:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="hod_name"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Supervisor:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="supervsor"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p><strong>Comment:</strong></p>
                                                    </div>

                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <p id="commenter"></p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">



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


                                            </div>

                                        </div>
                                    </div>
                                </div> -->


                                <!-- Start -->


                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title" style="border:none;">
                                            <h2>
                                                Approver List
                                            </h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>

                                                <li data-toggle="tooltip" id="add_appv" title="Add Approver">
                                                    <a class=""><i class="fa fa-plus"></i></a>
                                                </li>

                                            </ul>
                                            <div id="appv_display" style="display: none;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="">

                                                        <div class="x_content">
                                                            <br />
                                                            <span id="demo-form2" data-parsley-validate
                                                                class="form-horizontal form-label-left">

                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                        for="name">Employee Name<span>*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="name"
                                                                            class="form-control col-md-7 col-xs-12 required">
                                                                        <ul class="dropdown-menu"
                                                                            aria-labelledby="dropdownMenuButton1"
                                                                            id="emp_list">

                                                                        </ul>
                                                                    </div>
                                                                </div>






                                                                <!-- <button type="button" class="btn btn-success" id="add_docx">Add</button> -->
                                                                <div class="form-group">
                                                                    <div
                                                                        class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                                        <button type="button" class="btn btn-success"
                                                                            id="add">Add</button>
                                                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                            style="display: none;" id="add_loader"></i>
                                                                    </div>
                                                                </div>


                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                id="list_docx_loader"></i>
                                            <div class="table-responsive" id="list_appv_table">
                                                <div id="loader_div"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                        style="display: none;position:absolute;" id="appv_loader"></i>
                                                </div>
                                                <table class="table table-striped" id="appv_table">
                                                    <!-- <thead>
                                                        <tr>

                                                            <th class="column-title">&nbsp; </th>
                                                            <th class="column-title">&nbsp; </th>
                                                            <th class="column-title">Approval
                                                                Status </th>
                                                            <th class="column-title">Date of Action
                                                            </th>
                                                            <th class="column-title">Action</th>


                                                        </tr>
                                                    </thead> -->


                                                    <tbody id="forwardData">
                                                        <tr>
                                                            <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                    style="display: ;" id="loading"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="x_content" id="approval_type_div" style="display:none;">

                                            <div>

                                                <div class="form-row" id="turnbturn" style="display: none">
                                                    <input class="form-check-input radioOption" data-toggle="tooltip"
                                                        title="text goes here" type="radio" name="RadioOptions"
                                                        id="turn" value="chronological">
                                                    <label data-toggle="tooltip" title="text goes here"
                                                        class="form-check-label" for="turn">Turn by Turn
                                                        Approval</label>
                                                    &nbsp;
                                                    <input class="form-check-input radioOption" data-toggle="tooltip"
                                                        title="text goes here" type="radio" name="RadioOptions"
                                                        id="random" value="random">
                                                    <label class="form-check-label" data-toggle="tooltip"
                                                        title="text goes here" for="random">Random Approval</label>
                                                    <div style="margin-top:2em">
                                                        <!-- <label class="switch">
                                                            <input type="checkbox" id="requiredGroup">
                                                            <span class="slider round"></span>

                                                        </label> -->
                                                        <button class="btn btn-primary" id="send_for_appv"> Send for
                                                            Approval</button>
                                                        <!-- <i class="fa fa-info-circle" data-toggle="tooltip"
                                                            data-placement="bottom" title="text goes in here"
                                                            style="padding-left: 8px;  color: gray; font-size:15px !important; position:relative; top:4px;"></i> -->
                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                    </div>
                                    <!-- <div class="x_panel">
                                        
                                    </div> -->
                                    <!-- <div class="x_panel">
                                        <div class="x_content">

                                            <div style="">
                                                <label class="switch">
                                                    <input type="checkbox" id="requiredGroup">
                                                    <span class="slider round"></span>

                                                </label>
                                               
                                            </div>

                                        </div>
                                    </div> -->
                                </div>


                                <!-- End -->

                                <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">

                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>

                                                            <th class="column-title">&nbsp; </th>
                                                            <th class="column-title">&nbsp; </th>
                                                            <th class="column-title">Approval Status </th>
                                                            <th class="column-title">Date of Action</th>
                                                            <th class="column-title">Action</th>

                                                            <th class="bulk-actions" colspan="5">
                                                                <a class="antoo"
                                                                    style="color:#fff; font-weight:500;">Bulk Actions (
                                                                    <span class="action-cnt"> </span> ) <i
                                                                        class="fa fa-chevron-down"></i></a>
                                                            </th>
                                                        </tr>
                                                    </thead>


                                                    <tbody id="forwardData">
                                                        <tr>
                                                            <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                    style="display: ;" id="loading"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div> -->

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




<div class="modal fade" id="modal_error_pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Error!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal_emp_approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Add an Approver
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="edit_form">
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee
                                Name<span>*</span>
                            </label>
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" class="form-control col-md-7 col-xs-12 required">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="emp_list">

                                </ul>
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">


                            </div>
                        </div>


                        <!-- <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="form_footer">
                                <button type="submit" class="btn btn-success" id="add">Add</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="add_loader"></i>
                                <div id="add_user_loading" style="display:  none">Loading...</div>
                            </div>
                        </div> -->
                    </span>
                </div>

                <div id="edit_msg" style="display: none;">
                    <h4>Approver Added Successfully!</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<script src="js-files/view_employee_leave_details.js"></script>
<?php
include("_common/footer.php");
?>