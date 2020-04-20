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
          

    <input type = "hidden" value="<?php echo $rtaid; ?>" id="rtaid">
    <input type = "hidden" value="<?php echo $rtauniqueid; ?>" id="rtauniqueid">
    <input type = "hidden" value="<?php echo $dateofrecon; ?>" id="dateofrecon">

   <div class="table-responsive table_wraper tradeplanview">
     <input type ="button" id="emailExcelToBenpose" class="btn btn-primary text-right" value="Intimate User" style="float: right;">
          <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>

                            <th><input type="checkbox" name="getallchkbox" class="getallchkbox" value="All"><br>All</th>
                           
                            <th>PAN</th>
                            <th>Name</th>
                            <th>Relative Name</th>
                            <th>Relationship</th>
                            <th>Script</th>
                            <th>Holding as per RTA</th>
                            <th>Holding as per software</th>
                            <th>Difference</th>
<!--                            <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody class="appendviewreconciltn">
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
                             
                    <section class="col col-md-3 col-xs-3">
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
                
                    <section class="col col-md-3 col-xs-3">
                    <div class="input">
                        <label class="control-label">Date Type</label>
                        <select id="datetype" name="datetype" class="form_fields form-control col-md-7 col-xs-12" required>
                        <option value="">Select Date Type</option>
                        <option value="1">Specific Date</option>
                        <option value="2">Date Range</option>
                        </select>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3" id="specfdte">
                    <div class="input">
                        <label class="control-label">Specific Date</label>
                        <input type="text" class="form-control bootdatepick" id="spficdate"  name="spficdate" readonly>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3" id="dtrngfrm">
                    <div class="input">
                        <label class="control-label">Date Range From</label>
                        <input type="text" class="form-control bootdatepick" id="daterngfrm"  name="daterngfrm" readonly>
                    </div>
                   </section>
                
                    <section class="col col-md-3 col-xs-3" id="dterngto">
                    <div class="input">
                        <label class="control-label">Date Range To</label>
                        <input type="text" class="form-control bootdatepick" id="daterngto"  name="daterngto" readonly>
                    </div>
                   </section>
                            
                    <section class="col col-md-3 col-xs-3">
                    <div class="input">
                        <label class="control-label">No.of Securities</label>
                        <input type="text" class="form-control" id="noofsec"  name="noofsec" onkeypress="return numberOnly()">
                    </div>
                   </section>
                                 
                    <section class="col col-md-3 col-xs-3">
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

<div id="myModalerrormssage" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Error Message</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">NOTE
                    <div class="clearelement"></div>
                    This PAN is missing in RTA sheet.
                </div>
            </div>
          
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<div id="sendmail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
               
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">
                    <div class="clearelement"></div>
                    <input type="hidden" id = "emailid" value = "">
                     <input type="hidden" id = "name" value = "">
                      <input type="hidden" id = "diffrnc" value = "">
                   Are you sure you want to send email notification to users?
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesmail" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>





