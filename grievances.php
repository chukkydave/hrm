<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Grievances </h3>
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
                            
                            <th class="column-title">ID </th>
                            <th class="column-title">By </th>
                            <th class="column-title">&nbsp; </th>
                            <!-- <th class="column-title">Branch </th> -->
                            <th class="column-title">Against</th>
                            <th class="column-title">&nbsp; </th>
                            <th class="column-title">Correspondence </th>
                            <th class="column-title">Displinary </th>
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="8">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="grievanceData">
                          <tr>
                            <td colspan="8" id="load"><i class="fa fa-spinner fa-spin fa-fw fa-3x"></i></td>
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
            list_of_grievance();
          })

          function list_of_grievance(){
            var company_id = localStorage.getItem('company_id');
            var page = 1;
            var limit = 10;

              $('#load').show();
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
                        $('#load').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            
                            $.each(response['data'], function (i, v) {

                              
                                // var incident_date = new Date(response['data'][i]['incident_date']);
                                // var response_date = new Date(response['data'][i]['grievance_hr_response_date']);
                            


                              strTable += '<tr>';
                              strTable += '<td>'+response['data'][i]['g_code']+'</td>';
                              strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+site_url+'/files/images/employee_images/sml_'+response['data'][i]['grievance_person_picture']+'" alt="..." width="50"></div></td>';
                              strTable += '<td>'+response['data'][i]['grievance_person_fullname']+'<br>on:'+response['data'][i]['incident_date']+'</td>';
                              strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+site_url+'/files/images/employee_images/sml_'+response['data'][i]['grievance_person_against_picture']+'" alt="..." width="50"></div></td>';
                              strTable += '<td>'+response['data'][i]['grievance_person_against_fullname']+'<br>on:'+response['data'][i]['grievance_hr_response_date']+'</td>';
                              strTable += '<td></td>';
                              strTable += '<td>Pending</td>';
                              strTable += '<td></td>';
                              
                              strTable += '</tr>';  

                                


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="9">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#load').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="8">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();
                        

                    }    
                
                },

                error: function(response){
                  var strTable = "";
                  $('#load').hide();
                  strTable += '<tr>';
                  strTable += '<td colspan="8" class="text-danger">Connection error</td>';
                  strTable += '</tr>';
                  $("#grievanceData").html(strTable);
                  $("#grievanceData").show();
                }        

            });
          }


        </script>
<?php
include("_common/footer.php");
?>         