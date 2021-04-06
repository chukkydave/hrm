<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Employee Payout Type</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="employment_payment_types"><button type="button" class="btn btn-success" id="add_employee">Back</button></a>
                    
                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_type_name">Payment Type<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="payment_type_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_type_credit_or_debit">Credit or Debit<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="payment_type_credit_or_debit">
                            <option>---</option>
                            <option>Credit</option>
                            <option>Debit</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="payment_type_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_pay_type">
                         
                      
                          </div>
                        </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="add_pay_type">Update</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="pay_type_loader"></i>
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
        <div class="modal fade" id="modal_payment_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Payment Type Edited Successfully!</h4>
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
            fetch_payment_type_details();

            $('#add_pay_type').on('click', edit_payment_type);
          })
          function fetch_payment_type_details(){
            var pathArray = window.location.pathname.split( '/' );
            var payment_type_id = pathArray[4].replace(/%20/g,' ');
            var company_id = localStorage.getItem('company_id');


          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/fetch_company_payment_type_byID",
            data: { "payment_type_id" : payment_type_id, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {

                $.each(response['data'], function (i, v) {

                    $('#payment_type_name').val(response['data'][i]['payment_type_name']);
                    $('#payment_type_description').val(response['data'][i]['payment_type_description']);
                    $('#payment_type_credit_or_debit').val(response['data'][i]['payment_type_credit_or_debit']);         
                });
    
                                   
              }


            },

            error: function(response){

              alert("Connection Error.");

            }

            });
          }

          function edit_payment_type(){
            var payment_type_name = $('#payment_type_name').val();
            var payment_type_description = $('#payment_type_description').val();
            var payment_type_credit_or_debit = $('#payment_type_credit_or_debit').val();
            var company_id = localStorage.getItem('company_id');
            var pathArray = window.location.pathname.split( '/' );
            var payment_type_id = pathArray[4].replace(/%20/g,' ');

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
    
              $('#error_pay_type').html("You have a blank field");

              return; 

            }

                        
          
          $('#add_pay_type').hide();
          $('#pay_type_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/edit_company_payment_type",
            data: { "payment_type_name" : payment_type_name, "payment_type_description" : payment_type_description, "company_id" : company_id, "payment_type_id" : payment_type_id, "payment_type_credit_or_debit" : payment_type_credit_or_debit},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_payment_type').modal('show');

                $('#modal_payment_type').on('hidden.bs.modal', function () {
                    $('#payment_type_name').val();
                    $('#employment_type_description').val();
                    // window.location.reload();
                    window.location.href = base_url+"/erp/hrm/employment_payment_types";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_pay_type').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_pay_type').html(response.msg);

              }

               

          $('#add_pay_type').show();
          $('#pay_type_loader').hide();


            },

            error: function(response){
                $('#add_pay_type').show();
                $('#pay_type_loader').hide();
                $('#error_pay_type').html("Connection Error.");

            }

          });

          }

        </script>


<?php
include("_common/footer.php");
?> 
