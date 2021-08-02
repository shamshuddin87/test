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
     

<h1 class="h1_heading">Trading Plan</h1>
 <div class="containergrid">       
    <div class="formcss">                           
     <div class="typography form_pad">
                
        <form action="tradingplan/inserttradingplan" autocomplete="off" id="inserttradingplan" class="nishana" method="post" enctype="multipart/form-data">
            <div class="formelementmain"> 
                   <section class="col col-md-6 col-xs-6">
                    <div class="input">
                        <label class="control-label">Request For</label>
                        <select id="reqstfr" name="reqstfr" class="form_fields form-control col-md-7 col-xs-12" required>
                        <?php foreach($rquestfor as $req){  ?>
                        <option value="<?php echo $req['id']; ?>"><?php echo $req['tradingplan']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                   </section>
                
                    <section class="col col-md-6 col-xs-6" id="reltv">
                    <div class="input">
                    <label class="control-label">Select Relative</label>
                      <select id="relative" name="relative" class="form_fields form-control col-md-7 col-xs-12">
                         <option value="">Select Relative</option>
                           <?php foreach($retvdetail as $reltv){  ?>
                          <option value="<?php echo $reltv['id']; ?>"><?php echo $reltv['name']; ?></option>
                          <?php } ?>
                        </select>
                        </div>
                    </section>
                
                    <section class="col col-md-6 col-xs-6" >
                    <div class="input">
                    <label class="control-label">Company Name</label>
                     <select id="cmpnme" name="cmpnme" class="form_fields form-control col-md-7 col-xs-12"required >
                           <?php foreach($cmpnydetail as $comp){  ?>
                          <option value="<?php echo $comp['id']; ?>"><?php echo $comp['companyname']; ?></option>
                          <?php } ?>
                    </select>
                    </div>
                    </section>
                          
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                    <label class="control-label">Period Of Plan From</label>
                        <input type="text" class="form-control bootdatepick" id="frmdate"  name="frmdate" readonly>
                    </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                    <label class="control-label">Period Of Plan To</label>
                        <input type="text" class="form-control bootdatepick" id="todate"  name="todate" readonly>
                    </div>
                    </section>
                                 
                    <section class="col col-md-3 col-xs-3">
                    <div class="input">
                        <label class="control-label">Type Of Security</label>
                        <select id="sectype" name="sectype[]" class="form_fields form-control col-md-7 col-xs-12" required>
                        <option value=""  >Select Security</option>
                        <?php foreach($sectype as $rel){  ?>
                        <option value="<?php echo $rel['id']; ?>"><?php echo $rel['security_type']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3">
                    <div class="input">
                        <label class="control-label">Date Type</label>
                        <select id="datetype" name="datetype[]" class="form_fields form-control col-md-7 col-xs-12" required>
                        <option value="">Select Date Type</option>
                        <option value="1">Specific Date</option>
                        <option value="2">Date Range</option>
                        </select>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3" id="specfdte">
                    <div class="input">
                        <label class="control-label">Specific Date</label>
                        <input type="text" class="form-control bootdatepick" id="spficdate"  name="spficdate[]" readonly>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3" id="dtrngfrm">
                    <div class="input">
                        <label class="control-label">Date Range From</label>
                        <input type="text" class="form-control bootdatepick" id="daterngfrm"  name="daterngfrm[]" readonly>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3" id="dterngto">
                    <div class="input">
                        <label class="control-label">Date Range To</label>
                        <input type="text" class="form-control bootdatepick" id="daterngto"  name="daterngto[]" readonly>
                    </div>
                   </section>
                            
                    <section class="col col-md-3 col-xs-3">
                    <div class="input">
                        <label class="control-label">No.of Securities</label>
                        <input type="text" class="form-control" id="noofsec"  name="noofsec[]" onkeypress="return numberOnly()">
                    </div>
                   </section>
                                 
                    <section class="col col-md-3 col-xs-3">
                    <div class="input">
                        <label class="control-label">Value of Securities</label>
                        <input type="text" class="form-control" id="valueofsecurity"  name="valueofsecurity[]" onkeypress="return numberOnly()">
                    </div>
                   </section>
                </div>
                       
            <div class = "appendtradingplan " id="appendtradingplan"></div>
                <div class="addsection col-md-6">
                    <input type="button" class="btn btn-primary addtradeplan" value="+" >
                    <input type="button" class="btn btn-primary remvtradeplan" value="-">
                    <input type="hidden" class="appendtrade" plancntr='1'>
                        
                </div>

           <div class="control-label btnsubmitme cntrol_tab_one col-md-6 text-right">
                <div class="floatright text-right">
                <input type="submit" class="btn btn-primary tradeplan floatleft" value="Submit" >
                </div>
            </div>
          </form>
                                              
                <div class="clearelement"></div>
            </div>
       </div>     
    </div>
    
   <div class="table-responsive table_wraper bg_white">
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
                    <tbody class="appendtradeplan">
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
<div class="preloder_wraper">
    <a href="javascript:;" class="preloder"></a>
</div>

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






