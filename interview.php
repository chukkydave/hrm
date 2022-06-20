<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Interview</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Add</button> -->
                        <a href="exits"><button type="button" class="btn btn-danger">Back</button></a>
                    </div>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">


                    <div class="x_content" style="padding:20px 0px;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div style="display:flex; justify-content:center;">
                                <button class="btn btn-lg btn-primary">Send Interview Questions</button>
                                <button class="btn btn-lg btn-info" data-toggle="collapse" data-target="#collapseEg"
                                    aria-expanded="false" aria-controls="collapseExample">Send Interview
                                    Schedule</button>
                            </div>
                            <br>
                            <span id="collapseEg" data-parsley-validate
                                class="form-horizontal form-label-left collapse">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="message">Message<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="message"
                                            class="form-control col-md-7 col-xs-12"></textarea>
                                        <div>
                                            <input type="file" id="message_file" class="form-control col-md-7 col-xs-12"
                                                style="border:none;">
                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-danger" id="comment_error"></div>


                                    </div>

                                </div>


                                <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                        <button type="button" class="btn btn-success" id="add_comment_btn">Send</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="add_comment_loader"></i>
                                    </div>
                                </div>


                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>
                                            Interview
                                        </h2>
                                    </div>

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <dl>
                                        <dt>Coffee</dt>
                                        <dd>- black hot drink</dd>
                                        <dt>Milk</dt>
                                        <dd>- white cold drink</dd>
                                        <dt>Coffee</dt>
                                        <dd>- black hot drink</dd>
                                        <dt>Milk</dt>
                                        <dd>- white cold drink</dd>
                                        <dt>Coffee</dt>
                                        <dd>- black hot drink</dd>
                                        <dt>Milk</dt>
                                        <dd>- white cold drink</dd>
                                        <dt>Coffee</dt>
                                        <dd>- black hot drink</dd>
                                        <dt>Milk</dt>
                                        <dd>- white cold drink</dd>
                                    </dl>
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

<div class="modal fade" id="exit_date_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Select Exit Date
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_workExp_prevCom">Exit
                                Date
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="exit_date" required="required" style="margin-bottom:5px;"
                                    class="form-control col-md-7 col-xs-12 required">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="exit_date_error">

                            </div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="approve_btnn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="approvee_loader"></i>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js-files/interview.js"></script>



<?php
include_once("../gen/_common/footer.php");
?>