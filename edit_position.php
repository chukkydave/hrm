<?php
include("_common/header.php");
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Position</h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">

                        <a href="company_positions"><button type="button" class="btn btn-primary">Back</button></a>


                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <br />
                        <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position_name">Position
                                    Name<span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="position_name" required="required"
                                        class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eligibility">Leave
                                    Eligibility<span>*</span>
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-4">
                                    <input type="number" id="eligibility" required="required"
                                        class="form-control col-md-7 col-xs-12 required">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-4">
                                    <input type="text" required="required"
                                        class="form-control col-md-7 col-xs-12 required" disabled value="Months">
                                </div>
                                <span style="vertical-align:sub;">From Date Of Joining</span>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alloted_days">Allotted
                                    Leave Days<span>*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="alloted_days" required="required"
                                        class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea cols="3" class="form-control col-md-7 col-xs-12"
                                        id="position_description">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_edit_position">


                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success" id="edit_pos">Edit</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="edit_pos_loader"></i>
                                    <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                                </div>
                            </div>

                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->

<!-- modal -->
<div class="modal fade" id="modal_position_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                <h4>Position Edited Successfully!</h4>
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
    fetch_employee_position();
    $('#edit_pos').on('click', edit_company_position);

})

function fetch_employee_position() {
    // var pathArray = window.location.pathname.split( '/' );
    var position_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');
    var company_id = localStorage.getItem('company_id');


    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "hrm/fetch_company_position_byID",
        data: {
            "position_id": position_id,
            "company_id": company_id
        },

        success: function(response) {

            console.log(response);

            if (response.status == '200') {

                $.each(response['data'], function(i, v) {

                    $('#position_name').val(response['data'][i]['position_name']);
                    $('#position_description').val(response['data'][i]['position_description']);
                    $('#eligibility').val(v.leave_is_eligible)
                    $('#alloted_days').val(v.alloted_leave_days)

                });


            }


        },

        error: function(response) {

            alert("Connection Error.");

        }

    });
}

function edit_company_position() {
    var position_name = $('#position_name').val();
    var position_description = $('#position_description').val();
    let alloted = $('#alloted_days').val()
    let eligibility = $('#eligibility').val()
    var company_id = localStorage.getItem('company_id');
    // var pathArray = window.location.pathname.split( '/' );
    var position_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

    var blank;




    $(".required").each(function() {

        var the_val = $.trim($(this).val());

        if (the_val == "" || the_val == "0") {

            $(this).addClass('has-error');

            blank = "yes";

        } else {

            $(this).removeClass("has-error");

        }

    });

    if (blank == "yes") {

        $('#error_edit_position').html("You have a blank field");

        return;

    }



    $('#edit_pos').hide();
    $('#edit_pos_loader').show();



    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "hrm/edit_company_position",
        data: {
            "position_name": position_name,
            "position_description": position_description,
            "company_id": company_id,
            "position_id": position_id,
            leave_eligible: eligibility,
            alloted_leave: alloted,
        },

        success: function(response) {

            console.log(response);

            if (response.status == '200') {


                $('#modal_position_edit').modal('show');

                $('#modal_position_edit').on('hidden.bs.modal', function() {
                    $('#position_name').val();
                    $('#position_description').val();
                    // window.location.reload();
                    window.location.href = base_url + "company_positions";
                })


            } else if (response.status == '400') { // coder error message


                $('#error_edit_position').html('Technical Error. Please try again later.');

            } else if (response.status == '401') { //user error message


                $('#error_edit_position').html(response.msg);

            }



            $('#edit_pos').show();
            $('#edit_pos_loader').hide();


        },

        error: function(response) {
            $('#edit_pos').show();
            $('#edit_pos_loader').hide();
            $('#error_edit_position').html("Connection Error.");

        }

    });

}
</script>

<?php
include("_common/footer.php");
?>