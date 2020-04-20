<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$getuserid = trim($this->session->loginauthspuserfront['id']);
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
     

    <h1 class="h1_heading text-center">Form D</h1>
    <div class="containergrid">     
    </div>
    
    
   <div class="table-responsive table_wraper">
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
                            <?php if($user_group_id == '7'){?><th>Date of Sending for Approval</th>
                            <?php }else { ?> <th>Created On</th> <?php } ?>
                           <!--  <th>Company Name</th> -->
                            <th>Designation</th>
                            <?php if($user_group_id == '7'){?>
                            <th>Send for Approval</th> <?php } ?>
                            <th>View Draft</th> 
                            <?php if($user_group_id == '7'){?><th>View Final</th> <?php } ?>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
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


<div id="myModalsendaprv" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send For Approval</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">
                    Do You Want To Send This Request For Approval?
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesapprove" >Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div id="modaldocument" class="modal fade" role="dialog">
  <div class="modal-dialog modal_width">
    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-header">
        <div class="button_pdf">
            <input type="hidden" name="formdid" id="formdid">
             <div class="downloadpdf floatright"><div class="pdfln floatright"></div><div class="clearelement"></div></div>
            <button id="" class="formdpdf"><i class="fa fa-file-pdf-o"></i>Generate PDF</button>
<!--            <button id="" style="display: none;" class="down_load"><a target="_blank"></a><i class="fa fa-download"></i>Download</button>-->
        </div>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-body docpdf">
        <p>Some text in the modal.</p>
      </div>
      
    </div>
  </div>
</div>

<div id="Mymodaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">From D</h4>
      </div>
        <div class="modal-body">
           <form id="updateformd" action="sebi/updateformd" method="post" enctype="multipart/form-data" autocomplete="off" > 
                    <input type="hidden" name="upformdid" id="upformdid">
                     <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Name</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $name;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">PAN</label>
                                <input type="text" id="pan" name="pan" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $pan;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Address</label>
                                <input type="text" id="address" name="address" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $address;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Contact No.</label>
                                <input type="text" id="cntctno" name="cntctno" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $cntctno;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">CIN/DIN</label>
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" value="L85195TG1984PLC004507" readonly required>
                            </div>
                    </section>
               
                      <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Connection with company</label>
                            <input type="text" id="cmpcnctn" name="cmpcnctn" class="form_fields form-control col-md-7 col-xs-12" value="" required>
                            </div>
                        </section>
               
                        <section class="">
                            <div class="input">
                            <label class="control-label heading col col-md-12 col-xs-12" style="margin-top: 10px;">Date of allotment advice/acquisition of shares/sale of shares specify</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">From</label>
                             <input type="text" id="fromdate" name="fromdate" class="form-control " readonly required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">To</label>
                                <input type="text" id="todate" name="todate" class="form-control " readonly required>
                            </div>
                       </section>
                         </div>
                    </section>
               
                    <section class="">
                            <div class="input">
                            <label class="control-label heading col col-md-12 col-xs-12"style="margin-top: 10px;">% of shareholding</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Pretransaction</label>
                             <input type="text" id="pretrans" name="pretrans" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Posttransaction</label>
                                <input type="text" id="posttrans" name="posttrans" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                       </section>
                         </div>
                    </section>
               
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Date of intimation to company</label>
                                <input type="text" id="dateofintimtn" name="dateofintimtn" class="form-control bootdatepick" readonly required>
                            </div>
                    </section> 
               
                 <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Mode of acquisition</label>
                            <select id="acquimode" name="acquimode" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Mode</option>
                                    <?php foreach($modeacqui as $shwmode){  ?>
                                    <option value="<?php echo $shwmode['id']; ?>"><?php echo $shwmode['acquisitionmode']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                     <section class="">
                            <div class="input">
                            <label class="control-label heading col col-md-12 col-xs-12" style="margin-top: 10px;">Trading in derivatives (Specify type of contract, Futures or Options etc)</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Buy Value</label>
                             <input type="text" id="buyvalue" name="buyvalue" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                        </section>
                                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Buy No of units(contracts* lot size)</label>
                                <input type="text" id="buynumbrunt" name="buynumbrunt" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                       </section>
                                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Sell Value</label>
                             <input type="text" id="sellvalue" name="sellvalue" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Sell No of units(contracts* lot size)</label>
                                <input type="text" id="sellnumbrunt" name="sellnumbrunt" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                       </section>
                         </div>
                    </section>
               
                    
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Exchange on which the trade was executed</label>
                                <input type="text" id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12">
                            </div>
                       </section>
                        
                      <section class="col col-md-12 company_asses">
                            <input type="submit" value="Update" class="btn btn-primary updateformbbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form> 
      </div>


      </div>
    </div>
</div>