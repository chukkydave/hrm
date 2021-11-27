<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
blockquote {
    background: #f9f9f9;
    border-left: 10px solid #ccc;
    margin: 1.5em 10px;
    padding: 0.5em 10px;
    quotes: "\201C""\201D""\2018""\2019";
}

/* #Exp_list li {} */

/* blockquote:before {
color: #ccc;
content: open-quote;
font-size: 4em;
line-height: 0.1em;
margin-right: 0.25em;
vertical-align: -0.4em;
} */

blockquote p {
    display: inline;
    font-size: 0.7em;
}
</style>
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
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Exit Configuration</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Add</button> -->
                        <!-- <a href="grievances"><button type="button" class="btn btn-danger">Back</button></a> -->

                    </div>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>



        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Exit Type
                            <!-- <small>Activity report</small> -->
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li id="edit_bank_details" data-toggle="collapse" data-target="#collapseExample"
                                aria-expanded="false" aria-controls="collapseExample">
                                <a class=""><span data-toggle="tooltip" title="Add Exit Type"><i
                                            class="fa fa-plus"></i><span></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <div class="collapse" id="collapseExample" style="">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">

                                        <div class="x_content">
                                            <br />
                                            <div class="form-row">
                                                <div class="col-sm-8 col-md-8 col-xs-8">
                                                    <input type="text" placeholder="Exit Type"
                                                        class="form-control col-md-12 col-xs-12 required"
                                                        id="exitType_name">
                                                    <p class="text-danger" id="exitType_error"></p>

                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="col-sm-2 col-xs-4" style="">
                                                    <button type="button" class="btn btn-success"
                                                        id="add_exitType_btn">Add</button>
                                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                        id="add_exitType_loader"></i>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="x_content">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="list_exitType_loader"></i>
                            <div class="">
                                <ul class="to_do" id="Exp_list" style="">

                                </ul>
                            </div>
                            <!-- <div class="table-responsive" id="list_exitType_table">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">

                                            <th class="column-title">Exit Type</th>
                                            <th class="column-title"></th>

                                        </tr>
                                    </thead>
                                    <tbody id="list_exitType_body">

                                    </tbody>
                                </table>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Exit Interview Questions
                            <!-- <small>Activity report</small> -->
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false"
                                aria-controls="collapseExample">
                                <a class=""><span data-toggle="tooltip" title="Add Exit Interview Questions"><i
                                            class="fa fa-plus"></i><span></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <div class="collapse" id="collapseExample2" style="">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">

                                        <div class="x_content">
                                            <br />
                                            <div class="form-row">
                                                <div class="col-sm-8 col-md-8 col-xs-8">
                                                    <input type="text" placeholder="Exit Interview Question"
                                                        class="form-control col-md-12 col-xs-12 required"
                                                        id="interview_question">
                                                    <p class="text-danger" id="interview_error"></p>

                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="col-sm-2 col-xs-4" style="">
                                                    <button type="button" class="btn btn-success"
                                                        id="add_interview_btn">Add</button>
                                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                        id="add_interview_loader"></i>

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="x_content">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="list_interview_loader"></i>
                            <div class="">
                                <ul class="to_do" id="interview_list" style="">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Exit Policy/Info
                            <!-- <small>Activity report</small> -->
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li id="edit_bank_details" data-toggle="collapse" data-target="#collapseExample3"
                                aria-expanded="false" aria-controls="collapseExample">
                                <a class=""><span data-toggle="tooltip" title="Add Policy"><i
                                            class="fa fa-plus"></i><span></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <div class="collapse" id="collapseExample3" style="">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">

                                        <div class="x_content">
                                            <!-- <br />
                                            <div class="col-sm-8 col-md-8 col-xs-8">
                                                <div id="summernote">Hello Summernote</div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-sm-2 col-xs-4" style="">
                                                    <button type="button" class="btn btn-success"
                                                        id="add_policy_btn">Add</button>
                                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                        id="add_policy_loader"></i>

                                                </div>
                                            </div> -->

                                            <span id="demo-form2" data-parsley-validate
                                                class="form-horizontal form-label-left">

                                                <div class="col-sm-8 col-md-8 col-xs-8">
                                                    <div id="summernote"></div>
                                                </div>
                                                <br>
                                                <div class="col-sm-8 col-md-8 col-xs-8">
                                                    <input id="policy_file" type="file">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                        for="edit_exitType_name">Exit Type
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="edit_exitType_name"
                                                            class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div> -->

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger"
                                                        id="add_policy_error">


                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12" id="form_footer">
                                                        <button type="submit" class="btn btn-success"
                                                            id="add_policy_btn">Save</button>
                                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                            style="display: none;" id="add_policy_loader"></i>
                                                    </div>
                                                </div>

                                            </span>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="x_content">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="list_policy_loader"></i>
                            <div class="" id="policy_list">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
</div>
<!-- modal -->
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
            <div class="modal-body" id="mod_bodi">
                <h4>Grievance Report Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>


<div class="modal fade" id="edit_exitType_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Exit Type
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="edit_form">
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_exitType_name">Exit Type
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="edit_exitType_name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_exitType_error">


                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="form_footer">
                                <button type="submit" class="btn btn-success" id="edit_exitType_btn">Update</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="edit_exitType_loader"></i>
                            </div>
                        </div>

                    </span>
                </div>

                <div id="edit_msg" style="display: none;">
                    <h4>Grievance Report Updated Successfully!</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
        </div>
    </div>
</div>
<div class="modal fade" id="edit_interview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Exit Type
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="edit_form">
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_interview_name">Interview
                                Question
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="edit_interview_name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_interview_error">


                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="form_footer">
                                <button type="submit" class="btn btn-success" id="edit_interview_btn">Update</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="edit_interview_loader"></i>
                            </div>
                        </div>

                    </span>
                </div>

                <div id="edit_msg" style="display: none;">
                    <h4>Grievance Report Updated Successfully!</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal_view_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Grievance Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div id="container4">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Grievance Type:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="g_type"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Incident Date:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="incident_date"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Report:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="report"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Branch:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="branch"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Approval Status:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="approval"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Response:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="report"></p>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript" src="js-files/exit_config.js"></script>



<?php
include_once("../gen/_common/footer.php");
?>