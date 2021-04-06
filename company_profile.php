<?php
include("_common/header.php");
?>
<style type="text/css">
.profile_img {
    border-radius: 100%
}
</style>
<div id="page_loader" style="display: ;">

    <div class="right_col" role="main" style="display: none;">
        <div class="">
            <div class="page-title">

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <i class="fa fa-spinner fa-spin fa-fw fa-4x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- page content -->
<div id="employee_details_display" >
    <div class="right_col" role="main">

        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3 id="profile_name"></h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group" style="float: right">
                            <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                            <!-- <button type="button" class="btn btn-success" id="apply">Add</button> -->

                        </div>
                    </div>
                </div>
            </div>

            


            <div class="clearfix"></div>
            <div class="clearfix"></div>

            

            <div class="row">

                <div class="clearfix"></div>

                <!-- <div class="col-md-4 col-sm-12 col-xs-12">

                  <div class="x_panel" >
                    <br><br>
                    <span style="width: 100%;">
                    <img class="img-responsive avatar-view" src="" alt="Profile Picture" title="Profile Picture" id="user_image" class="profile_img"
                    style="width:100%; height:300px; border: 7px solid #E1E1E1; margin-left: auto; margin-right: auto; box-shadow: 0 4px 8px rgba(0,0,0,0.19)">
                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none ; " id="lg_change_loader"></i>
                    </span>

                    <br>
                  </div>

                </div> -->


                <div class="col-md-12 col-sm-12 col-xs-12"
                    style="box-shadow: 0 4px 8px rgba(0,0,0,0.19); border-radius: 20px; ">
                    <div class="x_panel" style=" margin-left: auto;margin-right: auto; position: relative;top: 6px;">
                        <!-- <div class="x_title">
                      <h2>Personal Profile</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        
                      </ul>
                      <div class="clearfix"></div>
                    </div> -->

                        <!-- <br> -->


                        <div class="col-md-12 col-sm-12 col-xs-12"
                            style="background-image:linear-gradient(90deg, rgba(42, 63, 84, 0.92) 0%, rgba(42, 63, 84, 0.95) 100%), url(../files/images/general_images/ware.jpg); height: 200px; box-shadow: 0 4px 8px rgba(0,0,0,0.19); border-radius: 20px">

                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 100px">
                                <img class="img-responsive avatar-view" src="" alt="Profile Picture"
                                    title="Profile Picture" id="user_image" class="profile_img"
                                    style="width:160px; height:160px; border-radius:100%; border: 4px solid #E1E1E1; margin-left: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.19)">
                                <span
                                    style="margin-left: 0px; text-align: left; position: relative; left: 50px; top: 5px;">
                                    <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Firstname </label> -->
                                    <h2 id="firstname"></h2>
                                </span>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none ; "
                                    id="lg_change_loader"></i>

                                <br>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h2 style="color: white; font-size: 30px;margin-top: 80px; margin-left: 40px;">Company Profile</h2>
                            </div>
                            


                        </div>
                        <!-- <div class="col-md-8 col-sm-12 col-xs-12 x_content"> -->

                        <div class="col-md-12 col-sm-12 col-xs-12"
                            style="margin-top: 70px; position: relative;left: 10px; padding: 10px">
                            <br />

                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                               
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                                    
                                    <!-- <div style="padding-bottom: 5px;"> -->
                                        <span style="color: black; font-size: 16px;">Name: <span
                                                id="">Chuks David CO.</span></span>
                                        <!-- <h2 ></h2> -->
                                    <!-- </div> -->
                                    <!-- <div style="padding-bottom: 5px;">
                                        <span style="color: black; font-size: 16px;">Address: <span
                                                id="date_of_birth"></span></span>
                                    </div>
                                    <span> -->
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                                    
                                        <span style="color: black; font-size: 16px;">Address: <span
                                                id="">Ilupeju Byepass</span></span>
                                        
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                                    
                                        <span style="color: black; font-size: 16px;">Contact Number: <span
                                                id="">08134567895</span></span>
                                        
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                                    
                                        <span style="color: black; font-size: 16px;">Email Address: <span
                                                id="">chuuky@chukky.com</span></span>
                                        
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                                    
                                        <span style="color: black; font-size: 16px;">Company Bio: <span
                                                id="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus quam tempore eius incidunt. Excepturi deleniti in recusandae distinctio sequi! Minima doloribus hic esse eius dolor expedita obcaecati neque sunt beatae!</span></span>
                                        
                                </div>
                                <!-- <div class="col-md-6 col-sm-12 col-xs-12"
                                    style="position: relative; top: -10px left: 40px;">

                                    <div style="padding-bottom: 5px;">
                                        <span style="color: black; font-size: 16px;">Contact Number: <span
                                                id="phone"></span></span>
                                    </div>
                                    <div style="padding-bottom: 5px;">
                                        <span style="color: black; font-size: 16px;">Email: <span
                                                id="email"></span></span>
                                    </div>
                                </div> -->
                                

                            </span>

                        </div>

                    </div>
                </div>
            </div>


            

           


        </div>
    </div>
</div>










<?php
        include("_common/footer.php");
        ?>