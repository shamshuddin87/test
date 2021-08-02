<?php
    $user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
    
    ?>
<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## -->
<div class="right_col" role="main">
    <div class="">
        <div class="content">
            <!-- My messages -->
            <div class="mainelementfom">
                <div class="table_wraper">
                    <h1 class="h1_heading">View User Master List</h1>
                    <div class="tablitiledesc text-center">
                        <div class="note" style="color: #000;padding: 12px 0;">
                            (<strong>Note : </strong>Fields marked with * are mandatory fields)
                        </div>
                    </div>
                    <div class="cssnumrws form-inline">
                        <span>Show</span>
                        <select id="noofrows" name="noofrows" class="noofrows form-control">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>Entries</span>
                        <div class="top_margin">
                            <input style="width: 217px" type="text" placeholder="Search By Emp Id/User Name" class="form-control" id="srch" status="0">
                        </div>
                        <div class="cssfilter">
                            <div class="control-label form-group">
                                <label>Employee Status</label>
                                <select id="emp_status" name="emp_status" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Resigned</option>
                                    <option value="3">Not a DP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="containergrid">
                        <!-- <input type="hidden" class="compnynmad" value="<?php echo $companynmdept;?>"> -->
                        <div class="panel panel-primary">
                            <div class="table-responsive">
                                <table class="table table-inverse" id="datablerushi">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <!--  <th>Mobile</th> -->
                                            <th>Designation</th>
                                            <th>Date Of Becoming Designation Person</th>
                                            <!-- <th>Company</th> -->
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Resignation/Deletion date</th>
                                            <!-- <th>Reminder Days</th> -->
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody class="appendrow" appendrow='1'></tbody>
                                </table>
                                <div class="panel panel-white">
                                    <div class="paginationmn"></div>
                                    <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="clearelement"></div>
                <div class="containergrid">
                    <!--
                        <div class="mainprogressbarforall" id="progressbr">
                            <div class="headerprogressbar">
                              <div aria-busy="true" aria-label="Loading, please wait." role="progressbarmaterial"></div>
                            </div>
                        </div>
                        -->
                    <div class="formcss">
                        <div class="typography form_pad">
                            <h2 class="h1_heading">Add User Master List</h2>
                            <div class="tabcontractledesc text-center">
                                <div class="note">
                                    (<strong>Note : </strong>Important Fields are * Specified.)
                                </div>
                            </div>
                            <div class="formelementmain">
                                <form action="usermaster/insertmasterlist" id="insertmasterlist" method="post"
                                    enctype="multipart/form-data" autocomplete="off">
                                    <div class="clearelement"></div>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">First Name *</label>
                                        <div class="input">
                                            <input type="text" id="firstname" name="firstname" required="required"
                                                class="form_fields form-control col-md-7 col-xs-12"
                                                onkeypress="return isAlphaNumeric_space(event,this);">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Last Name *</label>
                                        <div class="input">
                                            <input type="text" id="lastname" name="lastname" required="required"
                                                class="form_fields form-control col-md-7 col-xs-12"
                                                onkeypress="return isAlphaNumeric_space(event,this);">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">Email *</label>
                                        <div class="input">
                                            <input type="email" id="email" name="email"
                                                class="form_fields form-control col-md-7 col-xs-12" required="required">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Employee Code*</label>
                                        <div class="input">
                                            <input type="text" id="employeecode" name="employeecode" required="required"
                                                class="form_fields form-control col-md-7 col-xs-12" maxlength="9"
                                                pattern="[A-Za-z0-9]{9}" title="Please Enter 9 digit code"
                                                onkeypress="return isAlphaNumeric(event,this);">
                                        </div>
                                    </section>
                                    <div class="clearelement"></div>
                                    <!--   <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Mobile *</label>
                                        <div class="input">
                                            <input type="text" id="mobile" name="mobile" required="required" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return numbersonly(event,this);" maxlength="10">
                                        </div>
                                        </section> -->
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Designation *</label>
                                        <div class="input">
                                            <input type="text" id="designation" name="designation" required="required"
                                                class="form_fields form-control col-md-7 col-xs-12">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Date of becoming DP *</label>
                                        <div class="input">
                                            <input type="text" id="dpdate" name="dpdate" required="required"
                                                class="form_fields form-control col-md-7 col-xs-12 bootdatepick"
                                                readonly="readonly">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Gender *</label>
                                        <div class="input">
                                            <div class="mainradiobtn">
                                                <div class="floatleft radiobtn">
                                                    <input style="    margin-top: 0;" type="radio" class="flat" id="gender" name="gender" value="1"
                                                        checked="" required />
                                                </div>
                                                <div class="floatleft genderlbltxt">Male</div>
                                            </div>
                                            <div class="mainradiobtn">
                                                <div class="floatleft radiobtn">
                                                    <input style="    margin-top: 0;" type="radio" class="flat" id="gender" name="gender"
                                                        value="2" />
                                                </div>
                                                <div class="floatleft genderlbltxt">Female</div>
                                                <div class="clearelement"></div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">L+1 First Name</label>
                                        <div class="input">
                                            <input type="text" id="l1firstname" name="l1firstname"
                                                class="form_fields form-control col-md-7 col-xs-12"
                                                onkeypress="return isAlphaNumeric_space(event,this);">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">L+1 Last Name</label>
                                        <div class="input">
                                            <input type="text" id="l1lastname" name="l1lastname"
                                                class="form_fields form-control col-md-7 col-xs-12"
                                                onkeypress="return isAlphaNumeric_space(event,this);">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">L+1 Email *</label>
                                        <div class="input">
                                            <input type="email" id="l1email" name="l1email"
                                                class="form_fields form-control col-md-7 col-xs-12" required>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">L+1 Employee ID</label>
                                        <div class="input">
                                            <input type="text" id="l1empid" name="l1empid"
                                                class="form_fields form-control col-md-7 col-xs-12" maxlength="9"
                                                pattern="[A-Za-z0-9]{9}" title="Please Enter 9 digit code"
                                                onkeypress="return isAlphaNumeric(event,this);">
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Type Of User *</label>
                                        <div class="input">
                                            <select id="typeofusr" name="typeofusr"
                                                class="form_fields form-control col-md-7 col-xs-12" required>
                                                <option value="">Select Type</option>
                                                <option value="7">Sub User</option>
                                                <option value="14">Approver</option>
                                            </select>
                                        </div>
                                    </section>
                                    <div class="clearelement"></div>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">Company Access *</label>
                                        <div class="input">
                                            <select id="cmpaccnme" name="cmpaccnme[]"
                                                class="form_fields form-control col-md-7 col-xs-12" multiple>
                                                <!-- <option value="">Select Company</option> -->
                                                <?php foreach ($cmplist as $kc => $vc) { ?>
                                                <option value="<?php echo $vc['id'];?>" class="optncmp">
                                                    <?php echo $vc['companyname'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 col-xs-12">
                                        <div class="approvernamemain">
                                            <div class="mainelem company_product">
                                                <label class="control-label">Approver Name*</label>
                                                <input type="hidden" id="approvernm" name="approvernm"
                                                    class="approvernm" value="">
                                                <div class="header-search-wrapper  floatnone find_box_company">
                                                    <i class="fa fa-search"></i>
                                                    <input type="text" name="getvalueofsearch"
                                                        class="header-search-input z-depth-2 floatleft"
                                                        placeholder="Select Approver" id="search-box"
                                                        autocomplete="off" />
                                                    <div class="approvernameoption">
                                                        <div id="live-search-header-wrapper" class="">
                                                            <ul class="live-searchul"></ul>
                                                        </div>
                                                        <div id="appendapp" style="text-align: left;"></div>
                                                    </div>
                                                    <div class="clearelement"></div>
                                                    <div class="mainelementch">
                                                        <div class="clearelement"></div>
                                                    </div>
                                                </div>
                                                <div class="header-search-wrapper hide-on-med-and-down services_search find_box_company"
                                                    style="display: none;">
                                                    <i class="fa fa-search"></i>
                                                    <input type="text" name="getvalueofsearch"
                                                        class="header-search-input1 z-depth-2 floatleft"
                                                        placeholder="Explore Resolutions" id="search-box1" />
                                                    <div class="clearelement"></div>
                                                    <div id="live-search-header-wrapper1" class="">
                                                        <ul class="live-searchul1"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Department Access *</label>
                                        <div class="input">
                                            <select id="deptaccess" name="deptaccess[]"
                                                class="form_fields form-control col-md-7 col-xs-12" multiple>
                                                <!-- <option value="" >Select Department</option> -->
                                                <?php foreach ($deptlist as $kc => $vc) { ?>
                                                <option value="<?php echo $vc['id'];?>"
                                                    cmplink="<?php echo $vc['companyid'];?>" disabled>
                                                    <?php echo $vc['deptname'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Only COI Accessibility? *</label>
                                        <div class="input">
                                            <select id="coiaccess" name="coiaccess"
                                                class="form_fields form-control col-md-7 col-xs-12">
                                                <option value="">Select COI Accessibility</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Manager Type</label>
                                        <div class="input">
                                            <select id="managertype" name="managertype"
                                                class="form_fields form-control col-md-7 col-xs-12">
                                                <option value="">Select Manager Type</option>
                                                <option value="hr">HR Manager</option>
                                                <option value="dept">Department Manager</option>
                                            </select>
                                        </div>
                                    </section>
                                    <section id="main_mgrindept" class="col col-md-4 col-sm-6 col-xs-12" style="display: none;">
                                        <label class="control-label">Manager In *</label>
                                        <div class="input">
                                            <select id="mgrindept" name="mgrindept[]"
                                                class="form_fields form-control col-md-7 col-xs-12" multiple>
                                                <?php foreach ($deptlist as $kc => $vc) { ?>
                                                <option value="<?php echo $vc['id'];?>"
                                                    cmplink="<?php echo $vc['companyid'];?>">
                                                    <?php echo $vc['deptname'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">User Role*</label>
                                        <div class="input">
                                            <select id="roleid" name="roleid"
                                                class="form_fields form-control col-md-7 col-xs-12" required>
                                                <option value="">Select User Role</option>
                                                <?php foreach ($rolelist as $key => $value) { ?>
                                                <option value="<?php echo $value['role_id'];?>">
                                                    <?php echo $value['role_name'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12">
                                        <label class="control-label">Status*</label>
                                        <div class="input">
                                            <select id="emp_status_insert" name="emp_status"
                                                class="form_fields form-control col-md-7 col-xs-12" required>
                                                <option value="1">Active</option>
                                                <option value="2">Resigned</option>
                                                <option value="3">Not a DP</option>
                                            </select>
                                        </div>
                                    </section>
                                    <section class="col col-md-4 col-sm-6 col-xs-12 resignordeletiondate" style="display: none;">
                                        <label id="lblresignordeletiondate" class="control-label"></label>
                                        <div class="input">
                                            <input type="text" id="resignordeletiondate" name="resignordeletiondate" required="required"
                                                class="form_fields form-control col-md-7 col-xs-12 bootdatepick"
                                                readonly="readonly">
                                        </div>
                                    </section>
                                    <!--<section class="col col-md-4 col-sm-6 col-xs-12 ">
                                        <label class="control-label">Reminder Days *</label>
                                        <div class="input">
                                            <input type="text" id="reminderdays" name="reminderdays" class="form_fields form-control col-md-7 col-xs-12" value="90" onkeypress="return numbersonly(event,this);">
                                        </div>
                                        </section>-->
                                    <!--<div class="form-group col-md-4">
                                        <label class="control-label">Access Right *</label>
                                          <div class="input">
                                            <select id="accrgt" name="accrgt[]" class="form_fields form-control col-md-7 col-xs-12" required multiple>
                                                 <option value="">Select Access</option> 
                                                <option value="View">View</option>
                                                <option value="Add">Add</option>
                                                <option value="Edit">Edit</option>
                                                <option value="Delete">Delete</option>
                                            </select>
                                        </div>
                                        </div>-->
                                    <div class="control-label formgroup col-xs-12 mt-20">
                                        <button type="submit"
                                            class="btn btn-primary btnlblne floatright mstrlbtn mr-0">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="excluplod" style="width: 500px;display: block;margin: auto;">
                        <form action="usermaster/uploadEmpStatus" id="uploadempstatus" method="post" enctype="multipart/form-data">
                            <div class="boxshadow col-md-6 col-md-offset-3">
                                <label class="labelcss">Upload Bulk Employee Status Data Through Excel File</label>
                                <div class="choose_files">
                                    <input type="file" name="empstatusexcel" id="empstatusexcel" class="form-control">
                                </div>
                                <div class="updatefile">
                                    <div class="sample_down floatleft">
                                        <a href="samplefile\EmployeeStatus\employeestatus.xlsx" download="" style="padding: 5px 0;">
                                            <p class="sample">
                                                Download Sample Excel <i class="fa fa-file-excel-o" aria-hidden="true" style="color: #4c8c13;"></i>
                                            </p>
                                        </a>
                                    </div>
                                    <div class="floatright"> 
                                        <input type="submit" value="Upload" class="btn btn-primary btnlblne uploadcmdbtn" style="float: right;">
                                    </div>
                                    <div class="clearelement"></div>
                                </div>
                                <div id="message" class="message"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearelement"></div>
                <div class="preloder_wraper">
                    <a href="javascript:;" class="preloder"></a>
                </div>
                <div class="clearelement"></div>
            </div>
            <!-- /main content -->
        </div>
    </div>
</div>
<!-- ########################################## PageContent End ########################################## -->
<div id="Mymodaledit" class="modal fade" role="dialog" tabIndex=-1>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update User Master List</h4>
            </div>
            <div class="modal-body show_shadow">
                <form id="updatemasterlistid" action="usermaster/updatemasterlistid" method="post"
                    class="form-horizontal form-label-left" autocomplete="off">
                    <input type="hidden" name="mlistid" class="mlistid" id="mlistid" value="">
                    <input type="hidden" name="masterid" id="masterid" value="">
                    <input type="hidden" name="userid" id="userid" value="">
                    <!--  <input type="hidden" name="mruid" class="mruid" id="mruid" value=""> -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>First Name *</label></span>
                            <input type="text" class="form-control" id="firstname" name="firstname" onkeypress="return isAlphaNumeric_space(event,this);" required>
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>Last Name *</label></span>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                onkeypress="return isAlphaNumeric_space(event,this);" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="control-label form-group col-md-12">
                            <span class="floatleft"><label>Email *</label></span>
                            <input type="email" class="form-control" id="email" name="email" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--  <div class="control-label form-group col-lg-6">
                            <span class="floatleft"><b>Mobile *</b></span>
                            <input type="text" class="form-control" id="mobile" name="mobile" onkeypress="return numbersonly(event,this);" maxlength="10" required>
                            </div> -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="control-label form-group">
                                <span class="floatleft"><label>Employee Code *</label></span>
                                <input type="text" class="form-control" id="empcode" name="empcode"
                                    onkeypress="return isAlphaNumeric(event,this);" maxlength="9"
                                    pattern="[A-Za-z0-9]{9}" title="Please Enter 9 digit code" required>
                            </div>
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>Date of becoming DP *</label></span>
                            <input type="text" class="form-control bootdatepick" id="dpdate" name="dpdate"
                                readonly="readonly">
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>Designation *</label></span>
                            <div class="input">
                                <input type="text" id="designation" name="designation"
                                    class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>L+1 First Name</label></span>
                            <input type="text" class="form-control" id="l1firstname" name="l1firstname"
                                onkeypress="return isAlphaNumeric_space(event,this);">
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>L+1 Last Name</label></span>
                            <input type="text" class="form-control" id="l1lastname" name="l1lastname"
                                onkeypress="return isAlphaNumeric_space(event,this);">
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>L+1 Email</label></span>
                            <input type="email" class="form-control" id="l1email" name="l1email">
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>L+1 Employee ID</label></span>
                            <input type="text" class="form-control" id="l1empid" name="l1empid" maxlength="9"
                                pattern="[A-Za-z0-9]{9}" title="Please Enter 9 digit code"
                                onkeypress="return isAlphaNumeric(event,this);">
                        </div>
                        <div class="clearelement"></div>
                        <div class="control-label form-group col-md-12 typu">
                            <span class="floatleft"><label>Type Of User *</label></span>
                            <div class="input">
                                <select id="typeofusr" name="typeofusr"
                                    class="form_fields form-control col-md-7 col-xs-12">
                                    <option value="">Select Type</option>
                                    <option value="7">Sub User</option>
                                    <option value="14">Approver</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-label form-group col-lg-6 col-xs-12">
                            <span class="floatleft"><label>Company Access *</label></span>
                            <div class="input" multiple>
                                <select id="cmpaccnme" name="cmpaccnme[]"
                                    class="form_fields form-control col-md-7 col-xs-12" multiple>
                                    <!-- <option value="">Select Company</option> -->
                                    <?php foreach ($cmplist as $kc => $vc) { ?>
                                    <option value="<?php echo $vc['id'];?>" class="optncmp">
                                        <?php echo $vc['companyname'];?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-label form-group col-lg-6 col-xs-12">
                            <span class="floatleft"><label>Department Access *</label></span>
                            <div class="input">
                                <select id="deptaccess" name="deptaccess[]"
                                    class="form_fields form-control col-md-7 col-xs-12" multiple>
                                    <!-- <option value="" >Select Department</option> -->
                                    <?php foreach ($deptlist as $kc => $vc) { ?>
                                    <option value="<?php echo $vc['id'];?>" cmplink="<?php echo $vc['companyid'];?>"><?php echo $vc['deptname'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-label form-group col-lg-6 col-xs-12">
                            <span class="floatleft"><label>Only COI Accessibility? *</label></span>
                            <div class="input">
                                <select id="coiaccess" name="coiaccess"
                                    class="form_fields form-control col-md-7 col-xs-12">
                                    <option value="">Select COI Accessibility</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-label form-group col-lg-6 col-xs-12">
                            <span class="floatleft"><label>Manager Type</label></span>
                            <div class="input">
                                <select id="managertype" name="managertype"
                                    class="form_fields form-control col-md-7 col-xs-12">
                                    <option value="">Select Manager Type</option>
                                    <option value="hr">HR Manager</option>
                                    <option value="dept">Department Manager</option>
                                </select>
                            </div>
                        </div>
                        <div id="main_mgrindept" class="control-label form-group col-xs-12">
                            <span class="floatleft"><label>Manager In *</label></span>
                            <div class="input">
                                <select id="mgrindept" name="mgrindept[]"
                                    class="form_fields form-control col-md-7 col-xs-12" multiple>
                                    <!-- <option value="" >Select Department</option> -->
                                    <?php foreach ($deptlist as $kc => $vc) { ?>
                                    <option value="<?php echo $vc['id'];?>" cmplink="<?php echo $vc['companyid'];?>"><?php echo $vc['deptname'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-label form-group col-md-12 col-xs-12 typu">
                            <span class="floatleft"><label>Search Approver *</label></span>
                            <div class="input">
                                <input type="hidden" class="approveid" id="approveid" name="approveid" value="">
                                <input type="text" id="approvername" name="approvername"
                                    class="form_fields form-control col-md-7 col-xs-12">
                            </div>
                            <div id="myeditlist"></div>
                            <div id="appapnd" style="text-align: left;"></div>
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>User Role*</label></span>
                            <select id="roleid" name="roleid" class="form_fields form-control col-md-7 col-xs-12"
                                required>
                                <option value="">Select User Role</option>
                                <?php foreach ($rolelist as $key => $value) { ?>
                                <option value="<?php echo $value['role_id'];?>"><?php echo $value['role_name'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="control-label form-group col-md-6">
                            <span class="floatleft"><label>Status*</label></span>
                            <select id="emp_status_edit" name="emp_status" class="form_fields form-control col-md-7 col-xs-12"
                                required>
                                <option value="1">Active</option>
                                <option value="2">Resigned</option>
                                <option value="3">Not a DP</option>
                            </select>
                        </div>
                        <section class="col col-md-4 col-sm-6 col-xs-12 resignordeletiondate" style="display: none;">
                            <label id="lblresignordeletiondate"></label>
                            <div class="input">
                                <input type="text" id="resignordeletiondate" name="resignordeletiondate" required="required"
                                    class="form_fields form-control col-md-7 col-xs-12 bootdatepick"
                                    readonly="readonly">
                            </div>
                        </section>
                        <!--<div class="control-label form-group col-lg-6">
                            <span class="floatleft"><b>Reminder Days *</b></span>
                            <div class="input">
                                <input type="text" id="reminderdays" name="reminderdays" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return numbersonly(event,this);" required>
                            </div>
                            </div>-->
                        <!--<div class="control-label form-group col-lg-6">
                            <span class="floatleft"><b>Access Right *</b></span>
                            <div class="input">
                                <select id="accrgt" name="accrgt[]" class="form_fields form-control col-md-7 col-xs-12" required multiple>
                                    <option value="">Select Access</option> 
                                    <option value="View">View</option>
                                    <option value="Add">Add</option>
                                    <option value="Edit">Edit</option>
                                    <option value="Delete">Delete</option>
                                </select>
                            </div>
                            </div>-->
                    </div>
                    <div class="control-label form-group btnsubmitme col-md-12">
                        <button type="submit" class="btn btn-primary updatemlistid floatleft">Submit</button>
                        <!--  <div class="floatright">
                            <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">Close</button>
                            </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="myModalyesno" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Would you like to go ahead?</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center form_heading">
                    NOTE
                    <div class="clearelement"></div>
                    Deleting The User Will Remove His Access From The System.<br>
                    All The User Details Will be Deleted From The System.<br>
                    Are You Sure You Want To Proceed.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" mlistid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div id="delmod" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                &times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteid" value="" name="">
                <h5 style="text-align: center;">Are You Sure To Delete User?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteuser">Delete</button>
            </div>
        </div>
    </div>
</div>
