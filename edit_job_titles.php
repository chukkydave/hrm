<?php
include("_common/header.php");
?> 
<style>
  
</style>
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

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <button id="send" type="submit" class="btn btn-success">Send CV</button>
                    <button id="send" type="submit" class="btn btn-success" id="add_history">Add Position</button>
                  </div>
                </div>
              </div> -->

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <!--span class="input-group-btn"-->
                    <button type="button" class="btn btn-success" id="add_history">Add Job Title History</button>
                   
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Personal Profile <small>Activity report</small></h2>


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
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img" id="picture">
                        
                      </div>
                      <!-- <h3>Samuel Doe</h3> -->
                      <br>
                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                      

                  </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">

                        <div id="history_display" style="display: none;">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  
                                  <div class="x_content">
                                    <br />
                        
                                <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_id">Employee's Job Title <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select class="form-control col-md-7 col-xs-12 required" id="position_id">
                                        <!-- <option value="1">-- Choose Job Title From Branch --</option> -->
                                        <!-- <option>Full Time</option>
                                        <option>Contract Staff</option>
                                        <option>Intern</option>
                                        <option>Expatriate</option> -->
                                      </select>
                                    </div>
                                  </div>

                                  <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current_or_previous">Current or Previous <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select class="form-control col-md-7 col-xs-12 required" id="current_or_previous">
                                        <option value="2">-- Select --</option>
                                        <option value ="current">Current</option>
                                        <option value ="previous">Previous</option>
                                        <!-- <option>Intern</option>
                                        <option>Expatriate</option> --
                                      </select>
                                    </div>
                                  </div> -->

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_date">From <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="from_date" required="required" class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to_date">To <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="to_date" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">
                                      
                                    </div>
                                  </div>
                                      
                                  
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      <!-- <button class="btn btn-primary" type="button">Cancel</button>
                                      <button class="btn btn-primary" type="reset">Reset</button> -->
                                      <button type="button" class="btn btn-success" id="add_pos_history">Add</button>
                                      <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loader"></i>
                                    </div>
                                  </div>

                                </span>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="table-responsive" >
                          <table class="table table-striped jambo_table bulk_action">

                            <thead>
                              <tr class="headings">
                                <!-- <th>
                                  <input type="checkbox" id="check-all" class="flat">
                                </th> -->
                                <th class="column-title">Job Title</th>
                                <th class="column-title">From</th>
                                <th class="column-title">To</th>
                                
                                
                                <th class="column-title no-link last"><span class="nobr">Actions</span>
                                </th>
                                <th class="bulk-actions" colspan="4">
                                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                                
                              </tr>

                            </thead>

                            


                            <tbody  id="historyData" style="display: none">
                              <tr>
                                <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loading"></i>
                                </td>
                              </tr>


                              
                            </tbody>
                          </table>

                      <!-- <div class="ln_solid"></div> -->
                      
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



       
        <!-- modal -->
        <div class="modal fade" id="modal_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employee Position History Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>

        <div class="modal fade" id="editJobTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Job Title
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">
                <div class="mb-3" style="margin-bottom: 5px;">
                  <label for="edit_job_title" class="col-form-label">Employee's Job Title:</label>
                  <input type="text" class="form-control" id="edit_job_title">
                </div>
                <div class="mb-3" style="margin-bottom: 5px;">
                  <label for="edit_from" class="col-form-label">From:</label>
                  <input type="text" class="form-control" id="edit_from">
                </div>
                <div class="mb-3" style="margin-bottom: 5px;">
                  <label for="edit_to" class="col-form-label">To:</label>
                  <input type="text" class="form-control" id="edit_to">
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
              </div>
            </div>
          </div>
        </div>


        <script src="js-files/edit_job_titles.js"></script>
        <script type="text/javascript">
          


        </script>
        
<?php
include("_common/footer.php");
?>         
        
        

            
        

