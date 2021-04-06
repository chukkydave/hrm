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
                <h3 id="profile_name"><b>Attendance</b> | <font color="red">Edit</font> </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right" id="button_link">
                    
                    <a href="attendance"><button class="btn btn-primary">Back</button></a>'
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Employee Attendance Info</h2>
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
                      <ul class="list-unstyled user_data"  style="display: none;">
                        
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                    

                    </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_id">Employee <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="employee_id" required="required" class="form-control col-md-7 col-xs-12 required" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="date" required="required" class="form-control col-md-7 col-xs-12 required" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_in">Clock In Time <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="clock_in" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_out">Clock Out Time
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="clock_out" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">
                          
                        </div>
                      </div>
                          
                      
                      <!-- <div class="ln_solid"></div> -->
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="update_att">Update</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="att_loader"></i>
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

        <div class="modal fade" id="modal_attendance_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employee Attendance Info Edited Successfully!</h4>
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
            fetch_employee_attendance();
            // load_employee();
             $('#clock_in').datetimepicker({
              format: 'HH:mm:ss'
            });

            $('#clock_out').datetimepicker({
                
                format: 'HH:mm:ss'
            });
          

            $('#update_att').on('click', edit_employee_attendance);  
            
          })

          function load_employee(){

            var company_id = localStorage.getItem('company_id');
            var page = -1;
            var limit = 0;

             $.ajax({
                url: api_path+"hrm/list_of_company_employees",
                type: "POST",
                data: {"company_id" : company_id, "page" : page, "limit" : limit},
                dataType: "json",
                
                
                success: function (response) {
                    // console.log(response);
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['employee_id'] +'">' + response['data'][i]['firstname'] + " " + response['data'][i]['lastname'] + '</option>';
                    });
                    $('#employee_id').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    // alert('Connection error');
                }
            });

          }


          

          function edit_employee_attendance(){
    
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            // var pathArray = window.location.pathname.split( '/' );
            var attendance_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var employee_id = $('#employee_id').val();
            // var employment_position = $('#employment_position').val();
            var date = $('#date').val();
            var clock_out = $('#clock_out').val();
            var  clock_in= $('#clock_in').val();
            var additional_info = $('#additional_info').val();

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
    
              $('#error').html("You have a blank field");

              return; 

            }

                      
          $('#error').html("");
          $('#update_att').hide();
          $('#att_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/edit_employee_attendance",
            data: { "date" : date, "clock_in" : clock_in, "clock_out" : clock_out, "user_id" : user_id,  "attendance_id" : attendance_id, "company_id" : company_id, "employee_id" : employee_id},

                success: function(response) {
                    
                    $('#employee_details_display').show();
                    console.log(response);
                    
                    if (response.status == '200'){
                       

                      $('#modal_attendance_info').modal('show');



                      $('#modal_attendance_info').on('hidden.bs.modal', function () {
                          // do something…
                          // window.location.reload();
                          // window.location.href = base_url+"/erp/hrm/employees";
                          employee_id;
                          date;
                          clock_out;
                          clock_in;
                          

                      })
                              

                    }else if(response.status == '400'){ // coder error message
                      $('#page_loader').hide();
                
                      $('#error').html('Technical Error. Please try again later.');

                    }else if(response.status == '401'){ //user error message

                      $('#page_loader').hide();
                      $('#error').html(response.msg);

                    }

                     $('#update_att').show();
                    $('#att_loader').hide();   
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                    $('#page_loader').hide();
                    $('#employee_details_display').hide();
                    $('#employee_error_display').show();
                    
                }        

            });
        }

        function fetch_employee_attendance(){
    
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var attendance_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            
            // alert(employee_id);
            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/fetch_employee_attendance",
                data: {"company_id": company_id, "attendance_id": attendance_id},
                timeout: 60000,

                success: function(response) {
                    $('#page_loader').hide();
                    $('#employee_details_display').show();
                    
                    console.log(response);
                    var str3 = "";
                    if (response.status == '200'){

                     
                      $('#employee_id').val(response.data.employee_name);
                      $('#date').val(response.data.insert_date);
                      $('#clock_out').val(response.data.clock_out);
                      $('#clock_in').val(response.data.clock_in);
                      // $('#profile_name').html('<b>Attendance</b> | <font color="red">Edit</font>');
                      // $('#additional_info').val(response.data.additional_info);
                      // str2 += '<a href="attendance"><button id="send"  class="btn btn-primary">Back</button></a>';

                      str3 += '<div id="crop-avatar">';
                  
                      str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.profile_picture+'" alt="...">';
                      str3 += '</div>';

                       $("#picture").html(str3);

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

  </script>
<?php
include("_common/footer.php");
?> 

