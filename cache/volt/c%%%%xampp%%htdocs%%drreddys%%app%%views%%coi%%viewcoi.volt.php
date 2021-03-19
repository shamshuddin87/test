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
   
    <h1 class="h1_heading text-center" style="text-align: center;">View COI Declaration</h1>

    <table width="100%" border="1" class="table table-inverse" id="datableabhi">
     <thead>
      <tr>
        <th>Srno</th>
        <th>Requester EmpID</th> 
        <th>Requester Name</th>  
        <th>Requestor Dept</th>
        <th>Request Date</th>      
        <th>Status</th>                                           
        <th>Action</th>                                           
        <th>Audit Trail</th>                                           
        <th>Download</th>                                           
      </tr>
     </thead>
    <tbody class="approvaldata" appendrow='1'></tbody>
    </table>
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


 <div id="apprModalyesno" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Approval</h4>
            </div>
            <div class="modal-body show_shadow">
              <div class="text-center adminform_heading">
                  <div class="clearelement"></div> 
                  Are You Sure You Want To Approve?
              </div>            
          </div>      
          <div class="modal-footer">
              <button type="button" class="btn btn-primary mar_0" id="appryesconfirm" reqid>Yes</button>
              <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
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


<div id="rejectModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reject</h4>
            </div>
            <div class="modal-body show_shadow">
              <div class="text-center adminform_heading">
                  <div class="clearelement"></div> 
                  <label for="recommendation">Recommendation:</label>
                    <textarea id="recommendation" name="recommendation" rows="4" cols="20">
                    </textarea>
              </div>            
          </div>      
          <div class="modal-footer">
              <button type="button" class="btn btn-primary mar_0" id="rejectConfirm" reqid>Yes</button>
              <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
          </div>
      </div>
  </div>
</div>


<div id="returnModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Return</h4>
            </div>
            <div class="modal-body show_shadow">
              <div class="text-center adminform_heading">
                  <div class="clearelement"></div> 
                  <label for="recommendation">Recommendation:</label>
                    <textarea id="recommendation" name="recommendation" rows="4" cols="20">
                    </textarea>
              </div>            
          </div>      
          <div class="modal-footer">
              <button type="button" class="btn btn-primary mar_0" id="returnConfirm" reqid>Yes</button>
              <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
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
 





