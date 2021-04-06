<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Company Branch</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="branches"><button type="button" class="btn btn-success" id="add_employee">Back</button></a>
                    
                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name">Branch Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="branch_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_description">Branch Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="branch_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_comp_branch">
                         
                      
                          </div>
                        </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="edit_branch">Update</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_branch_loader"></i>
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
        <div class="modal fade" id="modal_edit_branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Company Branch Edited Successfully!</h4>
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
            fetch_branch_details();

            $('#edit_branch').on('click', edit_company_branch);
          })

          function edit_company_branch(){
            var branch_name = $('#branch_name').val();
            var branch_description = $('#branch_description').val();
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var branch_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
    
              $('#error_comp_branch').html("You have a blank field");

              return; 

            }

                        
          
          $('#edit_branch').hide();
          $('#edit_branch_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/edit_company_branch",
            data: { "branch_name" : branch_name, "branch_description" : branch_description, "company_id" : company_id, "branch_id" : branch_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_edit_branch').modal('show');

                $('#modal_edit_branch').on('hidden.bs.modal', function () {
                    $('#branch_name').val();
                    $('#branch_description').val();
                    // window.location.reload();
                    window.location.href = base_url+"branches";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_comp_branch').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_comp_branch').html(response.msg);

              }

               

          $('#edit_branch').show();
          $('#edit_branch_loader').hide();


            },

            error: function(response){
                $('#edit_branch').show();
                $('#edit_branch_loader').hide();
                $('#error_comp_branch').html("Connection Error.");

            }

          });

          }

           function fetch_branch_details(){
            // var pathArray = window.location.pathname.split( '/' );
            var branch_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var company_id = localStorage.getItem('company_id');


          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/fetch_company_branch_byID",
            data: { "branch_id" : branch_id, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {

                $.each(response['data'], function (i, v) {

                    $('#branch_name').val(response['data'][i]['branch_name']);
                    $('#branch_description').val(response['data'][i]['branch_description']);
                                 
                });
    
                                   
              }


            },

            error: function(response){

              alert("Connection Error.");

            }

            });
          }
        </script>
<?php
include("_common/footer.php");
?> 

