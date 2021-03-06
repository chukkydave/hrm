<?php
include("_common/header.php");
?>
<div id="page_loader" style="display: ;">
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"></div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <i class="fa fa-spinner fa-spin fa-fw fa-4x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- page content -->
<div id="employee_details_display" style="display: none;">

    <div class="right_col" role="main">

        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3 id="profile_name">Employee Info</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group" style="float: right;" id="button_link"></div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">


                        <div class="x_content">
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                                <br>
                                <div class="profile_img" id="picture"></div>
                                <br />
                                <br />
                            </div>

                            <br>
                            <div class="col-md-6 col-sm-6 col-xs-12 profile_left">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Firstname</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="firstname"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Lastname</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="lastname"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Middlename</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="middlename"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Gender</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="gender"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Date of Birth</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="dob"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Marital Status</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="marital_status"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Religion</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="religion"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Phone</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="phone"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Address</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="residential_address"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Email</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="email"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Status</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="status"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item active" role="presentation">

                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#basic_info_block"
                                role="tab" aria-controls="home" aria-selected="true">Basic Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link no" id="profile-tab" data-toggle="tab" href="#employment_info_block"
                                role="tab" aria-controls="profile" aria-selected="false">Employment Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link no" id="salary-tab" data-toggle="tab" href="#salary_info_block"
                                role="tab" aria-controls="salary" aria-selected="false">Salary Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link no" id="payslip-tab" data-toggle="tab" href="#payslip_block" role="tab"
                                aria-controls="payslip" aria-selected="false">Payslips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link no" id="leaves-tab" data-toggle="tab" href="#leaves_block" role="tab"
                                aria-controls="leaves" aria-selected="false">Leaves</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link no" id="job-title-history-tab" data-toggle="tab"
                                href="#job_title_history_block" role="tab" aria-controls="job_title_history"
                                aria-selected="false">Job Title History</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link no" id="attendance-tab" data-toggle="tab" href="#attendance_block"
                                role="tab" aria-controls="attendance" aria-selected="false">Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link no" id="document-tab" data-toggle="tab" href="#document_block" role="tab"
                                aria-controls="document" aria-selected="false">Documents</a>
                        </li>
                    </ul>

                </div>
            </div>



            <div class="tab-content" id="myTabContent">
                <div id="basic_info_block" class="tab-pane fade active in" role="tabpanel" aria-labelledby="home-tab">

                    <!-- <br> -->



                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>
                                        Qualifications & Certifications
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_QC" title="Add Q&C">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="QC_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="QC_institute_name">Institution<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="QC_institute_name" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_qc_fields">
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="QC_degree">Degree Acquired<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="QC_degree" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_qc_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="QC_year_concluded">Year Concluded<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="QC_year_concluded" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_qc_fields">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_QC_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                                    id="add_QC_loader"></i>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_QC_loader"></i>
                                        <div class="table-responsive" id="list_QC_table">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title" >Institution</th>
                                                        <th class="column-title" >Degree Acquired</th>
                                                        <th class="column-title" >Year Concluded</th>
                                                        <th class="column-title" width="10%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="list_QC_body">

                                                </tbody>
                                            </table>
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
                                        Work Experience
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_work-exp" title="Add Work Exp.">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="work-exp_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workExp_prevCom">Previous Company<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="workExp_prevCom" required="required" class="form-control col-md-7 col-xs-12 required add_workExp_fields">
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workExp_jobTitle">Job Title<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="workExp_jobTitle" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_workExp_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workExp_start">Start<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="workExp_start" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_workExp_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workExp_end">End<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="workExp_end" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_workExp_fields">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_workExp_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                                    id="add_workExp_loader"></i>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_workExp_loader"></i>
                                        <div class="table-responsive" id="list_workExp_table">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title" >Previous Company</th>
                                                        <th class="column-title" >Job Title</th>
                                                        <th class="column-title" >Start</th>
                                                        <th class="column-title" >End</th>
                                                        <th class="column-title" width="10%"></th>

                                                    </tr>
                                                </thead>
                                                <tbody id="list_workExp_body">
                                                    
                                                </tbody>
                                            </table>
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
                                        Next of Kin
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_NOK" title="Add N.O.K">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="NOK_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nok_name">Name<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="nok_name" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_nok_fields">
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nok_relationship">Relationship<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="nok_relationship" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_nok_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nok_phone">Phone Number<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="nok_phone" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_nok_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nok_address">Address<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="nok_address" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_nok_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nok_email">Email<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="email" id="nok_email" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_nok_fields">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_nok_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="add_nok_loader"></i>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_nok_loader"></i>
                                        <div class="table-responsive" id="list_nok_table">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title">Name</th>
                                                        <!-- <th class="column-title">Relationship</th> -->
                                                        <th class="column-title">Phone Number</th>
                                                        <th class="column-title">Address</th>
                                                        <th class="column-title">Email</th>
                                                        <th class="column-title" width="10%"></th>
                                                        <!-- <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                                        <th class="bulk-actions" colspan="7">
                                                            <a class="antoo" style="color: #fff; font-weight: 500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                        </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody id="list_nok_body">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="employment_info_block" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">

                    <!-- <br> -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>
                                        Employment Info
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="modal" id="edit_emp_info" data-target="#edit_employment_info_modal" title="Edit Employment Info">
                                            <a class=""><i class="fa fa-pencil"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <p><strong>Branch:</strong></p>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="branch"></p>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <p><strong>Employee Type:</strong></p>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="employment_type"></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <p><strong>Employment Date:</strong></p>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="date_of_employment"></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <p><strong>Supervisor:</strong></p>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <p id="supervisor"></p>
                                            </div>
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
                                        Job Title
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_jobTitle" title="Add Job Title">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="jobTitle_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jobTitle_name">Job Title<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select class="form-control col-md-7 col-xs-12 add_jobTitle_fields" id="jobTitle_name">
                                                                    <option value="">-- Select Job Title --</option>
                                                                    
                                                                </select>
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jobTitle_from">From<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="jobTitle_from" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_jobTitle_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jobTitle_to">To<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="jobTitle_to" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required ">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_jobTitle">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_jobTitle_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                                    id="add_jobTitle_loader"></i>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_jobTitle_loader"></i>
                                        <div class="table-responsive" id="list_jobTitle_table">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title" >Job Title</th>
                                                        <th class="column-title" >From</th>
                                                        <th class="column-title" >To</th>
                                                        <th class="column-title" width="10%"></th>

                                                    </tr>
                                                </thead>
                                                <tbody id="list_jobTitle_body">
                                                    
                                                </tbody>
                                            </table>
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
                                        Department History
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_dept" title="Add Department">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="dept_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dept_name">Department Name<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select class="form-control col-md-7 col-xs-12 add_dept_fields" id="dept_name">
                                                                    <option value="">-- Select Department --</option>
                                                                    
                                                                </select>
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dept_from">From<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="dept_from" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_dept_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dept_to">To<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="dept_to" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required ">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_dept">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_dept_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                                    id="add_dept_loader"></i>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_dept_loader"></i>
                                        <div class="table-responsive" id="list_dept_table">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title" >Department Name</th>
                                                        <th class="column-title" >From</th>
                                                        <th class="column-title" >To</th>
                                                        <th class="column-title" width="10%"></th>

                                                    </tr>
                                                </thead>
                                                <tbody id="list_dept_body">
                                                    
                                                </tbody>
                                            </table>
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
                                        Work Shift
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_workShift" title="Add Department">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="workShift_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workShift_name">Work Shift<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select class="form-control col-md-7 col-xs-12 add_workShift_fields" id="workShift_name">
                                                                    <option value="">-- Select WorkShift --</option>
                                                                    
                                                                </select>
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workShift_from">From<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="workShift_from" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_workShift_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="workShift_to">To<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="workShift_to" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required ">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_workShift">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_workShift_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                                    id="add_workShift_loader"></i>
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
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_workShift_loader"></i>
                                        <div class="table-responsive" id="list_workShift_table">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title" >Work Shift</th>
                                                        <th class="column-title" >From</th>
                                                        <th class="column-title" >To</th>
                                                        <th class="column-title" width="10%"></th>

                                                    </tr>
                                                </thead>
                                                <tbody id="list_workShift_body">
                                                    
                                                </tbody>
                                            </table>
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
                                        Additional Information
                                        <!-- <small>Activity report</small> -->
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="modal" id="edit_additional_info" data-target="#edit_additional_info_modal" title="Edit Additional Info">
                                            <a class=""><i class="fa fa-pencil"></i></a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <span id="demo-form2" class="form-horizontal form-label-left">

                                            <!-- <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <p><strong>Additional Info:</strong></p>
                                                </div> -->

                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <p id="list_addInfo"></p>
                                                </div>
                                            <!-- </div> -->

                                            <!--<div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="employment_type">Employment Type <span>*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md-7 col-xs-12 required"
                                                        id="employment_type">
                                                        <option>-- Select --</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="position">Job Title
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="position_val" required="required" disabled
                                                        style="margin-bottom:5px;"
                                                        class="form-control col-md-7 col-xs-12 required">
                                                    <h6 id="position_link"></h6>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="employment_department">Department <span>*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md-7 col-xs-12 required"
                                                        id="employment_department">
                                                        <option>-- Select --</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                    for="employment_branch">Employment Branch <span>*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md-7 col-xs-12 required"
                                                        id="employment_branch">
                                                        <option>-- Select --</option>

                                                    </select>
                                                </div>
                                            </div> -->



                                            


                                            

                                            <!-- <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="submit" class="btn btn-success" id="update_emp">Update
                                                        Employee Info</button>
                                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                        id="update_loader"></i>
                                                    <!-- <div id="add_user_loading" style="display:  none">Loading...</div> --
                                                </div>
                                            </div> -->

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="salary_info_block" class="tab-pane fade" role="tabpanel" aria-labelledby="salary-tab">

                    <!-- <br> -->

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Net Payment</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div id="no_record3" style="display: none;">
                                        <p><strong>No record available</strong></p>
                                    </div>
                                    <div id="net_pay" style="height:50px;">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 id="ttd_title_1">Gross Payment</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <!-- <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="ddsh_loading_1" ></i> -->
                                    <div id="no_record" style="display: none;">
                                        <p><strong>No record available</strong></p>
                                    </div>
                                    <div id="yearly_sales_report" style="height:350px;">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 id="ttd_title">Total Deductions</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
                                        id="ddsh_loading"></i>
                                    <div id="no_record2" style="display: none;">
                                        <p><strong>No record available</strong></p>
                                    </div>
                                    <div id="echart_pie2" style="height:350px;">


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="payslip_block" class="tab-pane fade" role="tabpanel" aria-labelledby="payslip-tab">

                    <!-- <br> -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Salary Payment History</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
                                        id="graph_loader"></i>
                                    <div id="no_recordpay" style="display: none;">
                                        <h3><strong>No record available</strong></h3>
                                    </div>
                                    <div id="mainb" style="height:350px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">


                                            <th class="column-title">Code</th>
                                            <th class="column-title">Payment Date</th>
                                            <th class="column-title">Payment Types</th>
                                            <th class="column-title">Credit or Debit</th>


                                            <th class="column-title no-link last"><span class="nobr">Amount</span>
                                            </th>
                                            <th class="bulk-actions" colspan="5">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk
                                                    Actions ( <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading">
                                        <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i>
                                        </td>
                                    </tr>

                                    <tbody id="salaryHistoryData">



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

                <div id="leaves_block" class="tab-pane fade" role="tabpanel" aria-labelledby="leaves-tab">

                    <!-- <br> -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Leave Summary</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"
                                        id="graph_loading"></i>
                                    <div id="no_record" style="display: none;">
                                        <h3><strong>No record available</strong></h3>
                                    </div>
                                    <div id="leave-history" style="height:300px;"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">


                                            <th class="column-title">Leave Title</th>
                                            <th class="column-title">From</th>
                                            <th class="column-title">To</th>
                                            <th class="column-title">Days Used</th>



                                            <th class="bulk-actions" colspan="4">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk
                                                    Actions ( <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading">
                                        <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: none;"></i></td>
                                    </tr>

                                    <tbody id="summaryData">



                                    </tbody>


                                </table>





                            </div>
                        </div>
                    </div>

                </div>

                <!-- <div id="job_title_history_block" class="tab-pane fade" role="tabpanel"
                    aria-labelledby="job-title-history-tab">

                    

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">


                                            <th class="column-title">Job Title</th>
                                            <th class="column-title">From</th>
                                            <th class="column-title">To</th>

                                            <th class="bulk-actions" colspan="3">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading_job">
                                        <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i>
                                        </td>
                                    </tr>

                                    <tbody id="positionHistoryData">



                                    </tbody>


                                </table>





                            </div>
                        </div>
                    </div>

                </div> -->

                <div id="attendance_block" class="tab-pane fade" role="tabpanel" aria-labelledby="attendance-tab">

                    <!-- <br> -->

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">


                                            <th class="column-title">Date</th>

                                            <th class="column-title">Clock In Time</th>
                                            <th class="column-title">Clock Out Time</th>
                                            <th class="column-title">Work Hours</th>
                                            <th class="column-title">Over Time/Late By</th>


                                            <th class="bulk-actions" colspan="5">
                                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                    <span class="action-cnt"> </span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tr id="loading_atten">
                                        <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: none;"></i></td>
                                    </tr>

                                    <tbody id="attData">



                                    </tbody>


                                </table>




                            </div>
                        </div>
                    </div>

                </div>

                <div id="document_block" class="tab-pane fade" role="tabpanel" aria-labelledby="document-tab">

                    <!-- <br> -->

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <!-- <h2>
                                        Job Title
                                        <!-- <small>Activity report</small> --
                                    </h2> -->
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>

                                        <li data-toggle="tooltip" id="add_docx" title="Add Document">
                                            <a class=""><i class="fa fa-plus"></i></a>
                                        </li>

                                    </ul>
                                    <div id="docx_display" style="display: none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">

                                                <div class="x_content">
                                                    <br />
                                                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="docx_name">Doc Name<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="docx_name" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_docx_fields">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="docx_type">Document type<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select class="form-control col-md-7 col-xs-12 add_docx_fields" id="docx_type">
                                                                    <option value="">-- Select Doc. Type --</option>
                                                                    
                                                                </select>
                                                                    
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="docx_file">File<span>*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="file" id="docx_file" required="required"
                                                                    class="form-control col-md-7 col-xs-12 required add_docx_fields">
                                                            </div>
                                                        </div>

                                                        
                                                        <!-- <button type="button" class="btn btn-success" id="add_docx">Add</button> -->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                
                                                                <button type="button" class="btn btn-success" id="add_docx_btn">Add</button>
                                                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                                                    id="add_docx_loader"></i>
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
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_docx_loader"></i>
                                    <div class="table-responsive" id="list_docx_table">
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr class="headings">


                                                    <!-- <th class="column-title">Doc#</th> -->
                                                    <th class="column-title">Name</th>
                                                    <th class="column-title">Type</th>
                                                    <th class="column-title">Date Uploaded</th>
                                                    <th class="column-title" width="10%"></th>
                                                    <!-- <th class="column-title no-link last"><span class="nobr">Action</span>
                                            </th> -->

                                                    
                                                </tr>
                                            </thead>

                                            

                                            <tbody id="documentData">



                                            </tbody>


                                        </table>

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

<div id="employee_error_display" style="display: none;">
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"></div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-danger alert-dimissible fade-in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true"></span>
                        </button>
                        <strong>Connection error</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="employee_data_display" style="display: none;">
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title"></div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-info alert-dimissible fade-in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true"></span>
                        </button>
                        <strong>No Employee Info Found</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_basic_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Basic Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_firstname">Firstname <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_firstname" required="required" class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_lastname">Lastname <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_lastname" required="required" class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_middlename">Middlename 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_middlename" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_gender">Gender <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- <input type="text" id="edit_basic_gender" required="required" class="form-control col-md-7 col-xs-12 required"> -->

                                <select class="form-control col-md-7 col-xs-12 required" id="edit_basic_gender">
                                    <option value="">-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_DOB">Date Of Birth <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_DOB" required="required" class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_marital_status">Marital Status <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- <input type="text"  required="required" class="form-control col-md-7 col-xs-12 required"> -->
                                <select class="form-control col-md-7 col-xs-12 required" id="edit_basic_marital_status">
                                    <option value="">-- Select --</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_religion">Religion <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- <input type="text"  required="required" class="form-control col-md-7 col-xs-12 required"> -->
                                <select class="form-control col-md-7 col-xs-12 required" id="edit_basic_religion">
                                    <option value="">-- Select --</option>
                                    <option value="Christian">Christian</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Others">Others</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_phone">Phone <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_phone" required="required" class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_address">Address <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_address" required="required" class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_email">Email <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_basic_email" required="required" class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_basic_religion">Status <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- <input type="text"  required="required" class="form-control col-md-7 col-xs-12 required"> -->
                                <select class="form-control col-md-7 col-xs-12 required" id="edit_basic_status">
                                    <option value="">-- Select --</option>
                                    <option value="Suspended">Suspended</option>
                                    <option value="Active">Active</option>
                                    <option value="Leave">Leave</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="x_content">
                                <p>Drag a picture to the box below.</p>

                                <form action="../api/hrm/upload_images?to_where=employee_picture" class="dropzone"
                                    id="employeepictureform"></form>
                                <br />
                                <br />
                                <br />
                                <br />
                                </div>



                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_basic_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_basic_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_basic_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employment_info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Employment Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_emp_branch">Branch <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12 required edit_emp_fields"
                                        id="edit_emp_branch">
                                        <option>-- Select --</option>

                                    </select>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_emp_type">Employment Type <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12 required edit_emp_fields"
                                        id="edit_emp_type">
                                        <option>-- Select --</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_emp_date">Employment Date <span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_emp_date" required="required"
                                        class="form-control col-md-7 col-xs-12 required edit_emp_fields">
                                </div>
                            </div>

                           

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_emp_supervisor">Supervisor
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_emp_supervisor" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="emp_list">
                                        
                                    </ul>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_emp_error">

                                </div>
                            </div>

                            <!-- <div class="ln_solid"></div> -->

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_emp_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_emp_loader"></i>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_additional_info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Additional Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="additional_info">Additional Info:
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea cols="3" class="form-control col-md-7 col-xs-12"
                                        id="additional_info">

                                </textarea>
                                </div>
                            </div>

                             

                           

                           

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_additional_error">

                                </div>
                            </div>

                            <!-- <div class="ln_solid"></div> -->

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_additional_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_additional_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_QC_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Qualifcations and Certifications
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_QC_institute_name">Institution
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_QC_institute_name" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_QC_degree">Degree Acquired
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_QC_degree" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            

                           

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_QC_year_concluded">Year Concluded
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_QC_year_concluded" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_QC_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_QC_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_QC_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_workExp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Work Experience
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workExp_prevCom">Previous Company
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_workExp_prevCom" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workExp_jobTitle">Job Title
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_workExp_jobTitle" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workExp_start">Start
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_workExp_start" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workExp_end">End
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_workExp_end" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_workExp_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_workExp_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_workExp_loader"></i>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_dept_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Department History
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_dept_prevCom">Department Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" id="edit_dept_name">
                                        <option value="">-- Select Department --</option>
                                        
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_dept_start">From
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_dept_from" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_dept_end">To
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_dept_to" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_dept_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_dept_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_dept_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_docx_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Document
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Document Name:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="edit_docx_name"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Document Type:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="edit_docx_type"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Date Uploaded:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="edit_docx_date"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>File:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a target="_blank" id="edit_docx_file">View Document</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_docx_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-success" id="edit_docx_btn">Save</button> -->
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_docx_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_workShift_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Department History
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workShift_prevCom">Work Shift
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" id="edit_workShift_name">
                                        <option value="">-- Select Work-Shift --</option>
                                        
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workShift_start">From
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_workShift_from" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_workShift_end">To
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_workShift_to" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_workShift_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_workShift_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_workShift_loader"></i>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_jobTitle_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Department History
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_jobTitle_prevCom">Work Shift
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" disabled id="edit_jobTitle_name">
                                        <option value="">-- Select Work-Shift --</option>
                                        
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_jobTitle_start">From
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_jobTitle_from" disabled required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_jobTitle_end">To
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_jobTitle_to" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_jobTitle_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_jobTitle_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_jobTitle_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_nok_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Qualifcations and Certifications
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <span id="" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_nok_name">Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_nok_name" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_nok_relationship">Relationship
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_nok_relationship" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_nok_phone">Phone
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_nok_phone" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_nok_address">Address
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="edit_nok_address" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                    for="edit_nok_email">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="edit_nok_email" required="required"                                      style="margin-bottom:5px;"
                                        class="form-control col-md-7 col-xs-12 required">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_nok_error">

                                </div>
                            </div>

                            

                        </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edit_nok_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i>
            </div>
        </div>
    </div>
</div>

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
            <div class="modal-body" >
                <h4 id="mod_body"></h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Confirm
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body" >
                <h4>Are you sure you want to delete this record?</h4>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" id="confirm_btn">Yes</button>
            <!-- </div> -->
        </div>
    </div>
</div>


<script type="text/javascript" src="js-files/employment_info_jsFiles/basic_info.js"></script>
<script type="text/javascript" src="js-files/employment_info_jsFiles/emp_info.js"></script>
<script type="text/javascript" src="js-files/employment_info_jsFiles/documents.js"></script>
<script type="text/javascript" src="js-files/employee_info_general.js"></script>

<?php
include("_common/footer.php");
?>