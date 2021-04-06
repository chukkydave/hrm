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
                    <h2>Employee Attendance</h2>
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


                    <div class="col-md-8 col-sm-8 col-xs-12">
                         
                         <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                          <!-- <div class="x_panel"> -->
                            <br>
                            <div class="x_content">

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
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tr id="loading">
                                    <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" ></i></td>
                                  </tr>
                                  
                                 <tbody  id="attData">
                                    
                                  
                                    
                                  </tbody>


                                </table>


                      <!-- <div class="container">
                          <nav aria-label="Page navigation">
                              <ul class="pagination" id="pagination"></ul>
                          </nav>
                      </div> -->


                          <!-- </div> -->

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
            
            fetch_employee_view_details_att();
            list_employee_attendance();        
           
            
          })

          function fetch_employee_view_details_att(){
              
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
                      var str3 = "";
                      
                      if (response.status == '200'){

                         str2 +=  '<a href="'+base_url+'employees"><button class="btn btn-default">Back</button></a>';
                         str2 += '<a href="'+base_url+'edit_employee_attendance?id='+response.data.employee_id+'"><button class="btn btn-primary">Edit</button></a>';

                         $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b>');
                         
                          str3 += '<div id="crop-avatar">';
                            
                          str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.profile_picture+'" alt="...">';
                          str3 += '</div>';
                          
                          str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'employee_info?id='+response.data.employee_id+'">Profile</a></li>';
                          
                          str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_employment_info?id='+response.data.employee_id+'">Employment Info</a></li>';


                          str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_salary_info?id='+response.data.employee_id+'">Salary Info</a></li>';
                          
                          str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_salary_history?id='+response.data.employee_id+'">Payslips</a></li>';
                          
                          str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'view_leave_history?id='+response.data.employee_id+'">Leave History</a></li>';
                          
                          

                          str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_position_history?id='+response.data.employee_id+'">Job Title History</a></li>';        

                          str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'emp_documents?id='+response.data.employee_id+'">Documents</a></li>';

                          
                          str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'view_attendance?id='+response.data.employee_id+'">Attendance</a></li>';

                          str += '<li>';
                          str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                           str += '<a href="'+base_url+'edit_profile_pic?id='+response.data.employee_id+'">Edit Profile Picture</a>';
                          str += '</li>';
                          
                          

                        $("#button_link").html(str2);
                        $("#picture").html(str3);
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
          
    

        function list_employee_attendance(){

            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

            var page = 1;
            var limit = 10;
            

            $("#loading").show();
            $("#attData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"hrm/list_of_employee_attendances",
              data: { "company_id": company_id, "employee_id" : employee_id, "page" : page, "limit" : limit},
              timeout: 60000,

              success: function(response) {
                  
                  console.log(response);
                  $('#loading').hide();
                  var strTable = "";
                  
                  if (response.status == '200'){

                      if(response.data.length > 0){

                          var k = 1;
                          $.each(response['data'], function (i, v) {

                              strTable += '<tr>';
                              
                              strTable += '<td width="25%">'+response['data'][i]['date']+'</td>';
                              strTable += '<td>'+response['data'][i]['clock_in']+'</td>';
                              strTable += '<td>'+response['data'][i]['clock_out']+'</td>';
                              strTable += '<td>'+response['data'][i]['work_hours']+'</td>';
                              
                              strTable += '<td></td>';
                              
                              strTable += '</tr>';



                             

                              k++;
                               
                          });

                      }else{

                          strTable = '<tr><td colspan="5">No record.</td></tr>';

                      }


                      
                                 
                      $("#attData").html(strTable);
                      $("#attData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="5">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#attData").html(strTable);
                      $("#attData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="5">Technical Error</td>';
                      strTable += '</tr>';

                      
                      $("#attData").html(strTable);
                      $("#attData").show();

                  }


                  $("#loading").hide();
              
              },

              error: function(response){
                

                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
                strTable += '</tr>';

                
                $("#attData").html(strTable);
                $("#attData").show();
                $("#loading").hide();

              }        

          });
          }

        </script>
<?php
include("_common/footer.php");
?>         

