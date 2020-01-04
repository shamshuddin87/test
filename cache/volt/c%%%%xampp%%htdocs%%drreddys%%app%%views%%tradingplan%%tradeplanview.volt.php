<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
//echo "company is ";print_r($planuniqueid);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
     
<div id = "edittradeplan"><h1 class="h1_heading text-center">Trading Plan</h1>
 <div class="containergrid">       
    <div class="formcss">                           
     <div class="typography form_pad">
                
        <form action="tradingplan/inserttrade" autocomplete="off" id="inserttrade" class="nishana" method="post" enctype="multipart/form-data">
            <input type = "hidden" name="tradeid" value="<?php echo $planid; ?>" id="tradeid">
            <input type = "hidden" name="tradeuniqueid" value="<?php echo $planuniqueid; ?>" id="tradeuniqueid">
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
                
                    <section class="col col-md-6 col-xs-6">
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
                                 
                    
                </div>
                       
            <div class = "appendtradingplan " id="appendtradingplan"></div>
            <div class="addsection" >
                <input type="button" class="btn btn-primary addtradeplan" value="+" >
                <input type="button" class="btn btn-primary remvtradeplan" value="-">
                <input type="hidden" class="appendtrade" plancntr='1'>
                    
            </div>
           <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">
                <div class="floatright">
                <input type="submit" class="btn btn-primary tradeplan floatleft" value="Submit" >
                </div>
            </div>
          </form>
                                              
                <div class="clearelement"></div>
            </div>
       </div>     
    </div></div>
    <h1 class="h1_heading text-center">View Trading Plan</h1>       

    <input type = "hidden" value="<?php echo $planid; ?>" id="tradeid">
    <input type = "hidden" value="<?php echo $planuniqueid; ?>" id="tradeuniqueid">
   <div class="table-responsive table_wraper tradeplanview">
       <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">
                <div class="floatright">
                <input type="submit" class="btn btn-primary sendtradeplan" value="Send for approval" >
                </div>
            </div>
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
                            <th>Type Of Security</th> 
                            <th>Specific Date</th> 
                            <th>Date Range From</th> 
                            <th>Date Range To</th> 
                            <th>No.of Securities</th> 
                            <th>Value of Securities</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody class="appendtradeplanview">
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
 
<div id="Mymodalplanedit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content margintop">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Trade Plan</h4>
      </div>
        <div class="modal-body">
            <form action="tradingplan/updateplan" autocomplete="off" id="updateplan" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="planid" class="planid" id="planid" value="">
                <input type="hidden" name="requestfor" class="requestfor" id="requestfor" value="">
                <input type="hidden" name="relative" class="relative" id="relative" value="">
                <input type="hidden" name="companyid" class="companyid" id="companyid" value="">
                <input type="hidden" name="fromdate" class="fromdate" id="fromdate" value="">
                <input type="hidden" name="todate" class="todate" id="todate" value="">
                             
                    <section class="col col-md-4 col-xs-4">
                    <div class="input">
                        <label class="control-label">Type Of Security</label>
                        <select id="sectype" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                        <option value=""  >Select Security</option>
                        <?php foreach($sectype as $rel){  ?>
                        <option value="<?php echo $rel['id']; ?>"><?php echo $rel['security_type']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                   </section>
                
                    <section class="col col-md-4 col-xs-4">
                    <div class="input">
                        <label class="control-label">Date Type</label>
                        <select id="datetype" name="datetype" class="form_fields form-control col-md-7 col-xs-12" required>
                        <option value="">Select Date Type</option>
                        <option value="1">Specific Date</option>
                        <option value="2">Date Range</option>
                        </select>
                    </div>
                   </section>
                
                    <section class="col col-md-4 col-xs-4" id="specfdte">
                    <div class="input">
                        <label class="control-label">Specific Date</label>
                        <input type="text" class="form-control bootdatepick" id="spficdate"  name="spficdate" readonly>
                    </div>
                   </section>
                
                    <section class="col col-md-4 col-xs-4" id="dtrngfrm">
                    <div class="input">
                        <label class="control-label">Date Range From</label>
                        <input type="text" class="form-control bootdatepick" id="daterngfrm"  name="daterngfrm" readonly>
                    </div>
                   </section>
                
                    <section class="col col-md-4 col-xs-4" id="dterngto">
                    <div class="input">
                        <label class="control-label">Date Range To</label>
                        <input type="text" class="form-control bootdatepick" id="daterngto"  name="daterngto" readonly>
                    </div>
                   </section>
                            
                    <section class="col col-md-4 col-xs-4">
                    <div class="input">
                        <label class="control-label">No.of Securities</label>
                        <input type="text" class="form-control" id="noofsec"  name="noofsec" onkeypress="return numberOnly()">
                    </div>
                   </section>
                                 
                    <section class="col col-md-4 col-xs-4">
                    <div class="input">
                        <label class="control-label">Value of Securities</label>
                        <input type="text" class="form-control" id="valueofsecurity"  name="valueofsecurity" onkeypress="return numberOnly()">
                    </div>
                   </section>
            
           <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">
                <div class="floatright">
                <input type="submit" class="btn btn-primary updateplan floatleft" value="update" >
                </div>
            </div>

          </form>
      </div>


      </div>
    </div>
</div>

<div id="myModalyesno" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Would you like to go ahead?</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">NOTE
                    <div class="clearelement"></div>
                    All The Details of Trade Plan Will be Deleted.<br>Are You Sure You Want To Proceed.
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>





