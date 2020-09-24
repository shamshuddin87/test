<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
$current_year =  date("Y");
// print_r($getuserinfo);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom "> 
    <h1 class="h1_heading text-center" style="text-align: center;">Change in Designated Persons</h1>
<div class="table-responsive design_info itntfr" id="annualdisc" itntfr="annualdisc" >
        
        <div class="cssnumrws">
           <span>Show</span>
            <select id="noofrows" name="noofrows" class="noofrows">
               <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
             </select> 
        <span>Entries</span>

           <select id="dresign" name="dresign" class="form_fields form-control col-md-7 col-xs-12" onchange="changeFunc();" required="">
                <option value="1">Last 6 months connected persons</option>
                <option value="0" selected="selected">Other</option>
            </select>

            <div style="float: right;">
                <input type="text" placeholder="Search By Name" id="srch" status="0">
            </div>
            
            <div class="cssfilter" style="float: right;">               
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
        <div class="srcfac" style="float: right;">
            <input type="text" class="bootdatepick" id="date1"  placeholder="Start Date"  readonly="readonly"/>
            <input type="text" class="bootdatepick" id="date2" placeholder="End Date" readonly="readonly"/>
            <input type="button" id="dtrange" class="btn btn-primary" Value="Search"/>
        </div>
        <table class="table table-inverse" id="datableabhi7">
             <thead>
               <tr>
                    <th>Sr No.</th> 
                    <th>Name</th> 
                    <th>Employee Status</th>
                   <!--  <th>Employee ID</th>  -->
                    <th>Resignation Date</th> 
                    <th>Addition/ Deletion</th> 
                    <th>Date of Change</th> 
                </tr>
             </thead>
            <tbody class="accdetails8" appendrow='1'>   
            </tbody>
        </table> 
        <div class="panel panel-white">
            <div class="paginationmn" id="acc8"></div>
            <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
        </div>
    </div>
    
    

</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
 



</div>

