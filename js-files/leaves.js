$(document).ready(function() {
    list_of_leaves_applicant('');

    $(document).on('click', '.delete_leave', function() {
        var leave_id = $(this).attr('id').replace(/lev_/, ''); // table row ID 
        delete_leave(leave_id);

    });

    $(document).on('click', '#leave_filter', function() {
        $('#pagination').twbsPagination('destroy');
        $("#loading").show();
        list_of_leaves_applicant('');

    });

    $('#filter_leave').on('click', show_leave_filter_form);
    load_employee();
    load_leave_type();


    $('input#date_range').daterangepicker({
        autoUpdateInput: false
    });

    $('input#date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format(
            'YYYY/MM/DD'));

    });

})


function show_leave_filter_form() {

    $('#filter_leave_display').toggle();


}

function delete_leave(leave_id) {

    var company_id = localStorage.getItem('company_id');

    // alert(leave_id);
    var ans = confirm("Are you sure you want to delete?");
    if (!ans) {
        return;
    }
    // $('#delete_modal_position').modal('show');

    $('#row_' + leave_id).hide();
    $('#loader_row_' + leave_id).show();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "hrm/delete_employee_leave",
        data: {
            "company_id": company_id,
            "leave_id": leave_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            // alert('Connection error');
            $('#loader_row_' + leave_id).hide();
            $('#row_' + leave_id).show();

            // alert('connection error');
        },

        success: function(response) {
            // console.log(response);
            if (response.status == '200') {
                // $('#row_'+user_id).hide();
                // alert(leave_id);

            } else if (response.status == '401') {


            }

            $('#loader_row_' + leave_id).hide();
        }
    });
}

