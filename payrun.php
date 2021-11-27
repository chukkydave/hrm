<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://unpkg.com/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

<div class="right_col" role="main" id="main_display_loader_page" style="display: ;">

    <div class="page-title">
        <div class="title_left">
            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ; margin-top: 20px;" id="ldnuy"></i>
            <div id="loader_mssg" style="color: red; font-size: 14px; margin-top: 30px; background-color: ;"></div>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            </div>
        </div>
    </div>

</div>
<!-- /loader page content -->
<!-- page content -->
<div class="right_col" role="main" id="main_display" style="display: none;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><span id="namelo"></span> Payrun</h3>
            </div>



            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right;display:flex;">
                        <!-- <div style="text-align:center; padding:5px;border-radius:5px; margin-right:5px;"
                            id="payrun_statuslo"></div> -->
                        <!-- <button type="button" id="payrun_statuslo" class="btn btn-danger"></button> -->
                        <a href="payroll_history"><button type="button" class="btn btn-danger">Back</button></a>

                    </div>
                </div>
            </div>
        </div>





        <div class="clearfix"></div>

        <div class="row">


            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="whole_loader">
                    <i class="fa fa-spinner fa-spin fa-fw fa-5x"></i>
                </div>
                <div class="x_panel" id="first_part" style="display:none;">

                    <br>

                    <div class="x_content">
                        <div class="title_right" style="text-align: right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group" style="float: right;display:flex;">
                                    <div style="text-align:center; padding:5px;border-radius:5px; margin-right:5px;"
                                        id="payrun_statuslo"></div>
                                    <!-- <button type="button" id="payrun_statuslo" class="btn btn-danger"></button> -->
                                    <!-- <a href="payroll_history"><button type="button" class="btn btn-danger">Back</button></a> -->

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="smartwizard">

                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-1">
                                            Edit Payrun
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-2">
                                            Payrun Preview
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-3">
                                            Approval
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content">
                                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                        <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                        <div class="x_panel">

                                            <br>

                                            <div class="x_content">

                                                <div class="form-inline" style="margin-bottom:2em;">
                                                    <div class="form-group" style="margin-right:2em;">
                                                        <label for="ex3" class="col-form-label">Name: </label>
                                                        <input disabled type="text" id="payrun_name"
                                                            class="form-control" placeholder=" ">
                                                    </div>
                                                    <!-- <div class="form-group" style="margin-right:2em;">
                                                        <label for="ex4" class="col-form-label">Status: </label>
                                                        <input type="text" id="ex3" class="form-control"
                                                            placeholder=" ">
                                                    </div> -->
                                                    <div class="form-group" style="margin-right:2em;">
                                                        <label for="ex3" class="col-form-label">Pay Period: </label>
                                                        <input disabled type="text" id="date_range" class="form-control"
                                                            placeholder=" ">
                                                    </div>
                                                    <div class="form-group" style="margin-right:2em;">
                                                        <label for="ex3" class="col-form-label">Pay Date: </label>
                                                        <input disabled type="date" id="pay_date" class="form-control"
                                                            placeholder=" ">
                                                    </div>
                                                    <p id="secret_sche_id" style="display:none;"></p>
                                                    <br>
                                                    <div class="form-group" style="margin-top:10px;">
                                                        <button class="btn btn-sm btn-primary" id="pay_dates_btn"
                                                            style="display:none;">Save</button>
                                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x"
                                                            style="display: none;" id="pay_dates_loader"></i>
                                                        <p style="margin-top:10px; color:red; display:none;"
                                                            id="error_showing">Kindly fill in the
                                                            details to proceed</p>
                                                    </div>

                                                </div>

                                                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                    id="list_payrun_loader"></i>
                                                <div class="table-responsive" id="list_payrun_table">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                            <tr class="headings">

                                                                <th class="column-title">Employee</th>
                                                                <th class="column-title">Department</th>
                                                                <th class="column-title">Gross Pay</th>
                                                                <th class="column-title">Deductions</th>
                                                                <th class="column-title">Tax</th>
                                                                <th class="column-title">Net Pay</th>
                                                                <!-- <th class="column-title">Tax</th> -->
                                                                <th class="column-title" width="10%">Pay Slip
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="list_payrun_body">

                                                        </tbody>
                                                    </table>
                                                    <div class="container">
                                                        <nav aria-label="Page navigation">
                                                            <ul class="pagination" id="pagination"></ul>
                                                        </nav>
                                                    </div>

                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">

                                        <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                        <div class="x_panel">

                                            <br>

                                            <div class="x_content">

                                                <div class="form-inline" style="margin-bottom:2em;">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <p><strong>Payrun Name: </strong></p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <p id="payrun_name2"></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <p><strong>Pay Period: </strong></p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <p id="payperiod"></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <p><strong>Pay Date: </strong></p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <p id="paydate"></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                    id="list_payrun_loader2"></i>
                                                <div class="table-responsive" id="list_payrun_table2">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                            <tr class="headings">

                                                                <th class="column-title">Employee</th>
                                                                <th class="column-title">Department</th>
                                                                <th class="column-title">Gross Pay</th>
                                                                <th class="column-title">Deductions</th>
                                                                <th class="column-title">Tax</th>
                                                                <th class="column-title">Net Pay</th>
                                                                <!-- <th class="column-title">Tax</th> -->
                                                                <th class="column-title" width="10%">Pay Slip
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="list_payrun_body2">

                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">

                                        <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                        <div class="x_panel">

                                            <br>

                                            <div class="x_content">
                                                <div class="form-inline" style="margin-bottom:2em;">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <p><strong>Payrun Name: </strong></p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <p id="payrun_name3"></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <p><strong>Pay Period: </strong></p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <p id="payperiod3"></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <p><strong>Pay Date: </strong></p>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <p id="paydate3"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">
                                                        <div class="x_title" style="border:none;">
                                                            <h2>
                                                                Approval List
                                                            </h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li>
                                                                    <a class="collapse-link"><i
                                                                            class="fa fa-chevron-up"></i></a>
                                                                </li>

                                                                <li style="display:none;" data-toggle="tooltip"
                                                                    id="add_appv" title="Add Approver">
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
                                                                                        for="name">Employee
                                                                                        Name<span>*</span>
                                                                                    </label>
                                                                                    <!-- <div
                                                                                        class="col-md-6 col-sm-6 col-xs-12">
                                                                                        <select id="empo_name"
                                                                                            id="expo_name"
                                                                                            class="col-md-7 col-xs-12"></select>
                                                                                        
                                                                                    </div> -->
                                                                                    <div
                                                                                        class="col-md-6 col-sm-6 col-xs-12">
                                                                                        <select
                                                                                            class="form-control js-example-basic-single"
                                                                                            id="empo_name"
                                                                                            multiple="multiple"
                                                                                            style="width:100% !important;max-width:800px !important; border-radius:30px !important; "></select>
                                                                                    </div>
                                                                                </div>






                                                                                <div class="form-group">
                                                                                    <div
                                                                                        class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                                                        <button type="button"
                                                                                            class="btn btn-success"
                                                                                            id="add_apprvoer">Add</button>
                                                                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                                            style="display: none;"
                                                                                            id="add_apprvoer_loader"></i>
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

                                                            <div class="table-responsive" id="list_appv_table">
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                    style="display: none;" id="appv_loader"></i>


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


                                                                    <tbody id="appv_body">

                                                                    </tbody>
                                                                </table>

                                                            </div>

                                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                                                <br><br>
                                                                <div>


                                                                    <div class="form-row" id="approve_decline_buttons">
                                                                        <div class="col-md-2 col-sm-2 col-xs-6">
                                                                            <button style="display:none;" type="submit"
                                                                                class="btn btn-success"
                                                                                id="approve_btnn">Approve</button>
                                                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                                style="display: none;"
                                                                                id="approvee_loader"></i>

                                                                        </div>

                                                                        <div class="col-md-2 col-sm-2 col-xs-6">
                                                                            <button style="display:none;" type="submit"
                                                                                class="btn btn-danger"
                                                                                id="decline_btnn">Decline</button>
                                                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                                style="display: none;"
                                                                                id="declinee_loader"></i>
                                                                            <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                                                                        </div>
                                                                    </div>






                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                        id="list_payrun_loader3"></i>
                                                    <div class="table-responsive" id="list_payrun_table3">
                                                        <table class="table table-striped jambo_table bulk_action">
                                                            <thead>
                                                                <tr class="headings">

                                                                    <th class="column-title">Employee</th>
                                                                    <th class="column-title">Department</th>
                                                                    <th class="column-title">Gross Pay</th>
                                                                    <th class="column-title">Deductions</th>
                                                                    <th class="column-title">Tax</th>
                                                                    <th class="column-title">Net Pay</th>
                                                                    <!-- <th class="column-title">Tax</th> -->
                                                                    <th class="column-title" width="10%">Pay Slip
                                                                    </th>

                                                                </tr>
                                                            </thead>
                                                            <tbody id="list_payrun_body3">

                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="x_panel" id="second_part" style="display:none">

                    <br>

                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-inline" style="margin-bottom:2em;">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Payrun Name: </strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="payrun_name4"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Pay Period: </strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="payperiod4"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Pay Date: </strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="paydate4"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="x_panel">
                                <div class="x_title" style="border:none;">
                                    <h2>
                                        Approval List
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="table-responsive" id="list_appv_table2">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="appv_loader2"></i>


                                        <table class="table table-striped" id="appv_table2">
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


                                            <tbody id="appv_body2">

                                            </tbody>
                                        </table>

                                    </div>


                                </div>


                            </div>

                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="list_payrun_loader4"></i>
                            <div class="table-responsive" id="list_payrun_table4">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">

                                            <th class="column-title">Employee</th>
                                            <th class="column-title">Department</th>
                                            <th class="column-title">Gross Pay</th>
                                            <th class="column-title">Deductions</th>
                                            <th class="column-title">Tax</th>
                                            <th class="column-title">Net Pay</th>
                                            <!-- <th class="column-title">Tax</th> -->
                                            <th class="column-title" width="10%">Pay Slip
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody id="list_payrun_body4">

                                    </tbody>
                                </table>
                                <div class="container">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination2"></ul>
                                    </nav>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<!-- modal -->

