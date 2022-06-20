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
                <h3>Departments </h3>
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
                        <!--span class="input-group-btn"-->
                        <button type="button" class="btn btn-success" id="add_department">Add Department</button>
                        <!-- <a href="hrm/access_levels"><button type="button" class="btn btn-primary">Back</button></a> -->
                        <!-- </span> -->

                    </div>
                </div>
            </div>
        </div>


        <div id="department_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="department_name">Department Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="department_name" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="department_description">Description
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" id="department_description"
                                            class="form-control col-md-7 col-xs-12">

                          </textarea>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Parent Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12">
                            
                          </select>
                        </div>
                      </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;"
                                            id="error_dept">

                                        </div>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_dept">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="dept_loading"></i>
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



                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <!-- <th class="column-title">Code</th> -->
                                        <th class="column-title">Department</th>
                                        <!-- <th class="column-title">HOD</th> -->
                                        <!-- <th class="column-title">Branch </th> -->

                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="4">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>


                                <tbody id="departmentData">
                                    <tr>
                                        <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
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

<!-- modal -->
<div class="modal fade" id="modal_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Department Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="editHod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Head Of Department
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div class="x_panel">
                    <div class="x_title">


                        <i data-toggle="tooltip" data-placement="top" title="Add HOD" id="add_hod" class="fa fa-plus"
                            style="float:right;"></i>

                        <div id="hod_display" style="display: none;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">

                                    <div class="x_content">
                                        <br />
                                        <span id="demo-form2" data-parsley-validate
                                            class="form-horizontal form-label-left">


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="hod_name">HOD
                                                    Name<span>*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="hod_name" required="required"
                                                        class="form-control col-md-7 col-xs-12 required_hod">
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                                        id="emp_list">

                                                    </ul>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="hod_from">From<span>*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="hod_from" required="required"
                                                        class="form-control col-md-7 col-xs-12 required_hod">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="hod_to">To<span>*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="hod_to" required="required"
                                                        class="form-control col-md-7 col-xs-12 required_hod">
                                                </div>
                                            </div>


                                            <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                    <button type="button" class="btn btn-success"
                                                        id="add_hode">Add</button>
                                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                        id="hode_loading"></i>
                                                </div>
                                            </div>


                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <div class="table-responsive">
                            <i style="display: none;" id="hod_list_loader"
                                class="fa fa-spinner fa-spin fa-fw fa-2x"></i>
                            <table class="table table-striped jambo_table bulk_action" id="hodTable">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">HOD</th>
                                        <th class="column-title">From</th>
                                        <th class="column-title">To</th>
                                        <th class="column-title" width="10%"> </th>
                                    </tr>
                                </thead>
                                <tbody id="hod_list">

                                </tbody>
                            </table>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="js-files/departments.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>