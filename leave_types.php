<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
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
                <h3>Leave Types </h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!--span class="input-group-btn"-->
                        <a href="add_leave_type"><button type="button" class="btn btn-success" id="add_employee">Add
                                Leave Type</button></a>
                        <!-- </span> -->

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



                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Leave Type</th>
                                        <!-- <th class="column-title">Allowable Leave Days</th> -->
                                        <th class="column-title">Paid/Unpaid</th>
                                        <th class="column-title">Exclude Holidays </th>
                                        <th class="column-title">Exclude Weekends </th>

                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="6">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>


                                <tbody id="leaveData">
                                    <tr>
                                        <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
                                                id="loading"></i></td>
                                    </tr>
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
<!-- /page content -->


<script src="js-files/leave_types.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>