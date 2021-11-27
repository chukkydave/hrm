<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
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
                <h3>Payroll History </h3>
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
                        <button type="button" class="btn btn-primary" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">Filter</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />


                            <div class="form-row">

                                <div class="col-sm-4 col-xs-4">
                                    <input class="form-control col-sm-7 col-xs-12" type="text" placeholder="Name"
                                        id="name_filter">

                                </div>
                                <div class="col-sm-4 col-xs-4">
                                    <input class="form-control col-sm-7 col-xs-12" type="text" placeholder="Pay Period"
                                        id="payperiod_filter">

                                </div>

                                <div class="col-sm-4 col-xs-4">
                                    <select class="form-control" name="status_filter" id="status_filter">
                                        <option value="all">All</option>
                                        <option value="active">Active</option>
                                        <option value="approve">Approved</option>

                                    </select>
                                </div>


                            </div>

                            <div class="form-row">
                                <div class="col-sm-2 col-xs-4" style="margin-top:10px;">
                                    <button type="button" class="btn btn-success" id="filter_run">Search</button>

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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="list_sche_loader"></i>
                            <div class="table-responsive" id="list_sche_table">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">

                                            <th class="column-title">Name</th>
                                            <th class="column-title">Pay Period</th>
                                            <th class="column-title">Status</th>
                                            <th class="column-title" width="10%"></th>

                                        </tr>
                                    </thead>
                                    <tbody id="list_sche_body">

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

<!-- modal -->
<div class="modal fade" id="edit_sPayrun_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Payrun
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <br>

                            <div class="x_content">
                                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="list_sPayrun_loader"></i>
                                <div class="table-responsive" id="list_sPayrun_table">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">

                                                <th>
                                                    <!-- <input type="checkbox" id="check-all" class="flat"
                                                            onclick="checkAll(this)"> -->
                                                </th>
                                                <!-- <th class="column-title">#</th> -->
                                                <!-- <th class="column-title"></th> -->
                                                <!-- <th class="column-title" style="width: 10%">Code</th> -->
                                                <th class="column-title">Names</th>
                                                <th class="column-title">Department</th>
                                                <!-- <th class="column-title">Employment Type</th> -->
                                                <th class="column-title">Job Title</th>



                                                <th class="bulk-actions" colspan="6">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk
                                                        Actions (
                                                        <span class="action-cnt"> </span> ) <i
                                                            class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_sPayrun_body">

                                        </tbody>
                                    </table>
                                </div>
                                <!-- </div> -->





                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_nok_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i>
            </div>
        </div>
    </div>
</div>




<script src="js-files/payroll_history.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>