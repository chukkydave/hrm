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

.column-title {
    border-right: 1px solid rgba(115, 135, 156, 0.4);
    text-align: center;
}

.td-title {
    border-right: 1px solid rgba(115, 135, 156, 0.4);
    text-align: center;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Attendance Report</h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">

                        <button type="button" class="btn btn-primary" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">Filter</button>
                    </div>
                </div>
            </div>

        </div>


        <div id="upload_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p class="col-md-7 col-xs-12"><span>*</span>Upload a CSV file</p>
                                        <!-- <input type="file" id="dot" required="required" class="form-control col-md-7 col-xs-12 required"> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">Choose File
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" id="dot" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">

                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_terminate">Upload</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="termination_loader"></i>
                                    </div>
                                </div>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="add_attendence_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_id">Employee
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required" id="employee_id"
                                            name="employee_id">
                                            <option value="">-- Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="dater" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_in">Clock In
                                        Time <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="clock_in" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_out">Clock Out
                                        Time
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="clock_out" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_att">

                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="attendance_loader"></i>
                                    </div>
                                </div>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseExample" style="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />


                            <div class="form-row">

                                <!-- <div class="col-sm-4 col-xs-4">
                                    <select class="form-control col-md-7 col-xs-12 required" id="employee_name">
                                        <option value="">-- Select Employee--</option>

                                    </select>
                                </div> -->

                                <div class="col-sm-4 col-xs-4">
                                    <select class="form-control col-sm-7 col-xs-12" id="employee_department">
                                        <option value="">-- All Employees --</option>

                                    </select>
                                </div>

                                <div class="col-sm-4 col-xs-4">
                                    <!-- <input type="" date="year" class="form-control" id=""> -->
                                    <select class="form-control" name="month" id="month_filter">
                                        <option value="0">January</option>
                                        <option value="1">Febuary</option>
                                        <option value="2">March</option>
                                        <option value="3">April</option>
                                        <option value="4">May</option>
                                        <option value="5">June</option>
                                        <option value="6">July</option>
                                        <option value="7">August</option>
                                        <option value="8">September</option>
                                        <option value="9">October</option>
                                        <option value="10">November</option>
                                        <option value="11">December</option>
                                    </select>
                                </div>


                                <div class="col-sm-4 col-xs-4">
                                    <!-- <input type="" date="year" class="form-control" id=""> -->
                                    <select class="form-control" name="startyear" id="year_filter">
                                        <?php
                                        for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                                        <option value="<?=$year;?>"><?=$year;?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <!-- <div class="col-sm-4 col-xs-4">
                                    <input type="year" class="form-control" id="yearPicker">
                                </div> -->



                            </div>

                            <div class="form-row">
                                <div class="col-sm-2 col-xs-4" style="margin-top:10px;">
                                    <button type="button" class="btn btn-success" id="filter">Search</button>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

        <div class="row">


            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <br>

                    <div class="x_content">



                        <div class="table-responsive">
                            <select class="form-select no-border" id="order_by" aria-label="Default select example">
                                <option value="latest">Order by Latest</option>
                                <!-- <option value="alphabetical">Order from A-Z </option> -->
                            </select>
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings" id="headins">

                                        <th class="column-title">Employee</th>
                                        <th class="column-title">Shift</th>
                                        <th class="column-title">Summary</th>
                                        <!-- <th class="column-title">&nbsp;</th> -->

                                        <!-- <th class="column-title">Over Time/Late By</th> -->

                                        <!-- <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th> -->
                                    </tr>
                                </thead>

                                <tr id="loading">
                                    <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display:;"></i>
                                    </td>
                                </tr>
                                <tbody id="attendanceData">


                                    <!-- <tr>
                            <td colspan="7">No record.</td>
                          </tr> -->
                                </tbody>
                            </table>
                            <div class="container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- modal -->
<div class="modal fade" id="modal_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Employee Attendance Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/bcb3edd6a7.js" crossorigin="anonymous"></script>
<script src="js-files/attendance_report.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>