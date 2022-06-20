<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
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
                <h3>Pay Schedule</h3>
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

                        <!-- <button type="button" class="btn btn-success" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Create
                            Pay Schedule</button> -->
                        <a href="create_pay_schedule" id="create_pay_schedule" style="display:none;"><button
                                type="button" class="btn btn-success">Create
                                Pay Schedule</button></a>


                    </div>
                </div>
            </div>
        </div>


        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="position_name">Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="position_name" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">Payment
                                        Type<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <Select id="eligibility" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                            <option>-- Select --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">Payroll
                                        Type<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <Select id="eligibility" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                            <option>-- Select --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="recurring">Recurring
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input style="width: 30px; height: 20px;" type="checkbox" id="recurring">
                                    </div>
                                </div>

                                <div class="form-group" id="date_div" style="display:none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eligibility">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="display:flex">
                                        <div class="my-center mr2">Start Date</div>
                                        <input id="" type="date" required="required" class="form-control mr2"
                                            style="width:35%">
                                        <div class="my-center mr2">Every</div>
                                        <select id="no_of_days" required="required" class="form-control mr2"
                                            style="width:15%">
                                            <option value=""></option>

                                        </select>
                                        <div class="my-center">Days</div>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <Select id="allEmp" class="form-control col-md-7 col-xs-12 allEmp">

                                        </select>
                                        <button type="button" class="btn btn-sm btn-default" id="" data-toggle="modal"
                                            data-target="#selectEmployees">Select
                                            Employee(s)</button>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_position">
                                        <!--  <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" > -->

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                        <button type="button" class="btn btn-success" id="add_pos">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="position_loader"></i>
                                    </div>
                                </div>
                        </div>




                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_sche_loader"></i>
    <div class="row" id="list_sche_body">
        <div class="x_panel" style='width:20rem;'>
            <div class="x_content">
                <p>No Pay Schedule Currently</p>
            </div>
        </div>

        <!-- <div class="col-md-3 col-sm-6 col-xs-12 ">
            <div class="x_panel">

                <div class="x_content">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's
                                content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's
                                content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6  col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's
                                content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3  col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's
                                content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>


</div>
</div>
<!-- /page content -->



<!-- Modal -->
<div class="modal fade" id="selectEmployees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Select Employees
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_content">
                                    <br />


                                    <div class="form-row">

                                        <div class="col-sm-2 col-xs-4">
                                            <input type="text" class="form-control filters" placeholder="Firstname"
                                                id="firstname">
                                        </div>


                                        <div class="col-sm-2 col-xs-4">
                                            <input type="text" class="form-control filters" placeholder="Lastname"
                                                id="lastname">
                                        </div>

                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-2 filters" id="gender">
                                                <option value="">-- Gender --</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-2 filters" id="position">
                                                <option value="">-- Position --</option>

                                            </select>
                                        </div>

                                        <!-- <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="Code" id="employee_code">
                      </div> -->


                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-2 filters"
                                                id="employee_department">
                                                <option value="">--Department --</option>

                                            </select>
                                        </div>

                                        <div class="col-sm-2 col-xs-4">
                                            <select class="form-control col-sm-2 col-xs-4 filters" id="status">
                                                <option value="">-- Status --</option>
                                                <option value="active">Active</option>
                                                <option value="suspended">Suspended</option>
                                                <option value="terminated">Terminated</option>

                                            </select>
                                        </div>
                                    </div>
                                    <br><br><br>



                                    <div class="form-row">

                                        <!-- <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="Phone">
                      </div>


                      <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="email">
                      </div> -->

                                    </div>
                                    <!-- <div class="col-sm-3">
                        <select class="form-control col-md-7 col-xs-12 required" id="employee_department" name="sel_employee">
                            <option value="">-- Select department --</option>
                            
                        </select>
                      </div> -->

                                    <div class="form-row">






                                        <div class="col-sm-2 col-xs-4">
                                            <button type="button" class="btn btn-success" id="filter">Search</button>
                                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                id="filter_loader"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <br>

                        <div class="x_content">



                            <div class="table-responsive">

                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                                            <!-- <th class="column-title">S/N </th> -->
                                            <th>
                                                <input type="checkbox" id="check-all" class="flat"
                                                    onclick="checkAll(this)">
                                            </th>
                                            <!-- <th class="column-title">#</th> -->
                                            <th class="column-title"></th>
                                            <!-- <th class="column-title" style="width: 10%">Code</th> -->
                                            <th class="column-title">Names</th>
                                            <th class="column-title">Department</th>
                                            <th class="column-title">Employment Type</th>
                                            <th class="column-title">Job Title</th>



                                            <th class="bulk-actions" colspan="6">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading">
                                        <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i></td>
                                    </tr>

                                    <tbody id="employeeData">



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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveEmp">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js-files/pay_scedule.js"></script>

<?php
include_once("../gen/_common/footer.php");
?>