<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                <h3>Grievances </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float:right;">
                        <button type="button" class="btn btn-primary" data-toggle="collapse"
                            data-target="#collapseExample22" aria-expanded="false"
                            aria-controls="collapseExample">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseExample22" style="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />


                            <div class="form-row">

                                <div class="col-sm-4 col-xs-4">
                                    <input type="text" placeholder="Grievance ID"
                                        class="form-control col-md-7 col-xs-12 required" id="gId_filter">

                                </div>

                                <div class="col-sm-4 col-xs-4">
                                    <select class="form-control col-sm-7 col-xs-12" id="gBy_filter">
                                        <option value="">-- Grievance By --</option>

                                    </select>
                                </div>

                                <div class="col-sm-4 col-xs-4">
                                    <!-- <input type="" date="year" class="form-control" id=""> -->
                                    <select class="form-control" id="status_filter">
                                        <option vaue=''>--Status--</option>
                                        <option value="Pending">Pending</option>
                                        <!-- <option value="draft">Draft</option> -->
                                        <option value="in-progress">In Progress</option>
                                        <option value="on-hold">On Hold</option>
                                        <option value="resolved">Resolved</option>

                                    </select>
                                </div>



                            </div>

                            <div class="form-row">
                                <div class="col-sm-2 col-xs-4" style="margin-top:10px;">
                                    <button type="button" class="btn btn-success" id="filter_g">Search</button>
                                    <!-- <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="filter_g_loader"></i> -->
                                </div>
                            </div>



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



                        <div class="table-responsive">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="g_table_loader"></i>
                            <table class="table table-striped jambo_table bulk_action" id="g_table">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">ID </th>
                                        <th class="column-title">By </th>
                                        <th class="column-title">&nbsp; </th>
                                        <!-- <th class="column-title">Branch </th> -->
                                        <th class="column-title">Against</th>
                                        <th class="column-title">&nbsp; </th>
                                        <th class="column-title">Grievance Type </th>
                                        <th class="column-title">Status </th>
                                        <th class="column-title no-link last"><span class="nobr"></span>
                                        </th>
                                        <th class="bulk-actions" colspan="8">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>


                                <tbody id="grievanceData">
                                    <tr>
                                        <td colspan="8" id="load"><i class="fa fa-spinner fa-spin fa-fw fa-3x"></i></td>
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

<div class="modal fade" id="addParty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Add Party
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">

                            <div class="x_content">
                                <br />
                                <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee
                                            Name<span>*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control js-example-basic-single" id="empo_name"
                                                multiple="multiple"
                                                style="width:100% !important;max-width:800px !important; border-radius:30px !important; "></select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="party_error">

                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                            <button type="button" class="btn btn-success" id="add_party">Add</button>
                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                id="add_party_loader"></i>
                                        </div>
                                    </div>


                                </span>

                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="list_party_loader"></i>
                                <div class="table-responsive" id="list_party_table">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">

                                                <th class="column-title" width="10%">#</th>
                                                <th class="column-title">Party</th>

                                                <th class="column-title" width="10%"></th>

                                            </tr>
                                        </thead>
                                        <tbody id="list_party_body">

                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js-files/grievances.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>