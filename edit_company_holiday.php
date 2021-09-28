<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Company Holiday</h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">

                        <a href="company_holidays"><button type="button" class="btn btn-danger"
                                id="add_employee">Back</button></a>


                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="holiday_name">Holiday
                                    Name<span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="holiday_name" required="required"
                                        class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="branch_description">Date<span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="holiday_date" required="required"
                                        class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_com_holiday">


                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success" id="edit_holiday">Update</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="edit_holiday_loader"></i>
                                    <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                                </div>
                            </div>

                        </span>
                    </div>

                    <div class="x_content">
                        <div class="title_right" style="text-align: right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group" style="float: right">
                                    <!--span class="input-group-btn"-->
                                    <button type="button" class="btn btn-primary" id="filter_employee"
                                        data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false"
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
                                                <input type="text" class="form-control" placeholder="Firstname"
                                                    id="firstname">
                                            </div>


                                            <div class="col-sm-2 col-xs-4">
                                                <input type="text" class="form-control" placeholder="Lastname"
                                                    id="lastname">
                                            </div>

                                            <div class="col-sm-2 col-xs-4">
                                                <select class="form-control col-sm-2 col-xs-2" id="gender">
                                                    <option value="">-- Select gender --
                                                    </option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-sm-2 col-xs-4">
                                                <select class="form-control col-sm-2 col-xs-2" id="position">
                                                    <option value="">-- Select Job title --
                                                    </option>

                                                </select>
                                            </div>




                                            <div class="col-sm-2 col-xs-4">
                                                <select class="form-control col-sm-2 col-xs-2" id="employee_department">
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
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
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
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk
                                                            Actions (
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
                            </div>
                        </div>
                        <div class="input-group" style="float: right">
                            <a href="company_holidays"><button type="button" class="btn btn-success"
                                    id="done_holiday">Done</button></a>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="done_holiday_loader"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->

<!-- modal -->
<div class="modal fade" id="modal_edit_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Company Holiday Edited Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<script src="js-files/edit_company_holiday.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>