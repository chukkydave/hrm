<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- loader page -->
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

    <div id="employee_details_display" style="display: ;">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Leaves </h3>
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

                <div class="title_right" style="text-align: right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group" style="float: right">

                            <button type="button" class="btn btn-primary" id="filter_leave">Filter</button>
                            <a style="display:none;" href="add_leave" id="add_position"><button type="button"
                                    class="btn btn-success">Add
                                    Leave</button></a>


                        </div>
                    </div>
                </div>
            </div>


            <div id="filter_leave_display" style="display: none;">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br />


                                <div class="form-row">

                                    <div class="col-sm-3 col-xs-4">
                                        <select class="form-control col-sm-2 col-xs-2" id="employee_id">
                                            <option value="">-- Select Employee --</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-3 col-xs-4">
                                        <select class="form-control col-sm-2 col-xs-2" id="leave_type">
                                            <option value="">-- Select Leave Type --</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-3 col-xs-4">
                                        <input type="text" class="form-control" placeholder="Started Leave"
                                            id="date_range">
                                    </div>


                                    <div class="col-sm-3 col-xs-4">
                                        <input type="text" class="form-control required" placeholder="Leave code"
                                            id="leave_code">
                                    </div>




                                </div>
                                <br><br>

                                <div class="form-row">
                                    <div class="col-sm-3 col-xs-4">
                                        <button type="button" class="btn btn-success" id="leave_filter">Search</button>

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
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">ID</th>
                                            <th class="column-title">&nbsp; </th>
                                            <th class="column-title">By </th>
                                            <th class="column-title">Leave Type </th>
                                            <!-- <th class="column-title">Branch</th> -->
                                            <th class="column-title">Starts</th>
                                            <th class="column-title">Resumes</th>
                                            <th class="column-title">Days Used </th>
                                            <th class="column-title">Pre-Approvals </th>
                                            <th class="column-title">HR Approval </th>

                                            <th class="column-title no-link last"><span class="nobr">Action</span>
                                            </th>
                                            <th class="bulk-actions" colspan="9">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading">
                                        <td colspan="9"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i></td>
                                    </tr>
                                    <tbody id="leavesData" style="display: none;">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js-files/leave.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>