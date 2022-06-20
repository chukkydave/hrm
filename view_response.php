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
    color: red;
}

.my-center {
    display: grid;
    align-items: center;
}

.mr2 {
    margin-right: 2rem;
}

.ml1 {
    margin-left: 1em;
}

.flex {
    display: flex;
}

.cent {
    display: grid;
    align-items: center;
}

.grider {
    display: grid;
    gap: 1em;
    grid-auto-flow: column;
}

.boxShadow {
    box-shadow: 0 4px 8px rgb(0 0 0 / 19%);
}

.greyed-out {
    background-color: gray;
    color: whitesmoke;
    /* cursor: not-allowed;
    pointer-events: none; */

}
</style>
<!-- <link rel="stylesheet" href="assets/css/interview.css"> -->
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
                <h3>View Interview Response</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right; display:flex;">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <a href="exits"><button type="button" class="btn btn-danger">Back</button></a>
                    </div>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>

        <div class="row">

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12" style="background:none; border:none;">
                <div class="x_panel" style="background:none; border:none;">

                    <br>

                    <div class="x_content" style="background:none; border:none;display:none;" id="list_interview_div">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                            id="list_interview_loader"></i>
                        <div class=""
                            style=" background:#f9f9f9; box-shadow:4px 4px 4px 4px rgb(0 0 0 / 19%); padding: 2em 0; border-radius:10px;">
                            <div id="interview_list" style="display:grid;justify-items:center;"></div>
                            <div class="text-danger" id="res_error"></div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- modal -->
<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->


<script type="text/javascript" src="js-files/view_response.js"></script>



<?php
include_once("../gen/_common/footer.php");
?>