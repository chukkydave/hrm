<?php
include("_common/header.php");
?> 
      <div id="page_loader" style="display: ;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-spinner fa-spin fa-fw fa-4x"  ></i>
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
                <h3 id="profile_name"></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right" id="button_link">
                    
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Employment Info</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                      
                      <div class="profile_img" id="picture">
                        
                      </div>
                      
                      <br>


                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <br />

                      

                    </div>


                    <div class="col-md-8 col-sm-8 col-xs-12" style="padding: 0px; background-color:;">


                        
                         

                         <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                            <!-- <div class="x_title">
                              <h2>Designations</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                            </div> -->
                            <br>
                            <div class="x_content">

                              <div id="container4" style="height:300px;">
                                
                                <div class="row">
                                  <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Job Title:</strong></p>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="job_title"></p>
                                  </div>
                                </div>

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
                                    <p><strong>Department:</strong></p>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="department"></p>
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

                                <div class="row">
                                  <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Work-shift:</strong></p>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="work_shifts"></p>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Additional Information:</strong></p>
                                  </div>

                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="additional_info"></p>
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
          </div>
        </div>
      </div>
        <!-- /page content -->

        <div id="employee_error_display" style="display: none;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
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

        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employee Edited Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>


        <script src="js-files/view_employment_info.js"></script>
<?php
include("_common/footer.php");
?>         

