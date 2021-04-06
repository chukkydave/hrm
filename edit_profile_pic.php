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
                    <!-- <a href="employees"><button id="send" type="submit" class="btn btn-primary">Back</button></a> -->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Personal Profile </h2>
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
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="" alt="Avatar" title="Change the avatar" id="pflpct">
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none ; " id="pic_change_loader"></i>
                        </div>
                      </div>
                      <!-- <h3>Samuel Doe</h3> -->
                      <br>
                      <ul class="list-unstyled user_data" id="profile_links" style="display: none;">
                        
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                    

                    </div>


                    <div class="col-md-9 col-sm-9 col-xs-12">
                        
                      <div class="x_content">
	                    <p>Drag a picture to the box below.</p>
                      
	                    <form action="../api/hrm/upload_images?to_where=employee_picture" class="dropzone" id="employeepictureform"></form>
	                    <br />
	                    <br />
	                    <br />
	                    <br />
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

      <div id="employee_data_display" style="display: none;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-info alert-dimissible fade-in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true"></span>
                  </button>
                  <strong>No Employee Info Found</strong>
                </div>
              </div>
            </div>
          </div>
        </div>   
      </div>





       
        <!-- modal -->
        <div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4> Upload Successful!</h4>
              </div>
            </div>
          </div>
        </div>



        <script type="text/javascript">
            
          $(document).ready(function() {


            fetch_employee_profile_pics_details();

            Dropzone.options.employeepictureform = {

              maxFiles: 1,
              accept: function(file, done) {
                if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "image/gif"){
                  alert("You are allowed to drag only images");
                }else{
                  done();
                }
                
              },
              init: function() {

                this.on("maxfilesexceeded", function(file){
                    alert("No more files please!");
                });

                // this.on("sending", function(file, xhr, data) {
                //     data.append("company_id", $.session.get('id'));
                // });

                this.on("sending", function(file, xhr, formData) {

                  formData.append("company_id", localStorage.getItem('company_id'));

                  // var pathArray = window.location.pathname.split( '/' );
                  // var employment_type_id = $.urlParam('id');
                  formData.append("employee_id", $.urlParam('id') );

                });
              },
              success: function(file, response){

                var obj = jQuery.parseJSON(response);
                if(obj.status == "200"){
                  $("#pflpct").attr("src", "" );
                  $("#pflpct").attr("src", site_url+"/files/images/employee_images/mid_"+obj.data.image_name+"?t="+ new Date().getTime() );
                  $("#pflpct").attr("width", "250px" );
                }
                console.log(obj);

              }

            };
            
          });

          

         function fetch_employee_profile_pics_details(){
    
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
                    
                    if (response.status == '200'){
                      
                        // alert(response.data.firstname);
                        $('#profile_name').html('Edit <b>' +response.data.firstname+' ' +response.data.lastname+ '</b>  Profile');

                        $("#pflpct").attr("src", site_url+"/files/images/employee_images/"+response.data.profile_picture );
                        $("#pflpct").attr("width", "250px" );

                        // $("#profile_picture").attr("src", "https://www.paperlack.com.ng/files/images/employee_images/"+response.data.profile_picture);  

                        str2 +=  '<a href="employees"><button id="send"  class="btn btn-default">Back</button></a>';
                        str2 += '<a href="employee_info?id='+response.data.employee_id+'"><button id="send"  class="btn btn-primary">View Profile</button></a>';
                        

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
              
              
          }          


        </script>
<?php
include("_common/footer.php");
?>         
