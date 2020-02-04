<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
// print_r($getuserinfo);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">

<div class="pdfExport">
    <button type="button" class="btn btn-primary genfile pdf_bg">Export PDF</button>
    <a class="exportcss dwnldExcel" href="" style="display: none;" download>Download</a>
</div> 

<input type="hidden" name="userid" id="userid" value="<?php print_r(base64_decode($_GET["userid"])); ?>">   
<div class="table-responsive design_info">
 <h3 style="text-align: center;">Designated Person Information</h3>
   <table class="table table-inverse" id="datableabhi">
     <thead>
       <tr>
         <th>Sr No</th>
         <th>Name</th> 
          <th>Pan</th>
          <th>Aadhar</th>
          <th>Dob</th>  
          <th>Address</th>  
          <th>Gender</th>    
          <th>Education</th>                                                
          <th>Institution</th>                                                
        </tr>
     </thead>
   <tbody class="accdetails1" appendrow='1'>
          <?php if(isset($getuserinfo[0])) {    ?>
          <tr><td>1</td>
          <td> <?php print_r($getuserinfo[0]['name']); ?></td>
          <td> <?php print_r($getuserinfo[0]['pan']); ?></td>
          <td> <?php print_r($getuserinfo[0]['aadhar']); ?></td>
          <td> <?php print_r($getuserinfo[0]['dob']); ?></td>
          <td> <?php print_r($getuserinfo[0]['address']); ?></td>
          <td> <?php print_r($getuserinfo[0]['sex']); ?></td>
          <td> <?php print_r($getuserinfo[0]['education']); ?></td>
          <td> <?php print_r($getuserinfo[0]['institute']); ?></td><tr>
       <?php }else{?>
         <tr><td colspan="8" style="text-align: center;">Data Not Found</td>
        <?php  } ?>

   </tbody>
  </table>
  </div>
 

<div class="table-responsive design_info">
 <h3 style="text-align: center;">Designated Person's Relative Information</h3>
   <table class="table table-inverse" id="datableabhi1">
     <thead>
       <tr>
         <th>Sr No</th>
         <th>Name</th> 
          <th>Pan</th>
          <th>Aadhar</th>
          <th>Dob</th> 
          <th>Relationship</th> 
          <th>Address</th>  
          <th>Gender</th>    
          <th>Education</th>                                                
        </tr>
     </thead>
   <tbody class="accdetails2" appendrow='1'>
          <?php if(!empty($relativeinfo)) {  
         for($i=0;$i<sizeof($relativeinfo);$i++){
            ?>
           <tr><td> <?php  print_r($i+1); ?></td>
          <td> <?php print_r($relativeinfo[$i]['name']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['pan']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['aadhar']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['dob']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['relationshipname']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['address']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['sex']); ?></td>
          <td> <?php print_r($relativeinfo[$i]['education']); ?></td><tr>
       <?php } }else{?>
         <tr><td colspan="8" style="text-align: center;">Data Not Found</td>
        <?php  } ?>
    </tbody>
 </table>
 </div> 


<div class="table-responsive design_info">
<h3 style="text-align: center;">Designated Person's Demat Accounts</h3>
   <table class="table table-inverse" id="datableabhi2">
     <thead>
       <tr>
         <th>Sr No</th>
         <th>Account No</th> 
          <th>Designated Person Name</th>
          <th>Clearing House</th>
                                                        
        </tr>
     </thead>
   <tbody class="accdetails3" appendrow='1'>
          <?php if(!empty($accountinfo)) {  
         for($i=0;$i<sizeof($accountinfo);$i++){
            ?>
           <tr>
          <td> <?php  print_r($i+1); ?></td>
          <td> <?php print_r($accountinfo[$i]['accountno']); ?></td>
          <td> <?php print_r($accountinfo[$i]['usname']); ?></td>
          <td> <?php print_r($accountinfo[$i]['clearing_house']); ?></td>
          <tr>
        <?php } }else{?>
         <tr><td colspan="8" style="text-align: center;">Data Not Found</td>
        <?php  } ?>
   </tbody>
  </table>
</div>  

