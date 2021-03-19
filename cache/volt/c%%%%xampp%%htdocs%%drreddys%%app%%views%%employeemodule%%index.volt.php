<?php $gmnlog = $this->session->loginauthspuserfront; ?>
<div class="right_col" role="main">
<div class="row">
<div class="content">
<!--    Total Number of Contracts Ends-->
<!-- My messages -->
<div class="top_space">
<div class="container">
   <div class="preloder_wraper">
      <a href="javascript:;" class="preloder"></a>
   </div>
   <div class="col-md-12 col-sm-12 col-lg-10 col-lg-offset-2">
      <div class="login-button-container clearfix">
          <button class="btn personal active">
            Employee Personal Details        
            </button>          
          <button class="btn employment">
            <!-- Personal Employment   -->  Past Employment    
            </button>
           <button class="btn relatives ">
            Relatives  Details   
            </button>
          <button class="btn mfr">
            Material Financial Relationship  
            </button>
          
         <!--<div class="col-md-2 col-xs-12 sign-in register">
            <button class="btn personal active">
            Employee Personal Details        
            </button>
         </div>
          <div class="col-md-2 col-xs-12 register">
            <button class="btn employment">
            Personal Employment        
            </button>
         </div>
         <div class="col-md-2 col-xs-12 register">
            <button class="btn relatives ">
            Relatives  Details   
            </button>
         </div>
         <div class="col-md-2 col-xs-12 register">
            <button class="btn mfr">
            Material Financial Relationship  
            </button>
         </div>-->
      </div>
   </div>
   <div class="col-md-12 col-xs-12">
      <div class="row personaldetails" style="display: block;">
         <div class="tablitiledesc text-center">
            <div class="note">
               (<strong>Note : </strong>Please fill information on all the 4 tabs.)
            </div>
         </div>
         <!-------------------------------------------------------------------------------------------->
         <h3>Insert Personal Details</h3>
         <div class="insert">
            <div class="col-md-4 col-xs-12">
               <label for="fn">Employee ID*</label>
               <input type="text"  value="<?php echo($userdetails[0]['employeecode']) ?>" readonly="readonly"/>
            </div>
            <div class="col-md-4 col-xs-12">
               <label for="fn">First Name*</label>
               <input type="text"  value="<?php echo($userdetails[0]['firstname']) ?>" readonly="readonly"/>
            </div>
            <div class="col-md-4 col-xs-12">
               <label for="ln">Last Name*</label>
               <input type="text"  value="<?php echo($userdetails[0]['lastname']) ?>" readonly="readonly"/>
            </div>
            <div class="col-md-4 col-xs-12">
               <label for="eid">Email Id*</label>
               <input type="text" value="<?php echo($userdetails[0]['email']) ?>" readonly="readonly"/>
            </div>
            <form action="employeemodule/insmydetail" id="perdetail" method="post" autocomplete="off">
               <!-- <div class="col-md-12"> -->
               <!-- <label for="fname">Full Name:</label> -->
               <input type="hidden" id="fname" name="fname" placeholder="Your name.." value="<?php echo($userdetails[0]['fullname']) ?>">
               <input type="hidden" id="lname" name="lname" placeholder="Your name.." value="<?php echo($userdetails[0]['lastname']) ?>">
               <input type="hidden" id="ecode" name="ecode" placeholder="Your name.." value="<?php echo($userdetails[0]['employeecode']) ?>">
               <input type="hidden" id="toemail" name="toemail" placeholder="" value="<?php echo($userdetails[0]['email']) ?> ">

               <?php if(!empty($personaldetails)){ ?>
               <input type="hidden" id="rqid" name="rqid" placeholder="" value="<?php echo($personaldetails['id']) ?>">
               <div class="col-md-4 col-xs-12">
                  <label for="nation">Nationality*</label>
                  <select id="per_nation" name="per_nation" class="form_fields" onchange="nationality(this.id);">
                  <?php if($personaldetails['nationality'] == 'Indian'){?>
                     <option value="">Select Nationality</option>
                     <option value="Indian" selected>Indian</option>
                     <option value="Other">Other</option>
                  <?php } else if($personaldetails['nationality'] == 'Other'){ ?>
                     <option value="">Select Nationality</option>
                     <option value="Indian" >Indian</option>
                     <option value="Other" selected>Other</option>
                      <?php } else { ?>
                     <option value="">Select Nationality</option>
                     <option value="Indian" >Indian</option>
                     <option value="Other" >Other</option>
                      <?php }  ?>
                  </select>
               </div>
               <div class="col-md-4 col-xs-12">
                  <label id = "pan_label" for="pan">PAN*</label>
                  <input type="text" id="pan" name="PAN" value="<?php echo($personaldetails['pan']) ?>" placeholder="pan" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10">
               </div>
               <div class="col-md-4 col-xs-12">
                  <!-- <div class="tooltip_div">
                     <a href="javascript:void(0);" data="Nature of Identifier (only for overseas employees)" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                  </div> -->
                  <label for="legal_idntfr" style="display: inline;">Nature of Legal Identifier (only for overseas employee)</label>
                  <input type="text" id="legal_idntfr" name="legal_idntfr" value="<?php echo($personaldetails['legal_identifier']) ?>" placeholder="Nature of Legal Identifier">
               </div>
              <!--  <div class="col-md-4 col-xs-12">
                  <div class="tooltip_div">
                     <a href="javascript:void(0);" data="only for overseas employees" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                  </div>
                  <label for="legal_idntfctn_no">Any other legal identification number</label>
                  <input type="text" id="legal_idntfctn_no" value="<?php echo($personaldetails['legal_identification_no']) ?>" name="legal_idntfctn_no" onkeypress="return IsAlphaNumeric(event);" placeholder="Any other legal identification number">
               </div> -->
               <div class="col-md-4 col-xs-12">
                  <label id = "aadhar_label" for="aadhar">Aadhaar*</label>
                  <input type="text" id="aadhar" name="aadhar" placeholder="aadhaar" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo($personaldetails['aadhar']) ?>" maxlength="12" pattern="[0-9]{12}">
               </div>
              
                  <div class="col-md-4 col-xs-12">
                     <label for="Dob">Date of Birth (dd-mm-yyyy)*</label>
                     <input type="text" id="dob" name="dob" value="<?php echo($personaldetails['dob']) ?>" class="" placeholder="dd-mm-yyyy" maxlength="10" >
                  </div>
                  <div class="col-md-4 col-xs-12"> 
                     <label class="gender" for="sex" style="margin-bottom: 10px;">Gender*</label>
                     <?php if($personaldetails['sex'] == 'Male'){?>
                     <input type="radio" id="sex" name="sex" value="Male" checked/>Male
                     <input type="radio" id="sex" name="sex"  value="Female"/>Female
                     <input type="radio" id="sex" name="sex"  value="Other"/>Other
                     <?php } elseif($personaldetails['sex'] == 'Female'){?>
                     <input type="radio" id="sex" name="sex" value="Male" />Male
                     <input type="radio" id="sex" name="sex"  value="Female" checked />Female
                     <input type="radio" id="sex" name="sex"  value="Other"/>Other
                     <?php } elseif($personaldetails['sex'] == 'Other'){?>
                     <input type="radio" id="sex" name="sex" value="Male" />Male
                     <input type="radio" id="sex" name="sex"  value="Female"  />Female
                     <input type="radio" id="sex" name="sex"  value="Other" checked />Other
                     <?php } else {?>
                     <input type="radio" id="sex" name="sex" value="Male" />Male
                     <input type="radio" id="sex" name="sex"  value="Female"  />Female
                     <input type="radio" id="sex" name="sex"  value="Other"  />Other
                     <?php }?>
                  </div>
                  <div class="col-md-4 col-xs-12">
                     <div class="tooltip_div">
                        <a href="javascript:void(0);" data="Please enter multiple Education Qualifications using semi-colon separator. Educational qualifications to be graduation and above." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
                     </div>
                     <label for="age">Educational Qualification*</label>
                     <input type="text" id="eduqulfcn" name="eduqulfcn" value="<?php echo($personaldetails['education']) ?>" placeholder="Educational Qualification">
                  </div>
              
               <div class="col-md-4 col-xs-12">
                  <label for="age">Institute From Which Acquired*</label>
                  <input type="text" id="institute" name="institute" value="<?php echo($personaldetails['institute']) ?>" placeholder="Institute From Which Acquired">
               </div>
               <div class="col-md-4 col-xs-12"> 
                  <label for="subject">Address*</label>
                  <textarea id="address" name="address" value="<?php echo($personaldetails['address']) ?>" placeholder="Write address.." style="height:50px"><?php echo($personaldetails['address']) ?></textarea>
               </div>
               <div class="col-md-4 col-xs-12">
                  <label class="control-label">Upload Identity Proof (PAN, Aadhar or other legal identifier)</label>
                  <?php if(!empty($personaldetails['filepath'])){ ?>
                  <a href="<?php echo ($personaldetails['filepath']); ?>" download>&nbsp;<i class="fa fa-download" id="uploadattached1" aria-hidden="true"></i></a>
                  <input type="hidden" name="updtfile" id="updtfile" value="<?php echo ($personaldetails['filepath']); ?>">
                  <?php } ?>
                  <div class="choose_files">
                     <input type="file" name="hldngfile" id="hldngfile" >
                  </div>
               </div>
                <div class="col-md-4 col-xs-12 "> 
                        <label for="age">Mobile No.*</label>
                        <input type="text" id="mobno" name="mobno" value="<?php echo($personaldetails['mobileno']) ?>" placeholder="Mobile No." maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  >
                        <span id="mobileappend"></span>
                     </div>
               <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="col-md-4 col-xs-12 "> 
                        <label for="age">Alternate Phone Number</label>
                        <input type="text" id="landline" name="landline" value="<?php echo($personaldetails['landline']) ?>" placeholder="Alternate Phone Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 32 || event.charCode == 43'>
                     </div>
                      
                     <div class="col-md-4 col-xs-12 ">
                        <div class="tooltip_div">
                            <a href="javascript:void(0);" data="Please enter 0 if no shares of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                        </div>
                        <label for="age">No. of shares held in DRL*</label>  
                        <input type="text" id="shareholdng" name="shareholdng" value="<?php echo($personaldetails['sharehldng']) ?>" placeholder="No. of shares held in DRL" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                     </div>
                     <div class="col-md-4 col-xs-12 "> 
                         <div class="tooltip_div">
                            <a href="javascript:void(0);" data="Please enter 0 if no American Depository Receipts of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                        </div>
                        <label for="age">No. of American Depository Receipts held in DRL*</label>
                        <input type="text" id="adrsholdng" name="adrsholdng" value="<?php echo($personaldetails['adrshldng']) ?>" placeholder="No. of American Depository Receipts held in DRL" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                     </div>
                  </div>
               </div>
               <?php } else { ?>
               <div class="col-md-4 col-xs-12">
                  <label for="nation">Nationality*</label>
                  <select id="per_nation" name="per_nation" class="form_fields" onchange="nationality(this.id);" >
                     <option value="">Select Nationality</option>
                     <option value="Indian">Indian</option>
                     <option value="Other">Other</option>
                  </select>
               </div>
               <input type="hidden" id="rqid" name="rqid" placeholder="" value="">
               <div class="col-md-4 col-xs-12">
                  <label id = "pan_label" for="pan">PAN*</label>
                  <input type="text" id="pan" name="PAN" placeholder="pan" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10">
               </div>
               <div class="col-md-4 col-xs-12">
                  <!-- <div class="tooltip_div">
                     <a href="javascript:void(0);" data="Nature of Identifier (only for overseas employees)" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                  </div> -->
                  <label for="legal_idntfr" style="display: inline;">Nature of Legal Identifier (only for overseas employee) </label>
                  <input type="text" id="legal_idntfr" name="legal_idntfr"  placeholder="Nature of Legal Identifier" >
               </div>
               <!-- <div class="col-md-4 col-xs-12">
                  <div class="tooltip_div">
                     <a href="javascript:void(0);" data="only for overseas employees" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                  </div>
                  <label for="legal_idntfctn_no">Any other legal identification number</label>
                  <input type="text" id="legal_idntfctn_no" name="legal_idntfctn_no" onkeypress="return IsAlphaNumeric(event);" placeholder="Any other legal identification number">
               </div> -->
               <div class="col-md-4 col-xs-12">
                  <label id = "aadhar_label" for="aadhar">Aadhaar*</label>
                  <input type="text" id="aadhar" name="aadhar" placeholder="aadhaar" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12" pattern="[0-9]{12}">
               </div>
              
              
                   <div class="col-md-4 col-xs-12">
                     <label for="Dob">Date of Birth (dd-mm-yyyy)*</label>
                     <input type="text" id="dob" name="dob"  class="" placeholder="dd-mm-yyyy" maxlength="10" >
                  </div>
                  <div class="col-md-4 col-xs-12"> 
                     <label class="gender" for="sex" style="margin-bottom: 10px;">Gender*</label>
                     <input type="radio" id="sex" name="sex" value="Male" />Male
                     <input type="radio" id="sex" name="sex"  value="Female"/>Female
                     <input type="radio" id="sex" name="sex"  value="Other"/>Other
                  </div>
                  <div class="col-md-4 col-xs-12">
                     <div class="tooltip_div">
                        <a href="javascript:void(0);" data="Please enter multiple Education Qualifications using semi-colon separator. Educational qualifications to be graduation and above." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
                     </div>
                     <label for="age">Educational Qualification*</label>
                     <input type="text" id="eduqulfcn" name="eduqulfcn"  placeholder="Educational Qualification">
                  </div>
                 
             
                <div class="col-md-4 col-xs-12">
                     <label for="age">Institute From Which Acquired*</label>
                     <input type="text" id="institute" name="institute"  placeholder="Institute From Which Acquired">
                  </div>
               <div class="col-md-4 col-xs-12"> 
                  <label for="subject">Address*</label>
                  <textarea id="address" name="address" placeholder="Write address.." style="height:50px"></textarea>
               </div>
               <div class="col-md-4 col-xs-12">
                  <label class="control-label">Upload Identity Proof (PAN, Aadhar or other legal identifier)</label>
                  <div class="choose_files">
                     <input type="file" name="hldngfile" id="hldngfile" >
                  </div>
               </div>
                <div class="col-md-4 col-xs-12 "> 
                  <label for="age">Mobile No.*</label>
                  <input type="text" id="mobno" name="mobno" placeholder="Mobile No." maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' min="10" max="10" >
                  <span id="mobileappend"></span>
               </div>
              
               <div class="row">

                  <div class="col-md-12 col-xs-12">
                    
                    <div class="col-md-4 col-xs-12 "> 
                      <label for="">Alternate Phone Number</label>
                      <input type="text" id="landline" name="landline" placeholder="Alternate Phone Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 32 || event.charCode == 43'>
                   </div>
                      
                     <div class="col-md-4 col-xs-12 ">
                         <div class="tooltip_div">
                            <a href="javascript:void(0);" data="Please enter 0 if no shares of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                        </div>
                        <label for="age">No. of shares held in DRL*</label>  
                        <input type="text" id="shareholdng" name="shareholdng" placeholder="No. of shares held in DRL" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0" >
                     </div>
                     <div class="col-md-4 col-xs-12 ">
                         <div class="tooltip_div">
                            <a href="javascript:void(0);" data="Please enter 0 if no American Depository Receipts of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                        </div>
                        <label for="age">No. of American Depository Receipts held in DRL*</label>
                        <input type="text" id="adrsholdng" name=" "  placeholder="No. of American Depository Receipts held in DRL" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0">
                     </div>
                  </div>
               </div>
               <?php } ?>
               <div class="col-md-12 " > 
                  <input class="btn btn-primary" type="button" name="confirmpersonalinfo" value="Submit" id="confirmpersonalinfo" onclick="confirmdisclosure(this.id)"  style="float: right;">
               </div>
            </form>
         
         </div>
         <!-- My messages -->
         
         <div class="mainelementfom">
            <div class="clearelement"></div>
            <!------------------------------------MODAL BOX FOR EDIT------------------------------------------>
            <div id="mydataedit" class="modal fade" role="dialog">
               <div class="modal-dialog">
                  <div class="modal-content" style="border: none;padding: 0;">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please Edit Content</h4>
                     </div>
                     <div class="modal-body show_shadow">
                        <form action="employeemodule/updatemydetails" id="upmydetails" method="post" autocomplete="off">
                           <div class="col-md-6">
                              <input type="hidden" name="reqid" id="reqid" value="">
                              <input type="hidden" name="filepath" id="filepath" value="">
                              <label for="pan">PAN*</label>
                              <input type="text" id="pan" name="pan" placeholder="pan" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10">
                           </div>
                           <div class="col-md-6">
                              <label for="aadhar">Aadhaar*</label>
                              <input type="text" id="aadhar" name="aadhar" placeholder="aadhaar" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12" pattern="[0-9]{12}">
                           </div>
                           <div class="col-md-6">
                              <label for="legal_idntfr">Nature of Legal Identifier (only for overseas employee)</label>
                              <input type="text" id="legal_idntfr" name="legal_idntfr" placeholder="Nature of Legal Identifier">
                           </div>
                           <div class="col-md-6">
                              <div class="tooltip_div">
                                 <a href="javascript:void(0);" data="only for overseas employees" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                              </div>
                              <label for="legal_idntfctn_no">Any other legal identification number</label>
                              <input type="text" id="legal_idntfctn_no" name="legal_idntfctn_no" onkeypress="return IsAlphaNumeric(event);" placeholder="Any other legal identification number">
                           </div>
                           <div class="col-md-6">
                              <label for="Dob">Dob*</label>
                              <input type="text" id="dob" name="dob" class="bootdatepick" placeholder="dob" readonly>
                           </div>
                           <div class="col-md-6"> 
                              <label class="gender" for="sex" style="margin-bottom: 10px;">Gender*</label>
                              <input type="radio" id="sex" name="sex" value="Male" checked/>Male
                              <input type="radio" id="sex" name="sex"  value="Female"/>Female
                              <input type="radio" id="sex" name="sex"  value="Other"/>Other
                           </div>
                           <div class="col-md-12">
                              <label for="age">Mobile No.*</label>
                              <input type="hidden" id="upmobileno" name="upmobileno" value="">
                              <input type="text" id="upmobno" name="upmobno" placeholder="Mobile No." maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' min="10" max="10">
                           </div>
                           <div class="col-md-6">
                              <div class="tooltip_div">
                                 <a href="javascript:void(0);" data="Please enter multiple Education Qualifications using semi-colon separator. Educational qualifications to be graduation and above." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
                              </div>
                              <label for="age">Educational Qualification*</label>
                              <input type="text" id="eduqulfcn" name="eduqulfcn" placeholder="Educational Qualification">
                           </div>
                           <div class="col-md-6">
                              <label for="age">Institute From Which Acquired*</label>
                              <input type="text" id="institute" name="institute" placeholder="Institute From Which Acquired">
                           </div>
                           <div class="col-md-12"> 
                              <label for="subject">Address*</label>
                              <textarea id="address" name="address" placeholder="Write address.." style="height:100px"></textarea>
                           </div>
                           <div class="col-md-6">
                              <label class="control-label">Upload Identity Proof (PAN, Aadhar or other legal identifier)</label>
                              <div class="choose_files">
                                 <input type="file" name="hldngfile" id="hldngfile" >
                              </div>
                           </div>
                           <div class="col-md-12"> 
                              <input type="submit" value="Update">
                           </div>
                        </form>
                     </div>
                     <div class="modal-footer">
                     </div>
                  </div>
               </div>
            </div>
            <!------------------------------------MODAL BOX FOR EDIT FINISH------------------------------------------>
            <!-------------------------------DELETE MY INFO MODAL START HERE------------------------------------------>
            <!--------------------DELETE COMPANY MODEL--------------------->
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
                        <h5 style="text-align: center;">Are You Sure To Delete Personal Information?</h5>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="delinfo">Delete</button> 
                     </div>
                  </div>
               </div>
            </div>
            <!----------------------------------------DELETE MY INFO FINISH HERE------------------------->
            <!---------------------------------------------------------------------------------------------->
         </div>
      </div>
      <div class="col-md-12 col-xs-12 col-sm-12">
         <div class=" row relativesform" style="display: none;">
            <h3 class="col col-xs-6" style="margin-top: 30px;">Insert Relative Details</h3>
            <!--tooltip div -->
            <div class="tooltip_div col col-xs-6" style="margin-top: 30px;">
               <a href="javascript:void(0);" data="The term “immediate relative” means spouse of a person, and includes parents, siblings, and child of such person or the spouse, any of whom is either dependent financially on such person, or consults such person in taking decisions relating to trading in securities.!" class="tooltip_c">who is immediate relative <abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
            </div>
            <!--tooltip div end-->
            <div class="col col-xs-12">
               <form action ="employeemodule/relationdata" class="chklength" id="getdata_1" method="post" enctype="multipart/form-data" autocomplete="off">
                  <div class="input-group col-md-12 col-xs-12 col-sm-12">
                     <div class="row">
                        
                        <div class="col-md-4">
                           <label>Relationship*</label >
                           <select id="relationship" name="relationship" class="form_fields" required="">
                              <option value="2">Spouse</option>
                              <option value="3">Father</option>
                              <option value="4">Mother</option>
                              <option value="5">Brother</option>
                              <option value="6">Sister</option>
                              <option value="7">Son</option>
                              <option value="8">Daughter</option>
                              <option value="9">Son's Wife</option>
                              <option value="10">Daughter's Husband</option>
                              <option value="1">HUF</option>
                              <option value="11">Others</option>
                           </select>
                        </div>
                       
                        <div class="col-md-4">
                           <label>Full Name*</label>
                           <input  class="" placeholder="Full Name"  class="fname" id="fname" name="fname" type="text" />
                        </div>
                         <div class="col-md-4">
                           <label>Nature of Dependency*</label >
                           <select id="depnature" name="depnature[]" class="form_fields" required="" multiple size="3">
                              <option value="1">Financially Dependent</option>
                              <option value="2">Consult in trading for securities</option>
                              <option value="3">Non-dependent</option>
                           </select>
                        </div>
                        <div class="col-md-4 col-xs-12">
                           <label for="nation">Nationality*</label>
                           <select id="rel_nation" name="rel_nation" class="form_fields" required="" onchange="nationality(this.id);">
                               <option value="">Select Nationality</option>
                              <option value="Indian">Indian</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                        <div class="col-md-4">
                           <div class="tooltip_div">
                              <a href="javascript:void(0);" data="In case no PAN number available with dependents, please enter 00000000" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                           </div>
                           <label id = "rel_pan_label">PAN*</label>
                           <input  class=" panval" placeholder="PAN" class="pan" id="pan"  name="pan" type="text" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10" />
                        </div>
                        <div class="col-md-4">
                           <!-- <div class="tooltip_div">
                              <a href="javascript:void(0);" data="Nature of Identifier (only for overseas employees)" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                           </div> -->
                           <label for="legal_idntfr" style="display: inline;">Nature of Legal Identifier (only for overseas employee) </label>
                           <input type="text" id="legal_idntfr" name="legal_idntfr"  placeholder="Nature of Legal Identifier">
                        </div>
                        <!-- <div class="col-md-4">
                           <div class="tooltip_div">
                              <a href="javascript:void(0);" data="only for overseas employees" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                           </div>
                           <label for="legal_idntfctn_no">Any other legal identification number</label>
                           <input type="text" id="legal_idntfctn_no" name="legal_idntfctn_no" onkeypress="return IsAlphaNumeric(event);"  placeholder="Any other legal identification number">
                        </div> -->
                        <!-- </div>
                           <div class="row"> -->
                        <div class="col-md-4"> 
                           <label id= "rel_aadhar_label">Aadhaar*</label>
                           <input  class=" aadhar" placeholder="Aadhaar" id="aadhar"  name="aadhar" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12" pattern="[0-9]{12}" />
                        </div>
                        <div class="col-md-4">
                           <label>Date of Birth (dd-mm-yyyy)*</label>
                           <input type="text"  id="1_dob" name="dob" class="" placeholder="dd-mm-yyyy" maxlength="10">
                        </div>
                        <div class="col-md-4">
                           <div class="tooltip_div">
                              <a href="javascript:void(0);" data="Please enter multiple Education Qualifications using semi-colon separator. Educational qualifications to be graduation and above." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
                           </div>
                           <label>Educational Qualification</label>
                           <input type="text" id="eduqulfcn" name="eduqulfcn" placeholder="Educational Qualification">
                        </div>
                        <!-- </div>
                           <div class="row"> -->
                        <div class="col-md-4 col-xs-12">
                           <label for="institute">Institute From Which Acquired</label>
                           <input type="text" id="relinstitute" name="relinstitute" placeholder="Institute From Which Acquired">
                        </div>
                        
                        <div class="col-md-4"> 
                           <label style="display: block; margin-bottom: 10px;" for="sex">Gender*</label>
                           <input class = "relgender" type="radio" id="relmale" name="sex" value="Male" />Male
                           <input class = "relgender" type="radio" id="relfemale" name="sex"  value="Female"  >Female 
                           <input class = "relgender"type="radio" id="relother" name="sex"  value="Other"  >Other 
                        </div>
                        <div class="col-md-4  "> 
                           <label for="control-label">Mobile No.*</label>
                           <input type="text"  id="relmobno" name="relmobno" placeholder="Mobile No."onkeypress='return event.charCode >= 48 && event.charCode <= 57'  maxlength="10"  >
                        </div>
                        <!--  </div>
                           <div class="row"> -->
                        <div class="col-md-4 col-xs-12 "> 
                           <label for="age">Occupation</label>
                           <input type="text" id="reloccupation" name="reloccupation" placeholder="Occupation" >
                        </div>
                        <div class="col-md-4 col-xs-12 "> 
                           <label for="age">Name of Companies/Firm where employed</label>
                           <input type="text" id="relcompany" name="relcompany"  placeholder="Name of Companies/Firm where employed" >
                        </div>
                       
                        <div class="col-md-4 ">
                        <div class="tooltip_div">
                            <a href="javascript:void(0);" data="Please enter 0 if no shares of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                        </div>
                           <label for="age">No. of shares held in DRL*</label>
                           <input type="text" id="shareholdng" name="shareholdng" placeholder="No. of shares held in DRL"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0" >
                        </div>
                        <div class="col-md-4 col-xs-12"> 
                            <div class="tooltip_div">
                                <a href="javascript:void(0);" data="Please enter 0 if no American Depository Receipts of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                            </div>
                           <label for="age">No. of American Depository Receipts held in DRL*</label>
                           <input type="text" id="adrsholdng" name="adrsholdng" placeholder="No. of American Depository Receipts held in DRL" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="0">
                        </div>
                         <div class="col-md-4">
                           <label class="control-label">Upload Identity Proof (PAN, Aadhar or other legal identifier)</label>
                           <input type="file" name="file[]" id="file" >
                        </div>
                        <div class="col-md-4">
                           <label>Address*</label>
                            <span style="margin:0 20px;">
                              <input style="margin: 0;" type="checkbox" id="copyaddress" name="copyaddress" value="same">
                            <label>Same as your address</label>
                            </span><br>
                           <textarea class="" placeholder="Address" id="addr"  name="address" type="text"></textarea>
                        </div>
                     </div>
                      <div class="col-md-4 col-xs-12">
                           <label for="nation">Is the Company / Firm business partner of Dr. Reddy’s*</label>
                           <select id="cmppartner" name="cmppartner" class="form_fields" required="">
                               <option value="">Select Option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </div>
                     <div class="col-md-12">
                        <input class="btn btn-primary" type="button" name="relsub" value="Submit" id="relsub" onclick="confirmdisclosure(this.id)" style="float: right;">
                     </div>
                  </div>
               </form>
            </div>
             <div class="tablitiledesc">
               <div class="note">
                  <strong>Note : </strong><div style="display: inline-block;padding: 5px 15px;">When you fill up the details of your relatives in the above form, it will be visible in the table below.</div>
               </div>
            </div>
            <!--
               <div class="valida">  
               
               <span class="glyphicon glyphicon-plus addrelinfo" style="color: green;" formno="1"></span>
               <span class="glyphicon glyphicon-minus deleterelinfo" style="color:red;" formno="1"></span>
               </div>
               -->
            <!-------------------------------------------Relative Details Table----------------------------------->
            <div class="table_data">
               <table class="table table-inverse" id="datableabhi">
                  <thead>
                     <tr>
                        <th>Sr No</th>
                        <th>Relationship</th>
                        <th>Name</th>
                        <th>Legal Identifier No.</th>
                        <th>Aadhaar</th>
                        <th>Mobile No</th>
                        <th width="100px">Date of Birth</th>
                        <!-- <th>Qualification</th> -->
                        <th>File</th>
                        <th>No. of shares held in DRL</th>
                        <th>No. of American Depository Receipts held in DRL</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody class="reldetails" appendrow='1'></tbody>
               </table>
            </div>
            <!----------------------------------------------------------------------------------------------------->
            <!------------------------------Delete Relational Data Modal----------------------------------------->
            <div id="delrelation" class="modal fade" role="dialog">
               <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        &times;</button>
                     </div>
                     <div class="modal-body">
                        <input type="hidden" id="delrel" value="" name="">
                        <h5 style="text-align: center;">Are You Sure To Delete Relative Information?</h5>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="deleterel">Delete</button> 
                     </div>
                  </div>
               </div>
            </div>
            <!------------------------------------------------------------------------------------------------------>
            <!------------------------------------MODAL BOX FOR EDIT RELATIONSHIP------------------------------------------>
            <div id="reledit" class="modal fade" role="dialog" tabIndex=-1 >
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please Edit Content</h4>
                     </div>
                     <div class="modal-body show_shadow">
                        <form action="employeemodule/updaterelatives" id="uprel" method="post" autocomplete="off">
                          
                           <div class="col-md-6">
                              <label for="relationship">Relationship*</label>
                              <select id="relationship" name="relationship" class="form_fields" required="">
                                 <option value="2">Spouse</option>
                                 <option value="3">Father</option>
                                 <option value="4">Mother</option>
                                 <option value="5">Brother</option>
                                 <option value="6">Sister</option>
                                 <option value="7">Son</option>
                                 <option value="8">Daughter</option>
                                 <option value="9">Son's Wife</option>
                                 <option value="10">Daughter's Husband</option>
                                 <option value="1">HUF</option>
                                 <option value="11">Others</option>
                              </select>
                           </div>
                           <div class="col-md-6">
                              <label>Nature of Dependency*</label >
                              <select id="depnature" name="depnature[]" class="form_fields" required="" multiple size="4" style="margin-bottom: 0;">
                                 <option value="1">Financially Dependent</option>
                                 <option value="2">Consult in trading for securities</option>
                                 <option value="3">Non-dependent</option>
                              </select>
                           </div>
                           <div class="col-md-6">
                              <input type="hidden" name="releditid" id="releditid" value="">
                              <input type="hidden" name="filepath" id="filepath" value="">
                              <label for="name">Name*</label>
                              <input type="text" id="name" name="name" placeholder="Name" style="margin-bottom: 14px;">
                           </div>

                            <div class="col-md-6">
                              <label for="nation">Nationality*</label>
                              <select id="rel_nation_update" name="rel_nation_update" class="form_fields" onchange="nationality(this.id);">
                                
                                 <option value="Indian">Indian</option>
                                 <option value="Other">Other</option>
                              </select>
                           </div>
                           <div class="col-md-6">
                              <div class="tooltip_div">
                                 <a href="javascript:void(0);" data="In case no PAN number available with dependents, please enter 00000000" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                              </div>
                              <input type="hidden" name="reqid" id="reqid" value="">
                              <label id= "edit_pan_label" for="pan">PAN*</label>
                              <input type="text" id="pan" name="pan" placeholder="PAN" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10">
                           </div>
                           <div class="col-md-6">
                              <!-- <div class="tooltip_div">
                                 <a href="javascript:void(0);" data="Nature of Identifier (only for overseas employees)" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                              </div> -->
                              <label for="legal_idntfr" style="display: inline;">Nature of Legal Identifier (only for overseas employee) </label>
                              <input type="text" id="legal_idntfr" name="legal_idntfr"  placeholder="Nature of Legal Identifier">
                           </div>
                           <!-- <div class="col-md-6">
                              <div class="tooltip_div">
                                 <a href="javascript:void(0);" data="only for overseas employees" class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                              </div>
                              <label for="legal_idntfctn_no">Any other legal identification number</label>
                              <input type="text" id="legal_idntfctn_no" name="legal_idntfctn_no" onkeypress="return IsAlphaNumeric(event);" placeholder="Any other legal identification number">
                           </div> -->
                           <div class="col-md-6">
                              <label id= "edit_aadhar_label" for="aadhar">Aadhaar*</label>
                              <input type="text" id="aadhar" name="aadhar" placeholder="Aadhaar" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12" pattern="[0-9]{12}">
                           </div>
                           <div class="col-md-6">
                              <label for="Dob">Date of Birth (dd-mm-yyyy)*</label>
                              <input type="text" id="dob" name="dob" class="" placeholder="dd-mm-yyyy" maxlength="10" >
                           </div>
                           <div class="col-md-6" style="margin-bottom: 15px;">
                              <label style="display: block; margin-bottom: 10px;" for="sex">Gender*</label>
                              <input type="radio" id="sex" name="sex" value="Male" checked/>Male
                              <input type="radio" id="sex" name="sex"  value="Female"/>Female
                              <input type="radio" id="sex" name="sex"  value="Other"/>Other
                           </div>
                           <div class="col-md-6">
                              <div class="tooltip_div">
                                 <a href="javascript:void(0);" data="Please enter multiple Education Qualifications using semi-colon separator. Educational qualifications to be graduation and above." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
                              </div>
                              <label for="age">Educational Qualification</label>
                              <input type="text" id="eduqulfcn" name="eduqulfcn" placeholder="Educational Qualification">
                           </div>
                           <div class="col-md-6 col-xs-12">
                              <label for="institute">Institute From Which Acquired</label>
                              <input type="text" id="relinstituteup" name="relinstituteup" placeholder="Institute From Which Acquired">
                           </div>
                           <div class="col-md-6 col-xs-12 " style="margin-top: 0px;"> 
                              <label for="age">Mobile No.*</label>
                              <input type="text"  id="relmobnoup" name="relmobnoup" placeholder="Mobile No." onkeypress='return event.charCode >= 48 && event.charCode <= 57'  maxlength="10"  >
                           </div>
                           <div class="col-md-12"> 
                              <label for="subject">Address*</label>
                              <textarea id="address" name="address" placeholder="Write address.." style="height:100px"></textarea>
                           </div>
                           
                                 <div class="col-md-6">
                                    <div class="tooltip_div">
                                        <a href="javascript:void(0);" data="Please enter 0 if no shares of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                                    </div>
                                    <label for="age">No. of shares held in DRL*</label>
                                    <input type="text" id="shareholdng" name="shareholdng" placeholder="No. of shares held in DRL"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  >
                                 </div>
                                 <div class="col-md-6">
                                     <div class="tooltip_div">
                                        <a href="javascript:void(0);" data="Please enter 0 if no American Depository Receipts of DRL are held." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                                    </div>
                                    <label for="age" style="max-width: 95%;">No. of American Depository Receipts held in DRL*</label>
                                    <input type="text" id="adrsholdng" name="adrsholdng" placeholder="No. of American Depository Receipts held in DRL" onkeypress='return event.charCode >= 48 && event.charCode <= 57' >
                                 </div>
                                 <div class="col-md-6 col-xs-12 "> 
                                    <label for="age">Occupation</label>
                                    <input type="text" id="reloccupationup" name="reloccupationup" placeholder="Occupation"  >
                                 </div>
                                 <div class="col-md-6 col-xs-12 "> 
                                    <label for="age">Name of Companies/Firm where employed</label>
                                    <input type="text" id="relcompanyup" name="relcompanyup"  placeholder="Name of Companies/Firm where employed" >
                                 </div>
                                 <div class="col-md-6">
                                    <label class="control-label">Upload Identity Proof (PAN, Aadhar or other legal identifier)</label>
                                    <input type="file" name="file" id="file" >
                                 </div>
                                 <div class="col-md-6">
                                    <label for="nation">Is the Company / Firm business partner of Dr. Reddy’s*</label>
                                   <select id="cmppartner" name="cmppartner" class="form_fields" required="">
                                       <option value="">Select Option</option>
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                   </select>
                                 </div>
                           <div class="col-md-12"> 
                              <input type="button" class="btn btn-primary" name= "relupdate" value="Update" onclick="confirmdisclosure(this.id)" id="relupdate" style="float: right;">
                           </div>
                        </form>
                     </div>
                     <div class="modal-footer">
                     </div>
                  </div>
               </div>
            </div>
            <!----------------------MODAL BOX FOR EDIT RELATIONSHIP FINISH------------------------------------------>
         </div>
      </div>
      <div class="col-md-12 col-lg-12">
        <div class="row relativesform mymfr" style="display: none;">
            <div class="tooltip_div col col-xs-12" style="margin-top: 10px;float: left;">
                <a style="float: left;" href="javascript:void(0);" data="The term “material financial relationship” shall mean a relationship in which one person is a recipient of any kind of payment such as by way of a loan or gift during the immediately preceding twelve months, equivalent to at least 25% of designated person’s annual income but shall exclude relationships in which the payment is based on arm’s length transactions" class="tooltip_c">what is material financial relationship <abbr class="fa fa-info-circle"></abbr><span class="arrow-down"></span></a>
            </div>
            <label style="margin-top: 10px;" class="do">Do you have any Material Financial Relationship? 
              <?php if(isset($mfrstatus) ){ 
                if($mfrstatus[0]['status'] == 1){?>
                Yes<input type="radio" name="mfrstatus" value="1" class="mfrstatusupdt" checked onclick="showmfrsection();" /> 
                No<input type="radio" name="mfrstatus" value="0" class="mfrstatusupdt" onclick="hidemfrsection();"><br>
            <?php } else if(isset($mfrstatus) && $mfrstatus[0]['status'] == 0) { ?>
                Yes<input type="radio" name="mfrstatus" value="1" class="mfrstatusupdt" onclick="showmfrsection();"> 
                No<input type="radio" name="mfrstatus"value="0" class="mfrstatusupdt" checked onclick="hidemfrsection();"/><br>
            <?php } else { ?>
                Yes<input type="radio" name="mfrstatus" value="1" class="mfrstatusupdt" onclick="showmfrsection();"> 
                No<input type="radio" name="mfrstatus" value="0" class="mfrstatusupdt" onclick="hidemfrsection();"/><br>
            <?php }} else{ ?>
                Yes<input type="radio" name="mfrstatus" value="1" class="mfrstatusupdt" onclick="showmfrsection();"> 
                No<input type="radio" name="mfrstatus"value="0" class="mfrstatusupdt" onclick="hidemfrsection();"/><br>
            <?php } ?>
            </label>
            <div id = "showmfr" style="display: none;">   

            <div class="row"> 
            <h3 class="col col-xs-6" style="margin-top: 30px;">Financial Relationship Details</h3>
            
            <div class="col col-xs-12">
               <div class="input-group row">
                  <div class="col-md-6">
                     <label>Name of the Person*</label>
                     <input type="text" placeholder="Name of the Person" id="mfrname">
                  </div>
                  <div class="col-md-6">
                     <label>Identity Number (PAN/Aadhaar etc.)*</label>
                     <input type="text" placeholder="Identity Number" id="adharpan" onkeypress="return isAlphaNumeric(event,this.value);">
                  </div>
                  <div class="col-md-6">
                     <label>Relationship*</label>
                     <input type="text" placeholder="Relationship " id="mfrrelation">
                  </div>
                  <div class="col-md-6">
                     <label>Nature of Transaction*</label>
                     <input type="text" placeholder="Nature of Transaction " id="mfrtransaction">
                  </div>
                  <div class="col-md-6">
                     <label>Demat Account No.*</label>
                     <input type="text" placeholder="Demat Account No." id="mfrclientid" onkeypress="return isAlphaNumeric(event);" maxlength="16">
                  </div>
                  <div class="col-md-6">
                     <label>Mobile No.*</label>
                     <input type="text" placeholder="Mobile No. " id="mfrmobile"  maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                  </div>
                  <div class="col-md-6">
                     <label>Address</label>
                     <textarea id="materialaddress" placeholder="Write address.." style="height:100px"></textarea>
                  </div>
                   <div class="col-md-6">
                    <label for="nation">Is the person with whom material financial relationship exists, a third party associated with Dr. Reddy’s?*</label>
                    <select id="mfr_thirdparty" name="mfr_thirdparty" class="form_fields" required="">
                       <option value="">Select Option</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                   </div>
                  <div class="col-md-12 text-right">
                     <button type="button" class="btn btn-primary" id="savemfr">Submit</button>
                  </div>
               </div>
            </div>
         </div>
             
             <div class="tablitiledesc">
               <div class="note">
                  <strong>Note : </strong><div style="display: inline-block;padding: 5px 15px;">The data submitted in the above form will be visible in the table below.</div>
               </div>
            </div>
             
            <!---------------------------------------------------------------------------------------------->
            <!----TABLE OF INSERTED DATA------------------------------------------------------------------>
            <!--             <h4 class="mfrdetails">Material Financial Relationship</h4> -->
            <table class="table table-inverse" id="datableabhi">
               <thead>
                  <tr>
                     <th>Sr No</th>
                     <th>Name of the Person</th>
                     <th>Identity Number</th>
                     <th>Relationship</th>
                     <th>Mobile No</th>
                     <th>Address</th>
                     <th> Action </th>
                  </tr>
               </thead>
               <tbody class="mfrtable" appendrow='1'></tbody>
               <tr>
                  <td></td>
               <tr>
            </table>
            </div>
         </div>
         <div id="mfrdelmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">
                     &times;</button>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" id="mfrdelid" value="" name="">
                     <h5 style="text-align: center;">Are you sure you want to delete this entry?</h5>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" id="delbtnmfr">Delete</button> 
                  </div>
               </div>
            </div>
         </div>
         <div id="updateholdings1" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal">
                     &times;</button>                    
                     <h5 style="text-align: center;color: #000;margin: 45px 50px 25px 50px;line-height: 25px;">If you have updated your holdings, then please confirm whether you have submitted necessary disclosures under Insider Trading Regulations to the Compliance officer.</h5>
                  </div>
                  <div class="modal-footer" style="border-top:none;">
                     <button type="button" class="btn btn-primary" id="yesdisclosures1">I understand</button> 
                  </div>
               </div>
            </div>
         </div>
         <div id="updateholdings2" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal">
                     &times;</button>                    
                     <h5 style="text-align: center;color: #000;margin: 45px 50px 25px 50px;line-height: 25px;">Please confirm whether you have submitted necessary disclosures under Insider Trading Regulations to the Compliance officer</h5>
                  </div>
                  <div class="modal-footer" style="border-top:none;">
                     <button type="button" class="btn btn-primary" id="yesdisclosures2">Yes</button> 
                     <button style="color: #522c8f !important;border-color: #cecece;"  type="button" class="btn btn-default" id="nodisclosures2" onclick="nodisclosures(this.id);">No</button>
                  </div>
               </div>
            </div>
         </div>
         <div id="updateholdings3" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal">
                     &times;</button>                    
                     <h5 style="text-align: center;color: #000;margin: 45px 50px 25px 50px;line-height: 25px;">Please confirm whether you have submitted necessary disclosures under Insider Trading Regulations to the Compliance officer</h5>
                  </div>
                  <div class="modal-footer" style="border-top:none;">
                     <button type="button" class="btn btn-primary" id="yesdisclosures3">Yes</button> 
                     <button style="color: #522c8f !important;border-color: #cecece;" type="button" class="btn btn-default" id="nodisclosures3" onclick="nodisclosures(this.id);">No</button>
                  </div>
               </div>
            </div>
         </div>
         <div id="mfrdelmodaledit" class="modal fade" role="dialog" tabIndex=-1 >
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">
                     Please Update Your data</h5> 
                     <button type="button" class="close" data-dismiss="modal">
                     &times;</button>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" id="mfreditid" value="" name="">
                  </div>
                  <div class="col-md-6">
                     <label>Name of the Person</label>
                     <input type="text" placeholder="Name of the Person" id="mfrnameup">
                  </div>
                  <div class="col-md-6">
                     <label>Identity Number (PAN/Aadhaar etc.)*</label>
                     <input type="text" placeholder="Identity Number" id="adharpanup" onkeypress="return isAlphaNumeric(event,this.value);">
                  </div>
                  <div class="col-md-6">
                     <label>Relationship</label>
                     <input type="text" placeholder="Relationship " id="mfrrelationup">
                  </div>
                  <div class="col-md-6">
                     <label>Nature of Transaction*</label>
                     <input type="text" placeholder="Nature of Transaction " id="mfrtransactionup">
                  </div>
                  <div class="col-md-6">
                     <label>Demat Account No.*</label>
                     <input type="text" placeholder="Demat Account No." id="mfrclientidup" onkeypress="return isAlphaNumeric(event,this.value); "maxlength="16" pattern="[A-Za-z0-9]{16}">
                  </div>
                  <div class="col-md-6">
                     <label>Mobile No.*</label>
                     <input type="text" placeholder="Mobile No. " id="mfrmobileup"  maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                  </div>
                  <div class="col-md-6">
                     <label>Address</label>
                     <textarea id="materialaddressup" placeholder="Write address.." style="height:100px"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label for="nation">Is the person with whom material financial relationship exists, a third party associated with Dr. Reddy’s?*</label>
                    <select id="mfr_thirdparty" name="mfr_thirdparty" class="form_fields" required="">
                       <option value="">Select Option</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                   </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" id="upmfrmod">Update</button> 
                  </div>
               </div>
            </div>
         </div>
         <div id="tradeintimationmodel" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Please Fill Form</h4>
                  </div>
                  <div class="modal-body show_shadow">
                     <form action="employeemodule/inserttrdintimtn" id="inserttrdintimtn" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="compid" class="compid" id="compid" value="">
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <div class="mainelem company_product">
                                 <label class="control-label">Search Name of company*</label>
                                 <div class="header-search-wrapper  floatnone find_box_company">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft" placeholder="Select Company" id="search-box" autocomplete="off"/>
                                    <div id="live-search-header-wrapper" class="">
                                       <ul class="live-searchul"></ul>
                                    </div>
                                    <div class="clearelement"></div>
                                    <div class="mainelementch">
                                       <div class="clearelement"></div>
                                    </div>
                                 </div>
                                 <div class="header-search-wrapper hide-on-med-and-down services_search find_box_company" style="display: none;">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="getvalueofsearch" class="header-search-input1 z-depth-2 floatleft" placeholder="Explore Resolutions" id="search-box1"/>
                                    <div class="clearelement"></div>
                                    <div id="live-search-header-wrapper1" class="">
                                       <ul class="live-searchul1"></ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Name Of Company*</label>
                              <input type="text" id="validators" name="validators" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Name Of the Person*</label> 
                              <select id="reltedprty" name="reltedprty" class="form_fields form-control col-md-7 col-xs-12" >
                                 <option value="" id="reltedprty" >Select Related Party</option>
                                 <?php foreach($relatedparty as $party){  ?>
                                 <option value="<?php echo $party['id']; ?>"><?php echo $party['related_party']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Type Of Security</label>  
                              <select id="secutype" name="secutype" class="form_fields form-control col-md-7 col-xs-12" >
                                 <option value="" id="secutype" >Select Security Type</option>
                                 <?php foreach($sectype as $secutype){  ?>
                                 <option value="<?php echo $secutype['id']; ?>"><?php echo $secutype['security_type']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Type Of Transaction</label>  
                              <select id="trnstype" name="trnstype" class="form_fields form-control col-md-7 col-xs-12" >
                                 <?php foreach($transctn as $trns){  ?>
                                 <option value="<?php echo $trns['id']; ?>"><?php echo $trns['transaction']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">No. Of Shares*</label>
                              <input type="text" id="shres" name="shres" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                           </div>
                        </section>
                        <section class="col col-md-12 col-xs-12" id="dateoftrans">
                           <div class="input">
                              <label class="control-label">Date Of Transaction</label> 
                              <input type="text" name="transdate" id="transdate" class="form-control bootdatepick" required readonly>
                           </div>
                        </section>
                        <section class="col col-md-12 ">
                           <input type="submit" value="Submit" class="btn btn-primary ">
                        </section>
                        <div class="clearelement"></div>
                     </form>
                  </div>
                  <div class="modal-footer">
                  </div>
               </div>
            </div>
         </div>
         <div id="Mymodaledit" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Please Fill Form</h4>
                  </div>
                  <div class="modal-body show_shadow">
                     <form action="employeemodule/updatetrdintimtn" id="updatetrdintimtn" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" id="trdeditid" value="" name="trdeditid">
                        <input type="hidden" name="compid" class="compid" id="compid" value="">
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <div class="mainelem company_product">
                                 <label class="control-label">Search Name of company*</label>
                                 <div class="header-search-wrapper  floatnone find_box_company">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft" placeholder="Select Company" id="search-box" autocomplete="off"/>
                                    <div id="live-search-header-wrapper" class="">
                                       <ul class="live-searchul"></ul>
                                    </div>
                                    <div class="clearelement"></div>
                                    <div class="mainelementch">
                                       <div class="clearelement"></div>
                                    </div>
                                 </div>
                                 <div class="header-search-wrapper hide-on-med-and-down services_search find_box_company" style="display: none;">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="getvalueofsearch" class="header-search-input1 z-depth-2 floatleft" placeholder="Explore Resolutions" id="search-box1"/>
                                    <div class="clearelement"></div>
                                    <div id="live-search-header-wrapper1" class="">
                                       <ul class="live-searchul1"></ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Name Of Company*</label>
                              <input type="text" id="validators" name="validators" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Name Of the Person*</label> 
                              <select id="reltedprty" name="reltedprty" class="form_fields form-control col-md-7 col-xs-12" >
                                 <?php foreach($relatedparty as $party){  ?>
                                 <option value="<?php echo $party['id']; ?>"><?php echo $party['related_party']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Type Of Security</label>  
                              <select id="secutype" name="secutype" class="form_fields form-control col-md-7 col-xs-12" >
                                 <?php foreach($sectype as $secutype){  ?>
                                 <option value="<?php echo $secutype['id']; ?>"><?php echo $secutype['security_type']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">Type Of Transaction</label>  
                              <select id="trnstype" name="trnstype" class="form_fields form-control col-md-7 col-xs-12" >
                                 <?php foreach($transctn as $trns){  ?>
                                 <option value="<?php echo $trns['id']; ?>"><?php echo $trns['transaction']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6">
                           <div class="input">
                              <label class="control-label">No. Of Shares*</label>
                              <input type="text" id="shres" name="shres" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                           </div>
                        </section>
                        <section class="col col-md-6 col-xs-6" id="dateoftrans">
                           <div class="input">
                              <label class="control-label">Date Of Transaction</label> 
                              <input type="text" name="transdate" id="transdate" class="form-control bootdatepick" required readonly>
                           </div>
                        </section>
                        <section class="col col-md-12 ">
                           <input type="submit" value="Submit" class="btn btn-primary ">
                        </section>
                        <div class="clearelement"></div>
                     </form>
                  </div>
                  <div class="modal-footer">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 col-lg-12">
         <div class="row employmentform" style="display: none;">
            <h3 style="text-align: center;">Add Past Employer</h3>
             
             <div class="col-md-7 col-xs-12">
                
                <label for="age">Please enter no. of past employment(s)*
                 <div class="tooltip_div" style="margin-left: 5px;">
                     <a href="javascript:void(0);" data="In case your no. of past employments exceed 5 then please mention only latest 5 employment details here. For rest of the companies please send email to the Compliance Officer." class="tooltip_c right" style="margin-right:0px;"><abbr class="fa fa-info-circle iji"></abbr><span class="arrow-down"></span></a>
                  </div>
               </label>

               <div class="note" style="padding: 2px 0;">
                  (<strong>Note : </strong>Rows corresponding to this number will open up  for entry. You can enter maximum 5 past employment details.)
               </div> 
               <div class="row">
                  <div class="col-md-8">
                   <input type="text" id="pastemp" name="pastemp" placeholder="No. of Past Employer">
                  </div>
                  <div class="col-md-4">
                     <button class="add_button" style="margin-top:0;">Go</button>
                  </div>
               </div>               
             </div>
             
            <!-- <div class="note">
               (<strong>Note : </strong>Rows corresponding to this number will open up for entry. max 5 past employments.)
            </div> -->
             <div class="containergrid">
               <div class="formcss">
                  <div class="typography form_pad" id="addnoofforms">
                     <div class="clearelement"></div>
                  </div>
               </div>
            </div>
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
            <div class="text-center modal_heading">
               NOTE
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
<div id="sendappp" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body show_shadow">
            <div class="text-center modal_heading">
               <div class="clearelement"></div>
               Are You Sure To Send This Information For Approval?
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary mar_0 sendreq" tempid="">Send</button>
         </div>
      </div>
   </div>
</div>

<!--  ############# User Guide ################## -->
 <div id="modeluserguide" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            <!--<div class="modal-header">
                <h4 class="modal-title">
                </h4>
            </div>-->
            <div class="modal-body" id="modalcontent" style="float:none;">

                
            </div>
            <!--<div class="modal-footer">
            </div>-->
        </div>
    </div>
</div>
<!--  ############# User Guide ################## -->
<!-- ########################################## PageContent End ########################################## -->