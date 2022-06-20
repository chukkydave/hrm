<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id"
        content="341582025304-09693s1st8481k09g6qj5omt6h9tgoie.apps.googleusercontent.com">

    <title>NaHere | Human Resource Management Software </title>


    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto|Ubuntu" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="assets/admin_template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
    <!-- Font Awesome -->
    <link href="assets/admin_template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/admin_template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="assets/admin_template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="assets/admin_template/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/admin_template/build/css/custom.min.css" rel="stylesheet">



    <style type="text/css">
    .ui-autocomplete {
        z-index: 2147483647;
    }

    /*.ui-autocomplete-loading {
          background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
        }*/

    .typeahead,
    .tt-query,
    .tt-hint {
        width: 350px;
        padding: 8px 12px;
        font-size: 12px;
        line-height: 20px;
        border: 2px solid #ccc;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        outline: none;
    }



    .tt-query {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }



    .tt-dropdown-menu {
        width: 422px;
        margin-top: 12px;
        padding: 8px 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
    }



    .tt-suggestion.tt-cursor {
        color: #fff;
        background-color: #0097cf;

    }

    .tt-suggestion p {
        margin: 0;
    }

    .background {
        background-color: #fff;
    }

    .has-error {
        background-color: #f7cdcd;
    }

    .modal-header {
        padding: 9px 15px;

        border-bottom: 1px solid #eee;
        background-color: #0480be;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .green {
        color: green;
    }

    .gray {
        color: gray;
    }
    </style>

    <!-- jQuery -->
    <!-- remember: move to footer -->
    <!-- jQuery -->
    <script src="assets/admin_template/vendors/jquery/dist/jquery.min.js?v=1.1"></script>
    <!-- Bootstrap -->
    <script src="assets/js/common.js?v=1.3"></script>
    <script src="assets/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/admin_template/vendors/twbs-pagination-1.4.0/jquery.twbsPagination.js" type="text/javascript">
    </script>
    <script src="assets/js/jquery-ui.min.js?v=1"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- jQuery autocomplete -->
    <!-- <script src="assets/admin_template/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script> -->
    <script src="assets/admin_template/vendors/moment/min/moment.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>

    <script src="assets/admin_template/vendors/dropzone/dist/min/dropzone.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


    <script type="text/javascript">
    $(document).ready(function() {

        if (localStorage.getItem('user_id') == "" || localStorage.getItem('user_id') == null || localStorage
            .getItem('company_id') == "" || localStorage.getItem('company_id') == null) {

            //redirect user to login page
            window.location.href = site_url;

        } else {

            fetch_company_colors();


        }

        if (localStorage.getItem('profile_photo') == "" || localStorage.getItem('profile_photo') == null ||
            localStorage.getItem('profile_photo') == undefined) {

            $('#profile_img').attr('src', '/files/images/user_profile_images/sml_default_picture.png');

        } else {

            $('#profile_img').attr('src', '/files/images/user_profile_images/sml_' + localStorage.getItem(
                'profile_photo'));

        }


    });


    function fetch_company_colors() {

        var company_id = localStorage.getItem('company_id');

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "company/get_company_colours",
            data: {
                "company_id": company_id
            },
            timeout: 60000,

            success: function(response) {



                if (response.status == '200') {

                    var color = '#2A3F54';
                    if (response.data.middle_left_bar == '' || response.data.middle_left_bar == null) {
                        response.data.middle_left_bar = color;
                    }

                    if (response.data.body_color == '' || response.data.body_color == null) {
                        response.data.body_color = color;
                    }

                    if (response.data.bottom_left_bar == '' || response.data.bottom_left_bar == null) {
                        response.data.bottom_left_bar = color;
                    }

                    if (response.data.top_left_bar == '' || response.data.top_left_bar == null) {
                        response.data.top_left_bar = color;
                    }


                    $('.left_col').css('background', response.data.middle_left_bar);
                    $('body').css('background', response.data.body_color);
                    // $('a').css('background', response.data.body_color);
                    $('.sidebar-footer').css('background', response.data.bottom_left_bar);
                    $('.sidebar-footer a').css('background', response.data.bottom_left_bar);
                    $('.site_title').css('background', response.data.top_left_bar);
                    $('table.jambo_table thead').css('background', response.data.body_color);
                    $('ul.side-menu li a').children().css('background-color', response.data.body_color);


                    // fetch_company_colors();


                }


                can_company_access_page();

            },
            // objAJAXRequest, strError
            error: function(response) {

                alert('Connection error!');

            }

        });
    }


    function can_company_access_page() {

        var company_id = localStorage.getItem('company_id');
        var user_id = localStorage.getItem('user_id');
        var module_id = 19;

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "wms/can_company_access_module",
            data: {
                "company_id": company_id,
                "user_id": user_id,
                "module_id": module_id,
                "token": localStorage.getItem('token')
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);

                if (response.status == '200') {

                    //show details
                    $("#whole_body").fadeIn();
                    $(".container33").hide();

                    $(".right_col").css("min-height", $(window).height() - 51);

                    //2.
                    // fetch_user_module_roles();
                    fetch_company_colors();

                } else {

                    // alert("You do not have access to this module.");
                    $("#page_error_div").html(
                        '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;' +
                        response.msg);
                    $(".container33").hide();
                    $("#page_error_div").show();

                }

            },

            error: function(response) {

                // alert("You do not have access to this module");
                $("#page_error_div").html(
                    '<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; Connection Error. Please try again.'
                );
                $(".container33").hide();
                $("#page_error_div").show();
                // window.location.href = site_url+"/feeds";

            }

        });

    }


    function group_modules_users_can_access() {

        var user_id = localStorage.getItem('user_id');
        var company_id = localStorage.getItem('company_id');

        var pathArray = window.location.href.split('/');
        var username = pathArray[2].split('.')[0];

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "user/modules_users_can_access_within_company",
            data: {
                "user_id": user_id,
                "company_id": company_id
            },
            timeout: 60000,

            success: function(response) {
                console.log(response);
                if (response.status == '200') {


                    if (response.total_rows != 0) {

                        var k = 1;
                        var list_mds = "";
                        $.each(response.data, function(i, v) {


                            if (v.access_count == 1) {

                                var link_lk = ' href="' + site_url + '/' + v.module_landing_page +
                                    '" ';
                                var set_coy_class = "set_coy";

                            } else {

                                var link_lk = 'class="get_comp_list"';
                                var set_coy_class = "";

                            }


                            list_mds += '<li>   <a ' + link_lk + ' id="themodli_' + v.module_id +
                                '"  dir="' + v.module_abbrv + "-" + v.company_id + "-" + v
                                .company_name + '" class="' + set_coy_class +
                                '" >   <span class="image"><img src="../files/images/icons/' + v
                                .module_little_icon +
                                '" alt=""></span>     <span>        <span><b>' + v.module_abbrv +
                                '</b></span> </span>       <span class="message">' + v
                                .module_full_name +
                                '</span>                      </a>          </li>';



                            list_mds += '<span id="comp_todi_' + v.module_id +
                                '" style="display: none">';
                            $.each(v.more_comp_list, function(i2, v2) {
                                list_mds +=
                                    '<li class="" style="display:"><a href="https://employee.ng/' +
                                    v2.landing_page + '" class="set_coy"   dir="' + v
                                    .module_abbrv + "-" + v2.company_id + "-" + v2
                                    .comp_name + '" >' + v2.comp_name + '</a></li>';
                            });
                            list_mds += '</span>';




                            k++;

                        });

                        $(".fst_dd").append(list_mds + '<li><div class="text-center"><a href="https://' +
                            username +
                            '.employee.ng/user/modules_list4"><strong>Add More Apps </strong><i class="fa fa-angle-right"></i></a></div></li>'
                        );
                        // $( list_mds ).insertAfter( ".fst_dd" );
                        $("#feed_tg").attr("href", site_url + "/feeds");



                    } else {

                        // alert("No sd");

                    }

                    $('#whole_body').show();


                } else {

                    // alert("You do not have access to this module");
                    // $('#whole_body').html('<font color="black">You do not have access to this module</font>');

                }

            },

            error: function(response) {
                // alert("error");
                // console.log(response);
                // alert("You do not have access to this module");
                // $("#whole_body").html('<font color="black">You do not have access to this module</font>');
            }

        });

    }

    function can_user_access_this_module() {

        var company_id = localStorage.getItem('company_id');
        var user_id = localStorage.getItem('user_id');
        var module_id = 13;

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "user/can_user_access_this_module",
            data: {
                "company_id": company_id,
                "user_id": user_id,
                "module_id": module_id,
                "token": localStorage.getItem('token')
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);

                if (response.status == '200') {

                    group_modules_users_can_access();

                    $("#whole_body").show();
                    $('#user_name').html(localStorage.getItem('firstname') + ' ' + localStorage.getItem(
                        'lastname'));

                    //2.
                    fetch_user_module_roles();


                } else {

                    alert("You do not have access to this module");
                    $('#whole_body').html(
                        '<font color="black">You do not have access to this module</font>');
                    window.location.href = site_url;

                }

            },

            error: function(response) {
                alert("You do not have access to this module");
                $("#whole_body").html('<font color="black">You do not have access to this module</font>');
                window.location.href = site_url;
            }

        });

    }




    function fetch_user_module_roles() {

        var company_id = localStorage.getItem('company_id');
        var user_id = localStorage.getItem('user_id');
        var module_id = 13;

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "user/get_user_roles_in_modules",
            data: {
                "company_id": company_id,
                "user_id": user_id,
                "module_id": module_id
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);

                if (response.status == '200') {

                    var k = 1;
                    $.each(response['data'], function(i, v) {

                        if (v.role_id == 8) { //a
                            $("#settings_tab").show();
                        }

                        if (v.role_id == 6) { //Procurement
                            $("#po_tab").show();
                        }

                        if (v.role_id == 7) { //Warehouse manager
                            $("#incoming_tab").show();
                            $("#outgoing_tab").show();
                            $("#qty_adjustment").show();
                        }

                        if (v.role_id == 9) { //Procurement
                            $("#invoice_tab").show();
                        }

                        k++;
                    });


                } else if (response.status == '400') {


                } else if (response.status == "401") {


                }

            },

            error: function(response) {


            }

        });
    }


    // $(document).ready(function(){

    //     user_access();

    // });

    // function user_access(){

    //   var user_id = localStorage.getItem('user_id');
    //   var company_id = localStorage.getItem('company_id');
    //   var firstname = localStorage.getItem('firstname');
    //   var lastname = localStorage.getItem('lastname');

    //   var link = base_url+"modules";


    //   $.ajax({

    //       type: "POST",
    //       dataType: "json",
    //       url: api_path+"accesscontrol/perm_controls",
    //       data: {"user_id" : user_id},
    //       timeout: 60000, // sets timeout to one minute

    //       error: function(response){
    //         localStorage.clear();
    //         window.location.href = site_url;
    //           alert('Connection error');

    //       },

    //       success: function(response) {

    //           console.log(response);
    //           if(response.status == '200'){

    //             function status(string) {
    //                 return string.charAt(0).toUpperCase() + string.slice(1);
    //             }
    //             // alert('success');
    //             if(!user_id){

    //               $('body').addClass('background');
    //               window.location.href = site_url;

    //             }else if(user_id !== undefined && location.href == link && company_id == undefined){

    //               window.location.href = base_url;

    //             }else{

    //               // $('#username').html(status(firstname)+' '+status(lastname)+' <span class=" fa fa-angle-down"></span>');

    //               $('body').fadeIn();
    //             } 

    //           }else if(response.status == '401'){

    //               $('body').hide();
    //               window.location.href = site_url+"/cv/edit";

    //           }else{

    //               alert('No module access');
    //               window.location.href = site_url+"/user"; 
    //           }

    //       }
    //   }); 
    // }

    //  function hrm_access(){
    //   var user_id = localStorage.getItem('user_id');
    //   var comp_id = localStorage.getItem('company_id');

    //   if(!(user_id && comp_id)){

    //     $('body').addClass('background');
    //     document.title = 'Employee.ng';
    //     window.location.href = site_url;
    //   }else{
    //     $('body').show();
    //   } 
    //  }

    //  function user_module_access(){

    //   var user_id = localStorage.getItem('user_id');
    //   var company_id = localStorage.getItem('company_id');
    //   var module_id = 13;

    //   $.ajax({

    //       type: "POST",
    //       dataType: "json",
    //       url: api_path+"user/check_if_user_has_access_to_a_module ",
    //       data: {"company_id": company_id, "user_id" : user_id, "module_id" : module_id},
    //       timeout: 60000, // sets timeout to one minute

    //       error: function(response){
    //           alert('Connection error');
    //       },

    //       success: function(response) {


    //           if(response.status == '200'){

    //             // alert('success');

    //           }else{

    //               alert('No module access');
    //               window.location.href = site_url+"/user";        
    //           }

    //       }
    //   }); 
    // }

    // function company_module_access(){
    //   var company_id = localStorage.getItem('company_id');
    //   var module_id = 13;

    //   $.ajax({ 
    //       type: "POST",
    //       dataType: "json",
    //       url: api_path+"user/check_if_company_has_access_to_a_module ",
    //       data: {"company_id": company_id, "module_id" : module_id},
    //       timeout: 60000, // sets timeout to one minute

    //       error: function(response){
    //           alert('Connection error');
    //       },

    //       success: function(response) {


    //           if(response.status == '200'){

    //             // alert('success');

    //           }else{

    //               alert('No module access');
    //               window.location.href = site_url+"/user";        
    //           }

    //       }
    //   }); 
    // } 
    </script>
    <!-- Bootstrap -->
    <!-- <script src="assets/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->

