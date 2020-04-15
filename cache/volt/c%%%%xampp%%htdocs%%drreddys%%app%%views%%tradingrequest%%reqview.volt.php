<?php 
$gmnlog = $this->session->loginauthspuserfront; 
//echo '<pre>'; print_r($status); exit;
?>



<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
    
        <!--    Total Number of Contracts Ends-->
        <!-- My messages -->
        <div class="mainelementfom">
        <div>  <h1 class="h1_heading text-center"> Approve Requests</h1> </div>
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

                <!--############### Start PERSONAL REQUEST ###########-->
                <div class="box_outer row col-md-12 col-xs-12 col-sm-12 row personaldetails" style="display: block;">

                 

                    <!-- start: added for status filter -->
                    <div class="cssfilter">
                        <div class="approve_button"><input type="button"  id="acceeptappr" value="Approve" class="btn btn-primary"></div>
                        
                            <div class="control-label form-group">
                                <label>Status Filter</label>
                                <select id="filterstatus" name="filterstatus" class="form-control">
                                    <option value="" <?php if($status==''){ echo 'selected'; } ?> >All</option>
<!--                                    <option value="drafted" <?php if($status=='drafted'){ echo 'selected'; } ?> >Drafted</option>-->
                                    <option value="sent_for_approval" <?php if($status=='sent_for_approval'){ echo 'selected'; } ?> >Sent for approval</option>
                                    <option value="not_approved" <?php if($status=='not_approved'){ echo 'selected'; } ?> >Not approved</option>
                                    <option value="approved" <?php if($status=='approved'){ echo 'selected'; } ?> >Approved</option>
                                    <option value="rejected" <?php if($status=='rejected'){ echo 'selected'; } ?> >Rejected</option>
                                    <option value="trade_pending" <?php if($status=='trade_pending'){ echo 'selected'; } ?> >Trade pending</option>
                                    <option value="trade_not_done" <?php if($status=='trade_not_done'){ echo 'selected'; } ?> >Trade Not Done</option>
                                    <option value="trade_completed" <?php if($status=='trade_completed'){ echo 'selected'; } ?> >Trade completed</option>
                                </select>
                            </div>
                    </div>
                    <!-- end: added for status filter -->
                    <div class="makeitresponsive">
                        <div class="table-responsive">   
                        <table class="table table-inverse" id="datable">
                            <thead>
                                <tr>       
                                    <!--<th>Sr No</th>-->
                                    <th>Name</th>
                                    <th>Security Type</th>
                                   <!--  <th>Name Of Company</th> -->
                                    <th>Type Of Transaction</th>
                                    <th>No Of Shares</th>
                                    <th>Type Of Request</th>
                                    <th>Name Of Relative</th>
                                    <th>Relationship</th>
                                    <th>Approval Status</th>
                                    <th>Trading Window</th>
                                    <th>Created Date</th>
                                    <th>File</th>
                                    <th>Audit Trail</th>
                                    <th>Action <input type="checkbox" class="getallchkbox" name="getallchkbox" chkval="ALL" value="ALL" size="30px;"></th>
                                </tr>
                            </thead>
                         <tbody class="viewreqtable" appendrow='1'></tbody>
                        </table>
                        </div>
                    </div>
                    <div class="panel panel-white">

                        <div class="cssnumrws count_page form-inline">
                           <label>Show</label>
                                <select id="noofrows" name="noofrows" class="noofrows form-control">
                                    <option value="10">10</option><option value="25">25</option>
                                    <option value="50">50</option><option value="100">100</option>
                                </select> 
                        <label>Entries</label>
                    </div>

                        <div class="paginationmn"></div>
                        <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                    </div>

                </div>
                <!--############### End PERSONAL REQUEST ###########-->

        </div>
        </div>


<div class="preloder_wraper">
    <a href="javascript:;" class="preloder"></a>
</div>

</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 



<div id="myModal" class="modal">
   <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Trading Status</h4>
      </div>
    <!-- <span class="close"  data-dismiss="modal">&times;</span> -->
    <table class="table table-inverse mytable" id="datable" typage="reqview">
     <thead>
       <tr><th>No Of Share</th><th>Price Per Share</th><th>Total Amount</th><th>Date Of Transaction</th><th>Demat Account No</th><th>File</th></tr></thead>
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
               <!--   <div class="input tradedate"> -->
                  <h5 style="text-align: center;">Are You Sure To Approve All This Trades?</h5>
                 <!--  <input type="text" class="form-control bootdatepick" id="tradedate"  name="tradedate">
                 </div> -->
                </section>
            </div>
            <div class="modal-footer">
             <input type="submit" class="btn btn-success" id="aprvsubmit" value="Submit">
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
