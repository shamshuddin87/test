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
   
  <h1 class="h1_heading text-center" style="text-align: center;">Annual Declaration</h1>
    <div class="note">
      <b>Note:</b>
       <span style="display: inline-block;padding: 5px 2px;">Annual declaration is to be filed once every year before 15th of April.</span>
   </div>
  <div class="create_button">
   <!--<a href="annualdeclaration/createannual"> <button type="button" class="btn btn-primary getdata">Create Declaration</button></a>-->
   <button type="button" class="btn btn-primary getdata" id="create_declaration">Create Declaration</button>
   </div>

   
  <table width="100%" border="1" class="table table-inverse" id="datableabhi">
 <thead>
  <tr>
    <th>Srno</th> 
    <th>Creation date</th>  
    <th>Send to Compliance Officer</th>
    <th>Annual Declaration Year</th>
    <th>Sent Date</th>      
    <th>Action</th>                                           
    </tr>
 </thead>
<tbody class="allpdf" appendrow='1'></tbody>
</table>
</div>


  
        


    <div id="sendmod" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
            <input type="hidden" id="reqid" value="" name="">
            <h5 style="text-align: center;">Are You Sure To Send This Request?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="sendreq" tempid="">Send</button> 
            </div>
        </div>
    </div>
</div>    
        
    <div id="updpersndetails" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
               <h5 style="text-align: center;">Please update your Nationality by going to the  'Personal Information' section in the tool</h5> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="gotopersndet" tempid="">Ok</button> 
            </div>
        </div>
    </div>
</div>    
        
<div class="clearelement"></div>
<div class="preloder_wraper">
    <a href="javascript:;" class="preloder"></a>
</div>
<div class="clearelement"></div>
</div>
</div>
</div>


<!---------------------------------------MODAL BOX-------------------------------------->



<!---------------------------------------Annual Declaration Form MODAL----------------------->
<div id="annualdeclarationform" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content" style="width: 900px">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Annual Declaration Form</h4>
         </div>
         <div class="modal-body show_shadow">
            <form action="annualdeclaration/insertannual" id="insertannual" method="post" autocomplete="off">
               <div class="col-md-12" style="padding-bottom: 20px;">
               
                  <label >Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company? (please mention names)*</label>
                  <select id="section1" name="section1" class="form_fields form-control col-md-7 col-xs-12" required="">
                     <option value="1">Yes</option>
                     <option value="0">No</option>
                  </select>
               </div>
               <div id = "div1" class="col-md-12" style="padding-bottom: 20px;">
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control" id="d1ques1" name="d1ques1[]" style="margin-top: 40px;" required="required">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d1ques2" name="d1ques2[]" class="form_fields form-control col-md-7 col-xs-12" required="required" style="margin-top: 20px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-6 col-xs-6">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d1ques3" name="d1ques3[]" class="form_fields form-control col-md-7 col-xs-12" required="required">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv1 " id="appenddiv1"></div>
               <div class="adddiv1section1">
                  <input type="button" id = "adddiv1" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv1" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd1" plancntr="1">
               </div>
               <div class="col-md-12" style="padding-bottom: 10px;">
                  <label >Are you Interested in ?</label>
               </div>
               <div id = "div2" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">i.Firm</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Firm Name</label>
                        <input type="text" class="form-control" id="d2ques1" name="d2ques1[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control" id="d2ques3" name="d2ques3[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d2ques3" name="d2ques3[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:40px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d2ques4" name="d2ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv2" id="appenddiv2"></div>
               <div class="adddiv2section1"  style="padding-bottom: 10px;">
                  <input type="button" id ="adddiv2" class="btn btn-primary "  value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv2" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd2" plancntr="1">
               </div>
               <div id = "div3" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">ii.Private/Public Company</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control" id="d3ques1" name="d3ques1[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control" id="d3ques2" name="d3ques2[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d3ques3" name="d3ques3[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:40px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d3ques4" name="d3ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv3 " id="appenddiv3"></div>
               <div class="adddiv3section1"  style="padding-bottom: 10px;">
                  <input type="button" id = "adddiv3" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv3" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd3" plancntr="1">
               </div>
               <div id = "div4" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">iii. In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives)</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control" id="d4ques1" name="d4ques1[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control" id="d4ques2" name="d4ques2[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d4ques3" name="d4ques3[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:40px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d4ques4" name="d4ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv4 " id="appenddiv4"></div>
               <div class="adddiv4section1"  style="padding-bottom: 10px;">
                  <input type="button" id ="adddiv4" class="btn btn-primary" value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv4" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd4" plancntr="1">
               </div>

               <!-- Section 2 start-->
               <div class="col-md-12" style="padding-bottom: 20px;">
                  <label >Are any of your relatives holding controlling interest i.e. 20% or more of the paid up share capital in any company</label>
                  <select id="section2" name="section2" class="form_fields form-control col-md-7 col-xs-12" required="">
                     <option value="1">Yes</option>
                     <option value="0">No</option>
                  </select>
               </div>
               <div id = "div5" class="col-md-12" style="padding-bottom: 20px;">
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Relative Name</label>
                       <select id="d5ques1" name="d5ques1[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:60px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control" id="d5ques2" name="d5ques2[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d5ques3" name="d5ques3[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top: 40px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d5ques4" name="d5ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv5 " id="appenddiv5"></div>
               <div class="adddiv5section2">
                  <input type="button" id = "adddiv5" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
               <input type="button" id= "remvdiv5" class="btn btn-primary remvdiv5" value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd5" plancntr="1">
               </div>
               <div class="col-md-12" style="padding-bottom: 10px;">
                  <label >Are you Interested in ?</label>
               </div>
               <div id = "div6" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">i.Firm</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Relative</label>
                        <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:100px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Firm Name</label>
                        <input type="text" class="form-control" id="d6ques2" name="d6ques2[]" style="margin-top: 100px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control" id="d6ques3" name="d6ques3[]" style="margin-top: 100px;">
                     </div>
                  </section>
                  <section class="col col-md-3 col-xs-3">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d6ques4" name="d6ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:60px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-3 col-xs-3">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d6ques5" name="d6ques5[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv6 " id="appenddiv6"></div>
               <div class="adddiv6section2"  style="padding-bottom: 10px;">
                  <input type="button" id ="adddiv6" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id= "remvdiv6" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd6" plancntr="1">
               </div>
               <div id = "div7" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">ii.Private/Public Company</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Relative</label>
                        <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:100px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control" id="d7ques2" name="d7ques2[]" style="margin-top: 100px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control" id="d7ques3" name="d7ques3[]" style="margin-top: 100px;">
                     </div>
                  </section>
                  <section class="col col-md-3 col-xs-3">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d7ques4" name="d7ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="" style="margin-top:60px;">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-3 col-xs-3">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d7ques5" name="d7ques5[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </section>
               </div>
               <div class = "appenddiv7 " id="appenddiv7"></div>
               <div class="adddiv7section2"  style="padding-bottom: 10px;">
                  <input type="button" id = "adddiv7" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv7" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd7" plancntr="1">
               </div>
               <div class="col-md-12"> 
                  <button type="submit" class="btn btn-primary ">Submit</button>
               </div>
            </form>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<!-----------------------------------Annual Declaration Form MODAL End-----------------------> 


<!-- ########################################## PageContent End ########################################## --> 
 





