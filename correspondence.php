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

.has-errors {
    border-color: red;
}
</style>
<link rel="stylesheet" href="assets/css/chat.css">

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
                <h3>Correspondence</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right; display:flex;">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <a href="exits"><button type="button" class="btn btn-danger" id="">Back</button></a>
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
                        <div class="messaging">
                            <div class="inbox_msg">

                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="list_corres_loader"></i>
                                <div class="mesgs" id="list_corres_table">
                                    <div class="msg_history" id="list_corres_body">


                                    </div>
                                    <div class="type_msg">
                                        <div class="input_msg_write">
                                            <input type="text" class="write_msg add_corres_fields" id="corres_msg"
                                                placeholder="Type a message" disabled />
                                            <button id="add_corres_btn" class="msg_send_btn" type="button"><i
                                                    class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                            <i class="fa fa-spinner fa-spin fa-fw fa-2x"
                                                style="display: none; float:right;" id="add_corres_loader"></i>
                                        </div>
                                    </div>
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

<script type="text/javascript" src="js-files/correspondence.js"></script>



<?php
include_once("../gen/_common/footer.php");
?>