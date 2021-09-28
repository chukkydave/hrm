<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.my-center {
    display: grid;
    align-items: center;
}

.mr2 {
    margin-right: 2rem;
}

@keyframes placeHolderShimmer {
    0% {
        background-position: -468px 0;
    }

    100% {
        background-position: 468px 0;
    }
}

.animated-background {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    /* height: 100vh; */
    position: relative;
    /* z-index: 999; */
}

.color {
    color: #f6f7f8 !important;
    padding: 10px;
    border-radius: 5px;
}

.center-text {
    text-align: center;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Pay Schedule</h3>
            </div>
        </div>
        <div class="title_right" style="text-align: right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group" style="float: right">

                    <!-- <button type="button" class="btn btn-success" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Create
                            Pay Schedule</button> -->
                    <a href="pay_schedule"><button type="button" class="btn btn-danger">Back</button></a>


                </div>
            </div>
        </div>


        <div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" id="loader_div">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span
                                            class="animated-background color">____________ __</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <span class="form-control col-md-7 col-xs-12 animated-background"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span
                                            class="animated-background color">____________ __</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <span class="form-control col-md-7 col-xs-12 animated-background"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span
                                            class="animated-background color">____________ __</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <span class="form-control col-md-7 col-xs-12 animated-background"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span
                                            class="animated-background color">____________ __</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <span class="form-control col-md-7 col-xs-12 animated-background"></span>
                                    </div>
                                </div>








                            </span>
                        </div>
                        <div class="input-group" style="float: right">
                            <button type="button" class="btn btn-sm animated-background"
                                style="color:#f6f7f8;border-radius:5px;" id="">______ ___________</button>
                        </div>
                        <div class="x_content">



                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr class="headings">
                                            <th style="border-right:1px solid lightgray;" class="center-text"><span
                                                    class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">_</span>
                                            </th>
                                            <th style="border-right:1px solid lightgray;"
                                                class="column-title center-text"><span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">_____</th>
                                            <th style="border-right:1px solid lightgray;"
                                                class="column-title center-text"><span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">___________</th>
                                            <th class="column-title center-text"><span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">___ _____</th>




                                        </tr>
                                    </thead>



                                    <tbody>

                                        <tr class="center-text">
                                            <td style="border-right:1px solid lightgray;"><span
                                                    class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                            <td class="" style="border-right:1px solid lightgray;">
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                            <td class="" style="border-right:1px solid lightgray;">
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                            <td>
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                        </tr>
                                        <tr class="center-text">
                                            <td class="" style="border-right:1px solid lightgray;">
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                            <td class="" style="border-right:1px solid lightgray;">
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                            <td class="" style="border-right:1px solid lightgray;">
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                            <td>
                                                <span class="animated-background"
                                                    style="color:#f6f7f8; padding:5px 2em;">____________</span>
                                            </td>
                                        </tr>

                                    </tbody>


                                </table>



                            </div>

                            <div class="input-group" style="float: right">
                                <button type="button" class="btn btn-sm animated-background"
                                    style="color:#f6f7f8;border-radius:5px;" id="">_______</button>
                                <button type="button" class="btn btn-sm animated-background"
                                    style="color:#f6f7f8;border-radius:5px;" id="">______</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" id="main_div" style="display:none;">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="schedule_name">Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 phone_skeleton">
                                        <input type="text" id="schedule_name" required="required"
                                            class="form-control col-md-7 col-xs-12 schedule_fields">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">Payment
                                        Type<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <Select id="list_payment_option" required="required"
                                            class="form-control col-md-7 col-xs-12 schedule_fields">
                                            <option>-- Select --</option>
                                        </select>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x" id="list_payment_loader"
                                            style="display: none;"></i>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">Payroll
                                        Type<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <Select id="list_payroll_option" required="required"
                                            class="form-control col-md-7 col-xs-12 schedule_fields">
                                            <option>-- Select --</option>
                                        </select>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x" id="list_payroll_loader"
                                            style="display: none;"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="recurring">Recurring
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input style="width: 30px; height: 20px;" type="checkbox" id="recurring">
                                    </div>
                                </div>

                                <div class="form-group" id="date_div" style="display:none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eligibility">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="display:flex">
                                        <div class="my-center mr2">Start Date</div>
                                        <input id="start_date" type="date" required="required" class="form-control mr2"
                                            style="width:35%">
                                        <div class="my-center mr2">Every</div>
                                        <select id="no_of_days" required="required" class="form-control mr2"
                                            style="width:15%">
                                            <option value=""></option>

                                        </select>
                                        <div class="my-center">Days</div>

                                    </div>

                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_position">
                                        <!--  <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" > -->

                                    </div>
                                </div>


                            </span>
                        </div>
                        <div class="input-group" style="float: right">
                            <button type="button" class="btn btn-sm btn-primary" id="selectBultEmp">Select
                                Employee(s)</button>
                        </div>
                        <div class="x_content">



                            <div class="table-responsive">

                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <!-- <th>
                                                <input type="checkbox" id="check-all" class="flat">
                                            </th> -->
                                            <!-- <th class="column-title">S/N </th> -->
                                            <th id="numCounter">
                                                0
                                            </th>
                                            <!-- <th class="column-title">#</th> -->
                                            <!-- <th class="column-title"></th> -->
                                            <!-- <th class="column-title" style="width: 10%">Code</th> -->
                                            <th class="column-title">Names</th>
                                            <th class="column-title">Department</th>
                                            <!-- <th class="column-title">Employment Type</th> -->
                                            <th class="column-title">Job Title</th>



                                            <th class="bulk-actions" colspan="6">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <!-- <tr id="loading">
                                        <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i></td>
                                    </tr> -->

                                    <tbody id="empListTable">

                                        <tr>
                                            <td colspan="4">No Employee(s) Selected</td>
                                        </tr>

                                    </tbody>


                                </table>


                                <div class="container">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination"></ul>
                                    </nav>
                                </div>


                            </div>

                            <div class="input-group" style="float: right">
                                <button type="button" class="btn btn-sm btn-danger"
                                    id="refresh_schedule_btn">Refresh</button>
                                <button type="button" class="btn btn-sm btn-success"
                                    id="add_schedule_btn">Update</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" id="add_schedule_loader"
                                    style="display: none;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>




</div>
</div>
<!-- /page content -->



<!-- Modal -->
<div class="modal fade" id="selectEmployees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Select Employees
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_content">
                                    <br />


                                    <div class="form-row">

                                        <div class="col-sm-2 col-xs-4">
                                            <input type="text" class="form-control filters" placeholder="Firstname"
                                                id="firstname">
                                        </div>


                                        <div class="col-sm-2 col-xs-4">
                                            <input type="text" class="form-control filters" placeholder="Lastname"
                                                id="lastname">
                                        </div>

                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-2 filters" id="gender">
                                                <option value="">-- Gender --</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-2 filters" id="position">
                                                <option value="">-- Position --</option>

                                            </select>
                                        </div>

                                        <!-- <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="Code" id="employee_code">
                      </div> -->


                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-2 filters"
                                                id="employee_department">
                                                <option value="">--Department --</option>

                                            </select>
                                        </div>

                                        <!-- <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-4 filters" id="status">
                                                <option value="">-- Status --</option>
                                                <option value="active">Active</option>
                                                <option value="suspended">Suspended</option>
                                                <option value="terminated">Terminated</option>

                                            </select>
                                        </div> -->
                                    </div>
                                    <br><br><br>



                                    <div class="form-row">

                                        <!-- <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="Phone">
                      </div>


                      <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="email">
                      </div> -->

                                    </div>
                                    <!-- <div class="col-sm-3">
                        <select class="form-control col-md-7 col-xs-12 required" id="employee_department" name="sel_employee">
                            <option value="">-- Select department --</option>
                            
                        </select>
                      </div> -->

                                    <div class="form-row">






                                        <div class="col-sm-2 col-xs-4">
                                            <button type="button" class="btn btn-success" id="filter">Search</button>
                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                id="filter_loader"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <br>

                        <div class="x_content">



                            <div class="table-responsive">

                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <!-- <th>
                                                <input type="checkbox" id="check-all" class="flat">
                                            </th> -->
                                            <!-- <th class="column-title">S/N </th> -->
                                            <th>
                                                <input type="checkbox" id="check-all" class="flat"
                                                    onclick="checkAll(this)">
                                            </th>
                                            <!-- <th class="column-title">#</th> -->
                                            <th class="column-title"></th>
                                            <!-- <th class="column-title" style="width: 10%">Code</th> -->
                                            <th class="column-title">Names</th>
                                            <th class="column-title">Department</th>
                                            <th class="column-title">Employment Type</th>
                                            <th class="column-title">Job Title</th>



                                            <th class="bulk-actions" colspan="6">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading">
                                        <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i></td>
                                    </tr>

                                    <tbody id="employeeData">



                                    </tbody>


                                </table>


                                <!-- <div class="container">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination"></ul>
                                    </nav>
                                </div> -->


                            </div>


                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveEmp">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js-files/edit_pay_schedule.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>