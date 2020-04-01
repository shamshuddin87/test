<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<?php //echo"<pre>";print_r($userdetails[0]['fullname']); ?> 

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
    
<!--    Total Number of Contracts Ends-->
<!-- My messages -->
<div class="mainelementfom">
  <div class="container">
   
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <div class="login-button-container clearfix">


     <!--  <div class="col-xs-6 sign-in">
        <button class="btn personal active">
           Personal Request        
        </button>
      </div>

      <div class="col-xs-6 register">
        <button class="btn relatives">
         Relative Request  
        </button>
      </div>
 -->
    </div>
  </div>

<!--###############PERSONAL REQUEST###########-->
<div class=""><h1 class="h1_heading text-center"> Approve Exception Requests</h1></div>
  <div class="box_outer row col-md-12 col-xs-12 col-sm-12 row personaldetails" style="display: block;">
<!--  <h3>Approve Exception Requests</h3> -->

  <div class="cssnumrws form-inline">
    <input type="button"  id="exceptapproval" value="Approve" class="btn btn-primary" style="float: right;"></button>
 <input type="hidden" name="" id="redirecturl" value="" >
 
   <label>Show</label>
     <select id="noofrows" name="noofrows" class="noofrows form-control">
       <option value="10">10</option><option value="25">25</option>
        <option value="50">50</option><option value="100">100</option>
        </select> 
        <label>Entries</label>
        </div> 
        <div class="table-responsive">   
        <table class="table table-inverse" id="datablerushi">
        <thead>
        <tr>
       
          <th>Sr No</th>
           <th>Name</th>
          <th>Security Type</th>
          <th>Name Of Company</th>
          <th>Type Of Transaction</th>
          <th>No Of Shares</th>
          <th>Type Of Request</th>
          <th>Name Of Relative</th>
          <th>Relationship</th>
<!--          <th>Price Per Share</th>-->
<!--          <th>Total Amount</th>-->
          <th>Exception Approvel Status</th>
          <th>Transaction Date</th>
          <th>Created Date</th>
          <th>File</th>
          <th>Audit Trail</th>
<!--          <th>Reason</th>-->
          <th><input type="checkbox" class="getallchkbox" name="getallchkbox" chkval="ALL" value="ALL" size="30px;"></th>
        </tr>
      </thead>
     <tbody class="viewreqtable" appendrow='1'></tbody>
   </table>
 </div>
  <div class="panel panel-white">
 <div class="paginationmn"></div>
<input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">

</div>
<div id="myModal" class="modal">
   <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Trading Status</h4>
      </div>
    
    <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
     <thead>
       <tr><th>No Of Share</th><th>Price Per Share</th><th>Total Amount</th><th>Date Of Transaction</th><th>Demat Account No</th></tr></thead>
         <tbody class="statustable" appendrow='1'></tbody>
      </table>
    </div>
  </div>
</div>

 <div id="approvdel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
            <input type="hidden" id="deleteid" value="" name="">
            <h5 style="text-align: center;">Are You Sure To Delete This Request?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="approvedel" tempid="">Delete</button> 
            </div>
        </div>
    </div>
</div>
</div>

<div id="commentmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h3>Please Enter Your Comment</h3>
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
           
           <textarea  width="100%" id="rejectmessage"></textarea>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="rejectapprov" rejectid="">Reject</button> 
            </div>
        </div>
    </div>
</div>
</div>
 

 <div id="showcomment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <textarea rows="4" cols="50" id="mymess" readonly>
            </textarea>

        </div>
    </div>
</div>   
</div>
<!------------------------------------------------------------------------------------------------------------>

</div>

<!--################################RELATIVE SECTION START HERE############-->
<div class="col-md-12 col-xs-12 col-sm-12 row relativesform" style="display: none;">
<!--MODAL BOX FOR EDIT RELATIONSHIP FINISH--->
</div>
</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
<div id="approvedreq" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
                <h4 class="modal-title">
                </h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="selctedid" name="selctedid">
              <input type="hidden" id="selctedidlength" name="selctedidlength">
                
              <!-- <h4 class="date_h4">Date Before Which Trading To Be Done</h4> -->
                <section class="col col-md-12 col-xs-12">
                 <div class="input tradedate">
                  <label class="control-label">Date Before Which Trading To Be Done</label>
                  <input type="text" class="form-control bootdatepick" id="tradedate"  name="tradedate">
                 </div>
                </section>
            </div>
            <div class="modal-footer">
             <input type="submit" class="btn btn-success Yesreqst" id="aprvsubmit" value="Submit">
            </div>
        </div>
    </div>
</div>

<div id="Mymodalaudittrail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Audit Trail</h4>
      </div>
        <div class="modal-body">
            <div class="trailreq">
                <table border="1" width="100%">
                  <tr>
                    <th>Events</th>
                    <th>Details</th>
                  </tr>
                    <tr>
                        <td>Created On :</td>
                        <td><span class="reqstcreateddte"></span></td>
                    </tr>
                    <tr>
                        <td>Updated On :</td>
                        <td><span class="reqstupdteddte"></span></td>
                    </tr>
                    <tr>
                        <td>Application Copy :</td>
                        <td><span class="pdfpath"></span></td>
                    </tr>
                    <tr>
                        <td>Sent for Approval On :</td>
                        <td><span class="reqstsendapprv"></span></td>
                    </tr>
                    <tr>
                        <td>Approved On :</td>
                        <td><span class="reqstapprvd"></span></td>
                    </tr>
                    <tr>
                        <td>Transaction Status :</td>
                        <td><span class="reqsttrdngsts"></span></td>
                    </tr>
                    <tr>
                        <td>Transaction Status Updated On :</td>
                        <td><span class="reqststsupdate"></span></td>
                    </tr>
                    <tr>
                        <td>Transaction Completed On :</td>
                        <td><span class="reqsttranscmplt"></span></td>
                    </tr>
                </table>
              
            </div>       
        </div>


      </div>
    </div>
</div>

<div id="showexereason" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            <h4 class="modal-title">Reason
                </h4>
            </div>
            <textarea rows="4" cols="50" id="exereason" readonly>
            </textarea>

        </div>
    </div>
</div>