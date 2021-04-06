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
                    <h2>Personal Profile</h2>
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
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="assets/admin_template/production/images/picture.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      
                      <br>


                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <br />

                      

                    </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <!-- <div class="x_panel"> -->
                            <br>
                            <div class="x_content">

                              <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                      
                                      
                                      <th class="column-title">&nbsp;</th>
                                      <th class="column-title">Supervisor Name</th>
                                      <th class="column-title">Employee Name</th>
                                    
                                      <th class="bulk-actions" colspan="3">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tr id="loading">
                                    <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" ></i></td>
                                  </tr>
                                  
                                 <tbody  id="Data">
                                    
                                  
                                    
                                  </tbody>


                                </table>


                      <!-- <div class="container">
                          <nav aria-label="Page navigation">
                              <ul class="pagination" id="pagination"></ul>
                          </nav>
                      </div> -->


                          </div>

                            </div>
                          <!-- </div> -->
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


        <script type="text/javascript">
         
          $(document).ready(function(){
            
            fetch_employee_details();
            
             
            
          })

           

          

          
          
       function fetch_employee_details(){
    
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            
            // alert(employee_id);
            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/fetch_company_employee_profile",
                data: {"company_id": company_id, "employee_id": employee_id},
                timeout: 60000,

                success: function(response) {
                    // console.log(response);
                    $('#page_loader').hide();
                    $('#employee_details_display').show();
                   
                    var str = "";
                    var str2 = "";
                    
                    if (response.status == '200'){

                       str2 +=  '<a href="employees"><button id="send"  class="btn btn-default">Back</button></a>';
                       str2 += '<a href="edit_supervisor?id='+response.data.employee_id+'"><button id="send"  class="btn btn-primary">Edit</button></a>';

                       $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b> Profile');
                       
                      
                        
                        str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                        str += '<a href="employee_info?id='+response.data.employee_id+'">Profile</a></li>';
                        
                        str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="view_salary_info?id='+response.data.employee_id+'">Salary/Employment Info</a></li>';
                        
                        str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="view_salary_history?id='+response.data.employee_id+'">Payroll</a></li>';
                        
                        str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
                        str += '<a href="view_leave_history?id='+response.data.employee_id+'">Leave History</a></li>';
                        
                        str += '<li><i class="fa fa-external-link user-profile-icon"></i>&nbsp;&nbsp;';
                        str += '<a href="view_supervisor?id='+response.data.employee_id+'">Supervisor/Manager</a></li>';
                        

                        str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="view_position_history?id='+response.data.employee_id+'">Job Title History</a></li>';        

                        str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                        str += '<a href="emp_documents?id='+response.data.employee_id+'">Documents</a></li>';

                      $("#button_link").html(str2);
                      $("#profile_links").html(str);
                      $("#profile_links").show();            

                    }else if(response.status == '400'){
                        $('#page_loader').hide();
                        $('#employee_details_display').hide();
                        $('#employee_error_display').show();
                    }    
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                    $('#page_loader').hide();
                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();
                    
                }        

            });
        }

        </script>

<?php
include("_common/footer.php");
?> 