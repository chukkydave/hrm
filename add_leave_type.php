<?php
  include("_common/header.php");
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Leave Type</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="leave_types"><button type="button" class="btn btn-success" id="add_employee">Back</button></a>
                    
                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_type">Leave Type <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="leave_type" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_description">Type Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12" id="leave_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status">Paid/Unpaid<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="paid_status">
                            <option>-- Select --</option>
                            <option value="yes">Paid</option>
                            <option value="no">Unpaid</option>
                          
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="allowable_days">Allowable Days Per Year<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="allowable_days" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Exclude Holidays While Calculating Days? 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="checkbox" name="exclude_holidays" id="exclude_holidays" style="width:20px;height:20px;">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Exclude Weekends While Calculating Days?
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="checkbox" name="exclude_weekends" id="exclude_weekends" style="width:20px;height:20px;">
                        </div>
                      </div>

                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="leave_error">
                          
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="add_leave">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="add_leave_loader"></i>
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

        <div class="modal fade" id="modal_leave_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Leave Type Added Successfully!</h4>
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
            $('#add_leave').on('click', add_leave_type);
          })

          function add_leave_type(){

            // $('#exclude_weekends').change(function(){
            //      if($(this).attr('checked')){
            //           $(this).val('true');
            //      }else{
            //           $(this).val('false');
            //      }
            // });

            if($('#exclude_weekends').is(':checked')){
                $('#exclude_weekends').val('yes');
            }else{
              $('#exclude_weekends').val('no');
            }

            if($('#exclude_holidays').is(':checked')){
                $('#exclude_holidays').val('yes');
            }else{
              $('#exclude_holidays').val('no');
            }

            // $('#exclude_holidays').change(function(){
            //      if($(this).attr('checked')){
            //           $(this).val('true');
            //      }else{
            //           $(this).val('false');
            //      }
            // });

            var leave_type = $('#leave_type').val();
            var leave_description = $('#leave_description').val();
            var paid_status = $('#paid_status').val();
            var allowable_days = $('#allowable_days').val();
            var company_id = localStorage.getItem('company_id');
            var exclude_weekends = $('#exclude_weekends').val();
            var exclude_holidays = $('#exclude_holidays').val();
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
    
              $('#leave_error').html("You have a blank field");

              return; 

            }

             

            if((paid_status == '-- Select --')){

              $('#leave_error').html('Please select an option');
                      
                  return;
            }

            // alert(exclude_holidays);
            // alert(exclude_weekends);
                        
          
          $('#add_leave').hide();
          $('#add_leave_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_leave_type",
            data: { "leave_type" : leave_type, "leave_description" : leave_description, "allowable_days" : allowable_days, "paid_status" : paid_status, "exclude_holidays" : exclude_holidays, "exclude_weekends" : exclude_weekends, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_leave_type').modal('show');

                $('#modal_leave_type').on('hidden.bs.modal', function () {
                    // do something…
                    // window.location.reload();
                    window.location.href = "leave_types";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#leave_error').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#leave_error').html(response.msg);

              }

               $('#add_leave').show();
              $('#add_leave_loader').hide();

            },
            error: function(response){

              $('#add_leave').show();
              $('#add_leave_loader').hide();
              $('#leave_error').html("Connection Error.");

            }

          });


          }
        </script>

<?php
  include("_common/footer.php");
?> 
