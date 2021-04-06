<?php
include("_common/header.php");
?> 
        <div id="page_loader" style="display: ;">

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
      </div>

         <!-- page content -->
         <div id="employee_details_display" style="display: none;">
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 id="profile_name"></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right" id="button_link">
                    
                    <!-- <button id="send" type="submit" class="btn btn-success">Send CV</button> -->
                    <!-- <button id="send" type="submit" class="btn btn-success">View Profile</button> -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Personal Profile <small>Activity report</small></h2>


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
                  </div> -->
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img" id="picture">
                        
                      </div>
                      <!-- <h3>Samuel Doe</h3> -->
                      <br>
                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                      

                    </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="table-responsive" >
                          <table class="table table-striped jambo_table bulk_action">

                            <thead>
                              <tr class="headings">
                                <!-- <th>
                                  <input type="checkbox" id="check-all" class="flat">
                                </th> -->
                                <th class="column-title">Payment Type</th>
                                <th class="column-title">Credit or Debit</th>
                                <th class="column-title">Amount Paid</th>
                                <!-- <th class="column-title">Frequency</th> -->
                                
                                
                                <!-- <th class="column-title no-link last"><span class="nobr">Actions</span> -->
                                </th>
                                <th class="bulk-actions" colspan="3">
                                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                                
                              </tr>

                            </thead>

                            


                            <tbody  id="salaryData" style="display: none">
                              <tr>
                                <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loading"></i>
                                </td>
                              </tr>


                              
                            </tbody>
                          </table>

                      <!-- <div class="ln_solid"></div> -->

                      
                      
                    </div>
                    <br>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_type">Payment Frequency <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="payment_frequency">
                            <option value="">-- Select Payment Frequency --</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">
                          
                        </div>
                      </div>

                      <!-- <div class="ln_solid"></div> -->
                      <br><br>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!-- <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button> -->
                            <button type="button" class="btn btn-success" id="upd_sal">Update</button>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loader"></i>
                          </div>
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


       
        <!-- modal -->
        <div class="modal fade" id="modal_salary_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Salary Info Updated Successfully!</h4>
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

            fetch_employee_edit_details_for_salary_info();
            fetch_employment_info();
            fetch_frequency_types();
            list_of_company_salary_walfare();
            get_employee_info();

            $('#upd_sal').on('click', add_salary_info);

          });

          function fetch_employee_edit_details_for_salary_info(){
              
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
                    
                      $('#page_loader').hide();
                      $('#employee_details_display').show();
                      
                      var str = "";
                      var str2 = "";
                      var str3 = "";
                      if (response.status == '200'){
                        
                         $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b>'); 

                           str2 +=  '<a href="'+base_url+'employees"><button id="send"  class="btn btn-default">Back</button></a>';
                           str2 += '<a href="'+base_url+'view_salary_info?id='+response.data.employee_id+'"><button id="send" class="btn btn-primary">View</button></a>';

                           str3 += '<div id="crop-avatar">';
                             
                           str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.profile_picture+'" alt="...">';
                           str3 += '</div>';
                           
                           // str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                           // str += '<a href="'+base_url+'employee_info?id='+response.data.employee_id+'">Profile</a></li>';
                           
                           // str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                           // str +=  '<a href="'+base_url+'view_employment_info?id='+response.data.employee_id+'">Employment Info</a></li>';

                           // str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                           // str +=  '<a href="'+base_url+'view_salary_info?id='+response.data.employee_id+'">Salary Info</a></li>';
                           
                           // str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
                           // str +=  '<a href="'+base_url+'view_salary_history?id='+response.data.employee_id+'">Payslips</a></li>';
                           
                           // str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
                           // str += '<a href="'+base_url+'view_leave_history?id='+response.data.employee_id+'">Leave History</a></li>';
                          
                           

                           // str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
                           // str +=  '<a href="'+base_url+'view_position_history?id='+response.data.employee_id+'">Job Title History</a></li>';        

                           // str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                           // str += '<a href="'+base_url+'emp_documents?id='+response.data.employee_id+'">Documents</a></li>';

                           // str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
                           // str += '<a href="'+base_url+'view_attendance?id='+response.data.employee_id+'">Attendance</a></li>';

                        $("#button_link").html(str2);
                        $("#picture").html(str3);
                        $("#profile_links").html(str);
                        $("#profile_links").show();     
                                   

                          
                      }else if(response.status == '400'){
                        $('#page_loader').hide();
                          $('#employee_details_display').hide();
                          $('#employee_data_display').show();
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

          function get_employee_info(){
    
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            
            // alert(employee_id);
            // $('#page_loader').hide();
            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/fetch_company_employee_profile",
                data: {"company_id": company_id, "employee_id": employee_id},
                timeout: 60000,

                success: function(response) {
                    
                  console.log(response);
                  
                  $("#payment_frequency").val(response.data.payment_frequency);
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                    
                }        

            });
        }

          function fetch_frequency_types(){

             $.ajax({
                url: api_path+"hrm/list_payroll_frequency_types",
                type: "POST",
                data: { },
                dataType: "json",
                
                
                success: function (response) {
                    console.log(response);
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['payroll_id'] +'">' + response['data'][i]['payroll_name'] +'</option>';
                    });
                    $('#payment_frequency').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    alert('Connection error..');
                }
            });
          }

         
          function add_salary_info(){
            
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            var payment_frequency = $('#payment_frequency').val();

            
            var arr = [];


            $(".num_field").each(function(){


              var the_amount = $(this).val();
              var payment = $(this).attr("id").replace(/amt_/,'');

              arr.push({
                amount: the_amount,
                payment_type_id: payment
              });
  
            });

            var arr2 = new Array();
            arr2['payment_details'] = arr;

            console.log(arr);

            if(payment_frequency == ""){
              alert("Payment Frequency Must Be Selected");
              return;
            }
                         
          
            $('#upd_sal').hide();
            $('#loader').show();

            



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/update_employee_salary_welfare",
            data: {"payment_details" : arr2['payment_details'], "payment_frequency" : payment_frequency, "employee_id" : employee_id, "company_id" : company_id },

            success: function(response) {

              console.log(response);

              if (response.status == '200') {


                $('#modal_salary_info').modal('show');

                $('#modal_salary_info').on('hidden.bs.modal', function () {
                    // do something…
                    
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error').html(response.msg);

              }

               
              $('#upd_sal').show();
              $('#loader').hide();

            },

            error: function(response){

              $('#upd_sal').show();
              $('#loader').hide();
              $('#error').html("Connection Error.-");

            }

          });

          }


          function fetch_employment_info(){
    
            var company_id = localStorage.getItem('company_id');
            // var pathArray = window.location.pathname.split( '/' );
            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
            
            // alert(employee_id);
            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/fetch_company_employee_employment_info",
                data: {"company_id": company_id, "employee_id": employee_id},
                timeout: 60000,

                success: function(response) {
                    // console.log(response);
                     $('#page_loader').hide();
                    $('#employee_details_display').show();
                    
                    var str = "";
                    
                    if (response.status == '200'){
                      

                      str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
                      str += '<a href="'+base_url+'employee_info?id='+employee_id+'">Profile</a></li>';
                      
                      str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                      str +=  '<a href="'+base_url+'view_employment_info?id='+employee_id+'">Employment Info</a></li>';

                      str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
                      str +=  '<a href="'+base_url+'view_salary_info?id='+employee_id+'">Salary Info</a></li>';
                      
                      str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
                      str +=  '<a href="'+base_url+'view_salary_history?id='+employee_id+'">Payslips</a></li>';
                      
                      str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
                      str += '<a href="'+base_url+'view_leave_history?id='+employee_id+'">Leave History</a></li>';
                      
                      

                      str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
                      str +=  '<a href="'+base_url+'view_position_history?id='+employee_id+'">Job Title History</a></li>';        

                      str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
                      str += '<a href="'+base_url+'emp_documents?id='+employee_id+'">Documents</a></li>';

                      str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
                      str += '<a href="'+base_url+'view_attendance?id='+employee_id+'">Attendance</a></li>';

                      str += '<li>';
                      str +=  '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
                       str += '<a href="'+base_url+'edit_profile_pic?id='+employee_id+'">Edit Profile Picture</a>';
                      str += '</li>';


                      
                      $("#profile_links").html(str);
                      $("#profile_links").show();     
                                 

                    }else if(response.status == '400'){
                        $('#page_loader').hide();
                        $('#employee_details_display').hide();
                        $('#employee_data_display').show();
                    }    
                    
                },
                // objAJAXRequest, strError
                error: function(response){
                    $('#page_loader').hide();
                        $('#employee_details_display').hide();
                        $('#employee_data_display').show();
                    
                }        

            });
        }

          function list_of_company_salary_walfare(){
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
             // var pathArray = window.location.pathname.split( '/' );

            var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
           

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/fetch_company_employee_SalaryWelfare",
                data: { "company_id": company_id, "user_id" : user_id, "employee_id" : employee_id},
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                              strTable += '<tr class="salary_id" id="'+response['data'][i]['sal_wel_type_id']+'">';
                              strTable += '<td>'+response['data'][i]['sal_wel_type']+'</td>';

                              strTable += '<td>'+response['data'][i]['sal_wel_credit_or_debit']+'</td>';
                              
                              strTable += '<td width="25%"><input type="number" id="amt_'+response['data'][i]['sal_wel_type_id']+'"  class="num_field" value="'+response['data'][i]['sal_wel_emp_amount']+'"></td>';
                              strTable += '<input type="hidden" id="pay_'+response['data'][i]['sal_wel_type_id']+'"value="'+response['data'][i]['sal_wel_type_id']+'">';
                              
                              strTable += '</tr>';


                                k++;
                                 
                            });

                        }else{

                            strTable = '<tr><td colspan="3">'+response.msg+'</td></tr>';

                        }
                        
                                   
                        $("#salaryData").html(strTable);
                        $("#salaryData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="3">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#salaryData").html(strTable);
                        $("#salaryData").show();
                        

                    }    
                
                },

                error: function(response){
                    var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="3"><strong class="text-danger">Connection error</strong></td>';
                        strTable += '</tr>';

                        
                        $("#salaryData").html(strTable);
                        $("#salaryData").show();
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
              
            if ($('#mainb').length ){
              
                var echartBar = echarts.init(document.getElementById('mainb'), theme);

                echartBar.setOption({
                title: {
                  text: 'Naira',
                  subtext: '...'
                },
                tooltip: {
                  trigger: 'axis'
                },
                legend: {
                  data: ['Salary']
                },
                toolbox: {
                  show: false
                },
                calculable: false,
                xAxis: [{
                  type: 'category',
                  data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ]
                }],
                yAxis: [{
                  type: 'value'
                }],
                series: [{
                  name: 'Salary',
                  type: 'bar',
                  data: [ 700000.00,  2250000.00, 1130000.00 , 2000000.00 , 2000000.00 , 2000000.00 , 2000000.00 , 2000000.00, 2000000.00, 2000000.00, 2000000.00, 2000000.00 ],
                  markPoint: {
                  data: [{
                    type: 'max',
                    name: '???'
                  }, {
                    type: 'min',
                    name: '???'
                  }]
                  },
                  markLine: {
                  data: [{
                    type: 'average',
                    name: '???'
                  }]
                  }
                }
                ]
                });

            }
              

              
              
               //echart Pie
              
            if ($('#echart_pie').length ){  

              var company_id = localStorage.getItem('company_id');
              var echartPie = echarts.init(document.getElementById('echart_pie'), theme);

              $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"company/count_total_employee_for_each_company_employment_type",
                data: {"company_id": company_id},
                timeout: 60000,

                success: function(response) {

                  console.log(response);                

                  if (response.status == '200'){

                    if(response.data.length != 0){

                      var list_of_names = [];
                      var list_of_values = [];
                      $(response.data).each(function(index, value){
                        
                        list_of_names.push( value.name );
                        list_of_values.push({ value: Number(value.employee_count), name: value.name});

                      });


                      $("#ddsh_loading").hide(); //hidel loader



                      var echartDonut = echarts.init(document.getElementById('echart_pie'), theme);
            
                      echartDonut.setOption({
                      tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                      },
                      calculable: true,
                      legend: {
                        x: 'center',
                        y: 'bottom',
                        data: list_of_names
                      },
                      toolbox: {
                        show: true,
                        feature: {
                        magicType: {
                          show: true,
                          type: ['pie', 'funnel'],
                          option: {
                          funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'center',
                            max: 1548
                          }
                          }
                        },
                        restore: {
                          show: true,
                          title: "Restore"
                        },
                        saveAsImage: {
                          show: true,
                          title: "Save Image"
                        }
                        }
                      },
                      series: [{
                        name: 'Total',
                        type: 'pie',
                        radius: ['35%', '55%'],
                        itemStyle: {
                        normal: {
                          label: {
                          show: true
                          },
                          labelLine: {
                          show: true
                          }
                        },
                        emphasis: {
                          label: {
                          show: true,
                          position: 'center',
                          textStyle: {
                            fontSize: '14',
                            fontWeight: 'normal'
                          }
                          }
                        }
                        },
                        data: list_of_values
                      }]
                      });

                    }else{


                      //no data available

                    }

                  }else if(response.status == '400'){
                      
                  }    
                    
                },
                // objAJAXRequest, strError
                error: function(response){
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
        
        

            
        

