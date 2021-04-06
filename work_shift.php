<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Work Shifts </h3>
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
                    <!--span class="input-group-btn"-->
                    <a href="create_new_shift">
                    <button type="button" class="btn btn-success" id="add_shift">Add New</button>
                    </a>
                    <!-- <a href="access_levels"><button type="button" class="btn btn-primary">Back</button></a> -->
                    <!-- </span> -->
                    
                  </div>
                </div>
              </div>
            </div>


            <div id="shift_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_name">Shift Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="department_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_name">Shift Start Time<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="department_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_name">Shift End Time<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="department_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      

                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Parent Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12">
                            
                          </select>
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" id="error_dept">
                      
                          </div>
                        </div>
                      </div>
                          
                      
                      <!-- <div class="ln_solid"></div> -->
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_dept">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="dept_loading"></i>
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
                            
                            <th class="column-title">Shift Name</th>
                            <th class="column-title">Employee Count</th>
                            <!-- <th class="column-title">Branch </th> -->
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="4">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                        <tr id="loading_td">
                          <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                        </tr>
                       
                        <tbody id="workshift_list">
                             
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
        <div class="modal fade" id="modal_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" >
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Success
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">
                <h4 id="msggg">Department Added Successfully!</h4>
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

            fetch_list();
            $(document).on('click', '.do_connections_exist', function(){
              
              var id = $(this).attr("id").replace(/id_/,'');
              $("#loadin_tr_"+id).show();
              $("#data_tr_"+id).hide();
              do_connections_exist(id);

            });

            $(document).on('click', '.view_shift_info', function(){
        
              var id = $(this).attr("id").replace(/id_/,'');
              var shift_name = $("#s_name_"+id).html();
              get_shift_details(id,shift_name);

            });

            //view_shift_info

          });

          function get_shift_details(id,shift_name){

            $("#msggg").html('<i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: ;" id=""></i>');

            $("#exampleModalLabel").html(shift_name);
            
            $('#modal_msg').modal('show');

            $.ajax({

              type: "POST",
              dataType: "json",
              cache: false,
              url: api_path+"workshifts/get_workshift",
              data: { "company_id" : localStorage.getItem('company_id') , "shift_id" : id },

              success: function(response) {

                console.log(response);

                if (response.status == '200') {
                  
                  var the_list = '<table class="table table-bordered" style="font-size: 13px"> <thead>   <th>Day </th>      <th>Start Time</th>            <th>End Time</th>    </tr>      </thead>   <tbody>';

                  $(response.data.shift_days).each( function(index, value){

                    the_list += '<tr>    <td>'+value.week_day_name+'</td>   <td>'+value.start_time+'</td>      <td>'+value.end_time+'</td>  </tr>';

                  });

                  the_list += '</tbody> </table>';

                  $("#msggg").html(the_list);

                }else if(response.status == '400'){ // coder error message
                  

                }else if(response.status == '401'){ //user error message
                  

                }

              },

              error: function(response){
                
                console.log(response);

              }

            });

          }

          function do_connections_exist(id){

            var company_id = localStorage.getItem('company_id');

            $.ajax({

              type: "POST",
              dataType: "json",
              cache: false,
              url: api_path+"workshifts/count_connections",
              data: { "company_id" : company_id , "shift_id" : id },

              success: function(response) {

                console.log(response);

                if (response.status == '200') {
                  
                  if(parseInt(response.data) > 0){

                    $("#msggg").html('<font size=3>Some employees are currently on this shift. Deleting this shift will leave them without shifts. <br><br>Do you still wish to delete it?</font> <br><br><button type="button" class="btn btn-success" id="">Yes</button>&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>');

                    $("#exampleModalLabel").html('Warning');
                    
                    $('#modal_msg').modal('show');

                    $("#loadin_tr_"+id).hide();
                    $("#data_tr_"+id).show();
                    
                  }else{

                    $("#loadin_tr_"+id).hide();
                    $("#data_tr_"+id).show();
                    delete_shift(id);

                  }

                }else if(response.status == '400'){ // coder error message
                  $("#loadin_tr_"+id).hide();
                  $("#data_tr_"+id).show();
                  alert("Error.");

                }else if(response.status == '401'){ //user error message
                  $("#loadin_tr_"+id).hide();
                  $("#data_tr_"+id).show();
                  alert("Error");

                }

              },

              error: function(response){
                
                alert("Error.");

              }

            });
          }

          function delete_shift(id){
            
            var ans = confirm("Are you sure you want to delete this shift");
            if(ans){

              $("#loadin_tr_"+id).show();
              $("#data_tr_"+id).hide();

              $.ajax({

                type: "POST",
                dataType: "json",
                cache: false,
                url: api_path+"workshifts/delete_workshift",
                data: { "company_id" : localStorage.getItem('company_id'), "shift_id": id },

                success: function(response) {

                  console.log(response);
                  if (response.status == '200') {

                    $("#data_tr_"+id).remove();

                  }else if(response.status == '400'){ //coder error message

                    $("#data_tr_"+id).show();

                  }else if(response.status == '401'){ //user error message

                    $("#data_tr_"+id).show();

                  }

                  $("#loadin_tr_"+id).hide();
                  
                },

                error: function(response){
                  console.log(response);
                  $("#loadin_tr_"+id).hide();
                  $("#data_tr_"+id).show();

                }

              });

            }else{



            }

          }


          function fetch_list(){

            var company_id = localStorage.getItem('company_id');

            $.ajax({

              type: "POST",
              dataType: "json",
              cache: false,
              url: api_path+"workshifts/list_shifts",
              data: { "company_id" : company_id },

              success: function(response) {

                console.log(response);

                if (response.status == '200') {

                  var the_list = "";
                  $(response.data).each(function(index, value){

                      the_list += '<tr id="data_tr_'+value.id+'">  <td valign="top" id="s_name_'+value.id+'">'+value.name+'</td>  <td valign="top">'+value.employee_count+'</td>    <td valign="top"><i  class="fa fa-info-circle view_shift_info" id="id_'+value.id+'"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" ></i> &nbsp;&nbsp;<a href="'+base_url+'edit_work_shift?id='+value.id+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit"></i></a>&nbsp;&nbsp; <i  class="fa fa-trash do_connections_exist"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee info" id="id_'+value.id+'"></i></td>     </tr>  <tr id="loadin_tr_'+value.id+'" style="display: none"><td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ;"></i></td></tr>';

                  });

                  $("#workshift_list").html(the_list);

                }else if(response.status == '400'){ // coder error message

                  the_list += '<tr>  <td valign="top" colspan="3">No record</td>     </tr>';
                  $("#workshift_list").html(the_list);

                }else if(response.status == '401'){ //user error message

                  $('#error_dept').html(response.msg);

                }

                $("#loading_td").hide();
                
              },

              error: function(response){
                console.log(response);
                $('#add_dept').show();
                $('#dept_loading').hide();
                $('#error_dept').html("Connection Error.");

              }

            });

          }

          

        </script>
<?php
include("_common/footer.php");
?>         