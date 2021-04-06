<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="341582025304-09693s1st8481k09g6qj5omt6h9tgoie.apps.googleusercontent.com">

    <title>NaHere! | Human Resource Management Software </title>

    <link rel="icon" href="../favicon.png">
    <!-- <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../favicon.ico" type="image/x-icon"> -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto|Ubuntu" rel="stylesheet">

    <!-- Bootstrap -->
<!-- <link href="assets/admin_template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link href="assets/admin_template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/admin_template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="assets/admin_template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

    <link href="assets/admin_template/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="assets/admin_template/build/css/custom.min.css" rel="stylesheet">



    <script src="assets/js/echarts.js?v=883"></script>
   

    <style type="text/css">
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

        #page_error_div {
          width: 50%;
          height: 100px;
          margin: 100px auto;
          margin-top: calc(100vh / 2 - 50px);
          text-align: center;
        }




        .container33 {
          width: 80px;
          height: 100px;
          margin: 100px auto;
          margin-top: calc(100vh / 2 - 50px);
        }

        .block33 {
          position: relative;
          box-sizing: border-box;
          float: left;
          margin: 0 10px 10px 0;
          width: 12px;
          height: 12px;
          border-radius: 3px;
          background: #FFF;
        }

        .block33:nth-child(4n+1) { animation: wave 2s ease .0s infinite; }
        .block33:nth-child(4n+2) { animation: wave 2s ease .2s infinite; }
        .block33:nth-child(4n+3) { animation: wave 2s ease .4s infinite; }
        .block33:nth-child(4n+4) { animation: wave 2s ease .6s infinite; margin-right: 0; }

        @keyframes wave {
          0%   { top: 0;     opacity: 1; }
          50%  { top: 30px;  opacity: .2; }
          100% { top: 0;     opacity: 1; }
        }




        /*for sections*/
        div#navbar_div ul {
          padding: 0;
          margin: 0;
          list-style-type: none;
          position: relative;
        }
        div#navbar_div li {
          list-style-type: none;
          border-left: 2px solid #000;
          margin-left: 1em;
        }
        div#navbar_div li div {
          padding-left: 1em;
          position: relative;
        }
        div#navbar_div li div::before {
          content:'';
          position: absolute;
          top: 0;
          left: -2px;
          bottom: 50%;
          width: 0.75em;
          border: 2px solid #000;
          border-top: 0 none transparent;
          border-right: 0 none transparent;
        }
        div#navbar_div ul > li:last-child {
          border-left: 2px solid transparent;
        }
        /*end of for sections*/



        .costing_cnc {
          display: none;
        }



    </style>

    <!-- jQuery -->
    <!-- remember: move to footer -->
    <!-- jQuery -->
    <script src="assets/admin_template/vendors/jquery/dist/jquery.min.js?v=1.1"></script>
    <!-- Bootstrap -->
    <script src="assets/js/common.js?v=1.4"></script>
    <script src="assets/admin_template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/admin_template/vendors/twbs-pagination-1.4.0/jquery.twbsPagination.js" type="text/javascript"></script>
    <script src="assets/js/jquerysession.js?v=1"></script>
    <script src="assets/js/wms.js?v=2.0"></script>
    <script src="assets/js/jquery-ui.min.js?v=1"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- jQuery autocomplete -->
    <!-- <script src="assets/admin_template/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script> -->

    <script src="assets/admin_template/vendors/dropzone/dist/min/dropzone.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            //confirm user id and company id are available
            if (localStorage.getItem('user_id') == "" || localStorage.getItem('user_id') == null || localStorage.getItem('company_id') == "" || localStorage.getItem('company_id') == null) {

                //redirect user to feeds page if not available
                window.location.href = site_url+"/feeds";

            } else {

                can_company_access_page();   

            }

            $(document).on('click', '#switch', function() {
                $('#loading_dlv').show();
                $('#warehouse_dlv').html('');
                $('#modal_switch').modal('show');
                getListOfWarehouseUSerHasAccessTo();

            });

            $(document).on('click', '.enter_ware', function() {
                
                var warehouse_id = $(this).attr("id").replace(/enter_/, '');
                var warehouse_name = $(this).attr("dir").replace(/entername_/, '');
                localStorage.setItem('warehouse_id', warehouse_id);
                localStorage.setItem('warehouse_name', warehouse_name);
                // alert("Set to this - " + localStorage.getItem('warehouse_name'));
                window.location.href = base_url;

            });

            $(document).on('click', '.get_comp_list', function(){

              var id = $(this).attr("id").replace(/themodli_/,'');
              var compn_and_d = $(this).attr("dir").split("-");
              var module_name = compn_and_d[0];
              
              $("#list_comp_tables").html($("#comp_todi_"+id).html());
              $(".mdl_hdn").html("Which company's "+module_name+"?");
              $("#modal_choose_company").modal("show");
              
            });

            $(document).on('click', '.set_coy', function(){

              var compn_and_d = $(this).attr("dir").split("-");
              var company_id = compn_and_d[1];
              var md_landing_page = compn_and_d[2]
              localStorage.setItem('company_id', company_id);
              // alert(localStorage.getItem('company_id'));
              // localStorage.setItem('company_name', company_name);

              window.location.href = "../"+md_landing_page;
              
            });

        });

        function can_company_access_page() {

            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            var module_id = 13;

            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "wms/can_company_access_module",
                data: {
                    "company_id": company_id,
                    "user_id": user_id,
                    "module_id": module_id
                },
                timeout: 60000,

                success: function(response) {

                    // console.log(response);

                    if (response.status == '200') {

                        //show details
                        // $("#whole_body").fadeIn();
                        // $(".container33").hide();

                        //2.
                        can_user_access_this_module();


                        // fetch_user_module_roles();
                        // group_modules_users_can_access();
                        
                    } else {

                        $("#page_error_div").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;'+response.msg);
                        $(".container33").hide();
                        $("#page_error_div").show();

                    }

                },

                error: function(response) {

                    // alert("You do not have access to this module");
                    $("#page_error_div").html('<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; Connection Error. Please try again.');
                    $(".container33").hide();
                    $("#page_error_div").show();
                    // window.location.href = site_url+"/feeds";

                }

            });

        }


        function can_user_access_this_module(){
            //accesscontrol/check_if_user_has_access_to_a_module
            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "accesscontrol/check_if_user_has_access_to_a_module",
                data: {
                    "company_id": localStorage.getItem('company_id'),
                    "user_id": localStorage.getItem('user_id'),
                    "module_id": 13
                },
                timeout: 60000,

                success: function(response) {

                    if (response.status == '200') {
                        
                        $("#whole_body").fadeIn();
                        $(".right_col").css("min-height", $(window).height() - 51);
                        $(".container33").hide();

                        var user_permission_status = response.user_status;
                        //store this on the page
                        $("#user_perm_status").html(user_permission_status);
                        group_modules_users_can_access();
                        
                    } else {

                        $("#page_error_div").html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp;You do not have access to this company's Warehouse Management System. <a href='../feeds' style='color: white'><u>Back to Feeds</u></a>");
                        $(".container33").hide();
                        $("#page_error_div").show();

                    }

                },

                error: function(response) {

                    // alert("You do not have access to this module");
                    $("#page_error_div").html('<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; Connection Error. Please refresh page.');
                    $(".container33").hide();
                    $("#page_error_div").show();
                    // window.location.href = site_url+"/feeds";

                }

            });
        }


        function group_modules_users_can_access() {

            // return;

            var user_id = localStorage.getItem('user_id');
            var company_id = localStorage.getItem('company_id');

            var pathArray = window.location.href.split('/');
            var username = pathArray[2].split('.')[0];

            $.ajax({
                  
                type: "POST",
                dataType: "json",
                url: api_path+"user/group_modules_users_can_access",
                data: { "user_id" : user_id , "company_id" : company_id , "token" : localStorage.getItem('token') },
                timeout: 60000,

                success: function(response) {

                    console.log(response);

                    $('#user_name').html(localStorage.getItem('firstname')+' '+localStorage.getItem('lastname'));
                    $('#hi_user_name').html(localStorage.getItem('firstname'));
                    $('.hi_user_name').html(localStorage.getItem('firstname'));
                    
                    if (response.status == '200'){ 

                        if(response.total_rows != 0){

                            var k = 1;
                            var list_mds = "";
                            $.each(response.data, function (i, v) {


                                if(v.access_count == 1){

                                  var link_lk = 'class="get_comp_list"';
                                  var set_coy_class = "";

                                }else{

                                  var link_lk = 'class="get_comp_list"';
                                  var set_coy_class = "";

                                }


                                // if(v.module_id != 19){ //remove this particular module from the list

                                list_mds += '<li>   <a '+link_lk+' id="themodli_'+v.module_id+'"  dir="'+v.module_abbrv+"-"+v.company_id+"-"+v.company_name+'" class="'+set_coy_class+'" >   <span class="image"><img src="../files/images/icons/'+v.module_little_icon+'" alt=""></span>     <span>        <span><b>'+v.module_abbrv+'</b></span> </span>       <span class="message">'+v.module_full_name+'</span>                      </a>          </li>';



                                list_mds += '<span id="comp_todi_'+v.module_id+'" style="display: none">';
                                $.each(v.more_comp_list, function (i2, v2){
                                    list_mds += '<li class="" style="display:"><a class="set_coy"   dir="'+v.module_abbrv+"-"+v2.id+"-"+v2.landing_page+'" style="cursor: pointer" >'+v2.comp_name+'</a></li>';
                                });
                                list_mds += '</span>';

                                k++;

                            });

                            $(".fst_dd").append(list_mds+'<li><div class="text-center"><a href="/user/myapps"><strong>Add More Apps </strong><i class="fa fa-angle-right"></i></a></div></li>');
                            // $( list_mds ).insertAfter( ".fst_dd" );

                        }else{


                        }

                        // $('#whole_body').show();
                        
                        fetch_company_colors();           

                    }else{
                        
                        fetch_company_colors();

                    }
                  
                },
                error: function(response){
                    
                    fetch_company_colors();
                }        

            });

        }



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

                    console.log(response);

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

                        
                        
                        

                    }

                    $('#user_name').html(localStorage.getItem('firstname') + ' ' + localStorage.getItem('lastname'));

                    if (localStorage.getItem('profile_photo') == "" || localStorage.getItem('profile_photo') == null || localStorage.getItem('profile_photo') == undefined) {

                        $('#profile_img').attr('src', '/files/images/user_profile_images/sml_default_picture.png');

                    } else {

                        $('#profile_img').attr('src', '/files/images/user_profile_images/sml_' + localStorage.getItem('profile_photo'));

                    }

                    fetch_warehouse_list();

                },
                // objAJAXRequest, strError
                error: function(response) {

                    fetch_warehouse_list();
                    // alert('Error fetching customization!');

                }

            });
        }


        function fetch_warehouse_list() {

            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');


            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "wms/list_warehouses_user_connected",
                data: {
                    "company_id": company_id,
                    "user_id": user_id
                },
                timeout: 60000,

                success: function(response) {

                    console.log(response)

                    if (response.status == '200') {
                        
                        var warehouse_id;
                        var warehouse_name;


                        //if 
                        if (isEmptyObject(response.data)) {

                            $('#switch_tab').hide();

                        } else if (!isEmptyObject(response.data)) {

                            var kup = 0;
                            $.each(response['data'], function(i, v) {

                                warehouse_id = response['data'][i]['warehouse_id'];
                                warehouse_name = response['data'][i]['warehouse_name'];

                                kup++;

                            });

                            if(kup > 1){
                                $('#switch_tab').show();
                            }else{
                                $('#switch_tab').hide();
                            }
                            

                        }

                        

                        $("#does_user_have_profile").html('yes');



                        if (localStorage.getItem('warehouse_id') == "null" ||
                            localStorage.getItem('warehouse_id') == null || 
                            localStorage.getItem('warehouse_id') == "" || 
                            localStorage.getItem('warehouse_id') == 'undefined' || 
                            localStorage.getItem('warehouse_name') == "null" || 
                            localStorage.getItem('warehouse_name') == "" || 
                            localStorage.getItem('warehouse_name') == undefined 
                            ) 
                        {

                            localStorage.setItem('warehouse_id', warehouse_id);
                            localStorage.setItem('warehouse_name', warehouse_name);

                            //save warehouse id on page
                            $("#current_warehouse_id").html(warehouse_id);

                        }else{
                            //still save warehouse id on page
                            $("#current_warehouse_id").html(localStorage.getItem('warehouse_id'));
                        }

                        //set warehouse name              
                        $('#wareh_name').html(localStorage.getItem('warehouse_name'));

                        //show page
                        $("#whole_body").fadeIn();
                        $(".container33").hide();


                        fetch_user_module_roles();

                    } else {

                        
                        fetch_user_module_roles();

                        if($("#user_perm_status").html() == "super_admin" || $("#user_perm_status").html() == "admin"){




                            $("#assgn_roles").addClass("fa-times"); //mark roles as x
                            
                            //now check if other setups are ready
                            $.ajax({

                                type: "POST",
                                dataType: "json",
                                url: api_path + "wms/is_setup_done",
                                data: {
                                    "company_id": localStorage.getItem('company_id')
                                },
                                timeout: 60000,

                                success: function(response) {
                                    console.log(response);
                                    if (response.status == '200') {

                                        if(response.data.warehouse == "yes"){
                                            $("#crt_whs").addClass("fa-check");
                                        }else{
                                            $("#crt_whs").addClass("fa-times");
                                        }

                                        if(response.data.user_name == "yes"){
                                            $("#updt_comp_dtl").addClass("fa-check");
                                        }else{
                                            $("#updt_comp_dtl").addClass("fa-times");
                                        } 

                                    } else {

                                    }
                                },
                                error: function(response) {

                                }
                            });





                            $(".dsh_dvs").fadeOut(200).promise().done(function(){
                                $("#admins_no_permission_dv").fadeIn(400);
                            });

                            

                        }else{

                            $(".dsh_dvs").fadeOut(200).promise().done(function(){
                                $("#no_permission_dv").fadeIn(400);
                            });

                        }      

                    }

                },
                // objAJAXRequest, strError
                error: function(response) {

                    $("#page_error_div").html('<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; Connection Error. Please try again.');
                    $(".container33").hide();
                    $("#page_error_div").show();
                    $("#whole_body").hide();

                }

            });
        }


        

        

        

        

        function fetch_user_module_roles() {

            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            var warehouse_id = localStorage.getItem('warehouse_id');
            var module_id = 13;

            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "wms/get_user_profile_in_warehouse",
                data: {
                    "company_id": company_id,
                    "user_id": user_id,
                    "module_id": module_id,
                    "warehouse_id": warehouse_id
                },
                timeout: 60000,

                success: function(response) {

                    console.log(response);

                    var an_admin;

                    if (response.status == '200') {

                        var k = 1;
                        $.each(response['data']['profile_details'], function(i, v) {

                            if (v.id == 2) { //Procurement
                                
                                $("#procurement").show();
                                $("#purchaseorders").show();
                                $("#paystovendors").show();
                                
                                $("#contacts").show(); // show contact page
                                $("#items").show(); //show items page
                            }

                            if(v.id == 26){ //warehouse manager

                                $("#incoming_tab").show();//warehouse manager
                                $("#receiveorders").show(); //receive orders/create orders

                                $("#outgoing_tab").show();  //warehouse manager
                                $("#invoicesreceipts").show();
                                $("#supplyitems").show(); //but cannot issue
                                $("#contacts").show(); // show contact page
                                $("#items").show(); //show items page
                                $("#itemsreceivedlist").show();
                                $("#qty_adjustment").show();

                                //if the
                                if(localStorage.getItem('warehouse_id') != ""){
                                    $("#whsections").attr("href","whsections?i="+localStorage.getItem('warehouse_id'));
                                    $("#whsections").show(); //
                                }
                                
                            }


                            if(v.id == 24){ //store manager outgoing

                                $("#outgoing_tab").show();  //warehouse manager
                                $("#supplyitems").show();
                            }

                            if(v.id == 3){//store manager incoming
                                $("#incoming_tab").show();
                                $("#itemsreceivedlist").show();
                            }


                            if(v.id == 0){//store manager incoming
                                $("#settings_tab").show();
                            }

                            $("#report_tab").show();

                            k++;
                        });

                        

                        $("#does_user_have_profile").html('yes_profile');


                    } else if (response.status == '400') {

                        //
                        $("#does_user_have_profile").html('no_profile');

                    } else if (response.status == "401") {

                        $("#does_user_have_profile").html('no_profile');

                    }

                },

                error: function(response) {

                }

            });
        }








        function getListOfWarehouseUSerHasAccessTo() {
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');

            $.ajax({

                type: "POST",
                dataType: "json",
                url: api_path + "wms/list_warehouses_user_connected",
                data: {
                    "company_id": company_id,
                    "user_id": user_id
                },
                timeout: 60000,

                success: function(response) {

                    if (response.status == '200') {
                        $('#loading_dlv').hide();
                        var str = "";
                        // alert(response.data.length)
                        if (Object.keys(response.data).length > 0) {

                            $.each(response['data'], function(i, v) {

                                str += '<tr>';
                                str += '<td>' + response['data'][i]['warehouse_name'] + '</td>';
                                str += '<td>' + response['data'][i]['warehouse_address'] + '</td>';
                                str += '<td><button name="enter_ware" class="enter_ware btn btn-primary btn-sm" id="enter_' + response['data'][i]['warehouse_id'] + '" dir="entername_' + response['data'][i]['warehouse_name'] + '" data-dismiss="modal">Enter</button></td>';
                                str += '</tr>';

                            })

                            // $('#switch_tab').show();
                            $('#warehouse_dlv').html(str);

                        }

                    } else {
                        $('#loading_dlv').hide();
                        $('#warehouse_dlv').html('');
                        $('#warehouse_dlv').html('Technical error!');
                    }

                },
                // objAJAXRequest, strError
                error: function(response) {
                    $('#loading_dlv').hide();
                    $('#warehouse_dlv').html('');
                    // alert('Error fetching warehouses!');
                    $('#warehouse_dlv').html('Error fetching List!');

                }

            });
        }
    </script>

