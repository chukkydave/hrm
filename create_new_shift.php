<?php
include("_common/header.php");
?>

<!-- page content -->
<div id="employee_details_display" style="display: ;">
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Create Shift</h3>
                </div>

                <div class="title_right" style="text-align: right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group" style="float: right">

                            <a href="work_shift"><button type="button" class="btn btn-primary"
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shift_name">Shift
                                        Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="shift_name" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="duration">Duration<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div style="display:flex;">
                                            <input type="number" id="duration" required="required"
                                                class="form-control col-md-3 col-xs-6 required"
                                                style="margin-right:10px;">
                                            <input type="text" id="duration_hrs" required="required"
                                                class="form-control col-md-3 col-xs-6 required" value="hours" disabled>
                                        </div>
                                    </div>
                                </div>

                                <br>


                            </span>


                            <div class="table-responsive" style="z-index: 10">
                                <table class="table table-striped jambo_table bulk_action" style="z-index: 10">
                                    <thead>
                                        <tr class="headings">
                                            <!-- <th>
                                <input type="checkbox" id="check-all" class="flat">
                              </th> -->
                                            <!-- <th class="column-title"> </th> -->

                                            <th class="column-title">Day</th>
                                            <th class="column-title">Start Time</th>
                                            <th class="column-title">End Time</th>
                                            <!-- <th class="column-title">Status </th> -->


                                            <!-- <th class="column-title no-link last"><span class="nobr">Action</span> -->
                                            </th>

                                        </tr>
                                    </thead>

                                    <!-- <tr id="loading">
                            <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                          </tr> -->


                                    <tbody id="wkdz">



                                    </tbody>


                                </table>



                                <br>
                                <button type="button" class="btn btn-success" id="add_work_shift">Create</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="create_loader"></i>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /page content -->

<div class="modal fade" id="modal_shift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Shift Successfully Created!</h4>
            </div>

        </div>
    </div>
</div>

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


<script src="js-files/create_new_shift.js"></script>
<?php
include("_common/footer.php");
?>