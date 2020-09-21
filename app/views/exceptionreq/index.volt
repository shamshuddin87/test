<?php $gmnlog = $this->session->loginauthspuserfront;
if(isset($_GET["redirect"]))
{
$redirecturl= $_GET["redirect"];
}
else{
  $redirecturl='';
}


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
  <div class="container">

 <input type="hidden" name="" id="redirecturl" value="<?php echo $redirecturl; ?>" >

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
      </div> -->

    </div>
  </div>

<!--###############################################PERSONAL REQUEST#####################################################-->
  <div class="box_outer row col-md-12 col-xs-12 col-sm-12 row personaldetails" style="display: block;">
    <!-- <button type="button" class="btn btn-primary createreq" style="float: right;">Create Request</button> -->
    <!-- <input type="button"  id="sendmulreq" value="Send" class="btn btn-primary" style="float: right;"> -->
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
      <option value="1" selected="selected">Personal</option>
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
 <div class="form-group">
    <label for="exampleFormControlInput1">Name Of Company</label>
     <input type="hidden" class="form-control" id="idofcmp" name="idofcmp" value="">
    <input type="text" class="form-control" id="nameofcmp" name="nameofcmp" placeholder="Search..." >
  </div>
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
   
  
<!--
  <div class="form-group">
    <label for="exampleFormControlInput1">Date Of Transaction</label>
    <input type="text" class="form-control bootdatepick" id="transdate"  name="transdate">
  </div>
-->

<!--
   <div class="form-group">
    <label for="exampleFormControlInput1">Price Per Shares</label>
    <input type="text" class="form-control" id="pricepershare" name="pricepershare" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Price Per Share">
  </div>
-->

<!--
   <div class="form-group">
    <label for="exampleFormControlInput1">Total Amount</label>
    <input type="text" class="form-control" id="totalamt"  name="totalamt" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Total Amount">
  </div>
-->



        <!-- <label class="control-label">Upload File</label>
        <div class="choose_files">
        <input type="file" name="hldngfile[]"  id="hldngfile" > -->
           <input type="submit" id ="sendrequest" name="sendreq" value="SEND" class="btn btn-primary sendrequst" style="float: right;">  
           
        <input type="submit"  name="draft" value="SAVE AS DRAFT" id="draftedreq" class="btn btn-primary reqdraft" style="float: right;"> 
       
      
      </form>
  
       </div>
      <div class="modal-footer">
     </div>
    </div>
  </div>
</div>


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
       <tr><th>No Of Share</th><th>Price Per Share</th><th>Total Amount</th><th>Date Of Transaction</th><th>Demat Account No</th></tr></thead>
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
<!--------------------------------------------Table For Created Request------------------------------------------------>
 <div class="">
  <h3 class="h1_heading text-center">Your Exception Requests</h3>
  <div class="cssnumrws form-inline">
   <label>Show</label>
     <select id="noofrows" name="noofrows" class="noofrows form-control">
       <option value="10">10</option><option value="25">25</option>
        <option value="50">50</option><option value="100">100</option>
        </select> 
        <label>Entries</label>
        </div> 
       <div class="table-responsive">    
        <table class="table table-inverse mytable" id="datablerushi" typage="reqview">
        <thead>
        <tr>
       <!--    <th><input type="checkbox" class="getallchkbox" name="getallchkbox" chkval="ALL" value="ALL" size="30px;">All</th> -->
          <th>Sr No</th>
          <th>Type Of Security</th>
          <!-- <th>Name Of Company</th> -->
          <th>Type Of Transaction</th>
          <th>No Of Shares</th>
          <th>Type Of Request</th>
          <th>Name Of Relative</th>
          <th>Relationship</th>

<!--          <th>Total Amount</th>-->
<!--          <th>Status</th>-->
          <th>Exception Approvel Status</th>
          <th>Transaction Date</th>
          <th>Created Date</th>
        <!--   <th>Updated Date</th> -->
           <th>Trading Status</th>
           <th>Audit Trail</th>
<!--            <th>Reason</th>-->
      <!--     <th>Action</th> -->
        </tr>
      </thead>
     <tbody class="reqtable" appendrow='1'></tbody>
   </table>
 </div>
  <div class="panel panel-white">
 <div class="paginationmn"></div>
<input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">

</div>




<!------------------------------------------------------------------------------------------------------------------>
<!------------------------MODAL BOX FOR UPDATE--------------------------------------------------------------->
      <div id="updatemodal" class="modal fade" role="dialog" tabIndex=-1>
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
 <div class="form-group">
    <label for="exampleFormControlInput1">Name Of Company</label>
     <input type="hidden" class="form-control" id="idofcmp" name="idofcmp" value="">
    <input type="text" class="form-control" id="nameofcmp" name="nameofcmp" placeholder="Search..." >
  </div>
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
   
  
<!--
  <div class="form-group">
    <label for="exampleFormControlInput1">Date Of Transaction</label>
    <input type="text" class="form-control bootdatepick" id="transdate"  name="transdate">
  </div>
-->

<!--
   <div class="form-group">
    <label for="exampleFormControlInput1">Price Per Shares</label>
    <input type="text" class="form-control" id="pricepershare" name="pricepershare" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Price Per Share">
  </div>
-->

<!--
   <div class="form-group">
    <label for="exampleFormControlInput1">Total Amount</label>
    <input type="text" class="form-control" id="totalamt"  name="totalamt" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Total Amount">
  </div>
-->



        <!-- <label class="control-label">Upload File</label>
        <div class="choose_files">
        <input type="file" name="hldngfile[]"  id="hldngfile" > -->
           <input type="submit"   value="Update" class="btn btn-primary" style="float: right;">  
           
        
       
      
      </form>
  
       </div>
      <div class="modal-footer">
     </div>
    </div>
  </div>
</div>






<!-------------------------------MODAL BOX FOR UPLOAD FILE------------------------------------------------------>
<div id="uploadmyfile" class="modal fade" role="dialog" tabIndex=-1>
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content margin-top"  style="width:900px;">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">×</button>
           <h4 class="modal-title">Trading Status</h4>
        </div>

        <div class="modal-body dispalytrade">
        <form action="tradingrequest/uploadtradingfile" id="uploadtrade" method="post" enctype="multipart/form-data" autocomplete="off">
           <div class="table-responsive">
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
          </div>

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

<!--################################RELATIVE SECTION START HERE##################################################################-->


<div class="col-md-12 col-xs-12 col-sm-12 row relativesform" style="display: none;">
<input type="submit"  class="btn btn-primary createreq" style="float: right;">Create Request</button>

<!----------------------MODAL BOX FOR EDIT RELATIONSHIP FINISH------------------------------------------>
</div>


</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 

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
                
              <h4 style="text-align: center;">Please confirm that you do not hold any UPSI Information</h4>
               
            </div>
            <div class="modal-footer">
             <input type="submit" class="btn btn-success Yesreqst" id="Yesreqst" value="Yes">
             <input type="submit" class="btn btn-success Norequest" id="Norequest" value="No">
            </div>
        </div>
    </div>
</div>
    
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
             <input type="submit" class="btn btn-success Yesreqst" id="Yesreqstsend" value="Yes">
             <input type="submit" class="btn btn-success Norequest" id="Norequestsend" value="No">
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