<?php
include("_common/header.php");
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Job Titles </h3>
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
                    
                    <button type="button" class="btn btn-success" id="add_position">Add Position</button>
                    
                    
                  </div>
                </div>
              </div>
            </div>


            <div id="position_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">Position Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="position_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_description">Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="position_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_position">
                         <!--  <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" > -->
                      
                          </div>
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_pos">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="position_loader"></i>
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
                            
                            <!-- <th class="column-title">Code</th> -->
                            <th class="column-title">Position</th>
                            <!-- <th class="column-title">Employees</th> -->
                            <!-- <th class="column-title">Branch </th> -->
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="4">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="positionData">
                          <tr>
                            <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="loading"></i></td>
                          </tr>   
                        </tbody>
                      </table>

                      <div class="container">
                          <nav aria-label="Page navigation">
                              <ul class="pagination" id="pagination"></ul>
                          </nav>
                      </div>

                    </div>
                            
                        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- modal -->
        <div class="modal fade" id="modal_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Position Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id="delete_modal_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Confirm
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to delete this position?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="yes_delete_position" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function(){
            list_of_positions('');
            $('#add_position').on('click', position);
            $('#add_pos').on('click', add_company_position); 

            $(document).on('click', '.delete_position', function(){
                var position_id = $(this).attr('id').replace(/pos_/,''); // table row ID 
                delete_position(position_id);                

            }); 

               
            
          })

          

          function list_of_positions(page){
            var company_id = localStorage.getItem('company_id');
            if(page == ""){
                var page = 1;
              }
              var limit = 50;

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_positions",
                data: { "company_id": company_id, "page": page, "limit": limit },
                timeout: 60000,

                success: function(response) {
                    // console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){
                            
                            $.each(response['data'], function (i, v) {

                              strTable += '<tr id="row_'+response['data'][i]['position_id']+'">';
                              // strTable += '<td>PN'+response['data'][i]['position_id']+'</td>';
                              
                              strTable += '<td>'+response['data'][i]['position_name']+'</td>';
                              // strTable += '<td>'+response['data'][i]['total_no_employees']+'</td>';
                              
                              strTable += '<td valign="top"><a href="'+base_url+'edit_position?id='+response['data'][i]['position_id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Position"></i></a>&nbsp;&nbsp; <a class="delete_position" style="cursor: pointer;" id="pos_'+response['data'][i]['position_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Position"></i></a></td>';
                              
                              strTable += '</tr>'; 

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['position_id']+'">';
                              strTable += '<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';
    
                                 
                            });

                          }else{

                            strTable = '<tr><td colspan="4">No record.</td></tr>';

                          }

                        
                        
                        $('#pagination').twbsPagination({
                            totalPages: Math.ceil(response.total_rows/limit),
                            visiblePages: 10,
                            onPageClick: function (event, page) {
                              list_of_positions(page);
                            }
                        });
                        
                        
                                   
                        $("#positionData").html(strTable);
                        $("#positionData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="4">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#positionData").html(strTable);
                        $("#positionData").show();
                        

                    }    
                
                },

                error: function(response){
                    alert('Connection error');
                }        

            });
          }

          function add_company_position(){
            var position_name = $('#position_name').val();
            var position_description = $('#position_description').val();
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
    
              $('#error_position').html("You have a blank field");

              return; 

            }

                        
          
          $('#add_pos').hide();
          $('#position_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_position",
            data: { "position_name" : position_name, "position_description" : position_description, "company_id" : company_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_position').modal('show');

                $('#modal_position').on('hidden.bs.modal', function () {
                    // do something…
                    $('#position_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_position').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_position').html(response.msg);

              }

               
              $('#add_pos').show();
              $('#position_loader').hide();

            },

            error: function(response){

               $('#add_pos').show();
              $('#position_loader').hide();
              $('#error_position').html("Connection Error.");

            }

          });

          }

        
           function delete_position(position_id){
             
            var company_id = localStorage.getItem('company_id');
            
            
            var ans = confirm("Are you sure you want to delete this position?");
            if(!ans){
                return;
            }
            // $('#delete_modal_position').modal('show');

            $('#row_'+position_id).hide();
            $('#loader_row_'+position_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_company_position",
                data: {"company_id": company_id, "position_id" : position_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+position_id).hide();
                    $('#row_'+position_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+position_id).hide();
                }
            });
        }

          function position(){
            $('#position_display').toggle();
            $('#position_description').val('');
            $('#position_name').val('');
            $('#error_position').hide();
          }

        </script>

<?php
include("_common/footer.php");
?>