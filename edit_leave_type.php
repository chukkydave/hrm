<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Company Leave Type</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="leave_types"><button type="button" class="btn btn-success">Back</button></a>
                    
                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_type">Leave Type<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="leave_type" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Type Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="leave_type_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid_status">Paid/Unpaid<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="paid_status">
                            <!-- <option>-- Select --</option> -->
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Exclude Holidays While Calculating Days? <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="checkbox" name="exclude_holidays" id="exclude_holidays" style="width:20px;height:20px;">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Exclude Weekends While Calculating Days? <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="checkbox" name="exclude_weekends" id="exclude_weekends" style="width:20px;height:20px;">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_leave_type">
                         
                      
                          </div>
                        </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="edit_lv_type">Edit</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_lv_loader"></i>
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
        <div class="modal fade" id="modal_leave_type_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Company Leave Successfully Edited</h4>
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
            fetch_leave_type_details();
            $('#edit_lv_type').on('click', edit_company_leave_type);

          })

          function fetch_leave_type_details(){
            // var pathArray = window.location.pathname.split( '/' );
            var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var company_id = localStorage.getItem('company_id');


          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/fetch_company_leave_byID",
            data: { "leave_id" : leave_id, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {
                
                $.each(response['data'], function (i, v) {

                    $('#leave_type').val(response['data'][i]['leave_type']);
                    $('#leave_type_description').val(response['data'][i]['leave_description']);
                    $('#allowable_days').val(response['data'][i]['allowable_days']);

                    if(response['data'][i]['paid_status'] == 'no'){
                      $('#paid_status').val('no');
                    }else{
                      $('#paid_status').val('yes');
                    }

                    if(response['data'][i]['exclude_weekends'] == 'no'){

                       $('#exclude_weekends').attr('checked', false);

                    }else{

                      $('#exclude_weekends').attr('checked', true);

                    }

                    if(response['data'][i]['exclude_holidays'] == 'no'){
                      $('#exclude_holidays').attr('checked', false);

                    }else{
                      $('#exclude_holidays').attr('checked', true);
                    }

                    
                                 
                });
    
                                   
              }


            },

            error: function(response){

              alert("Connection Error.");

            }

            });
          }

          
          function edit_company_leave_type(){

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

            var leave_type = $('#leave_type').val();
            var leave_description = $('#leave_type_description').val();
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var leave_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var paid_status = $('#paid_status').val();
            var allowable_days = $('#allowable_days').val();
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
    
              $('#error_leave_type').html("You have a blank field");

              return; 

            }

                        
          
          $('#edit_lv_type').hide();
          $('#edit_lv_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/edit_company_leave",
            data: { "leave_type" : leave_type, "leave_description" : leave_description, "company_id" : company_id, "leave_id" : leave_id, "allowable_days" : allowable_days, "paid_status" : paid_status, "exclude_holidays" : exclude_holidays, "exclude_weekends" : exclude_weekends},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_leave_type_edit').modal('show');

                $('#modal_leave_type_edit').on('hidden.bs.modal', function () {
                    
                    window.location.href ="leave_types";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_leave_type').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_leave_type').html(response.msg);

              }

               

          $('#edit_lv_type').show();
          $('#edit_lv_loader').hide();


            },

            error: function(response){
                $('#edit_lv_type').show();
                $('#edit_lv_loader').hide();
                $('#error_leave_type').html("Connection Error.");

            }

          });

          }

        </script>

<?php
include("_common/footer.php");
?> 