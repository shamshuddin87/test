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
     

    <h1 class="h1_heading text-center">Database of UPSI Shared</h1>
  <div class="containergrid formcss">
          
  
   <div class="table-responsive table_wraper">
       <div class="cssnumrws form-inline">
                <span>Show</span>
                <select id="noofrows" name="noofrows" class="noofrows form-control">
                <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
                </select> 
                <span>Entries</span>

            <div style="float:right;">
                <button type="button" class="btn btn-primary genfile pdf_bg" request="pdf"  style="padding: 8px 12px;">Export PDF</button>
                <button type="button" class="btn btn-primary genfile excel_bg" request="excel" style="padding: 8px 12px;">Export Excel</button>
                <a class="exportcss dwnldExcel" href="" style="display: none;" download>Download</a>
            </div>

            <div class="cssfilter" style="float:right;">               
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

            
        </div>
     
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name of UPSI</th>
                            <th>Project Start Date</th>
                            <th>Project End Date</th>
                            <th>Creation Date</th> 
                            <th>Shared By</th> 
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
                    </tbody>
                </table>
            </div>

 <div class="panel panel-white">
            <div class="paginationmn"></div>
            <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
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
 
