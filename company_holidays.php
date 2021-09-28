<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">

            <div class="title_left">
                <h3>Company Holidays</h3>
            </div>


            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!--span class="input-group-btn"-->
                        <!-- <button type="button" class="btn btn-success" id="add_hols">Add New</button> -->
                        <a href="add_com_hols"><button type="button" class="btn btn-success">Add New</button></a>
                        <!-- </span> -->

                    </div>
                </div>
            </div>

        </div>

        <div id="holiday_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;"
                                            id="error_holiday">

                                        </div>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_holiday">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="holiday_loader"></i>
                                    </div>
                                </div>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="list_of_users">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <br>
                        <!-- <div class="form-group">
                    <div class="pull-right">
                      <button type="button" class="btn btn-success"><a href="admin/add_user" style="color: white;">Add</a></button>
                      
                    </div>
                  </div><br><br> -->

                        <div class="x_content">


                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">

                                    <thead>
                                        <tr class="headings">
                                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                                            <th class="column-title">Holiday</th>
                                            <th class="column-title">Date</th>


                                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                                            </th>
                                            <th class="bulk-actions" colspan="3">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>

                                        </tr>

                                    </thead>




                                    <tbody id="holidayData" style="display: none">
                                        <tr>
                                            <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                    style="display: ;" id="loading"></i>
                                            </td>
                                        </tr>


                                        <!-- <tr>
                            <td>
                              <input type="checkbox" id="check-all" class="flat">
                            </td>
                            <td>1.</td>
                            <td><a href="admin/user_profile">Oluwaseye</a></td>
                            <td><a href="admin/user_profile">Gbenga</a></td>
                            <td><a href="admin/user_profile">seygz@gmail.com</a></td>
                            <td>
                              <a href="admin/user_permissions"><i class="fa fa-lock fa-2x" data-toggle="tooltip" data-placement="top" data-original-title="User Permissions"></i></a> &nbsp;&nbsp; -->

                                        <!-- <i class="fa fa-toggle-on fa-2x"  data-toggle="tooltip" data-placement="top" data-original-title="Disable Login"></i> &nbsp;&nbsp;  -->

                                        <!-- <i class="fa fa-trash fa-2x"  data-toggle="tooltip" data-placement="top" data-original-title="Disable Login"></i>
                            </td>
                          </tr>-->


                                    </tbody>
                                </table>
                                <div class="container">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination"></ul>
                                    </nav>
                                </div>

                                <!-- <div class="ln_solid"></div> -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content-->

<!-- modal -->
<div class="modal fade" id="modal_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Company Holiday Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>



<script src="js-files/company_holidays.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>