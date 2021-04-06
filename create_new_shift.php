<?php
include("_common/header.php");
?> 

        <!-- page content -->
        <div id="employee_details_display" style="display: ;">
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create Shift</h3>
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

                          <!-- <tr id="loading">
                            <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                          </tr> -->

                          
                         <tbody  id="wkdz">
                            
                            
                            
                         </tbody>


                        </table>


                        
                        <br>
                        <button type="button" class="btn btn-success" id="add_work_shift">Create</button>
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="create_loader"></i>
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
                <h4>Shift Successfully Created!</h4>
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
            
              populate_weeks();
              $(document).on('click', '#add_work_shift', function(){
                  add_work_shift();
              });

          });

          function add_work_shift(){

            var workshift_dtl = [];

            $(".day_line").each(function(){

              var id = $(this).attr("id").replace(/the_day_/,'');
              var start_time = $("#stst_"+id).val();
              var end_time = $("#endst_"+id).val();

              workshift_dtl.push({
                day_id: id,
                start_time: start_time,
                end_time: end_time
              });

            });

            var data = new Array();
            data['work_shift_name'] = $("#shift_name").val();
            data['date_settings'] = workshift_dtl;

            console.log(data);

            $("#create_loader").show();
            $("#add_work_shift").hide();

            $.ajax({

              type: "POST",
              dataType: "json",
              cache: false,
              url: api_path+"workshifts/create",
              data: { "company_id" : localStorage.getItem('company_id'), "shift_name" : data['work_shift_name'], "day_of_the_week" : data['date_settings']  },

              success: function(response) {

                console.log(response);

                if (response.status == '200') {

                  $('#modal_shift').modal('show');

                  $('#modal_shift').on('hidden.bs.modal', function () {
                      $('#department_display').hide();
                      window.location.href = "work_shift"
                  });
                  
                  
                }else if(response.status == '400'){ // coder error message

                  $('#error_dept').html('Technical Error. Please try again later.');

                }else if(response.status == '401'){ //user error message

                  $('#error_dept').html(response.msg);

                }


                $("#create_loader").hide();
                $("#add_work_shift").show();

              },

              error: function(response){

                $("#create_loader").hide();
                $("#add_work_shift").show();

              }

            });

          }

          function populate_weeks(){

              var weekdays = ["Monday", "Tuesday", "Wednesday",  "Thursday" , "Friday" , "Saturday" , "Sunday" ];

              var weekdayslength = weekdays.length;
              var loopcontent = "";
              for (var i = 0; i < weekdayslength; i++) {

                var day_id = i + 1;

                loopcontent += '<tr class="headings">       <!-- <th class="column-title"><input type="checkbox"></th> -->                                               <th class="column-title flat day_line"  id="the_day_'+day_id+'">'+weekdays[i]+' &nbsp; &nbsp; </th>                              <th class="column-title"> <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control start_time" value="" id="stst_'+day_id+'" /> </div> </th>                              <th class="column-title">  <div class="input-prepend input-group"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>   <input type="text" style="width: 200px" name="datefilter" class="form-control end_time" value="" id="endst_'+day_id+'" /> </div>   </th>                               </tr> ';

              }

              $("#wkdz").html(loopcontent);

          }

          

           
        </script>


        <script type="text/javascript">
            $(function () {
                $('.start_time').datetimepicker({
                    format: 'h:mm A'
                });
            });


            $(function () {
                $('.end_time').datetimepicker({
                    format: 'h:mm A'
                });
            });
        </script>
<?php
include("_common/footer.php");
?> 