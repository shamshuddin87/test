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
     

    <h1 class="h1_heading text-center">Form C</h1>
    <div class="containergrid">       
          <div class="formcss">                           
            <div class="typography form_pad">
                                      
        <div class="formcbtn">
         <button type="button" class="btn btn-primary" id="formctypes">Create Form C</button>
         <button type="button" class="btn btn-primary" id="formcprevious">View Previous</button>
         <button type="button" class="btn btn-primary" id="formcsend">Send</button> 
        <input type="hidden" class="approverid" name="approverid" value="<?php echo $approverid;?>">
      </div> 
                                               
                <div class="clearelement"></div>
            </div>
       </div>   
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
                            <th></th>
                           <!--  <th>Company Name</th> -->
                            <th>Buy/Sell</th>
                            <th>No.Of Shares</th>
                            <th>Value Of Shares</th>
                            <th>Date</th>
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

<div id="Mymodalformc" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Form C</h4>
      </div>
        <div class="modal-body">
           <form id="insertformc" action="sebi/insertformc" method="post" enctype="multipart/form-data" autocomplete="off" > 
                     <input type = "hidden" name="approverid" id="approverid" value="<?php echo $approverid;?>">
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
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $cin;?>" readonly required>
                            </div>
                    </section>
               
                     <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Category</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id'];?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Company Name</label>
                            <select id="cmpnme" name="cmpnme" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Company</option>
                                    <?php foreach($company as $shwcmp){  ?>
                                    <option value="<?php echo $shwcmp['id']; ?>"><?php echo $shwcmp['companyname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
               
                        <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Date of allotment advice/acquisition of shares/sale of shares specify</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">From</label>
                             <input type="text" id="fromdate" name="fromdate" class="form-control bootdatepick" readonly required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">To</label>
                                <input type="text" id="todate" name="todate" class="form-control bootdatepick" readonly required>
                            </div>
                       </section>
                         </div>
                    </section>
               
                    <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">% of shareholding</label>
                           
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
               
                     <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Trading in derivatives (Specify type of contract, Futures or Options etc)</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Buy Value</label>
                             <input type="text" id="buyvalue" name="buyvalue" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                        </section>
                                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Buy Number of units(contracts* lot size)</label>
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
                                <label class="control-label">Sell Number of units(contracts* lot size)</label>
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
                            <input type="submit" value="Save As Draft" class="btn btn-primary saveformbbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form> 
      </div>


      </div>
    </div>
</div>

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
            <input type="hidden" name="formcid" id="formcid">
             <div class="downloadpdf btn btn-primary floatright"><div class="pdfln floatright"></div><div class="clearelement"></div></div>
            <button id="" class="formcpdf"><i class="fa fa-file-pdf-o"></i>Generate PDF</button>
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

<div id="Mymodaledit" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Form C</h4>
      </div>
        <div class="modal-body">
           <form id="updateformc" action="sebi/updateformc" method="post" enctype="multipart/form-data" autocomplete="off" > 
                    <input type="hidden" name="upformcid" id="upformcid">
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
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" value="" readonly required>
                            </div>
                    </section>
               
                     <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Category</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id'];?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Company Name</label>
                            <select id="cmpnme" name="cmpnme" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Company</option>
                                    <?php foreach($company as $shwcmp){  ?>
                                    <option value="<?php echo $shwcmp['id']; ?>"><?php echo $shwcmp['companyname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
               
                        <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Date of allotment advice/acquisition of shares/sale of shares specify</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">From</label>
                             <input type="text" id="fromdate" name="fromdate" class="form-control bootdatepick" readonly required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">To</label>
                                <input type="text" id="todate" name="todate" class="form-control bootdatepick" readonly required>
                            </div>
                       </section>
                         </div>
                    </section>
               
                    <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">% of shareholding</label>
                           
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
               
                     <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Trading in derivatives (Specify type of contract, Futures or Options etc)</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Buy Value</label>
                             <input type="text" id="buyvalue" name="buyvalue" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57|| event.charCode == 46' >
                            </div>
                        </section>
                                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Buy Number of units(contracts* lot size)</label>
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
                                <label class="control-label">Sell Number of units(contracts* lot size)</label>
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

<!-- ##############   Form c Types START  ############## -->

<div id="myModalFormctypes" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 650px;">
        <div class="modal-content" style="width: 100%;">          
      <div class="modal-header" style="float: none;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="">Select the Type of Transaction for which you want to generate Form C</h4>
      </div>
            <div class="modal-body show_shadow">
                <div class="modal_heading">
                    <div class="openFormc btn btn-primary" id="type1">Form C - Securities traded without taking pre-clearance.</div><br>
                    <div class="openFormc btn btn-primary" id="type2">Form C - Exercise of ESOP.</div><br>
                    <div class="openFormc btn btn-primary" id="type3">Form C - Allotment of ESOP.</div>
                </div>
            </div>
          
            
        </div>
    </div>
</div>

<div id="Mymodaltype1" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Form C - Type I</h4>
      </div>
        <div class="modal-body">
           <form id="insertformctype1" action="sebi/insertformctype1" method="post" enctype="multipart/form-data" autocomplete="off" > 
                <input type = "hidden" name="approverid" id="approverid" value="<?php echo $approverid;?>">
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Name</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $name;?>" readonly required>
                                
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">PAN</label>
                                <input type="text" id="pan" name="pan" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $pan;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Address</label>
                                <input type="text" id="address" name="address" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $address;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Contact No.</label>
                                <input type="text" id="cntctno" name="cntctno" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $cntctno;?>" readonly required>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Type Of Security</label>
                                <select id="sectypeid" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="" id="sectype" >Select Security</option>
                                    <?php foreach($security as $sectype){  ?>
                                    <option value="<?php echo $sectype['id']; ?>"><?php echo $sectype['security_type']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Demat Account No.</label>
                                <select id="demataccno" name="demataccno" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="" id="demataccno" >Select Account No.</option>
                                    <?php foreach($demataccno as $accno){  ?>
                                    <option value="<?php echo $accno['accountno']; ?>"><?php echo $accno['accountno']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">No. Of Shares</label>
                            <input type="text" id="noofshare" name="noofshare" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57  || event.charCode == 46' required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Price Per Share</label>
                            <input type="text" id="pricepershare" name="pricepershare" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57  || event.charCode == 46' required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Total Amount</label>
                            <input type="text" id="totalamt" name="totalamt" class="form-control" readonly required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Type of Transaction</label>
                            <select class="form-control" id="typeoftrans" name="typeoftrans">
                                <option value="1">Buy</option>
                                <option value="2">Sell</option>
                                <!--<option value="3">Pledge creation</option>
                                <option value="4">Pledge Revocation</option>
                                <option value="5">Exercise of stock</option>-->
                            </select>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date of Transaction</label>
                                <input type="text" id="dateoftrans" name="dateoftrans" class="form-control " placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                        </section>
               
<!--
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">CIN/DIN</label>
                                
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" value="L85195TG1984PLC004507" readonly required>
                                
                            </div>
                    </section>
-->
               
                       <section class="col col-md-4 col-xs-4">
                         <div class="input">
                            <label class="control-label">Category</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id'];?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        
                        
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date of intimation to company</label>
                                <input type="text" id="dateofintimtn" name="dateofintimtn" class="form-control " placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                        </section> 

                      <!--<section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Type Of Contract</label>
                            <select id="contracttype" name="contracttype" class="form_fields form-control col-md-7 col-xs-12">
                                    <option value="">Select Contract</option>
                                    <option value="1">Futures</option>
                                    <option value="2">Options</option>
                            </select>
                            </div>
                        </section>-->



                        <!--<section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Contract Specification</label>
                             <input type="text" id="contractspeci" name="contractspeci" class="form-control">
                            </div>
                        </section>-->

                        <section class="">
                            <div class="input ">
                            <label class="control-label heading col col-md-12 col-xs-12" style="margin-top: 10px;">Date of allotment advice/acquisition of shares/sale of shares specify</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">From</label>
                             <input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="dd-mm-yyyy" maxlength="10"  required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">To</label>
                                <input type="text" id="todate" name="todate" class="form-control" placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                       </section>
                         </div>
                    </section>
               
               
                    
               
                 <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Mode of acquisition</label>
                             <div><br></div>
                            <select id="acquimode" name="acquimode" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Mode</option>
                                    <?php foreach($modeacqui as $shwmode){  ?>
                                    <option value="<?php echo $shwmode['id']; ?>"><?php echo $shwmode['acquisitionmode']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                     <!--<section class="">
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
                    </section>-->
               
                    
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Exchange on which the trade was executed</label>
                                <select id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Option</option>
                                    <?php foreach($exchngtrd as $shwtrd){  ?>
                                    <option value="<?php echo $shwtrd['id']; ?>"><?php echo $shwtrd['fieldname']; ?></option>
                                    <?php } ?>
                                </select>
                                <!--<input type="text" id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12">-->
                            </div>
                       </section>
                        
                      <section class="col col-md-12 company_asses">
                            <input type="submit" value="Submit" class="btn btn-primary updateformbbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form> 
      </div>


      </div>
    </div>
</div>

<div id="Mymodaltype2" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Form C - Type II</h4>
      </div>
        <div class="modal-body">
           <form id="insertformctype2" action="sebi/insertformctype2" method="post" enctype="multipart/form-data" autocomplete="off" > 
                <input type = "hidden" name="approverid" id="approverid" value="<?php echo $approverid;?>">
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Name</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $name;?>" readonly required>
                                
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">PAN</label>
                                <input type="text" id="pan" name="pan" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $pan;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Address</label>
                                <input type="text" id="address" name="address" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $address;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Contact No.</label>
                                <input type="text" id="cntctno" name="cntctno" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $cntctno;?>" readonly required>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Type Of Security</label>
                                <select id="sectypeid" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="" id="sectype" >Select Security</option>
                                    <?php foreach($security as $sectype){  ?>
                                    <option value="<?php echo $sectype['id']; ?>"><?php echo $sectype['security_type']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Demat Account No.</label>
                                <select id="demataccno" name="demataccno" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="" id="demataccno" >Select Account No.</option>
                                    <?php foreach($demataccno as $accno){  ?>
                                    <option value="<?php echo $accno['accountno']; ?>"><?php echo $accno['accountno']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">No. Of Shares</label>
                            <input type="text" id="noofshare" name="noofshare" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57  || event.charCode == 46' required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Price Per Share</label>
                            <input type="text" id="pricepershare" name="pricepershare" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Total Amount</label>
                            <input type="text" id="totalamt" name="totalamt" class="form-control" required readonly>
                        </div>
                    </section>
               
                    <!--<section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Type of Transaction</label>
                            <select class="form-control" id="typeoftrans" name="typeoftrans">
                                <option value="1">Buy</option>
                                <option value="2">Sell</option>
                                <option value="3">Pledge creation</option>
                                <option value="4">Pledge Revocation</option>
                                <option value="5">Exercise of stock</option>
                            </select>
                        </div>
                    </section>-->
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date of Transaction</label>
                                <input type="text" id="dateoftrans" name="dateoftrans" class="form-control " placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                        </section>
               
<!--
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">CIN/DIN</label>
                                
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" value="L85195TG1984PLC004507" readonly required>
                                
                            </div>
                    </section>
-->
               
                       <section class="col col-md-4 col-xs-4">
                         <div class="input">
                            <label class="control-label">Category</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id'];?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        
                        
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date of intimation to company</label>
                                <input type="text" id="dateofintimtn" name="dateofintimtn" class="form-control " placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                        </section> 

                      <!--<section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Type Of Contract</label>
                            <select id="contracttype" name="contracttype" class="form_fields form-control col-md-7 col-xs-12">
                                    <option value="">Select Contract</option>
                                    <option value="1">Futures</option>
                                    <option value="2">Options</option>
                            </select>
                            </div>
                        </section>-->



                        <!--<section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Contract Specification</label>
                             <input type="text" id="contractspeci" name="contractspeci" class="form-control">
                            </div>
                        </section>-->

                        <section class="">
                            <div class="input ">
                            <label class="control-label heading col col-md-12 col-xs-12" style="margin-top: 10px;">Date of purchase / sale of shares</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">From</label>
                             <input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="dd-mm-yyyy" maxlength="10"  required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">To</label>
                                <input type="text" id="todate" name="todate" class="form-control" placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                       </section>
                         </div>
                    </section>
               
               
                    
               
                 <!--<section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Mode of acquisition</label>
                             <div><br></div>
                            <select id="acquimode" name="acquimode" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Mode</option>
                                    <?php foreach($modeacqui as $shwmode){  ?>
                                    <option value="<?php echo $shwmode['id']; ?>"><?php echo $shwmode['acquisitionmode']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>-->
               
                     <!--<section class="">
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
                    </section>-->
               
                    
                        <!--<section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Exchange on which the trade was executed</label>
                                <select id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Option</option>
                                    <?php foreach($exchngtrd as $shwtrd){  ?>
                                    <option value="<?php echo $shwtrd['id']; ?>"><?php echo $shwtrd['fieldname']; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="text" id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12">
                            </div>
                       </section>-->
                        
                      <section class="col col-md-12 company_asses">
                            <input type="submit" value="Submit" class="btn btn-primary updateformbbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form> 
      </div>


      </div>
    </div>
</div>

<div id="Mymodaltype3" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Form C - Type III</h4>
      </div>
        <div class="modal-body">
           <form id="insertformctype3" action="sebi/insertformctype3" method="post" enctype="multipart/form-data" autocomplete="off" > 
                <input type = "hidden" name="approverid" id="approverid" value="<?php echo $approverid;?>">
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Name</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $name;?>" readonly required>
                                
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">PAN</label>
                                <input type="text" id="pan" name="pan" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $pan;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Address</label>
                                <input type="text" id="address" name="address" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $address;?>" readonly required>
                            </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Contact No.</label>
                                <input type="text" id="cntctno" name="cntctno" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $cntctno;?>" readonly required>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Type Of Security</label>
                                <select id="sectypeid" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="" id="sectype" >Select Security</option>
                                    <?php foreach($security as $sectype){  ?>
                                    <option value="<?php echo $sectype['id']; ?>"><?php echo $sectype['security_type']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Demat Account No.</label>
                                <select id="demataccno" name="demataccno" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="" id="demataccno" >Select Account No.</option>
                                    <?php foreach($demataccno as $accno){  ?>
                                    <option value="<?php echo $accno['accountno']; ?>"><?php echo $accno['accountno']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">No. Of Shares</label>
                            <input type="text" id="noofshare" name="noofshare" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57  || event.charCode == 46' required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Price Per Share</label>
                            <input type="text" id="pricepershare" name="pricepershare" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57  || event.charCode == 46' required>
                        </div>
                    </section>
               
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Total Amount</label>
                            <input type="text" id="totalamt" name="totalamt" class="form-control" required readonly>
                        </div>
                    </section>
               
                    <!--<section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">Type of Transaction</label>
                            <select class="form-control" id="typeoftrans" name="typeoftrans">
                                <option value="1">Buy</option>
                                <option value="2">Sell</option>
                                <option value="3">Pledge creation</option>
                                <option value="4">Pledge Revocation</option>
                                <option value="5">Exercise of stock</option>
                            </select>
                        </div>
                    </section>-->
               
                    <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date of Transaction</label>
                                <div><br></div>
                                <input type="text" id="dateoftrans" name="dateoftrans" class="form-control " placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                        </section>
               
<!--
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">CIN/DIN</label>
                                
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" value="L85195TG1984PLC004507" readonly required>
                                
                            </div>
                    </section>
-->
               
                       <section class="col col-md-4 col-xs-4">
                         <div class="input">
                            <label class="control-label">Category</label>
                             <div><br></div>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id'];?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        
                        
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date of intimation to company</label>
                                <input type="text" id="dateofintimtn" name="dateofintimtn" class="form-control " placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                        </section> 

                      <!--<section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Type Of Contract</label>
                            <select id="contracttype" name="contracttype" class="form_fields form-control col-md-7 col-xs-12">
                                    <option value="">Select Contract</option>
                                    <option value="1">Futures</option>
                                    <option value="2">Options</option>
                            </select>
                            </div>
                        </section>-->



                        <!--<section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Contract Specification</label>
                             <input type="text" id="contractspeci" name="contractspeci" class="form-control">
                            </div>
                        </section>-->

                        <section class="">
                            <div class="input ">
                            <label class="control-label heading col col-md-12 col-xs-12" style="margin-top: 10px;">Date of purchase / sale of shares</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">From</label>
                             <input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="dd-mm-yyyy" maxlength="10"  required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">To</label>
                                <input type="text" id="todate" name="todate" class="form-control" placeholder="dd-mm-yyyy" maxlength="10" required>
                            </div>
                       </section>
                         </div>
                    </section>
               
               
                    
               
                 <!--<section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Mode of acquisition</label>
                             <div><br></div>
                            <select id="acquimode" name="acquimode" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Mode</option>
                                    <?php foreach($modeacqui as $shwmode){  ?>
                                    <option value="<?php echo $shwmode['id']; ?>"><?php echo $shwmode['acquisitionmode']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </section>-->
               
                     <!--<section class="">
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
                    </section>-->
               
                    
                        <!--<section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Exchange on which the trade was executed</label>
                                <select id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Option</option>
                                    <?php foreach($exchngtrd as $shwtrd){  ?>
                                    <option value="<?php echo $shwtrd['id']; ?>"><?php echo $shwtrd['fieldname']; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="text" id="exetrd" name="exetrd" class="form_fields form-control col-md-7 col-xs-12">
                            </div>
                       </section>-->
                        
                      <section class="col col-md-12 company_asses">
                            <input type="submit" value="Submit" class="btn btn-primary updateformbbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form> 
      </div>


      </div>
    </div>
</div>



<!-- ##############   Form c Types END  ############## -->