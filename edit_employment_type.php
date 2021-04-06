<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Employment Type</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="employement_type"><button type="button" class="btn btn-success" id="add_employee">Back</button></a>
                    
                    
                  </div>
                </div>
              </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employment_type">Type Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="employment_type" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employment_description">Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="employment_description">
                            
                          </textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_emp_type">
                         
                      
                          </div>
                        </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="add_emp_type">Update</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="emp_type_loader"></i>
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
        <!-- /page content -->

        <!-- modal -->
        <div class="modal fade" id="modal_employment_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employment Type Edited Successfully!</h4>
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
            fetch_employment_type_details();

            $('#add_emp_type').on('click', edit_employment_type);
          })

          function fetch_employment_type_details(){
            // var pathArray = window.location.pathname.split( '/' );
            var employment_type_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var company_id = localStorage.getItem('company_id');


          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/fetch_company_employment_type_byID",
            data: { "employment_type_id" : employment_type_id, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {

                $.each(response['data'], function (i, v) {

                    $('#employment_type').val(response['data'][i]['employment_type_name']);
                    $('#employment_description').val(response['data'][i]['employment_type_description']);
                                 
                });
    
                                   
              }


            },

            error: function(response){

              alert("Connection Error.");

            }

            });
          }

           function edit_employment_type(){
            var employment_type = $('#employment_type').val();
            var employment_description = $('#employment_description').val();
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employment_type_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
    
              $('#error_emp_type').html("You have a blank field");

              return; 

            }

                        
          
          $('#add_emp_type').hide();
          $('#emp_type_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/edit_company_employment_type",
            data: { "employment_type" : employment_type, "employment_description" : employment_description, "company_id" : company_id, "employment_type_id" : employment_type_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_employment_type').modal('show');

                $('#modal_employment_type').on('hidden.bs.modal', function () {
                    $('#employment_type').val();
                    $('#employment_description').val();
                    // window.location.reload();
                    window.location.href = base_url+"employement_type";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_emp_type').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_emp_type').html(response.msg);

              }

               

          $('#add_emp_type').show();
          $('#emp_type_loader').hide();


            },

            error: function(response){
                $('#add_emp_type').show();
                $('#emp_type_loader').hide();
                $('#error_emp_type').html("Connection Error.");

            }

          });

          }
        </script>

<?php
include("_common/footer.php");
?> 
