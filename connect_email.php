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
                    <h2>Connected Email</h2>
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
                      <!-- <h3>Samuel Doe</h3> -->
                      <br>


                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                     

                    </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                          <br><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Connected Account <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" class="form-control col-md-7 col-xs-12 required" placeholder="Employee.ng Email">
                        </div>
                      </div>






                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="update_error">
                          
                        </div>
                      </div>

                      

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="update_emp">Connect to Account</button>
                          <button type="submit" class="btn btn-danger" id="discnoct" style="display: none">Disconnect Account</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="update_loader"></i>
                          <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                        </div>
                      </div>

                    </span>
                      
                        
                      
   
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

      <div id="employee_data_display" style="display: none;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
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
                <h4>Employee Connected Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>




        <div class="modal fade" id="remove_user_modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Disconnected Successfully!</h4>
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
            
            fetch_employee_details_for_edit_employee();
           
            $('#update_emp').on('click', edit_employee);

            $('#discnoct').on('click', disconnect_user);

            $('input#dob').datepicker({
                dateFormat: "yy-mm-dd"
              });
          })

          
          function fetch_employee_details_for_edit_employee(){
    
            var company_id = localStorage.getItem('company_id');
            var employee_id = $.urlParam('id'); //pathArray[3].replace(/%20/g,' ');

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/fetch_company_employee_profile",
                data: {"company_id": company_id, "employee_id": employee_id},
                timeout: 60000,

                success: function(response) {

                  console.log(response);

                   $('#page_loader').hide();
                   $('#employee_details_display').show();

                    var str = "";
                    var str2 = "";
                    var str3 = "";

                    if (response.status == '200'){
                     
                        // alert(response.data.firstname);
                        // $('#profile_name').html('<b>'+response.data.firstname+' '+response.data.lastname+' </b> | <font color="red">Edit</span>');
                        // $('#firstname').val(response.data.firstname);
                        // $('#lastname').val(response.data.lastname);
                        // $('#middlename').val(response.data.middlename);
                        // $('#gender').val(response.data.gender);
                        // $('#dob').val(response.data.dob);
                        // $('#marital_status').val(response.data.marital_status);
                        // $('#phone').val(response.data.phone);
                        $('#email').val(response.data.employee_email);
                        // $('#next_of_kin').val(response.data.next_of_kin);
                        // $('#residential_address').val(response.data.residential_address);
                        // $('#religion').val(response.data.religion);

                        if(response.data.employee_email != ""){
                          $("#discnoct").show();
                        }
                      

                        str2 +=  '<a href="'+base_url+'employees"><button id="send"  class="btn btn-default">Back</button></a>';
                        str2 += '<a href="'+base_url+'employee_info?id='+response.data.employee_id+'"><button id="send"  class="btn btn-primary">View Profile</button></a>';
                        
                         str3 += '<div id="crop-avatar">';
                  
                        str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.profile_picture+'" alt="...">';
                        str3 += '</div>';

                        str += '<li>';
                        str +=  '<i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="'+base_url+'edit_employee?id='+response.data.employee_id+'">Basic Profile</a>';

                        str += '</li>';
                        

                        str += '<li>';
                        str += '<i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="'+base_url+'edit_employment_info?id='+response.data.employee_id+'">Employment Profile</a>';
                        str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                         str += '<a href="'+base_url+'edit_profile_pic?id='+response.data.employee_id+'">Edit Profile Picture</a>';
                        str += '</li>'
                        


                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="'+base_url+'edit_job_titles?id='+response.data.employee_id+'">Edit Position History</a>';
                        str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="'+base_url+'edit_salary_info?id='+response.data.employee_id+'">Edit Salary/Welfare Info</a>';
                        str += '</li>';
                        

                        // str += '<li>';
                        // str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                        // str +=  '<a href="hrm/edit_supervisor/'+response.data.employee_id+'">Edit Supervisor</a>';
                        
                        // str += '</li>';
                        

                        str += '<li>';
                        str +=  '<i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="'+base_url+'edit_employee_docs?id='+response.data.employee_id+'">Documents</a>';
                        str += '</li>';


                        str += '<li>';
                        str +=  '<i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                        str +=  '<a href="'+base_url+'connect_email?id='+response.data.employee_id+'">Connect Email</a>';
                        str += '</li>';

                      
                      $("#button_link").html(str2);
                       $("#picture").html(str3);
                      $("#profile_links").html(str);
                      $("#profile_links").show();            

                    }else if(response.status == '400'){
                      $('#employee_details_display').show();
                        $('#employee_details_display').hide();
                        $('#employee_data_display').show();
                    }    
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                  $('#employee_details_display').show();
                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();
                    
                }        

            });
        }


        function disconnect_user(){

          var company_id = localStorage.getItem('company_id');
            
          var employee_id = $.urlParam('id'); //pathArray[3].replace(/%20/g,' ');
          
          var email = $('#email').val();

          var user_id = localStorage.getItem('user_id');

          $('#update_emp').hide();
          $('#update_loader').show();
          $('#discnoct').hide();

          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/disconnect_ess_users",
            data: { "email" : email , "company_id" : company_id, "employee_id" : employee_id , "user_id" : user_id },

                success: function(response) {
                    
                    $('#employee_details_display').show();
                    if (response.status == '200'){
                      $('#remove_user_modal_update').modal('show');

                      $('#remove_user_modal_update').on('hidden.bs.modal', function () {

                      })
                              

                    }else if(response.status == '400'){ // coder error message
                
                      $('#update_error').html(response.msg);

                    }else if(response.status == '401'){ //user error message
                      
                      $('#update_error').html(response.msg);

                    }

                    $('#update_emp').show();
                    $('#update_loader').hide();   
                    
                },
                // objAJAXRequest, strError
                error: function(response){

                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();

                }        

            });


        }


          function edit_employee(){
    
            var company_id = localStorage.getItem('company_id');
            
            var employee_id = $.urlParam('id'); //pathArray[3].replace(/%20/g,' ');
            
            var email = $('#email').val();

            var user_id = localStorage.getItem('user_id');

            var blank;

            

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
    
              // $('#update_error').html("You have a blank field");

              return; 

            }

            if(!validateEmail(email)){
                  
                  $('#update_error').html('invalid Email');
                      
                  return;
            }
           
          
          $('#update_emp').hide();
          $('#update_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/assign_ess_users",
            data: { "email" : email , "company_id" : company_id, "employee_id" : employee_id , "user_id" : user_id },

                success: function(response) {
                    
                    $('#employee_details_display').show();
                    if (response.status == '200'){
                      $('#modal_update').modal('show');

                      $('#modal_update').on('hidden.bs.modal', function () {

                      })
                              

                    }else if(response.status == '400'){ // coder error message
                
                      $('#update_error').html(response.msg);

                    }else if(response.status == '401'){ //user error message
                      
                      $('#update_error').html(response.msg);

                    }

                    $('#update_emp').show();
                    $('#update_loader').hide();   
                    
                },
                // objAJAXRequest, strError
                error: function(response){

                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();

                }        

            });
        }

        
        function validateEmail(emailaddress){  

             var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  

             if(!emailReg.test(emailaddress)) {  

                  return false

             }else{

                  return true;
              }
          }

          function isValidDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;

            if(!regEx.test(dateString)) {  

                  return false

             }else{

                  return true;
              }
          }

        </script>

<?php
include("_common/footer.php");
?>