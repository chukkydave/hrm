<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Forward Leaves</h3>
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
                    
                    <a href="leaves"><button type="button" class="btn btn-primary">Back</button></a>
                    
                    
                  </div>
                </div>
              </div>
            </div>


            <div  style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    

                         

                    <!-- <div class="form-row">
                      <div class="col-sm-3 col-xs-4">
                        <button type="button" class="btn btn-success" id="filter">Search</button>
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="filter_loader"></i>
                      </div>

                    </div> -->

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

                    <div class="form-row">
        
                      <div class="col-sm-8 col-xs-4">
                        <h4><strong>Forward leaves to Approvers</strong></h4>
                      </div>

                    </div>
                    <br> <br> 

                    <div class="form-row">
        
                       <div id="fwd_list" style="width: 400px">
                                      
                      </div>
                      
                      <div id="submit_btn_div" style="display: none; width: 100%; float: left">         
                        <input type="submit" value="Submit" name="submit_forward" id="submit_forward">
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loading"></i>
                        
                      </div>

                    </div>
                    
                    
                    <div class="form-row">

                      <div class="col-sm-8 col-xs-4">
                        <input type="text" name="textfield" id="emp_search_field" class="fm_fld_style col-sm-8 col-xs-4 srch_emp" autocomplete="off" dir="leaves" title="" >
                      </div>
                   <!-- 
                      <div class="col-sm-8 col-xs-4">
                      
                      </div> -->
                   </div>

                   <div class="form-row">

                      <div id="emp_bx" class="col-sm-8 col-xs-4"></div>
                    
                   </div>
                  


                   <!-- <div style="margin-bottom: 30px; float: left; width: 100%"> -->
          
                      <!-- <table width="80%" border="0" cellspacing="0" cellpadding="5">
                      
                      <tr>
                        <td colspan="100%">
                        
                          <div id="fwd_list" style="width: 400px">
                                      
                          </div>
                          
                          <div id="submit_btn_div" style="display: none; width: 100%; float: left">         
                            <input type="submit" value="Submit" name="submit_forward" id="submit_forward">
                            <img src="https://paperlack.com/assets/img/designimg/loader111.gif" width="220" height="19" id="lddn" style="display: none" style="display: none"/>
                          </div>
                          
                        </td>
                      </tr>
                      
                          <tr>
                            <td width="70%">
                              <input type="text" name="textfield" id="emp_search_field" class="fm_fld_style  srch_emp" autocomplete="off" dir="leaves" title="" >
                              <input type="hidden" value="74" name="item_id" id="item_id" >
                            </td>
                            <td width="2%">&nbsp;</td>
                            <td width="28%">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td><div id="emp_bx" style="position: "></div></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>  -->     
                    <!-- </div> -->

                   <br><br><br><br> 

                   <div class="form-row">
        
                      <div class="col-sm-8 col-xs-4">
                        <h4><strong>Note: You may drag to rearrange approval order Fowarded for approval to:</strong></h4>
                      </div>

                    </div>
                    <br><br><br>

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Approver</th>
                            <th class="column-title">&nbsp; </th>
                            <th class="column-title">Date Sent</th>
                            <th class="column-title">Approval Status </th>
                            <th class="column-title">Date of Action</th>
                            
                            <th class="bulk-actions" colspan="5">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        
                        <tbody id="forwardData">
                          <tr>
                            <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="loading"></i></td>
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
        <script type="text/javascript">
          $(document).ready(function(){
            list_of_forward_leaves_applicant();
            // approval_autocomplete();
            // list_of_leaves_applicant();

            //  $(document).on('click', '.delete_leave', function(){
            //     var leave_id = $(this).attr('id').replace(/lev_/,''); // table row ID 
            //     delete_leave(leave_id);                

            // }); 

            //  $('#filter_leave').on('click', show_leave_filter_form); 
            //  load_employee_type();
            //  load_leave_type();

          })

          function approval_autocomplete(){
  
            var keyword = $.trim($('#keyword').val());
            // var the_purpose = $.trim($(this).attr("dir"));
            // var settings = $(this).attr("title");
            var company_id = localStorage.getItem('company_id');
            
            
            
            if(keyword != ""){
              
              $.ajax({
                type: "POST",
                url: api_path+"hrm/employee_autocomplete",
                data: { "keyword" : keyword , "company_id" : company_id},
                
                success:function(response){
                  console.log(response);
                  // if(data.indexOf("session_still_on") == -1){
                  //   window.location.href = linka;
                  // }else if(data != ""){
                  //   $("#emp_bx").html(data);
                  // }else{
                  //   $("#emp_bx").html("");
                  // }
                },
                error:function(jxhr){
                  alert("Error"); 
                }
              });
            }else{
              $("#emp_bx").html("");
            }
            
          }

           function list_of_forward_leaves_applicant(){
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var application_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_approvals",
                data: { "company_id": company_id, "application_id": application_id },
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();

                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {
                                  // var date = response['data'][i]['date_sent'].datepicker({
                                  //    dateFormat: "dd-m-yy"
                                  // })

                                

                                strTable += '<tr>';
                                strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';
                                strTable += '<td width="35%" valign="top"><b>'+response['data'][i]['approval_person']+'</b></td>';
                                strTable += '<td valign="top">'+response['data'][i]['date_sent']+'</td>';

                                if(response['data'][i]['approval_status'] == 'pending'){

                                  strTable += '<td><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" style="color: orange; font-size: 30px;" title="Forward Leave Applicant"></i></td>';

                                }else if(response['data'][i]['approval_status'] == 'yes'){

                                  strTable += '<td><i class="fa fa-check-circle"  data-toggle="tooltip" data-placement="top" style="color: green; font-size: 30px;" title="Forward Leave Applicant"></i></td>';

                                }

                                strTable += '<td valign="top">'+response['data'][i]['time_acted']+'</td>';
                                
                                strTable += '</tr>';


                              //   strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['leave_id']+'">';
                              // strTable += '<td colspan="9"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              // strTable +=  '</td>';
                              // strTable += '</tr>';


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="5">No record.</td></tr>';

                        }
                        
                        //  $('#pagination').twbsPagination({
                        //   totalPages: Math.ceil(response.total_rows/limit),
                        //   visiblePages: 10,
                        //   onPageClick: function (event, page) {
                        //     list_of_leaves_applicant(page);
                        //   }
                        // });
                                   
                        $("#forwardData").html(strTable);
                        $("#forwardData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="5">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#forwardData").html(strTable);
                        $("#forwardData").show();
                        

                    }    
                
                },

                error: function(response){
                    var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
                        strTable += '</tr>';

                        
                        $("#forwardData").html(strTable);
                        $("#forwardData").show();
                        
                }        

            });
          }

           
        
          function delete_leave(leave_id){
             
            var company_id = localStorage.getItem('company_id');
            
            
            var ans = confirm("Are you sure you want to delete?");
            if(!ans){
                return;
            }
            // $('#delete_modal_position').modal('show');

            $('#row_'+leave_id).hide();
            $('#loader_row_'+leave_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_employee_leave",
                data: {"company_id": company_id, "leave_id" : leave_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+leave_id).hide();
                    $('#row_'+leave_id).show();

                    // alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+leave_id).hide();
                }
            });
        }

         
        </script>
<?php
include("_common/footer.php");
?>         