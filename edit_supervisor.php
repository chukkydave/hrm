<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div id="employee_details_display">
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
                            
                            <div class="x_content">

                              <div  style="height:200px;">
                                <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                  <div class="form-group">
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">
                                      No current Supervisor
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      Search By Supervisor's Names/ or Supervisor's Employee Code to add
                                    </div>
                                  </div>   

                                  <div class="form-group">
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="date_of_employment" required="required" class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                  </div>

                                  

                                </span>
                                
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
                    $('#employee_details_display').show();
                   
                    var str = "";
                    var str2 = "";
                    
                    if (response.status == '200'){

                       str2 +=  '<a href="employees"><button id="send"  class="btn btn-default">Back</button></a>';
                       str2 += '<a href="employee_info/'+response.data.employee_id+'"><button id="send"  class="btn btn-primary">View Profile</button></a>';

                       $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b> Profile');
                       
                      
                        
                        str += '<li>';
                        str +=  '<i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="edit_employee?id='+employee_id+'">Basic Profile</a>';

                        str += '</li>';
                        

                        str += '<li>';
                        str += '<i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="edit_employment_info?id='+employee_id+'">Employment Profile</a>';
                        str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                         str += '<a href="edit_profile_pic?id='+employee_id+'">Edit Profile Picture</a>';
                        str += '</li>'
                        


                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="edit_job_titles?id='+employee_id+'">Edit Position History</a>';
                        str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="edit_salary_info?id='+employee_id+'">Edit Salary/Welfare Info</a>';
                        str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="edit_supervisor?id='+employee_id+'">Edit Supervisor</a>';
                        
                        str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="edit_employee_docs?id='+employee_id+'">Documents</a>';
                        str += '</li>';
                        
                      $("#button_link").html(str2);
                      $("#profile_links").html(str);
                      $("#profile_links").show();            

                    }else if(response.status == '400'){
                        
                        $('#employee_details_display').hide();
                        $('#employee_error_display').show();
                    }    
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                    
                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();
                    
                }        

            });
        }

        </script>

<?php
include("_common/footer.php");
?> 