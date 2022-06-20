<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Audit Trail </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <br>

                    <div class="x_content">
                        <div class="col-md-4  col-sm-12 col-xs-12 form-group">
                            <form class="form-horizontal">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon"><i
                                                        class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>

                                                <input class="form-control" name="dt_range" type="text"
                                                    placeholder="Enter Date Range" id="reservationtt">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!-- <div class="title_right"> -->
                        <div class="col-md-4 col-sm-12 col-xs-12 form-group top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Name" id="name_audit"
                                    style="border-radius:5px !important; border: 1px solid #ccc !important;">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" style="color:white;" type="button"
                                        id="go">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="x_content">

                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_audit_loader"></i>
                        <div class="table-responsive" id="list_audit_table">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Date & Time</th>
                                        <th class="column-title">Action</th>
                                        <th class="column-title">Performed By</th>
                                        <th class="column-title">Performed For</th>
                                        <th class="column-title" width="10%">Section</th>
                                        <th class="column-title">Description</th>

                                    </tr>
                                </thead>
                                <tbody id="list_audit_body">

                                </tbody>
                            </table>
                            <div class="container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination" id="pagination" style="margin-left: 7%;"></ul>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="js-files/audit_trail.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>