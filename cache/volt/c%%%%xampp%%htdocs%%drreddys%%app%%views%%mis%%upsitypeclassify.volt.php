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
       <div class="cssnumrws">
                <span>Show</span>
                <select id="noofrows" name="noofrows" class="noofrows">
                <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
                </select> 
                <span>Entries</span>
             <div style="float:right;">
                <button type="button" class="btn btn-primary genfile pdf_bg" request="pdf" >Export PDF</button>
                <button type="button" class="btn btn-primary genfile excel_bg" request="excel">Export Excel</button>
                <a class="exportcss dwnldExcel" href="" style="display: none;" download>Download</a>
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
                            <th>Added By</th> 
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
 
