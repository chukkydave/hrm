<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<style>
.no-border {
    border: none;
    outline: none;
    background-color: #f5f6f8;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 2em;
}
</style>
<link href="https://unpkg.com/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

<!-- page content -->
<div id="employee_details_display" style="display: ;">
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Create Company Holiday</h3>
                    <span id="holiday_its"></span>
                </div>

                <div class="title_right" style="text-align: right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group" style="float: right">
                            <a href="company_holidays"><button type="button" class="btn btn-danger">Back</button></a>


                        </div>
                    </div>
                </div>

                <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>


            <!-- <div class="collapse" id="collapseExample4">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br />


                                <div class="form-row">

                                    <div class="col-sm-2 col-xs-4">
                                        <input type="text" class="form-control" placeholder="Firstname" id="firstname">
                                    </div>


                                    <div class="col-sm-2 col-xs-4">
                                        <input type="text" class="form-control" placeholder="Lastname" id="lastname">
                                    </div>

                                    <div class="col-sm-2 col-xs-4">
                                        <select class="form-control col-sm-2 col-xs-2" id="gender">
                                            <option value="">-- Select gender --</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-2 col-xs-4">
                                        <select class="form-control col-sm-2 col-xs-2" id="position">
                                            <option value="">-- Select Job title --</option>

                                        </select>
                                    </div>




                                    <div class="col-sm-2 col-xs-4">
                                        <select class="form-control col-sm-2 col-xs-2" id="employee_department">
                                            <option value="">-- Select Department --</option>

                                        </select>
                                    </div>


                                </div>
                                <br><br><br>




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
            </div> -->

            <div class="clearfix"></div>


            <div class="row">


                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">

                        <br>

                        <div class="x_content">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="smartwizard">

                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#step-1">
                                                Create Holiday
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#step-2">
                                                Remove Employees not involved
                                            </a>
                                        </li>


                                    </ul>

                                    <div class="tab-content">
                                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate
                                                        class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                for="holiday_name">Name<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="holiday_name" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                for="holiday_date">Date<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="holiday_date" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                for="firstname">
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="text-danger form-control col-md-7 col-xs-12"
                                                                    style="display: none;" id="error_holiday">

                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                                <button type="button" class="btn btn-success"
                                                                    id="add_holiday">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                    style="display: none;" id="holiday_loader"></i>
                                                            </div>
                                                        </div>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">

                                            <div class="x_content">
                                                <div class="title_right" style="text-align: right">
                                                    <div
                                                        class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                                        <div class="input-group" style="float: right">
                                                            <!--span class="input-group-btn"-->
                                                            <button type="button" class="btn btn-primary"
                                                                id="filter_employee" data-toggle="collapse"
                                                                data-target="#collapseExample4" aria-expanded="false"
                                                                aria-controls="collapseExample">Filter</button>

                                                            <!-- </span> -->

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="collapseExample4">
                                                    <!-- <div class="row"> -->
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">

                                                            <div class="x_content">
                                                                <br />


                                                                <div class="form-row">

                                                                    <div class="col-sm-2 col-xs-4">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Firstname" id="firstname">
                                                                    </div>


                                                                    <div class="col-sm-2 col-xs-4">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Lastname" id="lastname">
                                                                    </div>

                                                                    <div class="col-sm-2 col-xs-4">
                                                                        <select class="form-control col-sm-2 col-xs-2"
                                                                            id="gender">
                                                                            <option value="">-- Select gender --
                                                                            </option>
                                                                            <option value="male">Male</option>
                                                                            <option value="female">Female</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="col-sm-2 col-xs-4">
                                                                        <select class="form-control col-sm-2 col-xs-2"
                                                                            id="position">
                                                                            <option value="">-- Select Job title --
                                                                            </option>

                                                                        </select>
                                                                    </div>




                                                                    <div class="col-sm-2 col-xs-4">
                                                                        <select class="form-control col-sm-2 col-xs-2"
                                                                            id="employee_department">
                                                                            <option value="">-- Select Department --
                                                                            </option>

                                                                        </select>
                                                                    </div>


                                                                </div>
                                                                <br><br><br>




                                                                <div class="form-row">






                                                                    <div class="col-sm-2 col-xs-4">
                                                                        <button type="button" class="btn btn-success"
                                                                            id="filter">Search</button>
                                                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                            style="display: none;"
                                                                            id="filter_loader"></i>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- </div> -->
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="x_panel">

                                                        <div class="x_content">
                                                            <br />

                                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                style="display: none;" id="list_workShift_loader"></i>
                                                            <div class="table-responsive" id="list_workShift_table">
                                                                <table
                                                                    class="table table-striped jambo_table bulk_action">
                                                                    <thead>
                                                                        <tr class="headings">

                                                                            <th>
                                                                                <input type="checkbox" id="check-all"
                                                                                    class="flat"
                                                                                    onclick="checkAll(this)">
                                                                            </th>
                                                                            <th class="column-title"></th>
                                                                            <th class="column-title">Names</th>
                                                                            <th class="column-title">Department</th>
                                                                            <th class="column-title">Employment Type
                                                                            </th>
                                                                            <th class="column-title">Job Title</th>



                                                                            <th class="bulk-actions" colspan="6">
                                                                                <a class="antoo"
                                                                                    style="color:#fff; font-weight:500;">Bulk
                                                                                    Actions (
                                                                                    <span class="action-cnt"> </span> )
                                                                                    <i
                                                                                        class="fa fa-chevron-down"></i></a>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="employeeData">



                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="container">
                                                                <nav aria-label="Page navigation">
                                                                    <ul class="pagination" id="pagination"></ul>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="input-group" style="float: right">
                                                            <a href="company_holidays"><button type="button"
                                                                    class="btn btn-success"
                                                                    id="done_holiday">Done</button></a>
                                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                                style="display: none;" id="done_holiday_loader"></i>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">


                            </div> -->
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                </div>



                <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <br>
                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="holiday_name">Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="holiday_name" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="holiday_date">Date<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="holiday_date" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;"
                                            id="error_holiday">

                                        </div>
                                    </div>
                                </div>




                            </span>
                        </div>

                        <div class="x_content">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="list_workShift_loader"></i>
                                <div class="table-responsive" id="list_workShift_table">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                
                                                <th>
                                                    <input type="checkbox" id="check-all" class="flat"
                                                        onclick="checkAll(this)">
                                                </th>
                                                <th class="column-title"></th>
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
                                        <tbody id="employeeData">



                                        </tbody>
                                    </table>
                                </div>
                                <div class="container">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination"></ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="input-group" style="float: right">
                                <button type="button" class="btn btn-success" id="add_holiday">Create</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="holiday_loader"></i>
                            </div>
                        </div> 
                    </div>
                </div> -->
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


<script src="https://kit.fontawesome.com/bcb3edd6a7.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="js-files/add_com_hols.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>