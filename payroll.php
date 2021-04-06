<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payroll </h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">

                    <button type="button" class="btn btn-primary" id="add_position">Filter</button>
                    
                    <button type="button" class="btn btn-success" id="add_position">Add</button>
                    
                    <button type="button" class="btn btn-success" id="add_position">Upload</button>

                    
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
                            
                            <th class="column-title">Date</th>
                            <th class="column-title">Employee</th>
                            <th class="column-title">Clock In</th>
                            <th class="column-title">Clock Out</th>
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="5">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="positionsData">
                          <!-- <tr>
                            <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display:none ;" id="loading"></i></td>
                          </tr> -->

                          <tr>
                            <td colspan="5">No record.</td>
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
            // list_of_positions();
          })

          function attendance(){
            var company_id = localStorage.getItem('company_id');
            var page = 1;
            var limit = 10;

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_employee_grievance",
                data: { "company_id": company_id, "page": page, "limit": limit },
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                              // strTable += '<tr>';
                              // strTable += '<td>GR10</td>';
                              // strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+base_url+'/erp/assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';
                              // strTable += '<td>'+response['data'][i]['grievance_person_fullname']+'</td>';
                              // strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+base_url+'/erp/assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';
                              // strTable += '<td></td>';
                              // strTable += '<td>Pending</td>';
                              // strTable += '<td></td>';
                              
                              // strTable += '</tr>';  

                                


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="5">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="5">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();
                        

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