<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
//echo "company is ";print_r($user_group_id);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
     

    <h1 class="h1_heading text-center">Database of Connected Person</h1>


   <div class="table-responsive table_wraper">
    <div class="cssfilter  form-inline " style="">               
        <div class="control-label form-group">
            <label>Status</label>
            <select id="emp_status" name="emp_status" class="form-control">
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="2">Resigned</option>
                <option value="3">Not a DP</option>
            </select>
        </div>
    </div>
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Name of entity</th>
                            <th>Name</th>
                            <th>Identity No.</th> 
                            <th>Phone Number</th> 
                            <th>Mobile Number</th> 
                            <th>Designation</th> 
                            <th>Email ID</th> 
                            <th>Download Identity Proof</th> 
                            <th>Download Confidentiallity Agreement</th> 
                            <th>Added On</th>
                            <th>Added By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
                    </tbody>
                </table>
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
 
