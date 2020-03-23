<?php $gmnlog = $this->session->loginauthspuserfront;

    //print_r($selfdemat);exit;

 ?>

<?php //echo"<pre>";print_r($relativeinfo);exit;name user_id ?> 

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
    
    <!--    Total Number of Contracts Ends-->
    <!-- My messages -->
    <div class="mainelementfom">
        <div>  <h1 class="h1_heading text-center"> Your Requests</h1> </div>


    <div class="container">

        <input type="hidden" name="" id="redirecturl" value="<?php echo $redirecturl; ?>" >

        


       
        <!-- ------------------- Start Table For Created Request ------------------- -->
         <div class="bg_white">
            <div class="cssnumrws">
                <span>Show</span>
                <select id="noofrows" name="noofrows" class="noofrows">
                    <option value="10">10</option><option value="25">25</option>
                    <option value="50">50</option><option value="100">100</option>
                </select> 
                <span>Entries</span>
            </div> 
             <!-- start: added for status filter -->
            <div class="create_button">
             <div class="top_margin">   
            <button type="button" class="btn btn-primary createreq">Create Request</button>
<!--            <input type="button"  id="sendmulreq" value="Send" class="btn btn-primary">-->
            </div> 
                <div class="cssfilter">               
                    <div class="control-label form-group">
                        <label>Status Filter</label>
                        <select id="filterstatus" name="filterstatus" class="form-control">
                            <option value="">All</option>
<!--                            <option value="drafted">Drafted</option>-->
                            <option value="sent_for_approval">Sent for approval</option>
                            <option value="not_approved">Not approved</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="trade_pending">Trade pending</option>
                            <option value="trade_not_done">Trade Not Done</option>
                            <option value="trade_completed">Trade completed</option>
                        </select>
                    </div>
                </div>

            </div>
            
<!-- end: added for status filter -->
        <div class="makeitresponsive">
            <div class="table-responsive">    
                <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="getallchkbox" name="getallchkbox" chkval="ALL" value="ALL">All</th>
                            <th>Type Of Security</th>
                            <th>Name Of Company</th>
                            <th>Type Of Transaction</th>
                            <th>No Of Shares</th>
                            <th>Type Of Request</th>
                            <th>Name Of Relative</th>
                            <th>Relationship</th>
                            <!--<th>Total Amount</th>-->
<!--                            <th>Request Status</th>-->
                            <th>Approval Status</th>
                            <th>Trading Window</th>
                            <th>Created Date</th>
                            <!--<th>Updated Date</th>-->
                            <th>Trading Status</th>
                            <th>Audit Trail</th>
<!--                            <th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody class="reqtable" appendrow='1'></tbody>
                </table>
                <div class="panel panel-white">
                    <div class="paginationmn"></div>
                    <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                </div>
            </div>
        </div>
    </div>
        <!-- ------------------- End Table For Created Request ------------------- -->

    </div>
    </div>
    
<div class="clearelement"></div>
<div class="preloder_wraper">
    <a href="javascript:;" class="preloder"></a>
</div>
<div class="clearelement"></div>
<!-- /main content -->
 
</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 