function list_of_leaves_applicant(page) {

    var company_id = localStorage.getItem('company_id');
    if (page == "") {
        var page = 1;
    }
    var limit = 20;

    var employee_id = $('#employee_id').val();
    var leave_type = $('#leave_type').val();
    var leave_code = $('#leave_code').val();
    var date_range = $('#date_range').val();


    $("#loading").show();
    $("#leavesData").html('');
    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "hrm/list_of_company_leaves_applicant",
        data: {
            "company_id": company_id,
            "page": page,
            "limit": limit,
            "employee_id": employee_id,
            "leave_type": leave_type,
            "leave_code": leave_code,
            "date_range": date_range
        },
        timeout: 60000,

        success: function(response) {

            console.log(response);

            var strTable = "";
            var aprvv_status = "";

            $('#loading').hide();
            if (response.status == '200') {


                if (response.data.length > 0) {

                    var k = 1;
                    $.each(response['data'], function(i, v) {


                        var date = new Date(response['data'][i]['leave_start_from']);
                        // var dateParts = date.split("-");

                        // var dateObject = new Date(dateParts[2]+"/"+dateParts[1] - 1+"/"+dateParts[0]); 

                        var resumption_date = new Date(response['data'][i]['resumption_date']);
                        var leave_start = new Date(response['data'][i]['leave_start']);
                        // resumption_date.format();
                        // var date2 = dateFormat(now, "dddd, mmmm dS, yyyy, h:MM:ss TT");

                        if (response['data'][i]['leave_status'] == "Pending") {
                            aprvv_status =
                                '<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
                        } else if (response['data'][i]['leave_status'] == "Accepted") {
                            aprvv_status = '<i class="fa fa-check fa-2x" style="color: green"></i>';
                        } else if (response['data'][i]['leave_status'] == "Declined") {
                            aprvv_status = '<i class="fa fa-times fa-2x" style="color: red"></i>';
                        }


                        strTable += '<tr id="row_' + response['data'][i]['leave_id'] + '">';
                        strTable += '<td valign="top">' + response['data'][i]['leave_code'] +
                            '</td>';
                        strTable +=
                            '<td width="8%" valign="top"><div class="profile_pic pfl_ctna" style="height: 50px; width: 50px; overflow: hidden"><img src="' +
                            window.location.origin + '/files/images/employee_images/sml_' +
                            response['data'][i]['profile_picture'] +
                            '" alt="..." width="50" class="pfl_ctna"></div></td>';
                        strTable += '<td width="20%" valign="top"><b>' + response['data'][i][
                                'lastname'
                            ] + '</b>' + ", " + response['data'][i]['firstname'] + " " + response[
                                'data'][i]['middlename'] + '<br>on: ' + date.toDateString() +
                            '</td>';
                        strTable += '<td valign="top">' + response['data'][i]['leave_type'] +
                            '</td>';
                        // strTable += '<td valign="top">' + leave_start.toDateString() + '</td>';
                        // strTable += '<td valign="top">' + resumption_date.toDateString() + '</td>';
                        strTable += '<td valign="top">' + response['data'][i]['real_days_used'] +
                            '</td>';

                        // if(response['data'][i]['total_leave_sent_for_approval'] == response['data'][i]['total_pending_leave_approvals']){
                        strTable += '<td valign="top">' + response['data'][i][
                            'total_approvals_handled'
                        ] + "/" + response['data'][i]['total_leave_sent_for_approval'] + '</td>';
                        // }else{
                        //   strTable += '<td valign="top"><a href="'+base_url+'/erp/hrm/forward_application/'+response['data'][i]['leave_id']+'"><i  class="fa fa-forward"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="Forward Leave Applicant"></i></a> &nbsp;&nbsp;'+response['data'][i]['total_pending_leave_approvals']+"/"+response['data'][i]['total_leave_sent_for_approval']+'</td>';
                        // }

                        strTable += '<td valign="top">' + aprvv_status + '</td>';

                        strTable += '<td valign="top"><a href="' + base_url +
                            'view_employee_leave_details?id=' + response['data'][i]['leave_id'] +
                            '"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style=" color: gray; font-size: 20px;" title="View Employee Leave Details"></i></a> &nbsp;&nbsp;<a style="cursor: pointer;" class="delete_leave" id="lev_' +
                            response['data'][i]['leave_id'] +
                            '"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Leave Info"></i></a></td>';
                        strTable += '</tr>';

                        // <a href="'+base_url+'/erp/hrm//'+response['data'][i]['employee_id']+'"><i  class="fa fa-list"  data-toggle="tooltip" data-placement="top" font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;

                        strTable += '<tr style="display: none;" id="loader_row_' + response['data'][
                            i
                        ]['leave_id'] + '">';
                        strTable +=
                            '<td colspan="9"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                        strTable += '</td>';
                        strTable += '</tr>';


                        k++;

                    });

                } else {

                    strTable = '<tr><td colspan="9">No record.</td></tr>';

                }

                $('#pagination').twbsPagination({
                    totalPages: Math.ceil(response.total_rows / limit),
                    visiblePages: 10,
                    onPageClick: function(event, page) {

                        list_of_leaves_applicant(page);
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                    }
                });

                $("#leavesData").html(strTable);
                $("#leavesData").show();

            } else if (response.status == '400') {
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="10">No leave found for this Employee</td>';
                strTable += '</tr>';


                $("#leavesData").html(strTable);
                $("#leavesData").show();


            } else if (response.status == '401') {
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="10">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#leavesData").html(strTable);
                $("#leavesData").show();


            }

        },

        error: function(response) {
            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="10"><strong class="text-danger">Connection error!</strong></td>';
            strTable += '</tr>';


            $("#leavesData").html(strTable);
            $("#leavesData").show();

        }

    });
}


function load_leave_type() {

    var company_id = localStorage.getItem('company_id');

    $.ajax({
        url: api_path + "hrm/list_of_company_leaves_type",
        type: "POST",
        data: {
            "company_id": company_id,
            "page": 1,
            "limit": 20
        },
        dataType: "json",


        success: function(response) {

            // $('#page_loader').hide();
            // $('#employee_details_display').show();


            var options = '';

            $.each(response['data'], function(i, v) {
                options += '<option value="' + response['data'][i]['leave_id'] + '">' + response[
                    'data'][i]['leave_type'] + '</option>';
            });
            $('#leave_type').append(options);
        },
        // jqXHR, textStatus, errorThrown
        error(response) {

            $('#employee_details_display').hide();
            $('#employee_error_display').show();
        }
    });

}

