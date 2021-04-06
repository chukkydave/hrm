<?php
include("_common/header.php");
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Company Branches</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <button type="button" class="btn btn-success" id="add_branch">Add Branch</button>
                    <!-- </span> -->
                    
                  </div>
                </div>
              </div>

            </div>

            <div id="branch_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch_name">Branch Name <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="branch_name" required="required" class="form-control col-md-7 col-xs-12 required">
                          
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
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_branch">
                        
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_comp_branch">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="branch_loader"></i>
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
                            
                            <th class="column-title">Branch Name</th>
                            
                            <!-- <th class="column-title">Employees</th> -->
                           
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="3">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="branchData">
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

        <!-- modal -->
        <div class="modal fade" id="modal_branch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Company Branch Added Successfully!</h4>
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
            // list_of_positions();
            $('#add_branch').on('click', company_branch);
            list_of_company_branches();

            $('#add_comp_branch').on('click', add_company_branch);

            $(document).on('click', '.delete_branch', function(){
                var branch_id = $(this).attr('id').replace(/bra_/,''); // table row ID 
                delete_branch(branch_id);                

            }); 
          })


           function delete_branch(branch_id){
             
            var company_id = localStorage.getItem('company_id');
            
            
            var ans = confirm("Are you sure you want to delete this branch?");
            if(!ans){
                return;
            }
            // $('#delete_modal_position').modal('show');

            $('#row_'+branch_id).hide();
            $('#loader_row_'+branch_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_company_branch",
                data: {"company_id": company_id, "branch_id" : branch_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+branch_id).hide();
                    $('#row_'+branch_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+branch_id).hide();
                }
            });
        }

        
          function company_branch(){
            $('#branch_display').toggle();
            $('#branch_description').val('');
            $('#branch_name').val('');
           
            $('#error_branch').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

          function add_company_branch(){
            var branch_name = $('#branch_name').val();
            var branch_description = $('#branch_description').val();
            var company_id = localStorage.getItem('company_id');
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
    
              $('#error_branch').html("You have a blank field");

              return; 

            }

                        
          
          $('#add_comp_branch').hide();
          $('#branch_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_branch",
            data: { "branch_name" : branch_name, "branch_description" : branch_description, "company_id" : company_id, "user_id" : user_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_branch').modal('show');

                $('#modal_branch').on('hidden.bs.modal', function () {
                    // do something…
                    $('#branch_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_branch').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_branch').html(response.msg);

              }

               
              $('#add_comp_branch').show();
              $('#branch_loader').hide();

            },

            error: function(response){

              $('#add_comp_branch').show();
              $('#branch_loader').hide();
              $('#error_branch').html("Connection Error.");

            }

          });

          }

          function list_of_company_branches(){
            var company_id = localStorage.getItem('company_id');
           

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_branches",
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

                              strTable += '<tr id="row_'+response['data'][i]['branch_id']+'">';
                              strTable += '<td>'+response['data'][i]['branch_name']+'</td>';
                              
                              // strTable += '<td>'+response['data'][i]['$total_no_employees']+'</td>';
                              
                              strTable += '<td><a href="'+base_url+'edit_branch?id='+response['data'][i]['branch_id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Company Branch"></i></a>&nbsp;&nbsp; <a class="delete_branch" style="cursor: pointer;" id="bra_'+response['data'][i]['branch_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Company Branch"></i></a></td>';
                              
                              strTable += '</tr>';  

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['branch_id']+'">';
                              strTable += '<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';
                                


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="3">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#branchData").html(strTable);
                        $("#branchData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="3">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#branchData").html(strTable);
                        $("#branchData").show();
                        

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