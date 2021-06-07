<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payroll Settings</h3>
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

                        <!-- <button type="button" class="btn btn-success" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Create
                            Pay Schedule</button> -->


                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="position_name">Position Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="position_name" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eligibility">Leave
                                        Eligibility<span>*</span>
                                    </label>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input type="number" id="eligibility" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <input type="text" required="required"
                                            class="form-control col-md-7 col-xs-12 required" disabled value="Months">
                                    </div>
                                    <span style="vertical-align:sub;">From Date Of Joining</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alloted_days">Allotted
                                        Leave Days<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="alloted_days" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="position_description">Description<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" class="form-control col-md-7 col-xs-12 required"
                                            id="position_description">

                          </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_position">
                                        <!--  <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" > --

                                    </div>
                                </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> --
                                <button type="button" class="btn btn-success" id="add_pos">Add</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="position_loader"></i>
                            </div>
                        </div>

                        </span>
                    </div>
                </div>
            </div>
        </div> -->
    </div>


    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Payroll Type
                        <!-- <small>Activity report</small> -->
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false"
                            aria-controls="collapseExample">
                            <a class=""><i class="fa fa-plus"></i></a>
                        </li>

                    </ul>
                    <div class="collapse" id="collapseExample3">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_content">
                                    <br />
                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                for="payroll_name">Name<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="payroll_name" required="required"
                                                    class="form-control col-md-7 col-xs-12 required add_payroll_fields">

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                for="payroll_desc">Description<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="payroll_desc" required="required"
                                                    class="form-control col-md-7 col-xs-12 required add_payroll_fields"></textarea>
                                            </div>
                                        </div>
                                        <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                <button type="button" class="btn btn-sm btn-success"
                                                    id="add_payroll_btn">Add</button>
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                    id="add_payroll_loader"></i>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                            id="list_payroll_loader"></i>
                        <div class="table-responsive" id="list_payroll_table">
                            <table class="table table-striped bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Name</th>

                                        <th class="column-title" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="list_payroll_body">
                                    <tr>
                                        <td colspan="2">No record found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Payment Type
                        <!-- <small>Activity report</small> -->
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false"
                            aria-controls="collapseExample">
                            <a class=""><i class="fa fa-plus"></i></a>
                        </li>

                    </ul>
                    <div class="collapse" id="collapseExample4">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_content">
                                    <br />
                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                for="payment_name">Name<span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="payment_name" required="required"
                                                    class="form-control col-md-7 col-xs-12 required add_payment_fields">

                                            </div>

                                        </div>


                                        <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                <button type="button" id="add_payment_btn"
                                                    class="btn btn-sm btn-success" id="">Add</button>
                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                    id="add_payment_loader"></i>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                            id="list_payment_loader"></i>
                        <div class="table-responsive" id="list_payment_table">
                            <table class="table table-striped bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Name</th>

                                        <th class="column-title" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="list_payment_body">
                                    <tr>
                                        <td colspan="2">No record found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>
</div>
<!-- /page content -->

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4 id="mod_body"></h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="edit_payroll_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Payroll Type
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <span id="" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_payroll_name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_payroll_name" required="required" style="margin-bottom:5px;"
                                    class="form-control col-md-7 col-xs-12 required">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_payroll_desc">Description
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_payroll_desc" required="required" style="margin-bottom:5px;"
                                    class="form-control col-md-7 col-xs-12">

                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_payroll_error">

                            </div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_payroll_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_payroll_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Payment Type
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <span id="" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_payment_name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_payment_name" required="required" style="margin-bottom:5px;"
                                    class="form-control col-md-7 col-xs-12 required">

                            </div>
                        </div>





                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_payment_error">

                            </div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_payment_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_payment_loader"></i>
            </div>
        </div>
    </div>
</div>
<script src="js-files/payroll_setting.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>