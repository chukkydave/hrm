<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Company Holiday</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="company_holidays"><button type="button" class="btn btn-success" id="add_employee">Back</button></a>
                    
                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="holiday_name">Holiday Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="holiday_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_description">Date<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="holiday_date" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_com_holiday">
                         
                      
                          </div>
                        </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="edit_holiday">Update</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_holiday_loader"></i>
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
        <div class="modal fade" id="modal_edit_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Company Holiday Edited Successfully!</h4>
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
            fetch_holiday_details();

            $('input#holiday_date').datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('#edit_holiday').on('click', edit_company_holiday);
          })

          function edit_company_holiday(){
            var holiday_name = $('#holiday_name').val();
            var holiday_date = $('#holiday_date').val();
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var holiday_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

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
    
              $('#error_comp_holiday').html("You have a blank field");

              return; 

            }

                        
          
          $('#edit_holiday').hide();
          $('#edit_holiday_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/edit_company_holiday",
            data: { "holiday_name" : holiday_name, "holiday_date" : holiday_date, "company_id" : company_id, "holiday_id" : holiday_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_edit_holiday').modal('show');

                $('#modal_edit_branch').on('hidden.bs.modal', function () {
                    $('#holiday_name').val();
                    $('#holiday_date').val();
                    // window.location.reload();
                    window.location.href = base_url+"company_holidays";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_comp_holiday').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_comp_holiday').html(response.msg);

              }

               

          $('#edit_holiday').show();
          $('#edit_holiday_loader').hide();


            },

            error: function(response){
                $('#edit_holiday').show();
                $('#edit_holiday_loader').hide();
                $('#error_comp_holiday').html("Connection Error.");

            }

          });

          }

           function fetch_holiday_details(){
            // var pathArray = window.location.pathname.split( '/' );
            var holiday_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var company_id = localStorage.getItem('company_id');


          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/fetch_company_holiday_byID",
            data: { "holiday_id" : holiday_id, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {

                $.each(response['data'], function (i, v) {

                    $('#holiday_name').val(response['data'][i]['holiday_name']);
                    $('#holiday_date').val(response['data'][i]['holiday_date']);
                                 
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