</head>

<body class="nav-md">

  <div class="container33">
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
    <div class="block33"></div>
  </div>

  <div id="page_error_div" style="color: white; font-size: 16px; display: none ">

  </div>



<!-- <i class="fa fa-spinner fa-spin fa-fw fa-3x" id="preloader_loader" style="display: flex; align-items: center; justify-content: center;"></i> -->


  <div id="whole_body"  style="display: none;"> <!-- page beside loader section -->
    <div class="container body">
        <div class="main_container">
            <div class="col-lg-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="./" class="site_title"><i class="fa fa-paw"></i> <span>HRM</span></a>

                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">

                            <p id="wareh_name" class="text-center" style="color: #ccc;"></p>
                            <!-- <hr style="color: #ccc;"> -->
                            <ul class="navbar-nav side-menu" style="display: ;" id="main_menu">


                                <li class="nav-item"><a href="/hrm/" class="nav-link"><i class="fa fa-home"></i> Dashboard</a></li>

                                <li class="nav-item"><a href="employees" class="nav-link"><i class="fa fa-users"></i> Employees </a></li>

                                <li class="nav-item"><a href="leaves" class="nav-link"><i class="fa fa-edit"></i> Leaves </a></li>

                                <li class="nav-item"><a href="terminations" class="nav-link"><i class="fa fa-user"></i> Terminations </a></li>

                                <li class="nav-item"><a href="grievances" class="nav-link"><i class="fa fa-edit"></i> Grievances </a></li>

                                <li class="nav-item"><a href="attendance" class="nav-link"><i class="fa fa-bell-o"></i>Attendance</a></li>

                                <!-- <li><a href="hrm/payroll"><i class="fa fa-edit"></i> Payroll </a></li> -->


                                <li class="nav-item"><a class="nav-link"><i class="fa fa-user"></i> HR Settings <span class="fa fa-chevron-down"></span></a>

                                <ul class="nav child_menu">
                                  <li><a href="company_positions">Job Titles</a></li>
                                  <li><a href="departments">Departments</a></li>
                                  <li><a href="set_work_days">Set Work Days</a></li>
                                  <li><a href="leave_types">Leave Types</a></li>
                                  <li><a href="branches">Company Branches</a></li>
                                  <li><a href="employement_type">Employment Types</a></li>
                                  <li><a href="employment_payment_types">Employee Payment Types</a></li>
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

                        <a data-toggle="tooltip" data-placement="top" title="Logout" onclick="localStorage.clear();  window.location.href = site_url ">
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
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="username">
                                    <img src="" alt="" id="profile_img"><span class=" fa fa-angle-down"></span>

                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right" id="user_list">

                                    <li style="background-color: "><a onclick="window.location.href = site_url+'/user/myprofile'"><i class="fa fa-pencil pull-right"></i><b id="user_name"></b></a></li>

                                    <li><a onclick="window.location.href = site_url+'/user/change_password'">Change Password</a></li>

                                    <li><a onclick="function hi(){ localStorage.clear(); window.location.href = site_url}; hi();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>

                                    <!-- <img style="display:none;"
                    onload="show_login_status('Google', true)"
                    onerror="show_login_status('Google', false)"
                    src="https://accounts.google.com/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&followup=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&chtml=LoginDoneHtml&checkedDomains=youtube&checkConnection=youtube%3A291%3A1"
                    /> -->

                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-th fa-3x"></i>
                                    <!-- <span class="badge bg-green">0</span> -->
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list fst_dd" role="menu">
                                    <li class="">
                                        <a id="feed_tg" href="../feeds">
                                            <span class="image"><img src="../files/images/icons/feeds_icon.png" alt=""></span>
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

                            <!-- <li role="presentation">
                    <a href="/user/modules" class="dropdown-toggle info-number" >
                      <i class="fa fa-arrow-circle-left fa-3x text-center" style="font-size: 20px;"></i>

                    </a>
                  </li> -->

                            <!-- <li role="presentation">
                    <a href="/user/modules">
                      <i class="fa fa-home fa-3x" style="font-size: 20px;"></i>
                    </a>

                  </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- modal -->
            <div class="modal fade" id="modal_switch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Warehouses
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>

                        </div>
                        <div class="modal-body">
                            <!-- <h4 id="modal_msg">User permission updated successfully!</h4> -->

                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="headings">

                                                <th class="column-title" width="25%">Warehouse Name</th>
                                                <th class="column-title" width="50%">Warehouse Address</th>
                                                <th class="column-title" width="25%"></th>

                                            </tr>
                                        </thead>

                                        <tr id="loading_dlv">
                                            <td colspan="3" style="text-align: center; padding-top: 15px"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i></td>
                                        </tr>
                                        <tbody id="warehouse_dlv">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="yes_delete_position" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
              </div> -->
                    </div>
                </div>
            </div>


            



            <!-- modal for apps company question -->
            <div class="modal fade" id="modal_choose_company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header ">
                    <h3 class="modal-title mdl_hdn" id="exampleModalLabel" style="color: #fff;">-
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </h3>
                    
                  </div>
                  <div class="modal-body">
                    <h4 id="list_comp_tables">Team Member Added Successfully!</h4>
                    <span id="list_comp_tables2"></span>
                  </div>
                  <!-- <div class="modal-footer"> -->
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  <!-- </div> -->
                </div>
              </div>
            </div>

            <span id="user_perm_status" style="display: none"></span>
            <span id="current_warehouse_id" style="display: none"></span>
            <span id="does_user_have_profile" style="display: none"></span>