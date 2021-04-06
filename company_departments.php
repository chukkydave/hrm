<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Departments </h3>
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
                    <!--span class="input-group-btn"-->
                    <!-- <button type="button" class="btn btn-success" id="add_department">Add Department</button> -->
                    <!-- <a href="hrm/access_levels"><button type="button" class="btn btn-primary">Back</button></a> -->
                    <!-- </span> -->
                    
                  </div>
                </div>
              </div>
            </div>


            <div id="department_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_name">Department Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="department_name" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_description">Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" id="department_description" class="form-control col-md-7 col-xs-12 required">
                            
                          </textarea>
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Parent Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12">
                            
                          </select>
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="text-danger form-control col-md-7 col-xs-12" style="display: none;" id="error_dept">
                      
                          </div>
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_dept">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="dept_loading"></i>
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
                            
                            <th class="column-title">Name</th>
                            <th class="column-title">HOD</th>
                            <th class="column-title">Employees</th>
                            <!-- <th class="column-title">Branch </th> -->
                            
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="4">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                       
                        <tbody id="departmentData">
                          <!-- <tr>
                            <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="loading"></i></td>
                          </tr>    -->
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

        

        

<?php
include("_common/footer.php");
?> 