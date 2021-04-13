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
    <div class="cssnumrws form-inline">
        <label>Show</label>
        <select id="noofrows" name="noofrows" class="noofrows form-control">
            <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <label>Entries</label>
        
        <div class="top_margin">
        <input style="width: 217px" type="text" placeholder="Search By Requester ID / Name" class="form-control" id="srch" status="0">
    </div>
        
        <div class="cssfilter form-inline">               
        <div class="control-label form-group">
            <label>Status Filter</label>
            <select id="filterstatus" name="filterstatus" class="form-control">
                <option value="">All</option>
                <!--<option value="To Be Send">To Be Send</option>-->
                <option value="Pending Approval">Pending Approval</option>
                <option value="Returned">Returned</option>
                <option value="Rejected">Rejected</option>
                <option value="Approved">Approved</option>
            </select>
        </div>
        </div>
      </div> 
    <div class="cssnumrws form-inline">
    
        <div class="srcfac  form-inline ">
            <input type="text" class="bootdatepick form-control" id="date1"  placeholder="Start Date"  readonly="readonly"/>
            <input type="text" class="bootdatepick form-control" id="date2" placeholder="End Date" readonly="readonly"/>
            <input type="button" id="dtrange" class="btn btn-primary form-control" Value="Search" style="margin: 0 5px;"/>

          <a class="floatright exportcss dwnldExcel btn btn-primary" href="" style="display: none;" download>Download</a>
          <button type="button" class="floatright btn btn-primary genfile pdf_bg" request="pdf">Export PDF</button>
          <button type="button" class="floatright btn btn-primary genfile excel_bg" request="excel">Export Excel</button>
        </div>
        
        <div class="">
          
        </div>
    </div>
    
    <div class="containergrid">
    <div class="panel panel-primary">
        <div class="table-responsive">
        <table class="table table-inverse" id="datablerushi">
         <thead>
          <tr>
            <th>Srno</th>
            <th>Requester ID</th> 
            <th>Requester Name</th>  
            <th>Requestor Dept</th>
            <th>Request Date</th>      
            <th>Status</th>                                           
            <th>Action</th>                                           
            <th>Audit Trail</th>
            <th>Attachment</th> 
            <th>Declaration</th>                                           
                                                      
          </tr>
         </thead>
        <tbody class="approvaldata" appendrow='1'></tbody>
        </table>
    <div class="panel panel-white">
        <div class="paginationmn"></div>
        <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
    </div>
    </div>
    </div>
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
              <div class="adminform_heading">
                  <div class="clearelement"></div> 
                  <label for="recommendation" style="display: block;">Recommendation:</label>
                    <textarea style="width: 100%;" id="recommendation" name="recommendation" rows="4">
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
              <div class="adminform_heading">
                  <div class="clearelement"></div> 
                  <label for="recommendation" style="display: block;">Recommendation:</label>
                    <textarea style="width: 100%;" id="recommendation" name="recommendation" rows="4" cols="20">
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
 





