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
   
    <h1 class="h1_heading text-center" style="text-align: center;">COI Declaration</h1>
    <div class="create_button">
        <a href="coi/createcoi"> <button type="button" class="btn btn-primary getdata">Create Declaration</button></a>
    </div>
    <div class="cssnumrws form-inline">
        <label>Show</label>
        <select id="noofrows" name="noofrows" class="noofrows form-control">
            <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <label>Entries</label>
    </div> 
    <table width="100%" border="1" class="table table-inverse" id="datableabhi">
     <thead>
      <tr>
        <th>Srno</th> 
        <th>Request Date</th>  
        <!--<th>Status</th>-->
        <th>HR Review</th>
        <th>Manager Review</th>      
        <th>Audit Trail</th> 
        <th>Attachment</th>
        <th>Edit</th>                                           
        <th>Delete</th>                                           
        <th>Declaration</th> 
        
      </tr>
     </thead>
    <tbody class="allcoidata" appendrow='1'></tbody>
    </table>
    <div class="panel panel-white">
        <div class="paginationmn"></div>
        <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
    </div>
</div>

<div id="sendmod" class="modal fade" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
                &times;</button>

        </div>
        <div class="modal-body">
        <input type="hidden" id="reqid" value="" name="">
        <h5 style="text-align: center;">Are You Sure To Send This Request?</h5> </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="sendreq" tempid="">Send</button> 
        </div>
    </div>
</div>
</div>  


<div id="auditTrailModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Audit Trail</h4>
            </div>
            <div class="modal-body show_shadow">
              <div class="text-center adminform_heading">
                  <div class="clearelement"></div> 
                  <table width="100%" border="1" class="table table-inverse" id="datableabhi">
                 <thead>
                  <tr>
                    <th>Sr no</th> 
                    <th>Activity Name</th>  
                    <th>Date</th>
                    <th>Status</th>
                    <th>Recommendation</th>                                                
                  </tr>
                 </thead>
                <tbody id="audittrail" appendrow='1'></tbody>
                </table>
                 
              </div>            
          </div>      
      </div>
  </div>
</div>   
    
<div id="modaldelcoi" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
            &times;</button>
         </div>
         <div class="modal-body">
            <input type="hidden" id="deleteid" value="" name="">
            <h5 style="text-align: center;">Are You Sure To Delete This Request?</h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="confirmdeletereq" tempid="">Delete</button> 
         </div>
      </div>
   </div>
</div>
    
<div id="sendcoiforapproval" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body show_shadow">
             <input type="hidden" id="coi_id" value="" name="">
            <div class="text-center modal_heading">
               <div class="clearelement"></div>
               Do you want to send the Conflict of Interest Declaration form.
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary sendcoiform" name="sendtype" id="" value="yes" tempid="">Yes</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"  value="no" tempid="">No</button>
         </div>
      </div>
   </div>
</div>
        
<div id="attachmentsModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Attachments</h4>
        </div>
        <div class="modal-body show_shadow">
          <div class="text-center adminform_heading">
              <div class="clearelement"></div> 
              <table width="100%" border="1" class="table table-inverse" id="datableabhi">
             <thead>
              <tr>
                <th>Sr no</th> 
                <th>Attachment</th>                                                 
              </tr>
             </thead>
            <tbody id="attachment" appendrow='1'></tbody>
            </table>

          </div>            
      </div>      
  </div>
  </div>
</div> 
    
<div class="clearelement"></div>
<div class="preloder_wraper">
    <a href="javascript:;" class="preloder"></a>
</div>
<div class="clearelement"></div>
</div>
</div>
</div>


<!---------------------------------------MODAL BOX-------------------------------------->




<!-- ########################################## PageContent End ########################################## --> 
 





