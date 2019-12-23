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
     

    <h1 class="h1_heading text-center">Database of Connected Person</h1>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain">                      
                    <form id="insertrecipient" action="sensitiveinformation/insertrecipient" method="post" enctype="multipart/form-data" autocomplete="off"> 
                        
                      <section class="col col-md-4 col-xs-12">
                            <label class="control-label">Category*</label>
                            <div class="input">
                                <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($category as $shwcategory){  ?>
                                    <option value="<?php echo $shwcategory['id']; ?>"><?php echo $shwcategory['category']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <div class="othercate"></div>
                        
                        <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Name Of Entity</label>
                                <input type="text" id="entity" name="entity" class="form_fields form-control col-md-7 col-xs-12">
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Name Of The Recipient*</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12"  required>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Identity Number (PAN/Aadhar etc.)*</label>
                                <input type="text" id="identitynum" name="identitynum" class="form_fields form-control col-md-7 col-xs-12" onkeypress ="return numberalphOnly(event);" required>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Phone Number</label>
                                <input type="text" id="phonenum" name="phonenum"  maxlength="11" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" id="mobilenum" name="mobilenum" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                            </div>
                        </section>
                        
                         <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Designation</label>
                                <input type="text" id="designation" name="designation" class="form_fields form-control col-md-7 col-xs-12">
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-12">
                            <div class="input">
                                <label class="control-label">Email ID</label>
                                <input type="email" id="email" name="email" class="form_fields form-control col-md-7 col-xs-12" onkeypress ="return emailOnly(event);">
                            </div>
                        </section>
                        
                         <section class="col col-md-4 col-xs-12">
                        <div class="input">
                        <label class="control-label">Upload Identity Proof Of Recipient</label>
                            <div class="choose_files">
                                <input type="file" name="upload" id="upload" >
                            </div>
                        </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-12">
                        <div class="input">
                        <label class="control-label">Upload Confidentiality Agreement</label>
                            <div class="choose_files">
                                <input type="file" name="uploadagrm" id="uploadagrm" >
                            </div>
                        </div>
                        </section>
                   
                      <section class="col col-md-12 company_asses">
                            <input type="submit" value="Submit" class="btn btn-primary contractexcelbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form>
                </div>                                
                <div class="clearelement"></div>
            </div>
       </div>     
    </div>
    
   <div class="table-responsive table_wraper rectable" >
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Name of entity</th>
                            <th>Name</th>
                            <th>Identity No.</th> 
                            <th>Phone Number</th> 
                            <th>Mobile Number</th> 
                            <th>Designation</th> 
                            <th>Email ID</th> 
                            <th>Download Identity Proof</th> 
                            <th>Download Confidentiality Agreement</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
                    </tbody>
                </table>
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
                    All The Details of Recipient Will be Deleted.<br>Are You Sure You Want To Proceed.
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div id="Mymodaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Content</h4>
      </div>
        <div class="modal-body">
            <form action="sensitiveinformation/updaterecipient" autocomplete="off" id="updaterecipient" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                <input type="hidden" name="confiagrmnt" class="confiagrmnt" id="confiagrmnt" value="">
                <input type="hidden" name="identityfile" class="identityfile" id="identityfile" value="">
                
                    <section class="col col-md-4 col-xs-12">
                        
                        <div class="input">
                            <label class="control-label">Category*</label>
                            <select id="category" name="category" class="form_fields form-control col-md-7 col-xs-12" required>
                                <option value="">Select Category</option>
                                <?php foreach($category as $shwcategory){  ?>
                                <option value="<?php echo $shwcategory['id']; ?>"><?php echo $shwcategory['category']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </section>
                
                    <div class="othercateedit"></div>

                    <section class="col col-md-4 col-xs-12">
                        <div class="input">
                            <label class="control-label">Name Of Entity</label>
                            <input type="text" id="entity" name="entity" class="form_fields form-control col-md-7 col-xs-12">
                        </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-12">
                        <div class="input">
                            <label class="control-label">Name Of The Recipient*</label>
                            <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" required>
                        </div>
                    </section>
                        
                    <section class="col col-md-12 col-xs-12">
                        <div class="input">
                            <label class="control-label">Identity Number (PAN/Aadhaar etc.)*</label>
                            <input type="text" id="identitynum" name="identitynum" class="form_fields form-control col-md-7 col-xs-12" onkeypress ="return numberalphOnly(event);" required>
                        </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-12">
                        <div class="input">
                            <label class="control-label">Phone Number</label>
                            <input type="text" id="phonenum" name="phonenum"  maxlength="11" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                    </section>
                
                    <section class="col col-md-6 col-xs-12">
                            <div class="input">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" id="mobilenum" name="mobilenum" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                            </div>
                        </section>
                        
                     <section class="col col-md-6 col-xs-12">
                        <div class="input">
                            <label class="control-label">Designation</label>
                            <input type="text" id="designation" name="designation" class="form_fields form-control col-md-7 col-xs-12" >
                        </div>
                    </section>
                
                    <section class="col col-md-6 col-xs-12">
                        <div class="input">
                            <label class="control-label">Email ID</label>
                            <input type="email" id="email" name="email" class="form_fields form-control col-md-7 col-xs-12" onkeypress ="return emailOnly(event);">
                        </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-12">
                    <div class="input">
                    <label class="control-label">Upload Identity Proof Of Recipient</label>
                        <div class="choose_files">
                            <input type="file" name="upload" id="upload" >
                        </div>
                    </div>
                   </section>
                    
                    <section class="col col-md-6 col-xs-12">
                        <div class="input">
                        <label class="control-label">Upload Confidentiallity Agreement</label>
                            <div class="choose_files">
                                <input type="file" name="uploadagrm" id="uploadagrm" >
                            </div>
                         </div>
                  </section>
                    

                <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">
                    <div class="floatright">
                        <input type="submit" class="btn btn-primary updateme floatleft" value="Update" >
                        <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">Close</button>
                    </div>
                </div>
          </form>
      </div>


      </div>
    </div>
</div>