<!-- ------------------------ Start PERSONAL REQUEST ------------------------ -->
<div id="Mymodalreq" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Create  Trading Request</h4>
    </div>
    <div class="modal-body show_shadow">
        <form  action="" id="tradinform" method="post" autocomplete="off">

            <input type="hidden" class="form-control" id="approverid" name="approverid" value="<?php  echo $alldetails['approvid']; ?>">
            <input type="hidden" class="form-control" id="reqname" name="reqname" value="<?php  echo $alldetails['fullname']; ?>">

            <!--
            <div class="form-group">
                <label for="exampleFormControlSelect1">Demat Account No</label>
                <select id="demataccno" name="demataccno" class="form_fields form-control col-md-7 col-xs-12" required>
                    <option value="" id="demataccno" >Select Account No</option>
                    <?php foreach($demataccno as $rel){  ?>
                    <option value="<?php echo $rel['accountno']; ?>"><?php echo $rel['accountno']; ?></option>
                    <?php } ?>
                </select>
            </div>
            -->
            
            <div class="form-group">
                <label for="">Select Type Of Request</label>
                <select class="form-control" id="typeofrequest" name="typeofrequest">
                    <option value="" >Select Type of Request</option>
                    <option value="1" >Self</option>
                    <option value="2">Relative</option>
                </select>
            </div>

            <div class="form-group" id="selrel">
                <label for="exampleFormControlSelect1">Select Relative</label>
                <select id="selrelative" name="selrelative" class="form_fields form-control col-md-7 col-xs-12" >
                    <option value="" id="sectyperel" >Select Relattive</option>
                    <?php foreach($relativeinfo as $rel){  ?>
                    <option value="<?php echo $rel['id']; ?>"><?php echo $rel['name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Type Of Security</label>
                <select id="sectypeid" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                    <option value="" id="sectype" >Select Security</option>
                    <?php foreach($sectype as $rel){  ?>
                    <option value="<?php echo $rel['id']; ?>"><?php echo $rel['security_type']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Name Of Company</label>
                <input type="hidden" class="form-control" id="idofcmp" name="idofcmp" value="">
                <input type="text" class="form-control" id="nameofcmp" name="nameofcmp" placeholder="Search..." >
            </div>

            <div id="searchcmp"></div>

            <div class="form-group">
                <label for="exampleFormControlInput1">No Of Shares</label>
                <input type="text" class="form-control" name="noofshare" id="noofshare" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="No Of Share">
            </div>

            <div class="form-group">
                <label for="">Type Of Transaction</label>
                <select class="form-control" id="typeoftrans" name="typeoftrans">
                    <option value="1">BUY</option>
                    <option value="2">SELL</option>
                    <option value="3">BONUS</option>
                    <option value="4">RIGHTS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Approx price or range (shares/ADRs * market price)</label>
               
                <input type="text" class="form-control" id="sharesprice" name="sharesprice" placeholder="Approx price or range (shares/ADRs * market price)" >
            </div>

             

             <div class="form-group">
                <label for="exampleFormControlInput1">Broker through which dealing will take place</label>
               
                <input type="text" class="form-control" id="broker" name="broker" placeholder="Broker through which dealing will take place" >
            </div>

            <div class="form-group">
               
                <label for="">Demat Account</label>
                <select class="form-control" id="demataccount" name="demataccount">
                <option value="">Select Demat Account</option>
                          
                </select>
            </div>

              <div class="form-group">
                <label for="">Place</label>
                 <input type="text" class="form-control " id="place" name="place" placeholder="Place" >
               
            </div>




            <div class="form-group col-md-12" style="margin-left: -9px;">
                <label for="">Provide, details, of any transaction done in Company’s Security in the last Six months (Except exercise of stock options)</label>
                <div id = "left" class="form-group col-md-4" style="margin-left: -9px;">
                <label for="">Date</label>
                <input type="text" class="form-control bootdatepick" id="dateoftrans[]" name="dateoftrans[]" placeholder="Date" >
                </div>
                <div id = "middle" class="form-group col-md-4">
                 <label for="">Transaction</label>
                <input type="text" class="form-control " id="trans[]" name="trans[]" placeholder="Transaction" >
                </div>
                <div id = "right" class="form-group col-md-4">
                <label for="">No of Shares</label>
                <input type="text" class="form-control " id="sharestrans[]" name="sharestrans[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="No of Shares">
                </div>
               
            </div>

             <div class = "appenddiv" id="appenddiv">
            </div>

            <div class="adddiv2section1 col-md-12"  style="padding-bottom: 10px; text-align: right;">
            <input type="button" id ="adddiv" class="btn btn-primary "  value="+" onclick="addhtml(this.id);">
            <input type="button" id = "remvdiv" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
            <input type="hidden" class="append" plancntr="1">
            </div>




            <input type="button" id ="sendrequest" name="sendreq" value="SEND" class="btn btn-primary sendrequst" style="float: right;">  
<!--            <input type="button"  name="draft" value="SAVE AS DRAFT" id="draftedreq" class="btn btn-primary reqdraft" style="float: right;"> -->

        </form>
    </div>
    
    <div class="modal-footer">
    </div>
</div>
</div>
</div>
<!-- ------------------------ End PERSONAL REQUEST ------------------------ -->


 <div id="delmod" class="modal fade" role="dialog">
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
              <button type="button" class="btn btn-danger" id="deletereq" tempid="">Delete</button> 
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal">
   <div class="modal-dialog">
  <div class="modal-content">
   
    <span class="close"  data-dismiss="modal">&times;</span>
    <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
     <thead>
       <tr><th>No Of Share</th><th>Price Per Share</th><th>Total Amount</th><th>Date Of Transaction</th><th>Demat Account No</th><th>File</th></tr></thead>
         <tbody class="statustable" appendrow='1'></tbody>
      </table>
    </div>
  </div>
</div>


<div id="commentmodal" class="modal fade" role="dialog">
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


<!-- ---------------------- Start MODAL BOX FOR UPDATE ---------------------- -->
<div id="updatemodal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close modalclose" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Trading Request</h4>
    </div>
    
    <div class="modal-body show_shadow">
    <form  action="tradingrequest/tradingrequdate" id="tradinformupdate" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="editid" id="editid" value="">

        <div class="form-group">
            <label for="">Select Type Of Request</label>
            <select class="form-control" id="typeofrequest" name="typeofrequest">
                <option value="1" selected="selected">Personal</option>
                <option value="2">Relative</option>
            </select>
        </div>

        <div class="form-group" id="selrel">
            <label for="exampleFormControlSelect1">Select Relative</label>
            <select id="selrelative" name="selrelative" class="form_fields form-control col-md-7 col-xs-12" >
                <option value="" id="sectype" >Select Relattive</option>
                <?php foreach($relativeinfo as $rel){  ?>
                <option value="<?php echo $rel['id']; ?>"><?php echo $rel['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Type Of Security</label>
            <select id="sectype" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                <option value="" id="sectype" >Select Security</option>
                <?php foreach($sectype as $rel){  ?>
                <option value="<?php echo $rel['id']; ?>"><?php echo $rel['security_type']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Name Of Company</label>
            <input type="hidden" class="form-control" id="idofcmp" name="idofcmp" value="">
            <input type="text" class="form-control" id="nameofcmp" name="nameofcmp" placeholder="Search..." >
        </div>

        <div id="searchcmp"></div>

        <div class="form-group">
            <label for="exampleFormControlInput1">No Of Shares</label>
            <input type="text" class="form-control" name="noofshare" id="noofshare" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="No Of Share">
        </div>

        <div class="form-group">
            <label for="">Type Of Transaction</label>
            <select class="form-control" id="typeoftrans" name="typeoftrans">
                <option value="BUY">BUY</option>
                <option value="SELL">SELL</option>
                <option value="BONUS">BONUS</option>
                <option value="RIGHTS">RIGHTS</option>
            </select>
        </div>
        <input type="submit"   value="Update" class="btn btn-primary" style="float: right;"> 
        
    </form>
    </div>
    
    <div class="modal-footer">
    </div>
</div>
</div>
</div>
<!-- ---------------------- End MODAL BOX FOR UPDATE ---------------------- -->


<!-- ---------------------- Start MODAL BOX FOR UPLOAD FILE ---------------------- -->
<div id="uploadmyfile" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content margin-top">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">×</button>
           <h4 class="modal-title">Trading Status</h4>
        </div>

        <div class="modal-body dispalytrade">
        <form action="tradingrequest/uploadtradingfile" id="uploadtrade" method="post" enctype="multipart/form-data" autocomplete="off">

            <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
                <thead>
                    <tr>
                        <th style="width: 18%">No Of Share</th>
                        <th style="width: 20%">Price Per Share</th>
                        <th style="width: 25%">Total Amount</th>
                        <th style="width: 15%">Date Of Transaction</th>
                        <th style="width: 45%">Demat Account No</th>
                        <th style="width: 15%">Broker Notes</th>
                    </tr>
                </thead>
                <tbody class="modtable" appendrow='1'>
                    <tr>
                        <td>
                            <input type="text" name="noofshare" value="" id="noofsharemodal" class="form-control noshare">
                        </td>
                        <td>
                            <input type="text" name="priceofshare" value="" id="pricepersharemodal" class="form-control priceshare">
                        </td>
                        <td>
                            <input type="text" name="total" value="" id="totalamtmodal" class="form-control" readonly>
                        </td>
                        <td>
                            <input type="text"  name="transdate" value="" id="transdatemodal" class="form-control bootdatepick" readonly>
                        </td>
                        <td>
                            <select id="dmatacc" name="dmatacc" class="form_fields form-control col-md-7 col-xs-12" required>
                                <!--<option value="">Select Option</option>-->
                            </select>
                        </td>
                        <td>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </tr>
                </tbody>
            </table>

            <input type="hidden" name="transtype" id="transtype" value="">
            <input type="hidden" name="noofffshares" id="noofffshares" value="">
            <input type="hidden" name="transshare" id="transshare" value="">
            <input type="hidden" name="reqid" id="filereqid" value="">
            <input type="hidden" name="compid" id="compid" value="">
            <input type="hidden" name="sectype" id="sectype" value="">  
            <input type="hidden" name="tradedate" id="tradedate" value="">  
            <input type="hidden" name="createdate" id="createdate" value="">  

            <input  type="submit" name="uploadtrade" class="btn btn-primary"  value="Upload" id="subfile" tempid="" style="float:right;">

            <div style="display: none;" id="excdiv">
                <input  type="submit" name="uploadtrade" class="btn btn-primary"  value="Exception Request" id="excreq" exceptionreq="" style="float:right;">
            </div>
        </form>

            <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
                <thead>
                    <tr>
                        <th style="width: 10%">No Of Share</th>
                        <th style="width: 20%">Price Per Share</th>
                        <th style="width: 20%">Total Amount</th>
                        <th style="width: 15%">Date Of Transaction</th>
                        <th style="width: 20%">Demat Account No</th>
                        <th style="width: 20%">File</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody class="tradeviewtb" appendrow='1'></tbody>
            </table>

            <div class="cmplttrans">
                <h4 class="trade" style="text-align: center;">Is this transaction completed?</h4>
                <label class="switch_button">
                    <input type="checkbox" id="modalcheck" name="modalcheck" class="yestrade" value="true">
                    <span class="slider round"></span>
                </label>
            </div>
            <span id="typebtn">
                <input type="button" id="nottrade" class="btn btn-danger" value="Trading Not Done" >
            </span>
        </div>

</div>
</div>
</div>
<!-- ---------------------- End MODAL BOX FOR UPLOAD FILE ---------------------- -->


<div id="delmytrade" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5 style="text-align: center;">Are You Sure To Delete This trade?</h5> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="delthistrade" tempid="">Delete</button> 
            </div>
        </div>
    </div>
</div>



<!-- -------------------- Start MODAL BOX FOR EDIT RELATIONSHIP -------------------- -->
<div id="checkappvlrequest" class="modal fade" role="dialog">
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
             <!-- <a id="pdflink" download><input type="button" class="btn btn-success"  value="Download"></a> -->

              <input type="hidden" id="approverid" name="approverid">
              <input type="hidden" id="reqname" name="reqname">
              <input type="hidden" id="typeofrequest" name="typeofrequest">
              <input type="hidden" id="selrelative" name="selrelative">
              <input type="hidden" id="sectype" name="sectype">
              <input type="hidden" id="idofcmp" name="idofcmp">
              <input type="hidden" id="nameofcmp" name="nameofcmp">
              <input type="hidden" id="noofshare" name="noofshare">
              <input type="hidden" id="typeoftrans" name="typeoftrans">
               <input type="hidden" id="sendreq" name="sendreq">
              <input type="hidden" id="approxprice" name="approxprice">
             <input type="hidden" id="broker" name="broker">
             <input type="hidden" id="demataccount" name="demataccount">
            <input type="hidden" id="place" name="place">
           <input type="hidden" id="datetrans" name="datetrans">
          <input type="hidden" id="transaction" name="sendreq">
         <input type="hidden" id="sharestrans" name="sharestrans">



                
              <h4 style="text-align: center;">Please confirm that you do not hold any UPSI Information</h4>
               
            </div>
            <div class="modal-footer">
             <input type="submit" class="btn btn-success" id="Yesreqst" value="Yes">
             <input type="submit" class="btn btn-success" id="Norequest" value="No">
            </div>
        </div>
    </div>
</div>
<!-- -------------------- End MODAL BOX FOR EDIT RELATIONSHIP -------------------- -->


<div id="checkappvlreq" class="modal fade" role="dialog">
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
                
              <h4 style="text-align: center;">Please confirm that you do not hold any UPSI Information</h4>
               
            </div>
            <div class="modal-footer">
             <input type="button" class="btn btn-primary" id="Yesreqstsend" value="Yes">
             <input type="button" class="btn btn-danger" id="Norequestsend" value="No">
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


<div id="formI" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">
                     &times;</button>
                 
         <div id = "appendformI">
           
         </div>    
               
        </div>
            <div class="modal-footer" style="border-top:none;">
              <button type="button" class="btn btn-primary" id="Yesexcreqst">Yes</button> 
            <button style="color: #522c8f !important;border-color: #cecece;"  type="button" class="btn btn-default" id="Noexcrequest">No</button>
            </div>
    </div>
</div>
</div>
<div id="chckexcptnrequest" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal">
                     &times;</button>
                 <button type="button" class="btn btn-primary" id="pdflink" download value="Download" style="display:none;"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
               <h5 style="text-align: center;color: #000;margin: 45px 50px 25px 50px;line-height: 25px;">This transaction is a contra trade within 6 months of previous trade. You will require an exceptional pre-clearance approval for such trade request. Also, you can raise this request only if you do not hold any UPSI. Please confirm if you want to send exception approval?</h5>
               
            </div>
            <div class="modal-footer" style="border-top:none;">
              <button type="button" class="btn btn-primary" id="Yesexcreqst">Yes</button> 
            <button style="color: #522c8f !important;border-color: #cecece;"  type="button" class="btn btn-default" id="Noexcrequest">No</button>
            </div>
    </div>
</div>
</div>
<div id="exceptnresionmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h3>Please Enter Your Reason</h3>
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            </div>
            <div class="modal-body">
           
           <textarea  width="80%" id="reason"></textarea>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="reasonexe">Submit</button> 
            </div>
        </div>
    </div>
</div>
</div>
<div id="reasonexceptn" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h3>Additional Questions</h3>
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <label for="">I intend to sell/purchase/exercise no. of shares/ADRs/options of the Company because of following reason(s)</label>
                <select class="form-control" id="reasonoftrans" name="reasonoftrans">
                    <option value="">Select Option</option>
                    <option value="1">Medical Expenses for self / family Members</option>
                    <option value="2">Repayment of existing Loan</option>
                    <option value="3">Wedding /other family function</option>
                    <option value="4">Education</option>
                    <option value="5">Any other reason (Please specify)</option>
                </select>
            </div>
                
            <div class="form-group otherreason" style="display:none;">
                <label for="">Any other reason*</label>
                <input type="text" class="form-control" name="otherreason" id="otherreason" placeholder="Any other reason (Please specify)">
            </div>
                
           <div class="form-group">
                <label for="">Date of last purchase / sale</label>
                <input type="text" class="form-control bootdatepick" name="lasttransdate" id="lasttransdate" readonly placeholder="Date of last purchase / sale">
            </div>
            
            <div class="form-group">
                <label for="">No. of shares / ADRs purchase/sold</label>
                <input type="text" class="form-control" name="noofshareoftrans" id="noofshareoftrans" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="No. of shares / ADRs purchase/sold">
            </div>
                
            <div class="form-group">
                <label for="">Place</label>
                <input type="text" class="form-control" name="form2place" id="form2place"  placeholder="Place">
            </div>

            
<!--
           <textarea  width="80%" id="reasontrans"></textarea>
           <input type="hidden" id = "reasonlink">
-->

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="reasonexetrans">Submit</button> 
            </div>
        </div>
    </div>
</div>
</div>
