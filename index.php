<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css"> -->
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

<!-- default view -->
<div class="right_col" role="main" id="main_display_loader_page2" style="display: none;">
    <div class="page-title">
        <div id="" style="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br>
                        <div class="bs-example" data-example-id="simple-jumbotron">
                            <div class="jumbotron">
                                <div style="font-size: 30px; font-weight: bold">Hello, <span
                                        class="hi_user_name">newyear</span>!</div>
                                <p>Welcome to NaHere Human Resource Management Software (HRM).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            </div>
        </div>
    </div>
</div>
<!-- default vie end -->

<!-- page content -->
<div class="right_col" role="main" id="main_display" style="display: none;">
    <div class="">


        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard </h3>
            </div>

            <div class="title_right">
            </div>
        </div>

        <div class="clearfix"></div>


        <div class="row top_tiles">

            <a href="employees">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 feat_5_css">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="count" id="no_employees">
                            <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_employees"></i>
                        </div>
                        <h3>Employees</h3>
                        <p>Total No. of Employees</p>
                    </div>
                </div>
            </a>

            <a href="leaves">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 feat_5_css">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-plane"></i></div>
                        <div class="count" id="no_leaves">
                            <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_leaves"></i>
                        </div>
                        <h3>Leaves</h3>
                        <p>Pending Leaves</p>
                    </div>
                </div>
            </a>

            <a href="exits">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 feat_5_css">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-hand-stop-o"></i></div>
                        <div class="count" id="no_terminations">
                            <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_terminations"></i>
                        </div>
                        <h3>Exits</h3>
                        <p>Exits till date</p>
                    </div>
                </div>
            </a>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 feat_5">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-money"></i></div>
                    <div class="count" id="no_total_salary">
                        <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: none; " id=""></i>
                    </div>
                    <h3>Total Salary</h3>
                    <p>Past Month</p>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Employment Type</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="ddsh_loading"></i>
                        <div id="echart_pie" style="height:350px;"></div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 feat_5">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Employee Cost</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
                            id="yearly_sales_report_loading"></i>
                        <div id="yearly_sales_report" style="height:350px;"></div>

                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-6 col-xs-12 feat_5_notice">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="notice_board">
                            <h2>Notice Board</h2>
                        </a>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div style="height:350px;">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="notice_board_loading"></i>
                            <ul class="list-unstyled timeline" id="notice_board">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Total Number of Employees</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
                            id="total_employees_by_months_loading"></i>
                        <div id="total_employees_by_months" style="height:350px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="notice_board">
                            <h2>Upcoming events</h2>
                        </a>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                            id="upcoming_event_loading"></i>
                        <div style="height:350px;" id="upcoming_event">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 feat_5_exits">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exits</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="exit_chartert_loading"></i>
                        <div id="exit_chartert" style="height:350px;"></div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Calendar</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="calendarly_loader"></i>

                        <div id="calendarly" style="height:350px !important; dispaly:none;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>