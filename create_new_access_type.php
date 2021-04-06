<?php
include("_common/header.php");
?>      
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">

              <div class="title_left">
                <h3>Create New Access Type</h3>
              </div>

              
              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <!--span class="input-group-btn"-->
                    <button type="button" class="btn btn-success" id="create">Create</button>
                    <a href="access_levels"><button type="button" class="btn btn-primary">Back</button></a>
                    <!-- </span> -->
                    
                  </div>
                </div>
              </div>

            </div>

            <div id="create_access" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Access Type Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="firstname" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" id="error">
                      
                          </div>
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_user">Create</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="invite_loading"></i>
                        </div>
                      </div>

                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>




            <div id="list_of_users">
              <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                  <br>
                  <!-- <div class="form-group">
                    <div class="pull-right">
                      <button type="button" class="btn btn-success"><a href="admin/add_user" style="color: white;">Add</a></button>
                      
                    </div>
                  </div><br><br> -->

                  <div class="x_content">
                    

                    <div class="table-responsive" >
                      <table class="table table-striped jambo_table bulk_action">

                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Module</th>
                            <th class="column-title">Sub Events</th>
                            
                            <th class="column-title no-link last">
                              <span class="nobr">Action</span>
                            </th>
                            
                          </tr>

                        </thead>

                        <tr id="table_loader">
                          <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="loading"></i>
                          </td>
                        </tr>


                        <tbody  id="screenData" style="display: none">



                          <!-- <tr>
                            <td>
                              <input type="checkbox" id="check-all" class="flat">
                            </td>
                            <td>1.</td>
                            <td><a href="admin/user_profile">Oluwaseye</a></td>
                            <td><a href="admin/user_profile">Gbenga</a></td>
                            <td><a href="admin/user_profile">seygz@gmail.com</a></td>
                            <td>
                              <a href="admin/user_permissions"><i class="fa fa-lock fa-2x" data-toggle="tooltip" data-placement="top" data-original-title="User Permissions"></i></a> &nbsp;&nbsp; -->

                              <!-- <i class="fa fa-toggle-on fa-2x"  data-toggle="tooltip" data-placement="top" data-original-title="Disable Login"></i> &nbsp;&nbsp;  -->
                              
                              <!-- <i class="fa fa-trash fa-2x"  data-toggle="tooltip" data-placement="top" data-original-title="Disable Login"></i>
                            </td>
                          </tr>-->

                          
                        </tbody>
                      </table>

                      <!-- <div class="ln_solid"></div> -->
                      
                    </div>
                          
                  </div>
                </div>
              </div>
            </div>
            </div>

          </div>
        </div>
        <!-- /page content-->



        <script type="text/javascript">
          $(document).ready(function() {
            $('#create').on('click', create);

          });

          function create(){
            $('#create_access').toggle();
          }
        </script>
        
        
<?php
include("_common/footer.php");
?>      
        

            
        

