<?php
include("_common/header.php");
?>       
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">

              <div class="title_left">
                <h3>Document List For Employees</h3>
              </div>

              
              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <!--span class="input-group-btn"-->
                    <button type="button" class="btn btn-success" id="doc">Add New</button>
                    <!-- </span> -->
                    
                  </div>
                </div>
              </div>

            </div>

            <div id="doctype_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doctype_name">Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="doctype_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doctype_description">Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="doctype_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_doctype">
                        
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_doctype">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="doctype_loader"></i>
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
                            
                            <th class="column-title">Document Name</th>
                            <th class="column-title">Description</th>
                            <!-- <th class="column-title">Employees</th> -->
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="3">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                            
                          </tr>

                        </thead>

                        


                        <tbody  id="doctypeData" style="display: none">
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
                      <div class="container">
                          <nav aria-label="Page navigation">
                              <ul class="pagination" id="pagination"></ul>
                          </nav>
                      </div>

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
        <div class="modal fade" id="modal_doctype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Company Employee Document Type Added Successfully!</h4>
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
            list_doctype('');

            $('#doc').on('click', doctype);

            $('#add_doctype').on('click', add_doctype);

            $(document).on('click', '.delete_doctype', function(){
                var doctype_id = $(this).attr('id').replace(/doc_/,''); // table row ID 
                delete_doctype(doctype_id);                

            });

          });

          function doctype(){
            $('#doctype_display').toggle();

            $('#doctype_description').val('');
            $('#doctype_name').val('');
           
            $('#error_doctype').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

           function delete_doctype(doctype_id){
             
            var company_id = localStorage.getItem('company_id');
            
            
            var ans = confirm("Are you sure you want to delete?");
            if(!ans){
                return;
            }
            // $('#delete_modal_position').modal('show');

            $('#row_'+doctype_id).hide();
            $('#loader_row_'+doctype_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_company_doctype",
                data: {"company_id": company_id, "doctype_id" : doctype_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+doctype_id).hide();
                    $('#row_'+doctype_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+doctype_id).hide();
                }
            });
        }

        function add_doctype(){
            var doctype_name = $('#doctype_name').val();
            var doctype_description = $('#doctype_description').val();
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
    
              $('#error_doctype').html("You have a blank field");

              return; 

            }

                        
          
          $('#add_doctype').hide();
          $('#doctype_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_doctype",
            data: { "doctype_name" : doctype_name, "doctype_description" : doctype_description, "company_id" : company_id, "user_id" : user_id},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_doctype').modal('show');

                $('#modal_doctype').on('hidden.bs.modal', function () {
                    // do something…
                    $('#doctype_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error_doctype').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error_doctype').html(response.msg);

              }

               
              $('#add_doctype').show();
              $('#doctype_loader').hide();

            },

            error: function(response){

              $('#add_doctype').show();
              $('#doctype_loader').hide();
              $('#error_doctype').html("Connection Error.");

            }

          });

          }

          function list_doctype(page){
            var company_id = localStorage.getItem('company_id');
              if(page == ""){
              var page = 1;
            }
            var limit = 10;

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_doctypes",
                data: { "company_id": company_id, "page": page, "limit": limit},
                timeout: 60000,

                success: function(response) {
                    // console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                              strTable += '<tr id="row_'+response['data'][i]['doctype_id']+'">';
                              strTable += '<td>'+response['data'][i]['doctype_name']+'</td>';
                              
                              strTable += '<td>'+response['data'][i]['doctype_description']+'</td>';

                              
                              
                              strTable += '<td><a href="'+base_url+'edit_doctype?id='+response['data'][i]['doctype_id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Company Holiday"></i></a>&nbsp;&nbsp; <a class="delete_doctype" style="cursor: pointer;" id="doc_'+response['data'][i]['doctype_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Company Holiday"></i></a></td>';
                              
                              strTable += '</tr>';  

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['doctype_id']+'">';
                              strTable += '<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';
                                


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="3">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#doctypeData").html(strTable);
                        $("#doctypeData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="3">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#doctypeData").html(strTable);
                        $("#doctypeData").show();
                        

                    }    

                    $('#pagination').twbsPagination({
                        totalPages: Math.ceil(response.total_rows/limit),
                        visiblePages: 10,
                        onPageClick: function (event, page) {
                          list_doctype(page);
                        }
                    });
                
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
        
        
        

            
        

