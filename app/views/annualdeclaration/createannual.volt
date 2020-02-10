<?php
   $uid = trim($this->session->loginauthspuserfront['id']);
   $user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
   $gtselctedcmp = $this->session->cmpconmemberdoc;
   $condeptsess = $this->session->contractdepartment;
   $userlevel = $this->annualdeclarationcommon->FetchUserLevel($uid);
   $personaldetail = $this->annualdeclarationcommon->FetchPersonalDetail($uid);
   $empdetail = $this->annualdeclarationcommon->FetchEmpDetail($uid);
   $dematdetail = $this->annualdeclarationcommon->FetchDematDetail($uid);
   $mfrdetail = $this->annualdeclarationcommon->FetchMfrDetail($uid);
   $reldetail = $this->annualdeclarationcommon->FetchRelativeDetail($uid);
   $relDematdetail = $this->annualdeclarationcommon->FetchRelDematDetail($uid);
   //echo "company is ";print_r($uniqueid);exit;
   ?>
<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
<!-- My messages -->
<div class="mainelementfom">
   <div>

      <h1 class="h1_heading text-center">Annual Declaration Form
      </h1>
   </div>
    <?php if($userlevel['role_id']<5){ ?> 
    <div class="containergrid">
      <div class="formcss">
          <div id="belowleveluserdet">
         <h1 class="h1_heading" style="font-weight: normal;">A.Details Of Self</h1>
         <h2 class="text-center">i.Personal Details</h2>
        <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" class="table table-responsive table-inverse" width="100%">
            <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Email ID</th>
                <th>PAN</th>
                <th>Other Identification no.</th>
                <th>Nature of Identification no.</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Educational Qualification</th>
                <th>Institute from which qualification was acquired</th>
                <th>Residential Address</th>
                <th>Mobile no.</th>
                <th>No. of shares</th>
                <th>No. of ADRs</th>
            </tr>
            </thead>
            <tbody>
            <tr>
             <?php if(!empty($userlevel)){ ?> 
                 <td><?php echo $userlevel['employeecode'];?></td>
                 <td><?php echo $personaldetail['name'];?></td>
                 <td><?php echo $userlevel['email'];?></td>
                 <td><?php echo $personaldetail['pan'];?></td>
                 <td><?php echo $personaldetail['legal_identifier'];?></td>
                 <td><?php echo $personaldetail['legal_identification_no'];?></td>
                 <td><?php echo $personaldetail['dob'];?></td>
                 <td><?php echo $personaldetail['sex'];?></td>
                 <td><?php echo $personaldetail['education'];?></td>
                 <td><?php echo $personaldetail['institute'];?></td>
                 <td><?php echo $personaldetail['address'];?></td>
                 <td><?php echo $personaldetail['mobileno'];?></td>
                 <td><?php echo $personaldetail['sharehldng'];?></td>
                 <td><?php echo $personaldetail['adrshldng'];?></td>
               <?php } else{?>
                <td colspan ="14">No Data Found..</td>
               <?php  } ?>
             
            </tr>
            </tbody>
        </table>
          
          
          <h2 class="text-center">ii.Past Employer Details</h2>
        <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" class="table table-responsive table-inverse" width="100%">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Name of Employer</th>
                <th>Designation Served</th>
                <th>Start Date of Employment</th>
                <th>End Date of Employment</th>
            </tr>
            </thead>
            <tbody>
            
                
             <?php if(!empty($empdetail)){ for($i=0;$i<sizeof($empdetail);$i++){ $j = $i;$j++;?>
                <tr>
                 <td><?php echo $j;?></td>
                 <td><?php echo $empdetail[$i]['emp_name'];?></td>
                 <td><?php echo $empdetail[$i]['emp_desigtn'];?></td>
                 <td><?php echo $empdetail[$i]['startdate'];?></td>
                 <td><?php echo $empdetail[$i]['enddate'];?></td>
                    </tr>
               <?php } } else { ?>
                <tr>
                <td colspan ="14">No Data Found..</td>
                </tr>
               <?php  } ?>
            </tbody>
        </table>
          
        <h2 class="text-center">iii.Material Financial Relationship</h2>
        <table border="1" style="border-collapse: collapse; border: 1px solid #ccc"  class="table table-responsive table-inverse" width="100%">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Name of Related Party</th>
                <th>PAN / or any other Identification no. available</th>
                <th>Nature of Relationship</th>
                <th>Address of Related Party</th>
            </tr>
            </thead>
            <tbody>
            
             <?php if(!empty($mfrdetail)){ for($i=0;$i<sizeof($mfrdetail);$i++){ $j = $i;$j++; ?> 
                <tr>
                 <td><?php echo $j;?></td>
                 <td><?php echo $mfrdetail[$i]['related_party'];?></td>
                 <td><?php echo $mfrdetail[$i]['pan'];?></td>
                 <td><?php echo $mfrdetail[$i]['relationship'];?></td>
                 <td><?php echo $mfrdetail[$i]['address'];?></td>
                </tr>
               <?php }} else  { ?>
                <tr>
                <td colspan ="14">No Data Found..</td>
                </tr>
               <?php  } ?>
            </tbody>
        </table>
          
           <h2 class="text-center">iv.Demat Account Details</h2>
        <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" class="table table-responsive table-inverse" width="100%">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Demat Account No.</th>
                <th>Name of Depository Participant</th>
            </tr>
            </thead>
            <tbody>
            
             <?php if(!empty($dematdetail)){ for($i=0;$i<sizeof($dematdetail);$i++){ $j = $i;$j++; ?> 
                <tr>
                 <td><?php echo $j;?></td>
                 <td><?php echo $dematdetail[$i]['accountno'];?></td>
                 <td><?php echo $dematdetail[$i]['depository_participient'];?></td>
                </tr>
               <?php } } else { ?>
                <tr>
                <td colspan ="14">No Data Found..</td>
                </tr>
               <?php  } ?>
            </tbody>
        </table>
          <div><br></div>
          
          <h1 class="h1_heading" style="font-weight: normal;">B.Details of Relatives</h1>
          
                  <h2 class="text-center">i.List of Relatives</h2>
        <table border="1"  style="border-collapse: collapse; border: 1px solid #ccc" class="table table-responsive table-inverse" width="100%">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Name of Relative</th>
                <th>Relationship with Relative</th>
                <th>Type of Dependency</th>
                <th>PAN of Relative</th>
                <th>Other Identification no.</th>
                <th>Nature of Identification no.</th>
                <th>Aadhar of Relative</th>
                <th>Date of Birth of Relative</th>
                <th>Residential Address</th>
                <th>Qualification</th>
                <th>Institute / University from which Qualification Acquired</th>
                <th>No. of Shares</th>
                <th>No. of ADRs</th>
            </tr>
            </thead>
            <tbody>
            
             <?php if(!empty($reldetail)){ for($i=0;$i<sizeof($reldetail);$i++){ $j = $i;$j++; $deptype = '';?> 
                <tr>
                 <td><?php echo $j;?></td>
                 <td><?php echo $reldetail[$i]['name'];?></td>
                 <td><?php echo $reldetail[$i]['relationshipname'];?></td>
                 <?php if(!empty($reldetail[$i]['dependency_nature'])) { $deptype = implode(',',$reldetail[$i]['dependency_nature']); } ?>
                 <td><?php echo $deptype;?></td>
                 <td><?php echo $reldetail[$i]['pan'];?></td>
                 <td><?php echo $reldetail[$i]['legal_identifier'];?></td>
                 <td><?php echo $reldetail[$i]['legal_identification_no'];?></td>
                 <td><?php echo $reldetail[$i]['aadhar'];?></td>
                 <td><?php echo $reldetail[$i]['dob'];?></td>
                 <td><?php echo $reldetail[$i]['address'];?></td>
                 <td><?php echo $reldetail[$i]['education'];?></td>
                 <td><?php echo $reldetail[$i]['education'];?></td>
                 <td><?php echo $reldetail[$i]['sharehldng'];?></td>
                 <td><?php echo $reldetail[$i]['adrshldng'];?></td>
                </tr>
               <?php } } else { ?>
                <tr>
                <td colspan ="14">No Data Found..</td>
                </tr>
               <?php  } ?>
            </tbody>
        </table>
          
                     <h2 class="text-center">ii.Demat Account Details</h2>
        <table border="1" style="border-collapse: collapse; border: 1px solid #ccc"  class="table table-responsive table-inverse" width="100%">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Demat Account No.</th>
                <th>Name of Depository Participant</th>
            </tr>
            </thead>
            <tbody>
            
             <?php if(!empty($relDematdetail)){ for($i=0;$i<sizeof($relDematdetail);$i++){ $j = $i;$j++; ?> 
                <tr>
                 <td><?php echo $j;?></td>
                 <td><?php echo $relDematdetail[$i]['accountno'];?></td>
                 <td><?php echo $relDematdetail[$i]['depository_participient'];?></td>
                </tr>
               <?php } } else { ?>
                <tr>
                <td colspan ="14">No Data Found..</td>
                </tr>
               <?php  } ?>
            </tbody>
        </table>
          </div>
          <div class="col-md-12 text-right" style="margin-top: 20px;"> 
                  <button type="submit" class="btn btn-primary " id="submituserdata">Submit</button>
            </div>
        </div>
    </div>
    
    <?php } else { ?>
   <div class="containergrid">
      <div class="formcss">
         <div class="typography form_pad">
             
             
              
            <form action="annualdeclaration/insertannual" id="insertannual" method="post" autocomplete="off">
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 0px">1.</td>
                     <td colspan="4">
                        <div class="">
                           <label >Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company? (please mention names)*</label>
                           <input type="radio" id= "showsec1" name="showsec1" value="Yes"  onclick="showsection(this.id)">Yes
                           <input type="radio" id= "hidesec1" name="showsec1" value="No" onclick="hidesection(this.id)">No
                        </div>
                     </td>
                  </tr>
                  <table border="1" style="border-collapse: collapse; border: 1px solid #ccc; display: none;" width="100%"  id="test">
                  <tr >
                     <td style="border-right: 1px solid #f7f7f7; width: 2.5%;"></td>
                     <td style="width: 22%;"><label class="control-label">Company Name</label></td>
                     <td><label class="control-label">Can you significantly influence the decision making of this company?</label></td>
                     <td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label></td>
                  </tr>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7"></td>
                     <td>
                        <div id = "div1" class="" >
                           <section class="">
                              <div class="input">
                                 <input type="text" class="form-control inputbox3" id="d1ques1" name="d1ques1[]" style="" >
                              </div>
                           </section>
                        </div>
                     </td>
                     <td>
                        <section class="">
                           <select id="d1ques2" name="d1ques2[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" >
                              <option value="">Select Option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </section>
                     </td>
                     <td>
                        <section class="">
                           <select id="d1ques3" name="d1ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" >
                              <option value="">Select Option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </section>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="4" >
                        <div class = "appenddiv1 " id="appenddiv1">
                        </div>
                        <div class="adddiv1section1 col-md-12" style="text-align: right; padding: 10px 0;
">
                           <input type="button" id = "adddiv1" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                           <input type="button" id = "remvdiv1" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                           <input type="hidden" class="appendd1" plancntr="1">
                        </div>
                     </td>
                  </tr>
                </table>


               </table>
               <!-- table 1 end -->
               <!-- table 2 start -->
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold; padding-right: 5px">2.</td>
                     <td colspan="4">
                        <div class="" >
                           <label >Are you Interested in ?</label>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="5">
                        <div class="col-md-12">
                           <label style="padding-left: 17px;">i. Firm </label>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; width: 2.5%;"></td>
                     <td style="width: 22%">  <label class="control-label">Firm Name</label></td>
                     <td style="width: 16%">  <label class="control-label">Nature of Interest</label></td>
                     <td>    <label class="control-label">Can you significantly influence the decision making of this firm?</label></td>
                     <td>
                        <label class="control-label">Do this firm have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
                     </td>
                  </tr>

                  <tr>
                     <td style="border-right: 1px solid #f7f7f7"></td>
                     <td>
                        <div class="input">
                           <input type="text" class="form-control inputbox4" id="d2ques1" name="d2ques1[]" >
                        </div>
                     </td>
                     <td>
                        <div class="input">
                           <input type="text" class="form-control inputbox4" id="d2ques2" name="d2ques2[]" value="Partner" readonly="readonly">
                        </div>
                     </td>
                     <td>
                        <div class="input">
                           <select id="d2ques3" name="d2ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
                              <option value="">Select Option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="input">
                           <select id="d2ques4" name="d2ques4[]" class="form_fields form-control col-md-7 col-xs-12">
                              <option value="">Select Option</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </div>
                     </td>
                  <tr>
                     <td colspan="5" style="">
                        <div class = "appenddiv2" id="appenddiv2">
                        </div>
                        <div class="adddiv2section1 col-md-12"  style="padding-bottom: 10px; text-align: right;">
                           <input type="button" id ="adddiv2" class="btn btn-primary "  value="+" onclick="addhtml(this.id);">
                           <input type="button" id = "remvdiv2" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                           <input type="hidden" class="appendd2" plancntr="1">
                        </div>
                     </td>
                  </tr>
                  </tr>
               </table>
               <!-- table 2 end -->
               <!-- table 3 start-->
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
                  <tr>
                     <td colspan="6">
                        <div class="">
                           <label style="padding-left: 27px;">ii. Private/Public Company</label>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>
                     <td style="width: 22%"><label class="control-label">Company Name.(Please mention full and correct name of the entity clearly specifying if it is a private company or not)</label></td>
                     <td style="width: 16%"><label class="control-label">Nature of Interest</label></td>
                     <td ><label class="control-label">No. of Shares held</label></td>
                     <td><label class="control-label">Can you significantly influence the decision making of this company?</label></td>
                     <td>
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
                     </td>
                  </tr>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7"></td>
                     <td>
                        <div class="input">
                           <input type="text" class="form-control inputbox4" id="d3ques1" name="d3ques1[]" >
                         </div>
                     </td>
                     <td> 
                     <div class="input">
                    <select class="form-control inputbox4" id="d3ques2" name="d3ques2[]" >
                       <option value="">Select Option</option>
                       <option value="1">Member</option>
                       <option value="2">Director</option>
                       <option value="3">Member And Director</option>
                    </select>
                     </div>
                     </td>
                      <td><input type="text" class="form-control inputbox4" id="d3ques5" name="d3ques5[]" ></td>
                     <td>
                     <div class="input">
                     <select id="d3ques3" name="d3ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
                     <option value="">Select Option</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                     </select>
                     </div></td>
                     <td> 
                     <div class="input">
                     <select id="d3ques4" name="d3ques4[]" class="form_fields form-control col-md-7 col-xs-12">
                     <option value="">Select Option</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                     </select>
                     </div>
                     </td>
                  <tr>
                  <td colspan="6" >
                  <div class = "appenddiv3 " id="appenddiv3" ></div>
                  <div class="adddiv3section1 col-md-12"  style="text-align: right;">
                  <input type="button" id = "adddiv3" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv3" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd3" plancntr="1">
                  </div>
                  </td>
                  </tr>
                  </tr>
               </table>
               <!-- table 3 end-->
               <!-- table 5 start-->
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
               <tr>
               <td colspan="5">
               <div class="">
               <label style="padding-left: 27px;">iii. In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives)</label>
               </div>
               </td>
               </tr>
               <tr>
                <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>  
               <td style="width: 22%">  <label class="control-label">Company Name</label></td>
               <td style="width: 16%">  <label class="control-label">Percentage of Shares alongwith relative(%)</label></td>
               <td>    <label class="control-label">Can you significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>
               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d4ques1" name="d4ques1[]" >
                   </div>
               </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d4ques2" name="d4ques2[]" value="holding above 2% shares" readonly="readonly">
               </div>
               </td>
               <td>
               <div class="input">
               <select id="d4ques3" name="d4ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <td> 
               <div class="input">
               <select id="d4ques4" name="d4ques4[]" class="form_fields form-control col-md-7 col-xs-12">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <tr>
               <td colspan="5" style="">
               <div class = "appenddiv4 " id="appenddiv4"></div>
               <div class="adddiv4section1 col-md-12"  style="padding-bottom: 10px; text-align: right;">
               <input type="button" id ="adddiv4" class="btn btn-primary" value="+" onclick="addhtml(this.id);">
               <input type="button" id = "remvdiv4" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
               <input type="hidden" class="appendd4" plancntr="1">
               </div>
               </td>
               </tr>
               </table>
               <!-- table 5 end-->
          
                <!-- table 6 start-->
                <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
                <tr>
                <td colspan="6">
                <div class="">
               <label style="padding-left: 27px;">iv. Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company?</label>
                <input type="radio" id = "showsec3" name = "showsec3" value="Yes" onclick="showsection(this.id);"> Yes
               <input type="radio"  id = "hidesec3" name="showsec3"   value="No"  onclick="hidesection(this.id)">No
               </div>
                </td>
                </tr>
                </table>
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc; display: none;" width="100%" id="test2">
               
               <tr>
                <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>  
               <td style="width: 22%">  <label class="control-label">Company Name</label></td>
               <td style="width: 16%">  <label class="control-label">Can you significantly influence the decision making of this company?</label></td>
               <td>    <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label></td>
               </tr>
               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d8ques1" name="d8ques1[]" >
                   </div>
               </td>
               <td>
               <div class="input">
               <select id="d8ques2" name="d8ques2[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <td> 
               <div class="input">
               <select id="d8ques3" name="d8ques3[]" class="form_fields form-control col-md-7 col-xs-12">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <tr>
               <td colspan="5" style="">
               <div class = "appenddiv8 " id="appenddiv8"></div>
               <div class="adddiv8section1 col-md-12"  style="padding-bottom: 10px; text-align: right;">
               <input type="button" id ="adddiv8" class="btn btn-primary" value="+" onclick="addhtml(this.id);">
               <input type="button" id = "remvdiv8" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
               <input type="hidden" class="appendd8" plancntr="1">
               </div>
               </td>
               </tr>
               </table>
               <!-- table 6 end-->


               <!-- Section 2 start-->

               <!-- table 5 start-->
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
               <tr>
               <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 0px">3.</td>
               <td colspan="4">
               <div class="">
               <label >Are any of your relatives holding controlling interest i.e. 20% or more of the paid up share capital in any company</label>
               <input type="radio" id = "showsec2" name = "showsec2" value="Yes" onclick="showsection(this.id);"> Yes
               <input type="radio"  id = "hidesec2" name="showsec2"   value="No"  onclick="hidesection(this.id)">No 
               </div>
               </td>
               </tr>
                
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc;display: none;" width="100%"  id="test1">
               <tr>
                  <td style="border-right: 1px solid #f7f7f7;width: 2.4%;"></td>
               <td style="width: 20%">  <label class="control-label">Relative Name</label></td>
               <td style="width: 22%"><label class="control-label">Company Name</label></td>
               <td>    <label class="control-label">Can this relative significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>

               <tr>
                  <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 

               <div class="input">

               <select id="d5ques1" name="d5ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
               <option value="">Select Option</option>
               <?php for($i=0;$i < count($relativesinfo); $i++){?>
              
               <option value="<?php echo $relativesinfo[$i]['id'] ?>"><?php echo $relativesinfo[$i]['name'] ?></option>
               <?php } ?>
               
               </select>
               </div>
               </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d5ques2" name="d5ques2[]" >
               </div>
               </td>
               <td>
               <div class="input">
               <select id="d5ques3" name="d5ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div></td>
               <td> 
               <div class="input">
               <select id="d5ques4" name="d5ques4[]" class="form_fields form-control col-md-7 col-xs-12">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <tr>
               <td colspan="5" >
               <div class = "appenddiv5 " id="appenddiv5"></div>
               <div class="adddiv5section2" style="float: right;">
               <input type="button" id = "adddiv5" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
               <input type="button" id= "remvdiv5" class="btn btn-primary remvdiv5" value="-" onclick="removehtml(this.id);">
               <input type="hidden" class="appendd5" plancntr="1">
               </div>
               </td>
               </tr>
               </tr>
            </table>
               </table>
               <!-- table 5 end -->

               <!-- table 6 start --> 
                <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
               <tr>
               <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 6px">4.</td>
               <td colspan="6">
               <div class="">
               <label >Are you Interested in ?</label>
              
               </div>
               </td>
               </tr>

               <tr>
               <td colspan="6">
               <div class="col-md-12">
               <label style="padding-left: 20px;">i. Firm</label>
               </div>
               </td>
               </tr>

               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>   
               <td style="width: 20%">  <label class="control-label">Relative Name</label></td>
               <td style="width: 20%"><label class="control-label">Firm Name</label></td>
               <td style="width: 15%"><label class="control-label">Nature of interest</label></td>
               <td> <label class="control-label">Can this relative significantly influence the decision making of this firm?</label></td>
               <td>
               <label class="control-label">Do this firm have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>

               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>   
               <td> 
               <div class="input">
               <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
                   <option value="">Select Option</option>
              <?php for($i=0;$i < count($relativesinfo); $i++){?>
              
               <option value="<?php echo $relativesinfo[$i]['id'] ?>"><?php echo $relativesinfo[$i]['name'] ?></option>
               <?php } ?>
               
               </select>
               </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d6ques2" name="d6ques2[]" >
               </div>
               </td>

               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d6ques3" name="d6ques3[]" value="Partner" readonly="readonly">
               </div>
               </td>

               <td>
               <div class="input">
               <select id="d6ques4" name="d6ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div></td>
               <td> 
               <div class="input">
               <select id="d6ques5" name="d6ques5[]" class="form_fields form-control col-md-7 col-xs-12">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <tr>
               <td colspan="6" >
               <div class = "appenddiv6 " id="appenddiv6"></div>
               <div class="adddiv6section2" style="float: right;">
               <input type="button" id ="adddiv6" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
               <input type="button" id= "remvdiv6" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
               <input type="hidden" class="appendd6" plancntr="1">
               </div>
               </td>
               </tr>
               </tr>
               </table>

              <!-- table 6 end -->
              
            
            <!-- table 7  start -->
             <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
              

               <tr>
               <td colspan="7">
               <div class="">
              <label  style="padding-left: 27px;" class="">ii. In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives)</label>
               </div>
               </td>
               </tr>

               <tr>
               <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>   
               <td style="width: 20%">  <label class="control-label">Relative Name</label></td>
               <td style="width: 20%"><label class="control-label">Company Name</label></td>
               <td style="width: 15%"><label class="control-label">Nature of interest</label></td>
                <td ><label class="control-label">No. of Shares held</label></td>
               <td> <label class="control-label">Can this relative significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>

               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 
               <div class="input">
               <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
                    <option value="">Select Option</option>
              <?php for($i=0;$i < count($relativesinfo); $i++){?>
             
               <option value="<?php echo $relativesinfo[$i]['id'] ?>"><?php echo $relativesinfo[$i]['name'] ?></option>
               <?php } ?>
               
               </select>
               </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d7ques2" name="d7ques2[]" >
               </div>
               </td>

                <td> 
                     <div class="input">
                    <select class="form-control inputbox4" id="d7ques6" name="d7ques6[]" >
                       <option value="">Select Option</option>
                       <option value="1">Member</option>
                       <option value="2">Director</option>
                       <option value="3">Member And Director</option>
                    </select>
                     </div>
                </td>
                   <td><input type="text" class="form-control inputbox4" id="d7ques5" name="d7ques5[]" ></td>
               <td>
               <div class="input">
               <select id="d7ques3" name="d7ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div></td>
               <td> 
               <div class="input">
               <select id="d7ques4" name="d7ques4[]" class="form_fields form-control col-md-7 col-xs-12">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <tr>
               <td colspan="7" >
                <div class = "appenddiv7 " id="appenddiv7"></div>
               <div class="adddiv7section2"  style="float: right;">
               <input type="button" id = "adddiv7" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
               <input type="button" id = "remvdiv7" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
               <input type="hidden" class="appendd7" plancntr="1">
               </div>
               </td>
               </tr>
               </tr>
               </table>
    
                <!-- table 8 start-->
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
               <tr>
                   <td colspan="6">
                   <div class="">
                   <label style="padding-left: 27px;">iii. In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives)</label>
                   </div>
                   </td>
               </tr>
               <tr>
                   <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>  
                   <td style="width: 22%">  <label class="control-label">Relative Name</label></td>
                   <td style="width: 22%">  <label class="control-label">Company Name</label></td>
                   <td style="width: 16%">  <label class="control-label">Percentage of Shares alongwith relative(%)</label></td>
                   <td>    <label class="control-label">Can you significantly influence the decision making of this company?</label></td>
                   <td>
                   <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
                   </td>
               </tr>
               <tr>
                   <td style="border-right: 1px solid #f7f7f7"></td>
                    <td> 
                   <div class="input">
                   <select id="d9ques1" name="d9ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
                       <option value="">Select Option</option>
                  <?php for($i=0;$i < count($relativesinfo); $i++){?>

                   <option value="<?php echo $relativesinfo[$i]['id'] ?>"><?php echo $relativesinfo[$i]['name'] ?></option>
                   <?php } ?>

                   </select>
                    </div>
                   </td>
                   <td> 
                   <div class="input">
                   <input type="text" class="form-control inputbox4" id="d9ques2" name="d9ques2[]" >
                       </div>
                   </td>
                   <td> 
                   <div class="input">
                   <input type="text" class="form-control inputbox4" id="d9ques3" name="d9ques3[]" value="holding above 2% shares" readonly="readonly">
                   </div>
                   </td>
                   <td>
                   <div class="input">
                   <select id="d9ques4" name="d9ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
                   <option value="">Select Option</option>
                   <option value="Yes">Yes</option>
                   <option value="No">No</option>
                   </select>
                   </div>
                   </td>
                   <td> 
                   <div class="input">
                   <select id="d9ques5" name="d9ques5[]" class="form_fields form-control col-md-7 col-xs-12">
                   <option value="">Select Option</option>
                   <option value="Yes">Yes</option>
                   <option value="No">No</option>
                   </select>
                   </div>
                   </td>
               </tr>
               <tr>
                   <td colspan="6" style="">
                   <div class = "appenddiv9 " id="appenddiv9"></div>
                   <div class="adddiv9section1 col-md-12"  style="padding-bottom: 10px; text-align: right;">
                   <input type="button" id ="adddiv9" class="btn btn-primary" value="+" onclick="addhtml(this.id);">
                   <input type="button" id = "remvdiv9" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                   <input type="hidden" class="appendd9" plancntr="1">
                   </div>
                   </td>
               </tr>
               </table>
               <!-- table 8 end-->
                <!-- table 9 start-->
                <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
                <tr>
                <td colspan="6">
                    <div class="">
                    <label style="padding-left: 27px;">iv. Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company?</label>
                    <input type="radio" id = "showsec4" name = "showsec4" value="Yes" onclick="showsection(this.id);"> Yes
                   <input type="radio"  id = "hidesec4" name="showsec4"   value="No"  onclick="hidesection(this.id)">No
                   </div>
                </td>
                </tr>
                </table>
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc; display: none;" width="100%" id="test3">
               
               <tr>
                <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>
                <td style="width: 20%">  <label class="control-label">Relative Name</label></td>
               <td style="width: 22%">  <label class="control-label">Company Name</label></td>
               <td style="width: 16%">  <label class="control-label">Can you significantly influence the decision making of this company?</label></td>
               <td>    <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label></td>
               </tr>
               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>
                <td> 
                   <div class="input">
                   <select id="d10ques1" name="d10ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
                       <option value="">Select Option</option>
                  <?php for($i=0;$i < count($relativesinfo); $i++){?>

                   <option value="<?php echo $relativesinfo[$i]['id'] ?>"><?php echo $relativesinfo[$i]['name'] ?></option>
                   <?php } ?>

                   </select>
                    </div>
                </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d10ques2" name="d10ques2[]" >
                   </div>
               </td>
               <td>
               <div class="input">
               <select id="d10ques3" name="d10ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <td> 
               <div class="input">
               <select id="d10ques4" name="d10ques4[]" class="form_fields form-control col-md-7 col-xs-12">
               <option value="">Select Option</option>
               <option value="Yes">Yes</option>
               <option value="No">No</option>
               </select>
               </div>
               </td>
               <tr>
               <td colspan="5" style="">
               <div class = "appenddiv10 " id="appenddiv10"></div>
               <div class="adddiv10section1 col-md-12"  style="padding-bottom: 10px; text-align: right;">
               <input type="button" id ="adddiv10" class="btn btn-primary" value="+" onclick="addhtml(this.id);">
               <input type="button" id = "remvdiv10" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
               <input type="hidden" class="appendd10" plancntr="1">
               </div>
               </td>
               </tr>
                   </div>
               </table>
               <!-- table 9 end-->
                <div class="col-md-12 text-right" style="margin-top: 20px;"> 
                  <button type="submit" class="btn btn-primary ">Submit</button>
               </div>
            </form>     
            


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
<?php } ?>
<!-- ########################################## PageContent End ########################################## --> 
<div id="Mymodaldeclara" class="modal  fade" role="dialog" style="overflow-y: auto;left:-22%; ">
   <div class="modal-dialog">
      <div class="modal-content" style="width:950px;">
         <div class="modal-header">
             <?php 
                $current_year = date('Y'); 
                $earliest_year = 2025; 
                $latest_year = 2020; ?>
                <select id="annualyear" name="annualyear">
               <?php foreach ( range( $latest_year, $earliest_year ) as $i ) {?>
                <option value="<?php echo $i; ?>"
                <?php  if($i == $current_year){ ?> selected="selected" <?php } ?> ><?php echo $i;?></option>
                <?php } ?>
             ?> 
            </select>

          
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div id="downloadpdf" style="float: right;"></div>
            <div class="in_box">
               <button type="button" class="btn btn-primary formpdf floatright">Generate PDF</button>
               <input type="text" id = "uniqueid" name="uniqueid" value = "" style="display: none;">
            </div>
            <div class="modalform">

               <!---------------------------------INITIAL DECLARATION FORM--------------------------------------------------->
               <!----------------------------------------------------------------------------------------------------------->
            </div>
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
            <h5 style="text-align: center;">Are You Sure To Delete This Request?</h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="deletereq" tempid="">Delete</button> 
         </div>
      </div>
   </div>
</div>