</head>



<body class="nav-md" style="display: none;" id="whole_body">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>HRM</span></a>
                    </div>

                    <div class="clearfix"></div>



                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">

                            <ul class="nav side-menu">
                                <li><a href="/hrm/"><i class="fa fa-home"></i> Dashboard</a></li>

                                <li><a href="employees"><i class="fa fa-users"></i> Employees </a></li>

                                <li><a href="leaves"><i class="fa fa-edit"></i> Leaves </a></li>

                                <li><a href="exits"><i class="fa fa-user"></i> Terminations </a></li>

                                <li><a href="grievances"><i class="fa fa-edit"></i> Grievances </a></li>

                                <li><a href="attendance"><i class="fa fa-bell-o"></i>Attendance</a></li>

                                <!-- <li><a href="hrm/payroll"><i class="fa fa-edit"></i> Payroll </a></li> -->


                                <li><a><i class="fa fa-user"></i> HR Settings <span
                                            class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">
                                        <li><a href="job_title">Job Titles</a></li>
                                        <li><a href="departments">Departments</a></li>
                                        <li><a href="set_work_days">Set Work Days</a></li>
                                        <li><a href="leave_types">Leave Types</a></li>
                                        <li><a href="company_branches">Company Branches</a></li>
                                        <li><a href="employement_type">Employment Types</a></li>
                                        <li><a href="salary_component">Employee Payment Types</a></li>
                                        <!-- <li><a href="hrm/access_levels">Access Levels</a></li> -->
                                        <li><a href="emp_doc_type">Employee Doc Types</a></li>
                                        <li><a href="company_holidays">Company Holidays</a></li>
                                        <li><a href="work_shift">Work Shifts</a></li>

                                    </ul>

                                </li>


                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small" id="footer_logout">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout"
                            onclick="localStorage.clear();  window.location.href = site_url ">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>

                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false" id="username">
                                    <img src="" alt="" id="profile_img"><span class=" fa fa-angle-down"></span>

                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right" id="user_list">

                                    <li style="background-color: ">
                                        <a onclick="window.location.href = site_url+'/user/myprofile'">
                                            <i class="fa fa-pencil pull-right"></i><b id="user_name"></b>
                                        </a>
                                    </li>

                                    <li><a onclick="window.location.href = site_url+'/user/change_password'">Change
                                            Password</a></li>
                                    <li><a
                                            onclick="function hi(){ localStorage.clear(); window.location.href = site_url}; hi();"><i
                                                class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    <!-- <img style="display:none;"
                    onload="show_login_status('Google', true)"
                    onerror="show_login_status('Google', false)"
                    src="https://accounts.google.com/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&followup=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&chtml=LoginDoneHtml&checkedDomains=youtube&checkConnection=youtube%3A291%3A1"
                    /> -->


                                </ul>
                            </li>



                            <li role="presentation" class="dropdown">

                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-th fa-3x"></i>
                                    <!-- <span class="badge bg-red">0</span> -->
                                </a>

                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list fst_dd" role="menu">
                                    <li class="">
                                        <a id="feed_tg" href="">
                                            <span class="image"><img src="../files/images/icons/feeds_icon.png"
                                                    alt=""></span>
                                            <span>
                                                <span><b>Feeds</b></span>

                                            </span>
                                            <span class="message">
                                                Notifications Feeds
                                            </span>
                                        </a>
                                    </li>
                                </ul>

                            </li>


                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->