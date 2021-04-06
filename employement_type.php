<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Employment Types </h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <button type="button" class="btn btn-success" id="add_employee">Add Employee Type</button>
                    
                    
                  </div>
                </div>
              </div>
            </div>

            <div id="employee_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                   <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employment_type">Employee Type<span>*</span>
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
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="type_error">
                          
                        </div>
                      </div>                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" id="add_emp_type">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="type_loader"></i>
                          <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                        </div>
                      </div>

                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <div class="clearfix"></div>

            <div class="row">
             

              <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <br>

                  <div class="x_content">

                    

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title">Employment Type</th>
                            
                            <!-- <th class="column-title">Employees</th> -->
                            
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="3">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="typeData">
                          <tr>
                            <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="loading"></i></td>
                          </tr>   
                        </tbody>
                      </table>
                    </div>
                            
                        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <div class="modal fade" id="modal_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employment Type Added Successfully!</h4>
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
            
            $('#add_employee').on('click', emp_type);
            list_of_employment_type();

            $(document).on('click', '.delete_employment_type', function(){
                var type_id = $(this).attr('id').replace(/type_/,''); // table row ID 
                delete_employment_type(type_id);
            });

            $('#add_emp_type').on('click', add_emp_type);
          })

          function emp_type(){
            $('#employee_display').toggle();
            $('#employee_type').val('');
            $('#description').val('');
            
            $('#error').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

          function list_of_employment_type(){
            var company_id = localStorage.getItem('company_id');
            // var page = 1;
            // var limit = 10;

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_employment_types",
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

                              strTable += '<tr id="row_'+response['data'][i]['type_id']+'">';
                              strTable += '<td>'+response['data'][i]['type_name']+'</td>';
                             
                              // strTable += '<td>'+response['data'][i]['total_no_employees']+'</td>';
                              
                               strTable += '<td><a href="'+base_url+'edit_employment_type?id='+response['data'][i]['type_id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employment Type"></i></a>&nbsp;&nbsp; <a  class="delete_employment_type" style="cursor: pointer;" id="type_'+response['data'][i]['type_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employment Type"></i></a>';
                              
                              strTable += '</tr>';  


                               strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['type_id']+'">';
                              strTable += '<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';

                              k++;
                                 
                            });


                        }else{

                            strTable = '<tr><td colspan="3">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#typeData").html(strTable);
                        $("#typeData").show();

                    }else {
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="3">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#typeData").html(strTable);
                        $("#typeData").show();
                    }    
                
                },

                error: function(response){
                  
                  $('#loading').hide();
                  alert('Connection error');

                }        

            });
          }


          function delete_employment_type(type_id){
             
            var company_id = localStorage.getItem('company_id');
            
            

            var ans = confirm("Are you sure you want to delete?");
            if(!ans){
                return;
            }
            

            $('#row_'+type_id).hide();
            $('#loader_row_'+type_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_company_employment_type",
                data: {"company_id": company_id, "type_id" : type_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+type_id).hide();
                    $('#row_'+type_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+type_id).hide();
                }
            });
        }

        function add_emp_type(){

            

            var employment_type = $('#employment_type').val();
            var employment_description = $('#employment_description').val();
            
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
    
              $('#type_error').html("You have a blank field");

              return; 

            }

             

            
                        
          
          $('#add_emp_type').hide();
          $('#type_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_employment_type",
            data: { "employment_type" : employment_type, "employment_description" : employment_description,  "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_type').modal('show');

                $('#modal_type').on('hidden.bs.modal', function () {
                    // do something…
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#type_error').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#type_error').html(response.msg);

              }

               $('#add_emp_type').show();
              $('#type_loader').hide();

            },
            error: function(response){

              $('#add_emp_type').show();
              $('#type_loader').hide();
              $('#type_error').html("Connection Error.");

            }

          });


          }
        </script>
<?php
include("_common/footer.php");
?>         