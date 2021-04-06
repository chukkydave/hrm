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
                    <h2>Employment Documents</h2>
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
                      <div class="profile_img" id="picture">
                        
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

                              <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doc_type">File Name <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select class="form-control col-md-7 col-xs-12 required" id="doc_type">
                                        <option value="">-- Select --</option>
                                        
                                      </select>
                                    </div>
                                  </div>

                                  
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_date">Choose File
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="file" id="from_date" required="required" class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                  </div>

                                  

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">
                                      
                                    </div>
                                  </div>
                                      
                                  
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      <!-- <button class="btn btn-primary" type="button">Cancel</button>
                                      <button class="btn btn-primary" type="reset">Reset</button> -->
                                      <button type="button" class="btn btn-success" id="">Upload</button>
                                      <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loader"></i>
                                    </div>
                                  </div>

                                </span>
                                <br><br>

                              <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                      
                                      
                                      <th class="column-title">Doc#</th>
                                      <th class="column-title">Name</th>
                                      <th class="column-title">Size</th>
                                      <th class="column-title">Date Uploaded</th>
                                      <th class="column-title no-link last"><span class="nobr">Action</span>
                                      </th>
                                    
                                      <th class="bulk-actions" colspan="5">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tr id="loading">
                                    <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" ></i></td>
                                  </tr>
                                  
                                 <tbody  id="documentData">
                                    
                                  
                                    
                                  </tbody>


                                </table>


                      <div class="container">
                          <nav aria-label="Page navigation">
                              <ul class="pagination" id="pagination"></ul>
                          </nav>
                      </div>


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
            load_doc_files();  
            fetch_employee_edit_details_emp_docs();
            list_employee_documents(''); 

            $(document).on('click', '.delete_document', function(){
                var document_id = $(this).attr('id').replace(/doc_/,''); 
                delete_document(document_id);
            }); 
            
          })


          function fetch_employee_edit_details_emp_docs(){
              
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
                    
                      $('#page_loader').hide();
                      $('#employee_details_display').show();
                      
                      var str = "";
                      var str2 = "";
                      var str3 = "";
                      if (response.status == '200'){
                        
                          // alert(response.data.firstname);
                        str2 +=  '<a href="'+base_url+'employees"><button id="send"  class="btn btn-default">Back</button></a>';
                        str2 += '<a href="'+base_url+'emp_documents?id='+response.data.employee_id+'"><button id="send"  class="btn btn-primary">View</button></a>';

                          $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b> | <font color="red">Edit</font>');
                          
                          str3 += '<div id="crop-avatar">';
                            
                          str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.profile_picture+'" alt="..." style="width: 230px">';
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
                          $('#employee_data_display').show();
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

           
          function delete_document(document_id){
            // alert('user deleted');
            // var email = $.session.get('email'); 
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            

            var ans = confirm("Are you sure you want to delete this document");
            if(!ans){
                return;
            }
            

            $('#row_'+document_id).hide();
            $('#loader_row_'+document_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_user_doc",
                data: {"company_id": company_id, "document_id" : document_id, "user_id" : user_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+document_id).hide();
                    $('#row_'+document_id).show();

                    // alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+document_id).hide();
                }
            });
        }

         function load_doc_files(){

            var company_id = localStorage.getItem('company_id');

           

             $.ajax({
                url: api_path+"hrm/list_of_company_doctypes",
                type: "POST",
                data: {"company_id" : company_id},
                dataType: "json",
                
                
                success: function (response) {
                    
                  // console.log(response);
                    $('#employee_details_display').show();
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['doctype_id'] +'">' + response['data'][i]['doctype_name'] +'</option>';
                    });
                    $('#doc_type').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    $('#page_loader').hide();
                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();
                }
            });

          } 
       
        function list_employee_documents(page){

            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            if(page == ""){
                var page = 1;
              }
              var limit = 5;


            $("#loading").show();
            $("#documentData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"hrm/list_of_user_docs",
              data: { "company_id": company_id, "user_id" : user_id, "page" : page, "limit" : limit},
              timeout: 60000,

              success: function(response) {
                  
                  console.log(response);
                  $('#loading').hide();
                  var strTable = "";
                  
                  if (response.status == '200'){

                      if(response.data.length > 0){

                          var k = 1;
                          $.each(response['data'], function (i, v) {

                              strTable += '<tr id="row_'+response['data'][i]['document_id']+'">';
                              
                              strTable += '<td>D'+response['data'][i]['document_id']+'</td>';
                              

                              strTable += '<td width="30%" valign="top">'+response['data'][i]['original_filename']+'</td>';

                              strTable += '<td>'+response['data'][i]['file_size']+'</td>';
                              strTable += '<td width="25%" >'+response['data'][i]['date_uploaded']+'</td>';
                              strTable += '<td valign="top"> <a class="delete_document" style="cursor: pointer;" id="doc_'+response['data'][i]['document_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Document"></i></a></td>';
                              
                              strTable += '</tr>';



                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['document_id']+'">';
                              strTable += '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              // strTable += '</tr>';


                              k++;

                               
                          });

                      }else{

                          strTable = '<tr><td colspan="5">No record.</td></tr>';

                      }

                       $('#pagination').twbsPagination({
                          totalPages: Math.ceil(response.total_rows/limit),
                          visiblePages: 10,
                          onPageClick: function (event, page) {
                            list_of_employee_documents(page);
                          }
                        });
                      
                                 
                      $("#documentData").html(strTable);
                      $("#documentData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="5">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#documentData").html(strTable);
                      $("#documentData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="5">Technical Error</td>';
                      strTable += '</tr>';

                      
                      $("#documentData").html(strTable);
                      $("#documentData").show();

                  }


                  $("#loading").hide();
              
              },

              error: function(response){
                

                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
                strTable += '</tr>';

                
                $("#documentData").html(strTable);
                $("#documentData").show();
                $("#loading").hide();

              }        

          });
          }

        </script>

<?php
include("_common/footer.php");
?> 