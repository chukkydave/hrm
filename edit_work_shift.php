<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div id="employee_details_display" style="display: ;">
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Shift</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    
                    <a href="work_shift"><button type="button" class="btn btn-primary" id="add_employee">Back</button></a>
                    
                    
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_name">Shift Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="shift_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <br>                     
                      

                    </span>
                    

                    <div class="table-responsive"  style="z-index: 10">
                        <table class="table table-striped jambo_table bulk_action" style="z-index: 10">
                          <thead>
                            <tr class="headings">
                              <!-- <th>
                                <input type="checkbox" id="check-all" class="flat">
                              </th> -->
                              <!-- <th class="column-title"> </th> -->
                              
                              <th class="column-title">Day</th>
                              <th class="column-title">Start Time</th>
                              <th class="column-title">End Time</th>
                              <!-- <th class="column-title">Status </th> -->
                              
                              
                              <!-- <th class="column-title no-link last"><span class="nobr">Action</span> -->
                              </th>
                              
                            </tr>
                          </thead>

                          <tr id="loading_dv">
                            <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                          </tr>

                          
                         <tbody  id="wkdz">
                            
                            
                            
                         </tbody>


                        </table>


                        
                        <br>
                        <button type="button" class="btn btn-success" id="edit_work_shift">Update</button>
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_work_shift_loader"></i>
                      </div>


                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        </div>
        <!-- /page content -->

        <div class="modal fade" id="modal_shift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Shift Successfully Updated!</h4>
              </div>
              
            </div>
          </div>
        </div>

        <div id="employee_error_display" style="display: none;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-danger alert-dimissible fade-in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true"></span>
                  </button>
                  <strong>Connection error</strong>
                </div>
              </div>
            </div>
          </div>
        </div>   
      </div>

        <script type="text/javascript">

          $(document).ready(function(){

            get_shift_details();
            $("#edit_work_shift").on('click', edit_work_shift);

          });

          function edit_work_shift(){

              var workshift_dtl = [];

              $(".day_line").each(function(){

                var id = $(this).attr("dir").replace(/row_/,'');
                var weekday_id = $(this).attr("id").replace(/the_day_/,'');
                var start_time = $("#stst_"+id).val();
                var end_time = $("#endst_"+id).val();

                workshift_dtl.push({
                  row_id: id,
                  week_day_id: weekday_id,
                  start_time: start_time,
                  end_time: end_time
                });

              });


              //get current id
              // var pathArray = window.location.pathname.split( '/' );
              var shift_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
              var shift_name = $("#shift_name").val();


              $("#edit_work_shift").hide();
              $("#edit_work_shift_loader").show();

              $.ajax({

                type: "POST",
                dataType: "json",
                cache: false,
                url: api_path+"workshifts/update_workshift",
                data: { "company_id" : localStorage.getItem('company_id') , "shift_id" : shift_id , "shift_name" : shift_name , "day_list" : workshift_dtl },

                success: function(response) {

                  console.log(response);

                  if (response.status == '200') {

                    $("#msggg").html('<font size=3>Successfully Updated</font> <br>');

                    $("#exampleModalLabel").html('Successful');
                    
                    $('#modal_shift').modal('show');

                    $("#edit_work_shift").show();
                    $("#edit_work_shift_loader").hide();

                  }else if(response.status == '400'){ // coder error message
                    $("#edit_work_shift").show();
                    $("#edit_work_shift_loader").hide();
                  }else if(response.status == '401'){ //user error message
                    $("#edit_work_shift").show();
                    $("#edit_work_shift_loader").hide();
                  }

                },

                error: function(response){
                  
                  
                  $("#edit_work_shift").show();
                  $("#edit_work_shift_loader").hide();

                }

              });

          }

          function get_shift_details(){

            // var pathArray = window.location.pathname.split( '/' );
            var shift_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

            $.ajax({

              type: "POST",
              dataType: "json",
              cache: false,
              url: api_path+"workshifts/get_workshift",
              data: { "company_id" : localStorage.getItem('company_id') , "shift_id" : shift_id },

              success: function(response) {

                console.log(response);

                if (response.status == '200') {

                  $("#shift_name").val(response.data.shift_name);
                  var the_list = '';
                  $(response.data.shift_days).each( function(index, value){

                    the_list += '<tr class="headings">   <th class="column-title flat day_line"  id="the_day_'+value.week_day_id+'" dir="row_'+value.id+'">'+value.week_day_name+' &nbsp; &nbsp; </th> <th class="column-title"> <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control start_time" value="'+value.start_time+'" id="stst_'+value.id+'" /> </div> </th>                              <th class="column-title">  <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control end_time" value="'+value.end_time+'" id="endst_'+value.id+'" /> </div>  </th> </tr>'; 

                  });

                  $("#loading_dv").hide();
                  $("#wkdz").html(the_list);

                }else if(response.status == '400'){ // coder error message
                  


                }else if(response.status == '401'){ //user error message
                  


                }

              },

              error: function(response){
                
                console.log(response);

              }

            });

          }

        </script>


        <script type="text/javascript">

            $(document).on('focus', ".start_time", function() {
              $(this).datetimepicker({
                format: 'h:mm A'
              });
            });


            $(document).on('focus', ".end_time", function() {
              $(this).datetimepicker({
                format: 'h:mm A'
              });
            });

        </script>
<?php
include("_common/footer.php");
?>         