<div class="modal fade" id="edit_payslip_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Payslip
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <p id="secret_emp_id" style="display:none"></p>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Salary Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>


                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="" style="">

                            <div class="x_content">
                                <div style="display:flex;">
                                    <div class="x_panel" style="margin-right:10px;">
                                        <div class="x_title">
                                            <h2>Credit</h2>
                                            <ul class="nav navbar-right panel_toolbox">


                                                <li data-toggle="tooltip" id="add_credit" title="Add Credit">
                                                    <a class=""><i class="fa fa-plus"></i></a>
                                                </li>

                                            </ul>

                                            <div id="credit_display" style="display: none;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">

                                                        <div class="x_content">
                                                            <!-- <br /> -->
                                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                style="display: none;" id="credit_loader"></i>
                                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                <div id="credit_body"></div>

                                                                <br>
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                                                        <button type="button" class="btn btn-success"
                                                                            id="add_creditComponent_btn">Add</button>
                                                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x"
                                                                            style="display: none;"
                                                                            id="add_creditComponent_loader"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="table-responsive" style="max-height:50%;overflow-y:auto;">
                                                <table class="table table-striped jambo_table bulk_action">

                                                    <tbody id="credit_table">
                                                        <tr>
                                                            <td colspan="3">No Salary Component Found</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="form-group" style="display:flex;">
                                                    <label class="control-label" for="total_credit"
                                                        style="margin-right:10px;">Total:
                                                    </label>

                                                    <input type="text" id="total_credit" name="total_credit"
                                                        class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                                        style="width:30%; height:25px;" data-type="currency" disabled>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Debit</h2>
                                            <ul class="nav navbar-right panel_toolbox">


                                                <li data-toggle="tooltip" id="add_debit" title="Add Debit">
                                                    <a class=""><i class="fa fa-plus"></i></a>
                                                </li>

                                            </ul>
                                            <div id="debit_display" style="display: none;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">

                                                        <div class="x_content">
                                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                style="display: none;" id="debit_loader"></i>
                                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                <div id="debit_body"></div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                                                        <button type="button" class="btn btn-success"
                                                                            id="add_debitComponent_btn">Add</button>
                                                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x"
                                                                            style="display: none;"
                                                                            id="add_debitComponent_loader"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="table-responsive" style="max-height:50%;overflow-y:auto;">
                                                <table class="table table-striped jambo_table bulk_action">

                                                    <tbody id="debit_table">
                                                        <tr>
                                                            <td colspan="3">No Salary Component Found</td>

                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <div class="form-group" style="display:flex;">
                                                <label class="control-label" for="total_debit"
                                                    style="margin-right:10px;">Total:
                                                </label>

                                                <input type="text" id="total_debit" name="total_debit"
                                                    class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                                    style="width:30%; height:25px;" data-type="currency" disabled>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div style="display:flex; flex-direction:row;align-items:center;">
                                    <div class="" style="font-size:1.5em;"><b>Gross
                                            Payment:
                                            <span id="salary_amt">0</span></b></div>

                                    <div style="margin-left:1.5em">
                                        <Select class="form-control" style="border:none;" id="salary_type">
                                            <option>Select</option>
                                            <option value="Hour">Hourly</option>
                                            <option value="Week">Weekly</option>
                                            <option value="Month">Monthly</option>
                                            <option value="Year">Yearly</option>
                                        </select>
                                    </div>


                                </div>

                                <div style="font-size:1.5em; color: #26B99A;"><b>Net Payment:
                                        <span id="net_payment">0</span></b></div>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="save_pay_loader"></i>
                                <button style="margin-top:2em; display:none;" class="btn btn-sm btn-primary"
                                    id="save_pay">Save</button>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-success" id="edit_nok_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view_payslip_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Payslip
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div class="col-md-12" style="margin-top:2em;">
                    <!-- <div class="card"> -->
                    <!-- <div class="card-body"> -->
                    <h3 class="payslip-title title_center" id="com_name"></h3>
                    <!-- <h5 class="subtitle">8/10 Ilupeju Byepass, Lagos State, Nigeria</h5> -->

                    <div class="row" style="background:#17a2b8;color:white;">
                        <div class="col-sm-6 m-b-20">
                            <ul class="list-unstyled">
                                <li>
                                    <h3 class="text-uppercase" id="emy_name"><strong></strong></h3>
                                </li>
                                <li><span id="depy_name"></span> - <span id="joby_name"></span>
                                </li>
                                <li>Bank Name: <span id="banky_name"></span></li>
                                <li>Account Number: <span id="banky_no"></span></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 m-b-20">
                            <!-- <div class="invoice-details"> -->

                            <ul class="list-unstyled">
                                <li>
                                    <h3 class="text-uppercase">&#8203;</h3>
                                </li>
                                <li>Pay Period: <span id="pay_period_datey"></span>
                                </li>
                                <li>Payment Date: <span id="pay_datey"></span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- </div> -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <h4 class="m-b-10"><strong>Earnings</strong></h4>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="credit_loader2"></i>
                                <table class="table table-bordered" id="credit_body2">
                                    <tbody id="credit_table2">
                                        <!-- <tr>
                                                <td><strong>Basic Salary</strong> <span class="float-right">$6500</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>House Rent Allowance (H.R.A.)</strong> <span
                                                        class="float-right">$55</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Conveyance</strong> <span class="float-right">$55</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Other Allowance</strong> <span
                                                        class="float-right">$55</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Earnings</strong> <span
                                                        class="float-right"><strong>$55</strong></span></td>
                                            </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="debit_loader2"></i>
                                <table class="table table-bordered" id="debit_body2">
                                    <tbody id="debit_table2">
                                        <!-- <tr>
                                                <td><strong>Tax Deducted at Source (T.D.S.)</strong> <span
                                                        class="float-right">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Provident Fund</strong> <span class="float-right">$0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>ESI</strong> <span class="float-right">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Loan</strong> <span class="float-right">$300</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Deductions</strong> <span
                                                        class="float-right"><strong>$59698</strong></span></td>
                                            </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Gross Pay: <span id="gpay"></span></strong></p>
                            <p><strong>Net Salary: <span id="npay"></span></strong></p>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-success" id="edit_nok_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i> -->
            </div>
        </div>
    </div>
</div>





<!-- JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://kit.fontawesome.com/bcb3edd6a7.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

<!-- <script type="text/javascript" src="js-files/smartwizard.js"></script> -->
<!-- <script type="text/javascript" src="js-files/employment_info_jsFiles/salary_info.js"></script> -->
<script type="text/javascript" src="js-files/payrun.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>