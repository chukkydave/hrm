<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Notifications</h3>
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

                        <button type="button" class="btn btn-success" id="add_position" data-toggle="collapse"
                            data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">Create
                            Notification</button>


                    </div>
                </div>
            </div>
        </div>


        <div class="collapse" id="collapseExample4">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="notification_text">Notification<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" class="form-control col-md-7 col-xs-12 required"
                                            id="notification_text">

                                        </textarea>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="notification_text">Status<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select cols="3" class="form-control col-md-7 col-xs-12 required"
                                            id="notification_status">
                                            <option>--Select--</option>
                                            <option value="pending">Pending</option>
                                            <option value="publish">Publish</option>

                                        </select>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_position">
                                        <!--  <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" > -->

                                    </div>
                                </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                <button type="button" class="btn btn-success" id="add_not">Add</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="notification_loader"></i>
                            </div>
                        </div>

                        </span>
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

                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                        id="list_notification_loader"></i>
                    <div class="table-responsive" id="list_notification_table">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">

                                    <th class="column-title">Notification</th>

                                    <th class="column-title" width="10%">Actions</th>

                                </tr>
                            </thead>
                            <tbody id="list_notification_body">

                            </tbody>
                        </table>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->

<!-- modal -->


<!-- modal -->
<div class="modal fade" id="delete_modal_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Confirm
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <h4>Are you sure you want to delete this position?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="yes_delete_position" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_not_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Notification
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                for="edit_notification">Notification
                                <span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" id="edit_notification"
                                    class="form-control col-md-7 col-xs-12 edit_fields"></textarea>
                            </div>
                        </div>


                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_status">Status
                                <span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <select class="form-control col-md-7 col-xs-12 edit_fields" id="edit_status">
                                    <option value="">-- Select --</option>
                                    <option value="pending">Pending</option>
                                    <option value="publish">Publish</option>
                                </select>
                            </div>
                        </div> -->




                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_error">

                            </div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_not_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_not_loader"></i>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js-files/notice_board.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>