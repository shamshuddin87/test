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
    <h1 class="h1_heading text-center" style="text-align: center;">Form PCT</h1>
<div class="table-responsive design_info itntfr" id="annualdisc" itntfr="annualdisc" >
        
        <div class="cssnumrws">
           <span>Show</span>
            <select id="noofrows" name="noofrows" class="noofrows">
               <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
             </select> 
        <span>Entries</span>
<!--
            <div style="float: right;">
                <input type="text" placeholder="Search By Name or ID" id="srch" status="0">
            </div>
-->
        </div>
      <!--   <div class="srcfac">
            <input type="text" class="bootdatepick" id="date1"  placeholder="Start Date"  readonly="readonly"/>
            <input type="text" class="bootdatepick" id="date2" placeholder="End Date" readonly="readonly"/>
            <input type="button" id="dtrange" class="btn btn-primary" Value="Search"/>
        </div> -->
        <table class="table table-inverse" id="datableabhi7">
             <thead>
               <tr>
                    <th>Sr No.</th> 
                    <th>Name</th> 
                    <th>Name Of Company</th> 
                    <!-- <th>Approver No.</th>  -->
                    <th>No of Share(s)</th>
                    <th>Type Of Transaction</th>
                    <th>Date Of Approval</th>
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

