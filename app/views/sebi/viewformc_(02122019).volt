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
<!--
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                                      
        <div class="formabtn">
         <button type="button" class="btn btn-primary" id="formbrqust">Create Request</button> 
      </div> 
                                               
                <div class="clearelement"></div>
            </div>
       </div>     
    </div>
-->
    
    
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
                            <th>Created Date</th>
                            <th>Name</th>
                            <th>PAN</th>
                            <th>CIN/DIN</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>Category Of Person</th>
<!--                            <th>Date of appointment of Director /KMP</th> -->
                            <th>View Draft</th> 
                            <th>Approval Status</th> 
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

<div id="Mymodalformb" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">From B</h4>
      </div>
        <div class="modal-body">
           <form id="insertformb" action="sebi/insertformb" method="post" enctype="multipart/form-data" autocomplete="off" > 
                        
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
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                    </section>
               
                     <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Category</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id']; ?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Date Of Appointment Of Director</label>
                                <input type="text" id="date" name="date" class="form-control bootdatepick" readonly required>
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
                            <label class="control-label heading">Securities held at the time of becoming Promoter/appointment of Director/KMP</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Type Of Security</label>
                            <select id="security" name="security[]" class="form_fields form-control col-md-7 col-xs-12" required multiple>
                                    <?php foreach($security as $shwsecurity){  ?>
                                    <option value="<?php echo $shwsecurity['id']; ?>"><?php echo $shwsecurity['securitytype']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Security No.</label>
                                <input type="text" id="secuno" name="secuno" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                       </section>
                         </div>
                    </section>
               
                        <section class="col col-md-12 col-xs-12">
                            <div class="input">
                                <label class="control-label">% of Shareholding</label>
                                <input type="text" id="shrhldng" name="shrhldng" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 ' required>
                            </div>
                       </section>
               
                     <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Open Interest of the Future contracts held at the time of becoming Promoter/appointment of Director/KMP</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Number of units (contracts* lot size)</label>
                             <input type="text" id="futureunitnum" name="futureunitnum" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Notional value in Rupee terms</label>
                                <input type="text" id="futurentnlvlue" name="futurentnlvlue" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                       </section>
                         </div>
                    </section>
               
               <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Open Interest of the Option Contracts held at the time of becoming Promoter/appointment of Director/KMP</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Number of units (contracts* lot size)</label>
                             <input type="text" id="optionunitnum" name="optionunitnum" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Notional value in Rupee terms</label>
                                <input type="text" id="optionntnlvlue" name="optionntnlvlue" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                       </section>
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
            <input type="hidden" name="formbid" id="formbid">
             <div class="downloadpdf btn btn-primary floatright"><span class="glyphicon glyphicon-download-alt floatleft"></span><div class="pdfln floatright"></div><div class="clearelement"></div></div>
            <button id="" class="formbpdf"><i class="fa fa-file-pdf-o"></i>Generate PDF</button>
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
        <h4 class="modal-title" style="text-align:center;">From B</h4>
      </div>
        <div class="modal-body">
           <form id="updateformb" action="sebi/updateformb" method="post" enctype="multipart/form-data" autocomplete="off" > 
                    <input type="hidden" name="upformbid" id="upformbid">
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
                                <input type="text" id="cin" name="cin" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                    </section>
               
                     <section class="col col-md-6 col-xs-6">
                         <div class="input">
                            <label class="control-label">Category</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id']; ?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Date Of Appointment Of Director</label>
                                <input type="text" id="date" name="date" class="form-control bootdatepick" readonly required>
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
                            <label class="control-label heading">Securities held at the time of becoming Promoter/appointment of Director/KMP</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Type Of Security</label>
                            <select id="security" name="security[]" class="form_fields form-control col-md-7 col-xs-12" required multiple>
                                    <?php foreach($security as $shwsecurity){  ?>
                                    <option value="<?php echo $shwsecurity['id']; ?>"><?php echo $shwsecurity['securitytype']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Security No.</label>
                                <input type="text" id="secuno" name="secuno" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                       </section>
                         </div>
                    </section>
               
                        <section class="col col-md-12 col-xs-12">
                            <div class="input">
                                <label class="control-label">% of Shareholding</label>
                                <input type="text" id="shrhldng" name="shrhldng" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 ' required>
                            </div>
                       </section>
               
                     <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Open Interest of the Future contracts held at the time of becoming Promoter/appointment of Director/KMP</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Number of units (contracts* lot size)</label>
                             <input type="text" id="futureunitnum" name="futureunitnum" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Notional value in Rupee terms</label>
                                <input type="text" id="futurentnlvlue" name="futurentnlvlue" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                       </section>
                         </div>
                    </section>
               
               <section class="col col-md-12 col-xs-12">
                            <div class="input">
                            <label class="control-label heading">Open Interest of the Option Contracts held at the time of becoming Promoter/appointment of Director/KMP</label>
                           
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                            <label class="control-label">Number of units (contracts* lot size)</label>
                             <input type="text" id="optionunitnum" name="optionunitnum" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                        </section>
               
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Notional value in Rupee terms</label>
                                <input type="text" id="optionntnlvlue" name="optionntnlvlue" class="form_fields form-control col-md-7 col-xs-12"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                       </section>
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