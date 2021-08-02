<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
//echo "company is ";print_r($planuniqueid);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
     

    <h1 class="h1_heading">View Trading Plan</h1>       

    <input type = "hidden" value="<?php echo $planid; ?>" id="tradeid">
    <input type = "hidden" value="<?php echo $planuniqueid; ?>" id="tradeuniqueid">
   <div class="table-responsive table_wraper tradeplanview">
        <div class="cssnumrws">
       <span>Show</span>
        <select id="noofrows" name="noofrows" class="noofrows">
           <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <span>Entries</span>
    </div>
          <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Request For</th>
                            <th>Relative</th>
                            <th>Company</th>
                            <th>Period Of Plan From</th> 
                            <th>Period Of Plan To</th>
                            <th>Approval Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="appendtradeplanapprvl">
                    </tbody>
                </table>
      
    
    </div>
    
    <div class="panel panel-white">
 <div class="paginationmn"></div>
<input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">

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


<div id="tradeplanmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4>View Your Comment</h4>
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
           
           <textarea id="rejectplantrade"></textarea>

        </div>
    </div>
</div>
</div>



