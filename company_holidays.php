<?php
include("_common/header.php");
?>      
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">

              <div class="title_left">
                <h3>Company Holidays</h3>
              </div>

              
              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <!--span class="input-group-btn"-->
                    <button type="button" class="btn btn-success" id="add_hols">Add New</button>
                    <!-- </span> -->
                    
                  </div>
                </div>
              </div>

            </div>

            <div id="holiday_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="holiday_name">Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="holiday_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="holiday_date">Date<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="holiday_date" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" id="error_holiday">
                      
                          </div>
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_holiday">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="holiday_loader"></i>
                        </div>
                      </div>

                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>


        
            <div id="list_of_users">
              <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                  <br>
                  <!-- <div class="form-group">
                    <div class="pull-right">
                      <button type="button" class="btn btn-success"><a href="admin/add_user" style="color: white;">Add</a></button>
                      
                    </div>
                  </div><br><br> -->

                  <div class="x_content">
                    

                    <div class="table-responsive" >
                      <table class="table table-striped jambo_table bulk_action">

                        <thead>
                          <tr class="headings">
                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                            <th class="column-title">Holiday</th>
                            <th class="column-title">Date</th>
                            
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="3">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                            
                          </tr>

                        </thead>

                        


                        <tbody  id="holidayData" style="display: none">
                          <tr>
                            <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="loading"></i>
                            </td>
                          </tr>


                          <!-- <tr>
                            <td>
                              <input type="checkbox" id="check-all" class="flat">
                            </td>
                            <td>1.</td>
                            <td><a href="admin/user_profile">Oluwaseye</a></td>
                            <td><a href="admin/user_profile">Gbenga</a></td>
                            <td><a href="admin/user_profile">seygz@gmail.com</a></td>
                            <td>
                              <a href="admin/user_permissions"><i class="fa fa-lock fa-2x" data-toggle="tooltip" data-placement="top" data-original-title="User Permissions"></i></a> &nbsp;&nbsp; -->

                              <!-- <i class="fa fa-toggle-on fa-2x"  data-toggle="tooltip" data-placement="top" data-original-title="Disable Login"></i> &nbsp;&nbsp;  -->
                              
                              <!-- <i class="fa fa-trash fa-2x"  data-toggle="tooltip" data-placement="top" data-original-title="Disable Login"></i>
                            </td>
                          </tr>-->

                          
                        </tbody>
                      </table>

                      <!-- <div class="ln_solid"></div> -->
                      
                    </div>
                          
                  </div>
                </div>
              </div>
            </div>
            </div>

          </div>
        </div>
        <!-- /page content-->

        <!-- modal -->
        <div class="modal fade" id="modal_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Company Holiday Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>



        <script type="text/javascript">
          $(document).ready(function() {
            
            $('input#holiday_date').datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('#add_hols').on('click', doc);

            list_of_company_holidays();

            $('#add_holiday').on('click', add_company_holiday);

            $(document).on('click', '.delete_holiday', function(){
                var holiday_id = $(this).attr('id').replace(/hols_/,''); // table row ID 
                delete_holiday(holiday_id);                

            });
          });


           function delete_holiday(holiday_id){
             
            var company_id = localStorage.getItem('company_id');
            
            
            var ans = confirm("Are you sure you want to delete?");
            if(!ans){
                return;
            }
            // $('#delete_modal_position').modal('show');

            $('#row_'+holiday_id).hide();
            $('#loader_row_'+holiday_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_company_holiday",
                data: {"company_id": company_id, "holiday_id" : holiday_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+holiday_id).hide();
                    $('#row_'+holiday_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+holiday_id).hide();
                }
            });
        }


          function doc(){
            $('#holiday_display').toggle();
            $('#holiday_date').val('');
            $('#holiday_name').val('');
           
            $('#error_holiday').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }


          function add_company_holiday(){
            var holiday_name = $('#holiday_name').val();
            var holiday_date = $('#holiday_date').val();
            var company_id = localStorage.getItem('company_id');
            
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
    
              $('#error_holiday').html("You have a blank field");

              return; 

            }

                        
          
          $('#add_holiday').hide();
          $('#holiday_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_holiday",
            data: { "holiday_name" : holiday_name, "holiday_date" : holiday_date, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_holiday').modal('show');

                $('#modal_holiday').on('hidden.bs.modal', function () {
                    // do something…
                    $('#holiday_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_holiday').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_holiday').html(response.msg);

              }

               
              $('#add_holiday').show();
              $('#holiday_loader').hide();

            },

            error: function(response){

              $('#add_holiday').show();
              $('#holiday_loader').hide();
              $('#error_holiday').html("Connection Error.");

            }

          });

          }

          function list_of_company_holidays(){
            var company_id = localStorage.getItem('company_id');
           

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_holidays",
                data: { "company_id": company_id},
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                              strTable += '<tr id="row_'+response['data'][i]['holiday_id']+'">';
                              strTable += '<td>'+response['data'][i]['holiday_name']+'</td>';
                              
                              strTable += '<td>'+response['data'][i]['holiday_date']+'</td>';
                              
                              strTable += '<td><a href="'+base_url+'edit_company_holiday?id='+response['data'][i]['holiday_id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Company Holiday"></i></a>&nbsp;&nbsp; <a class="delete_holiday" style="cursor: pointer;" id="hols_'+response['data'][i]['holiday_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Company Holiday"></i></a></td>';
                              
                              strTable += '</tr>';  

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['holiday_id']+'">';
                              strTable += '<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';
                                


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="3">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#holidayData").html(strTable);
                        $("#holidayData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="3">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#holidayData").html(strTable);
                        $("#holidayData").show();
                        

                    }    
                
                },

                error: function(response){
                    alert('Connection error');
                }        

            });
          }


        </script>
        
<?php
include("_common/footer.php");
?>    
        
        

            
        

