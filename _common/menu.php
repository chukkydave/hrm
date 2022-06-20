<?php
$app_title = "Human Resource Management Software";
$app_abr = "HRM";
$app_id = 13;
$menu = '<ul class="nav side-menu" style="display: ;" id="main_menu">


                

                 <li id="dash_perm" style="display:none;"><a href="/hrm/"><i class="fa fa-home"></i> Dashboard</a></li>

                                    <!-- <li ><a><i class="fa fa-user"></i> Organization <span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu">
                                        <li><a href="company_profile">Company Profile</a></li>
                                        <li><a href="company_departments">Departments</a></li>
                                        
                                    </ul>

                                </li> -->

                                    <li class="hidata emp_perm" style="display:none;"><a href="employees"><i class="fa fa-users"></i> Employees </a></li>
                                    <li class="hidata feat_4 att_perm" style="display:none;"><a><i class="fa fa-user"></i> Attendance<span
                                                class="fa fa-chevron-down"></span></a>

                                        <ul class="nav child_menu">
                                            <li><a href="attendance">Daily Attendance</a></li>
                                            <li><a href="attendance_report">Attendance Report</a></li>
                                        </ul>

                                    </li>

                                    <li class="hidata feat_2 leaves_perm" style="display:none;"><a href="leaves" ><i class="fa fa-edit"></i> Leaves </a></li>
                                    <li class="hidata pay_permsi" id="pay_permsi" style="display:none;"><a><i class="fa fa-money"></i> Payroll <span
                                                class="fa fa-chevron-down"></span></a>

                                        <ul class="nav child_menu">
                                            <li><a href="pay_schedule">Pay Schedule</a></li>
                                            <li><a href="payroll_history">Payroll History</a></li>
                                            <!--<li><a href="payroll_settings">Payroll Settings</a></li>-->
                                        </ul>
                                    </li>
                                    <li class="hidata feat_6 claims_perm" style="display:none;"><a href="claims"><i class="fa fa-exclamation-triangle"></i> Employee Claims </a></li>
                                    <li class="hidata feat_3 grie_perm" style="display:none;"><a href="grievances"><i class="fa fa-edit"></i> Grievances </a></li>

                                    <li class="hidata feat_38 exit_perm" style="display:none;"><a><i class="fa fa-power-off"></i> Exits<span
                                                class="fa fa-chevron-down"></span></a>

                                        <ul class="nav child_menu">
                                            <li><a href="exits">All Exit</a></li>
                                            <li><a href="exit_config">Exit Configuration</a></li>
                                        </ul>

                                    </li>


                                    <!-- <li><a href="attendance"><i class="fa fa-bell-o"></i>Attendance</a></li> -->


                                    


                                    


                                    <li  id="settings"  class="hidata set_perm" style="display:none;"><a><i class="fa fa-user"></i> HR Settings <span
                                                class="fa fa-chevron-down"></span></a>

                                        <ul class="nav child_menu">
                                            <li><a href="users">Users</a></li>
                                            <li><a href="profilesandroles">Permissions</a></li>
                                            <li><a href="job_title">Job Titles</a></li>
                                            <li><a href="departments">Departments</a></li>
                                            <!-- <li><a href="set_work_days">Set Work Days</a></li> -->
                                            <li class="feat_2"><a href="leave_types">Leave Types</a></li>
                                            <li><a href="company_branches">Company Branches</a></li>
                                            <li><a href="employement_type">Employment Types</a></li>
                                            <li><a href="salary_component">Salary Component</a></li>
                                            <!--<li><a href="#">Company Profile Settings</a></li>-->
                                            <li><a href="emp_doc_type">Employee Doc Types</a></li>
                                            <li><a href="company_holidays">Company Holidays</a></li>
                                            <li><a href="work_shift">Work Shifts</a></li>
                                            <li><a href="notice_board">Notice Board</a></li>
                                        </ul>

                                    </li>
                                        <li class="hidata audit_perm" style="display:none;"><a href="audit_trail"><i class="fa fa-folder"></i> Audit Trail </a> </li>
                                        <li class="help_perm" style="display:none;"><a href="resources"><i class="fa fa-question"></i> Help </a> </li>


                <!-- <li class=""><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display: none;">
                    <li><a href="form.html">General Form</a></li>
                    <li><a href="form_advanced.html">Advanced Components</a></li>
                    <li><a href="form_validation.html">Form Validation</a></li>
                    <li><a href="form_wizards.html">Form Wizard</a></li>
                    <li><a href="form_upload.html">Form Upload</a></li>
                    <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                </li> -->

               

                

        </ul></ul><script src="js/menu.js?v=4313203"></script>';
?>