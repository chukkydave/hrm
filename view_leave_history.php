<?php
include("_common/header.php");
?>       
      <!-- <div id="loader" style="display: ;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-spinner fa-spin fa-fw fa-4x"  ></i>
              </div>
            </div>
          </div>
        </div>   
      </div> -->

        <!-- page content -->
        <div id="employee_details_display" style="display: ;">
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 id="profile_name"></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right" id="button_link">
                    
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Leave History</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                      <div class="profile_img" id="picture">
                        
                      </div>
                      
                      <br>


                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <br />

                      

                    </div>


                    <div class="col-md-8 col-sm-8 col-xs-12">
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2>Leave Summary</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                  </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="graph_loading" ></i>
                              <div id="no_record" style="display: none;">
                                  <h3><strong>No record available</strong></h3>
                              </div>
                              <div id="leave-history" style="height:300px;"></div>

                            </div>
                          </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <!-- <div class="x_panel"> -->
                            <br>
                            <div class="x_content">

                              <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                      
                                      
                                      <th class="column-title">Leave Title</th>
                                      <th class="column-title">From</th>
                                      <th class="column-title">To</th>
                                      <th class="column-title">Days Used</th>
                                    
                                      
                                     
                                      <th class="bulk-actions" colspan="4">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                      </th>
                                    </tr>
                                  </thead>

                                  <tr id="loading">
                                    <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" ></i></td>
                                  </tr>
                                  
                                 <tbody  id="summaryData">
                                    
                                  
                                    
                                  </tbody>


                                </table>


                      <!-- <div class="container">
                          <nav aria-label="Page navigation">
                              <ul class="pagination" id="pagination"></ul>
                          </nav>
                      </div> -->


                          </div>

                            </div>
                          <!-- </div> -->
                        </div>
                  
   
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- /page content -->

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

        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employee Edited Successfully!</h4>
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
            init_echarts();
            fetch_employee_view_details_leave_history();
            
            list_employee_leave_history();             
            
          })


          function fetch_employee_view_details_leave_history(){
              
              var company_id = localStorage.getItem('company_id');
              // var pathArray = window.location.pathname.split( '/' );
              var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
              
              // alert(employee_id);
              $.ajax({
                  
                  type: "POST",
                  dataType: "json",
                  url: api_path+"hrm/fetch_company_employee_profile",
                  data: {"company_id": company_id, "employee_id": employee_id},
                  timeout: 60000,

                  success: function(response) {
                      // console.log(response);
                      $('#page_loader').hide();
                      $('#employee_details_display').show();
                     
                      var str = "";
                      var str2 = "";
                      var str3 = "";
                      
                      if (response.status == '200'){

                         str2 +=  '<a href="'+base_url+'employees"><button class="btn btn-default">Back</button></a>';
                         str2 += '<a href="'+base_url+'edit_job_titles?id='+response.data.employee_id+'"><button class="btn btn-primary">Edit</button></a>';

                         $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b>');
                         
                          str3 += '<div id="crop-avatar">';
                            
                          str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.profile_picture+'" alt="...">';
                          str3 += '</div>';
                          
                          str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'employee_info?id='+response.data.employee_id+'">Profile</a></li>';
                          
                          str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_employment_info?id='+response.data.employee_id+'">Employment Info</a></li>';


                          str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_salary_info?id='+response.data.employee_id+'">Salary Info</a></li>';
                          
                          str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_salary_history?id='+response.data.employee_id+'">Payslips</a></li>';
                          
                          str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'view_leave_history?id='+response.data.employee_id+'">Leave History</a></li>';
                          
                         
                          

                          str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
                          str +=  '<a href="'+base_url+'view_position_history?id='+response.data.employee_id+'">Job Title History</a></li>';        

                          str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'emp_documents?id='+response.data.employee_id+'">Documents</a></li>';

                          
                          str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
                          str += '<a href="'+base_url+'view_attendance?id='+response.data.employee_id+'">Attendance</a></li>';

                          str += '<li>';
                          str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                           str += '<a href="'+base_url+'edit_profile_pic?id='+response.data.employee_id+'">Edit Profile Picture</a>';
                          str += '</li>';
                          

                        $("#button_link").html(str2);
                        $("#picture").html(str3);
                        $("#profile_links").html(str);
                        $("#profile_links").show();            

                      }else if(response.status == '400'){
                          $('#page_loader').hide();
                          $('#employee_details_display').hide();
                          $('#employee_error_display').show();
                      }    
                      
                  },
                  // objAJAXRequest, strError
                  error: function(response){
                      $('#page_loader').hide();
                      $('#employee_details_display').hide();
                      $('#employee_error_display').show();
                      
                  }        

              });
          }
           

          function list_employee_leave_history(){

            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

            var page = 1;
            var limit = 10;
            

            $("#loading").show();
            $("#summaryData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"hrm/list_company_employee_leaves_history",
              data: { "company_id": company_id, "employee_id" : employee_id, "page" : page, "limit" : limit},
              timeout: 60000,

              success: function(response) {
                  
                  console.log(response);
                  $('#loading').hide();
                  var strTable = "";
                  
                  if (response.status == '200'){

                      if(response.data.length > 0){

                          var k = 1;
                          $.each(response['data'], function (i, v) {

                              strTable += '<tr>';
                              
                              strTable += '<td>'+response['data'][i]['leave_name']+'</td>';
                              

                              strTable += '<td>'+response['data'][i]['leave_start_date']+'</td>';

                              strTable += '<td>'+response['data'][i]['resumption_date']+'</td>';
                              strTable += '<td>'+response['data'][i]['real_days_used']+'</td>';
                              
                              strTable += '</tr>';


                              k++;
                               
                          });

                      }else{

                          strTable = '<tr><td colspan="4">No record.</td></tr>';

                      }


                      
                                 
                      $("#summaryData").html(strTable);
                      $("#summaryData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="4">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#summaryData").html(strTable);
                      $("#summaryData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="4">Technical Error</td>';
                      strTable += '</tr>';

                      
                      $("#summaryData").html(strTable);
                      $("#summaryData").show();

                  }


                  $("#loading").hide();
              
              },

              error: function(response){
                

                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="4"><strong class="text-danger">Connection error</strong></td>';
                strTable += '</tr>';

                
                $("#summaryData").html(strTable);
                $("#summaryData").show();
                $("#loading").hide();

              }        

          });
          }

          function init_echarts() {
            

              if( typeof (echarts) === 'undefined'){ return; }
              console.log('init_echarts');
            
          
                var theme = {
                color: [
                  '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
                  '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
                ],

                title: {
                  itemGap: 8,
                  textStyle: {
                    fontWeight: 'normal',
                    color: '#408829'
                  }
                },

                dataRange: {
                  color: ['#1f610a', '#97b58d']
                },

                toolbox: {
                  color: ['#408829', '#408829', '#408829', '#408829']
                },

                tooltip: {
                  backgroundColor: 'rgba(0,0,0,0.5)',
                  axisPointer: {
                    type: 'line',
                    lineStyle: {
                      color: '#408829',
                      type: 'dashed'
                    },
                    crossStyle: {
                      color: '#408829'
                    },
                    shadowStyle: {
                      color: 'rgba(200,200,200,0.3)'
                    }
                  }
                },

                dataZoom: {
                  dataBackgroundColor: '#eee',
                  fillerColor: 'rgba(64,136,41,0.2)',
                  handleColor: '#408829'
                },
                grid: {
                  borderWidth: 0
                },

                categoryAxis: {
                  axisLine: {
                    lineStyle: {
                      color: '#408829'
                    }
                  },
                  splitLine: {
                    lineStyle: {
                      color: ['#eee']
                    }
                  }
                },

                valueAxis: {
                  axisLine: {
                    lineStyle: {
                      color: '#408829'
                    }
                  },
                  splitArea: {
                    show: true,
                    areaStyle: {
                      color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                    }
                  },
                  splitLine: {
                    lineStyle: {
                      color: ['#eee']
                    }
                  }
                },
                timeline: {
                  lineStyle: {
                    color: '#408829'
                  },
                  controlStyle: {
                    normal: {color: '#408829'},
                    emphasis: {color: '#408829'}
                  }
                },

                k: {
                  itemStyle: {
                    normal: {
                      color: '#68a54a',
                      color0: '#a9cba2',
                      lineStyle: {
                        width: 1,
                        color: '#408829',
                        color0: '#86b379'
                      }
                    }
                  }
                },
                map: {
                  itemStyle: {
                    normal: {
                      areaStyle: {
                        color: '#ddd'
                      },
                      label: {
                        textStyle: {
                          color: '#c12e34'
                        }
                      }
                    },
                    emphasis: {
                      areaStyle: {
                        color: '#99d2dd'
                      },
                      label: {
                        textStyle: {
                          color: '#c12e34'
                        }
                      }
                    }
                  }
                },
                force: {
                  itemStyle: {
                    normal: {
                      linkStyle: {
                        strokeColor: '#408829'
                      }
                    }
                  }
                },
                chord: {
                  padding: 4,
                  itemStyle: {
                    normal: {
                      lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                        lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                        }
                      }
                    },
                    emphasis: {
                      lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                        lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                        }
                      }
                    }
                  }
                },
                gauge: {
                  startAngle: 225,
                  endAngle: -45,
                  axisLine: {
                    show: true,
                    lineStyle: {
                      color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                      width: 8
                    }
                  },
                  axisTick: {
                    splitNumber: 10,
                    length: 12,
                    lineStyle: {
                      color: 'auto'
                    }
                  },
                  axisLabel: {
                    textStyle: {
                      color: 'auto'
                    }
                  },
                  splitLine: {
                    length: 18,
                    lineStyle: {
                      color: 'auto'
                    }
                  },
                  pointer: {
                    length: '90%',
                    color: 'auto'
                  },
                  title: {
                    textStyle: {
                      color: '#333'
                    }
                  },
                  detail: {
                    textStyle: {
                      color: 'auto'
                    }
                  }
                },
                textStyle: {
                  fontFamily: 'Arial, Verdana, sans-serif'
                }
              };

              
              //echart Bar
              
            if ($('#leave-history').length ){
              
                var company_id = localStorage.getItem('company_id');
                // var pathArray = window.location.pathname.split( '/' );
                var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
                var echartBar = echarts.init(document.getElementById('leave-history'), theme);

                
                 $('#employee_details_display').hide();

                 $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/view_employee_leave_history_for_graph",
                data: {"company_id": company_id, "employee_id": employee_id},
                timeout: 60000,

                success: function(response) {
                    $('#graph_loading').hide(); 
                    $('#employee_details_display').show();
                    
                      console.log(response);
                    if (response.status == '200'){

                      if(response.data.length != 0){

                      var list_of_names = [];
                      var list_of_value_used = [];
                      var list_of_values_remaining = [];
                      $(response.data.leave_history).each(function(index, value){

                        
                        list_of_names.push( value.name );
                        list_of_value_used.push({ value: Number(value.real_days_used), label: "name"});
                        list_of_values_remaining.push({ value: Number(value.remaining_days), label: "name"});

                      });

                      
                      echartBar.setOption({
                          title: {
                            text: 'Employee',
                            subtext: 'Leave History'
                          },
                          tooltip : {
                              trigger: 'axis',
                              axisPointer : {            
                                  type : 'shadow'        
                              }
                          },
                          legend: {
                              data: ['Used Days', 'Remaining Days']
                          },
                          grid: {
                              left: '3%',
                              right: '4%',
                              bottom: '3%',
                              containLabel: true
                          },
                          xAxis:  {
                              type: 'value'
                          },
                          yAxis: {
                              type: 'category',
                              data: list_of_names
                          },
                          series: [
                              
                              {
                                  name: 'Used Days',
                                  type: 'bar',
                                  stack: 'name',
                                  label: {
                                      normal: {
                                          show: true,
                                          position: 'insideRight'
                                      }
                                  },
                                  data: list_of_value_used
                              },
                              {
                                  name: 'Remaining Days',
                                  type: 'bar',
                                  stack: 'name',
                                  label: {
                                      normal: {
                                          show: true,
                                          position: 'insideRight'
                                      }
                                  },
                                  data: list_of_values_remaining
                              }
                              
                          ]
                      });
    

                    }

            

                    }else if(response.status == '400'){
                      // alert('error');
                      $('#graph_loading').hide();
                      $('#no_record').show();      
                    }    
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                  // alert('error');
                  $('#graph_loading').hide();
                    // $('#employee_details_display').hide();
                    // $('#employee_error_display').show();
                    
                }        

            });
            }
            
      }
                 
  </script>
<?php
include("_common/footer.php");
?>   

