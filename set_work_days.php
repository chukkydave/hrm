<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Company Work Days Per Week </h3>
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
                            
                            <th class="column-title">Day</th>
                            
                        
                            <th class="column-title no-link last"><span class="nobr">Status</span>
                            </th>
                            <th class="bulk-actions" colspan="2">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="work_days">
                          
                          <tr class="list_grey">
                            <td>Monday</td>
                            <td><input type="checkbox" name="day" id="monday"></td>
                          </tr>

                          <tr>
                            <td>Tuesday</td>
                            <td><input type="checkbox" name="day" id="tuesday"></td>
                          </tr>

                          <tr class="list_grey">
                            <td>Wednesday</td>
                            <td><input type="checkbox" name="day" id="wednesday"></td>
                          </tr>

                          <tr>
                            <td>Thursday</td>
                            <td><input type="checkbox" name="day" id="thursday"></td>
                          </tr>

                          <tr class="list_grey">
                            <td>Friday</td>
                            <td><input type="checkbox" name="day" id="friday"></td>
                          </tr>

                          <tr>
                            <td>Saturday</td>
                            <td><input type="checkbox" name="day"  id="saturday"></td>
                          </tr>

                          <tr class="list_grey">
                            <td>Sunday</td>
                            <td><input type="checkbox" name="day" id="sunday"></td>
                          </tr>

                             
                        </tbody>
                      </table>

                      <br><br>
                      <button type="button" class="btn btn-success" id="update_days">Update</button>
                      <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="days_loader"></i>

                    </div>
                            
                        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- modal -->
        <div class="modal fade" id="modal_work_days" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4 id="modal_msg">Company Work days updated successfully!</h4>
              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="yes_delete_position" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
              </div> -->
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function(){
            list_work_days();
            $('#update_days').on('click', set_work_days);
          })

          function set_work_days(){
            var company_id = localStorage.getItem('company_id');

            if($('#monday').is(':checked')){
                $('#monday').val('yes');
            }else{
              $('#monday').val('no');
            }

            if($('#tuesday').is(':checked')){
                $('#tuesday').val('yes');
            }else{
              $('#tuesday').val('no');
            }

            if($('#wednesday').is(':checked')){
                $('#wednesday').val('yes');
            }else{
              $('#wednesday').val('no');
            }

            if($('#thursday').is(':checked')){
                $('#thursday').val('yes');
            }else{
              $('#thursday').val('no');
            }

            if($('#friday').is(':checked')){
                $('#friday').val('yes');
            }else{
              $('#friday').val('no');
            }

            if($('#saturday').is(':checked')){
                $('#saturday').val('yes');
            }else{
              $('#saturday').val('no');
            }

            if($('#sunday').is(':checked')){
                $('#sunday').val('yes');
            }else{
              $('#sunday').val('no');
            }
                          
            var monday = $('#monday').val();
            var tuesday = $('#tuesday').val();
            var wednesday = $('#wednesday').val();
            var thursday = $('#thursday').val();
            var friday = $('#friday').val();
            var saturday = $('#saturday').val();
            var sunday = $('#sunday').val();

            // alert(monday);
            $('#days_loader').show();
            $('#update_days').hide();

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/add_company_workingdays",
                data: { "company_id": company_id, "monday" : monday, "tuesday" : tuesday, "wednesday" : wednesday, "thursday" : thursday, "friday" : friday, "saturday" : saturday, "sunday" : sunday},
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    
                    if (response.status == '200'){
                        
                       // alert('success');
                       

                      

                    }else if(response.status == '400'){
                        

                    } 

                    $('#modal_work_days').modal('show');
                    $('#days_loader').hide();
                    $('#update_days').show();   
                
                },

                error: function(response){
                  $('#days_loader').hide();
                    $('#update_days').show();
                    alert('Connection error');
                }        

            });
          }


          function list_work_days(){
            var company_id = localStorage.getItem('company_id');
          

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_company_working_days",
                data: { "company_id": company_id},
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    
                    if (response.status == '200'){
                        
                        $.each(response['data'], function(i, v){

                          // $("input[type='checkbox']").change(function(){
                          //      if($(this).attr('checked')){
                          //           $(this).val('yes');
                          //      }else{
                          //           $(this).val('no');
                          //      }
                          // });

                          // if($("input[type='checkbox']").is(':checked')){
                          //     $(this).val('yes');
                          // }else{
                          //   $(this).val('no');
                          // }

                          
                          if(response['data'][i]['monday'] == 'yes'){
                            $('#monday').attr('checked', 'checked');
                            $('#monday').val('yes');
                            
                            
                          }
                          if(response['data'][i]['monday'] == 'no'){
                             $('#monday').removeAttr('checked');
                             $('#monday').val('no');

                          }
                          if(response['data'][i]['tuesday'] == 'yes'){
                            $('#tuesday').attr('checked', 'checked');
                            $('#tuesday').val('yes');
                            
                          }
                          if(response['data'][i]['tuesday'] == 'no'){
                             $('#tuesday').removeAttr('checked');
                             $('#tuesday').val('no');
                          }
                          if(response['data'][i]['wednesday'] == 'yes'){
                            $('#wednesday').attr('checked', true);
                            $('#wednesday').val('yes');

  
                          }
                          if(response['data'][i]['wednesday'] == 'no'){
                             $('#wednesday').attr('checked', false);
                             $('#wednesday').val('no');

                          }
                          
                          if(response['data'][i]['thursday'] == 'yes'){
                            $('#thursday').attr('checked', true);
                             $('#thursday').val('yes');  
                            
                          }

                          if(response['data'][i]['thursday'] == 'no'){
                             $('#thursday').attr('checked', false);
                             $('#thursday').val('no');
                          }

                          if(response['data'][i]['friday'] == 'yes'){
                            $('#friday').attr('checked', true);
                            $('#friday').val('yes');   
                          }

                          if(response['data'][i]['friday'] == 'no'){
                             $('#friday').attr('checked', false);
                             $('#friday').val('no');
                          }

                          if(response['data'][i]['saturday'] == 'yes'){
                            $('#saturday').attr('checked', true);
                            $('#saturday').val('yes');   
                          }

                          if(response['data'][i]['saturday'] == 'no'){
                             $('#saturday').attr('checked', false);
                             $('#saturday').val('no');
                          }

                          if(response['data'][i]['sunday'] == 'yes'){
                            $('#sunday').attr('checked', true);
                            $('#sunday').val('yes');   
                          }

                          if(response['data'][i]['sunday'] == 'no'){
                             $('#sunday').attr('checked', false);
                             $('#sunday').val('no');
                          }
                          
                        });
                          

                       

                    }else if(response.status == '400'){
                        

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