<div class="table-responsive design_info">
  <h3 style="text-align: center;">Designated Person's Relative Demat Accounts</h3>
   <table class="table table-inverse" id="datableabhi3">
     <thead>
       <tr>
         <th>Sr No</th>
         <th>Account No</th> 
          <th>Designated Person's Relative Name</th>
          <th>Clearing House</th>
                                                        
        </tr>
     </thead>
   <tbody class="accdetails4" appendrow='1'>
          <?php if(!empty($relativeaccount)) {  
         for($i=0;$i<sizeof($relativeaccount);$i++){
            ?>
           <tr>
          <td> <?php  print_r($i+1); ?></td>
          <td> <?php print_r($relativeaccount[$i]['accountno']); ?></td>
          <td> <?php print_r($relativeaccount[$i]['name']); ?></td>
          <td> <?php print_r($relativeaccount[$i]['clearing_house']); ?></td>
          <tr>
       <?php } }else{?>
         <tr><td colspan="8" style="text-align: center;">Data Not Found</td>
        <?php  } ?>
   </tbody>
  </table>
</div>

<div class="table-responsive design_info">
  <h3 style="text-align: center;">Designated Person's Material Financial Relationship</h3>
   <table class="table table-inverse" id="datableabhi33">
     <thead>
       <tr>
         <th>Sr No</th>
         <th>Name Of Related Party</th> 
         <th>Identity Number</th> 
         <th>Nature Of Relationship</th>
         <th>Address</th>
        
                                                        
        </tr>
     </thead>
   <tbody class="accdetails4" appendrow='1'>
          <?php if(!empty($mfrdata)) {  
         for($i=0;$i<sizeof($mfrdata);$i++){
            ?>
           <tr>
          <td> <?php  print_r($i+1); ?></td>
          <td> <?php print_r($mfrdata[$i]['related_party']); ?></td>
          <td> <?php print_r($mfrdata[$i]['pan']); ?></td>
          <td> <?php print_r($mfrdata[$i]['relationship']); ?></td>
          <td> <?php print_r($mfrdata[$i]['address']); ?></td>
          
          <tr>
       <?php } }else{?>
         <tr><td colspan="3" style="text-align: center;">Data Not Found</td>
        <?php  } ?>
   </tbody>
  </table>
  </div>
 
    
    
    <div class="table-responsive design_info itntfr" id="personmis" itntfr="personmis">
        <h3 style="text-align: center;">Designated Person's Holding MIS</h3>
        <div class="cssnumrws">
            <span>Show</span>
            <select id="noofrows" name="noofrows" class="noofrows">
                <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
            </select> 
            <span>Entries</span>    
        </div> 
        <div class="srcfac" style="float: right;">
            <input type="text" class="bootdatepick" id="date1"  placeholder="Start Date"  readonly="readonly"/>
            <input type="text" class="bootdatepick" id="date2" placeholder="End Date" readonly="readonly"/>
            <input type="button" id="dtrange" class="btn btn-primary" Value="Search"/>
        </div>

        <table class="table table-inverse" id="datableabhi4">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Name Of Company</th> 
                    <th>Type Of Security</th> 
                    <th>No Of Securities</th> 
                    <th>Transaction Date</th>
                    <th>Transaction Type</th>
                    <th>Demat Account No</th>
                </tr>
            </thead>
            <tbody class="accdetails5" appendrow='1'>   
            </tbody>
        </table>
        <div class="panel panel-white">
            <div class="paginationmn" id="acc5"></div>
            <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
        </div>
    </div>
    

    <div class="table-responsive design_info itntfr" id="relativemis" itntfr="relativemis" >
        <h3 style="text-align: center;">Designated Person's Relatives Holding MIS</h3>
        <div class="cssnumrws">
           <span>Show</span>
            <select id="noofrows" name="noofrows" class="noofrows">
               <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
             </select> 
        <span>Entries</span>
        </div> 
        <div class="srcfac" style="float: right;">
            <input type="text" class="bootdatepick" id="desdate1"  placeholder="Start Date"  readonly="readonly"/>
            <input type="text" class="bootdatepick" id="desdate2" placeholder="End Date" readonly="readonly"/>
            <input type="button" id="dtrangedes" class="btn btn-primary" Value="Search"/>
        </div>
        <table class="table table-inverse" id="datableabhi6">
             <thead>
               <tr>
                    <th>Sr No</th>
                    <th>Name Of Relative</th> 
                    <th>Relationship</th> 
                    <th>Name Of Company</th> 
                    <th>No Of Securities</th> 
                    <th>No of Share</th> 
                    <th>Transaction Date</th>
                    <th>Transaction Type</th>
                    <th>Demat Account No</th>
                </tr>
             </thead>
            <tbody class="accdetails6" appendrow='1'>   
            </tbody>
        </table> 
        <div class="panel panel-white">
            <div class="paginationmn" id="acc6"></div>
            <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
        </div>
    </div>
    

</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
 



</div>

