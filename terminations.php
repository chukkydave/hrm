<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->
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
                <h3>Exits </h3>
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

                        <button type="button" class="btn btn-success" id="add_termination" style="display:none;">Add
                            Exit</button>


                    </div>
                </div>

            </div>
        </div>

        <div id="termination_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="employee">Employee<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required" id="sel_employee"
                                            name="sel_employee">
                                            <option>-- Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group" style="display: none;" id="list_empo_loader">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x "></i>
                                        </div>
                                    </div>
                                    <div id="list_empo_details" style="display:none;">
                                        <div class="form-group">
                                            <label
                                                class="control-label col-md-3 col-sm-3 col-xs-12">Department<span>:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="dpt"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date
                                                Of
                                                Joining<span>:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="date_of_join"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="control-label col-md-3 col-sm-3 col-xs-12">Supervisor<span>:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p style="" id="supervisor"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="control-label col-md-3 col-sm-3 col-xs-12">Status<span>:</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="emp_status"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <p><strong>Department:</strong></p>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <p id="dpt"></p>
                                        </div>
                                    </div> -->

                                    <!-- <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <p><strong>Date Of Joining:</strong></p>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <p id="date_of_join"></p>
                                        </div>
                                    </div> -->

                                    <!-- <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <p><strong>Supervisor:</strong></p>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <p id="supervisor"></p>
                                        </div>
                                    </div> -->

                                    <!-- <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <p><strong>Employment Status:</strong></p>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <p id="emp_status"></p>
                                        </div>
                                    </div> -->
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">Date of Exit
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="dot" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exit_ty">Exit
                                        Type<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required" id="exit_ty"
                                            name="exit type">
                                            <option></option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reason">Reason
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="reason">

                          </textarea>
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
                                        <button type="button" class="btn btn-success" id="add_terminate">Add</button>
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

        <div class="clearfix"></div>

        <div class="row">


            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <br>

                    <div class="x_content">

                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_term_loader"></i>
                        <div class="table-responsive" id="list_term_table">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <!-- <th class="column-title">ID</th> -->
                                        <th class="column-title">&nbsp; </th>
                                        <th class="column-title">Employee Name</th>
                                        <th class="column-title">Exit Type</th>
                                        <th class="column-title">Status</th>
                                        <th class="column-title">Pre-approved</th>
                                        <th class="column-title">Exit Status</th>
                                        <th class="column-title" width="10%"></th>

                                    </tr>
                                </thead>
                                <tbody id="list_term_body">

                                </tbody>
                            </table>
                        </div>


                        <!--  -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- modal -->
<div class="modal fade" id="modal_termination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Exit Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>
<div class="modal fade" id="askModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Select Action
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="display:flex; justify-content:center;">
                    <button class="btn btn-lg btn-primary" id="collapseEg2_btn">Send Interview
                        Questions</button>
                    <button class="btn btn-lg btn-info" id="collapseEg_btn">Send Interview
                        Schedule</button>
                </div>
                <br>
                <div id="collapseEg" style="display:none;" class="form-horizontal form-label-left">


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" id="message" class="form-control col-md-7 col-xs-12"></textarea>
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
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <button type="button" class="btn btn-success" id="add_comment_btn">Send</button>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="add_comment_loader"></i>
                        </div>
                    </div>


                </div>

                <div id="collapseEg2" style="display:none;">
                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_interview_loader"></i>
                    <div id="list_interview_table">
                        <ul class="to_do" id="interview_list">

                        </ul>
                    </div>
                    <div class="text-danger" id="quest_error"></div>
                    <div>

                        <button type="button" class="btn btn-success" id="add_quest_btn">Send</button>
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="add_quest_loader"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="viewModalRes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Interview Response
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">

                <div>
                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="view_interview_loader"></i>
                    <div id="view_interview_table">
                        <!-- <ul class="to_do" id="interview_view"> -->
                        <dl class="to_do" id="interview_view">

                        </dl>
                        <!-- </ul> -->
                    </div>
                    <div class="text-danger" id="int_error"></div>

                </div>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="viewModalSche" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Schedule Message
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div class="form-horizontal form-label-left">
                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="sche_msg_loader"></i>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Schedule
                            Message<span>*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden;border:none;" type="text"
                                id="sche_msg" class="form-control col-md-12 col-xs-12"></textarea>
                            <div>
                                <input type="file" id="sche_msg_file" class="form-control col-md-7 col-xs-12"
                                    style="border:none;">
                            </div>

                        </div>

                    </div>
                    <div class="form-group" id="view_doc_div" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">

                            <a target="_blank" id="view_sche_file"><button type="button"
                                    class="btn btn-info btn-block">View
                                    Document</button></a>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="text-danger" id="sche_msg_error"></div>


                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-success" id="update_comment_btn">Update</button>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="update_comment_loader"></i>
                        </div>
                    </div>
                </div>


            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>


<script type="text/javascript" src="js-files/terminations.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>