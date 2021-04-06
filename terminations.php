<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Terminations </h3>
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
                    
                    <button type="button" class="btn btn-success" id="add_termination">Add Termination</button>
                    
                    
                  </div>
                </div>
              </div>
            </div>

            <div id="termination_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee">Employee<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="sel_employee" name="sel_employee">
                            <option>-- Select --</option>
                            
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">Date of Termination <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="dot" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reason">Reason<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="reason">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">
                        
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_terminate">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="termination_loader"></i>
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
                            
                            <th class="column-title">ID</th>
                            <th class="column-title">&nbsp; </th>
                            <th class="column-title">Employee </th>
                            <th class="column-title">Reason </th>
                            <!-- <th class="column-title">Inserted By </th> -->
                            <th class="column-title">Inserted</th>
                            <th class="column-title">Termination Date</th>
                            <th class="column-title">Approvals</th>
                            
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="9">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                          <tr id="load" style="display:none;">
                            <td colspan="9"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                          </tr>
                        <tbody id="terminationData">
                        
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
        <div class="modal fade" id="modal_termination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Termination Added Successfully!</h4>
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
            list_of_terminations('');
            $('#add_termination').on('click', termination);

            $('input#dot').datepicker({
              dateFormat: "yy-mm-dd"
            });

            load_employee();
            $('#add_terminate').on('click', add_company_termination);  

            $(document).on('click', '.delete_termination', function(){
                var termination_id = $(this).attr('id').replace(/ter_/,''); // table row ID 
                delete_termination(termination_id);
            });
                      
          })

          function list_of_terminations(page){
            var company_id = localStorage.getItem('company_id');
            if(page == ""){
                var page = 1;
              }
              var limit = 25;

          $('#load').fadeIn(3000); 
            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/list_of_company_employees_termination",
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

                                strTable += '<tr id="row_'+response['data'][i]['termination_id']+'">';
                                strTable += '<td valign="top">'+response['data'][i]['termination_code']+'</td>';
                                 strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+site_url+'/files/images/employee_images/sml_'+response['data'][i]['profile_picture']+'" alt="..." width="50"></div></td>';
                                strTable += '<td width="20%" valign="top"><b>'+response['data'][i]['lastname']+'</b>'+ ", " +response['data'][i]['firstname']+ " " +response['data'][i]['middlename']+ '</td>';
                                strTable += '<td valign="top">'+response['data'][i]['reason']+'</td>';
                                // strTable += '<td valign="top">'+response['data'][i]['inserted_by']+'</td>';
                                strTable += '<td valign="top">'+response['data'][i]['notice_date']+'</td>';
                                strTable += '<td valign="top">'+format_a_date(response['data'][i]['resignation_date'])+'</td>';
                                strTable += '<td valign="top">'+response['data'][i]['total_pending_termination_approvals']+"/"+response['data'][i]['total_termination_sent_for_approvals']+'</td>';
                                strTable += '<td valign="top"><a href="'+base_url+'view_employee_termination_details?id='+response['data'][i]['termination_id']+'"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style=" color: gray; font-size: 20px;" title="View Employee Leave Details"></i></a> &nbsp;&nbsp;<a  class="delete_termination" style="cursor: pointer;" id="ter_'+response['data'][i]['termination_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Termination"></i></a></td>';
                                strTable += '</tr>';

                                strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['termination_id']+'">';
                                strTable += '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                                strTable +=  '</td>';
                                strTable += '</tr>';


                                k++;
                                 
                            });

                            // <a href="'+base_url+'/erp/hrm/employee_info"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;<a href="'+base_url+'/erp/hrm/edit_employee"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee"></i></a>&nbsp;&nbsp; 

                        }else{

                            strTable = '<tr><td colspan="9">No result</td></tr>';

                        }

                        // alert(response.total_rows);
                        // alert(limit);

                        $('#pagination').twbsPagination({
                          totalPages: Math.ceil(response.total_rows/limit),
                          visiblePages: 10,
                          onPageClick: function (event, page) {
                            list_of_terminations(page);
                          }
                        });
                        
                                  
                        $("#terminationData").html(strTable);
                        $("#terminationData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#load').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="9">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#terminationData").html(strTable);
                        $("#terminationData").show();
                        

                    }    
                
                },

                error: function(response){
                   var strTable = "";
                        $('#load').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="9"><strong class="text-danger">Connection error</strong></td>';
                        strTable += '</tr>';

                        
                        $("#terminationData").html(strTable);
                        $("#terminationData").show();
                }        

            });
          }

           function add_company_termination(){
            var employee_id = $('#sel_employee').val();
            var company_id = localStorage.getItem('company_id');
            var added_by = localStorage.getItem('user_id');
            var dot = $('#dot').val();
            var reason = $('#reason').val();

            // alert(employee_id);
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
    
              $('#error').html("You have a blank field");

              return; 

            }
         
          
          $('#add_terminate').hide();
          $('#termination_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"hrm/add_company_employee_termination",
            data: { "employee_id" : employee_id, "company_id" : company_id, "added_by" : added_by, "dot" : dot, "reason" : reason},

            success: function(response) {

              // console.log(response);

              if (response.status == '200') {


                $('#modal_termination').modal('show');

                $('#modal_termination').on('hidden.bs.modal', function () {
                    // do something…
                    $('#termination_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error').html("No result");

              }

               
              $('#add_terminate').show();
              $('#termination_loader').hide();

            },

            error: function(response){

              $('#add_terminate').show();
              $('#termmination_loader').hide();
              $('#error').html("Connection Error.");

            }

          });

          }

          function delete_termination(termination_id) {
             // alert('user deleted');
            // var email = $.session.get('email'); 
            var company_id = localStorage.getItem('company_id');
            // alert(employee_id);
            

            var ans = confirm("Are you sure you want to delete this user");
            if(!ans){
                return;
            }
            

            $('#row_'+termination_id).hide();
            $('#loader_row_'+termination_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_employee_termination",
                data: {"company_id": company_id, "termination_id" : termination_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+termination_id).hide();
                    $('#row_'+termination_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+termination_id).hide();
                }
            });
          }

          function termination(){
            $('#termination_display').toggle();
            $('#dot').val('');
            $('#employee').val('');
            $('#reason').val('');
            $('#error').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

          function load_employee(){

            var company_id = localStorage.getItem('company_id');
            var page = -1;
            var limit = 0;

             $.ajax({
                url: api_path+"hrm/list_of_company_employees",
                type: "POST",
                data: {"company_id" : company_id, "page" : page, "limit" : limit},
                dataType: "json",
                
                
                success: function (response) {
                    // console.log(response);
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['employee_id'] +'">' + response['data'][i]['firstname'] + " " + response['data'][i]['lastname'] + '</option>';
                    });
                    $('#sel_employee').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    // alert('Connection error');
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
            
    }
          
         
        </script>
<?php
include_once("../gen/_common/footer.php");
?>        