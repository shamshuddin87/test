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
    <div>  <h1 class="h1_heading text-center"> Update Annual Declaration Form
    
    </h1> 

  
   </div> 
   
       <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <form action="annualdeclaration/updateannual" id="updateannual" method="post" autocomplete="off">
               <div class="col-md-12" style="padding-bottom: 20px;">
                

                  <label >Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company? (please mention names)*</label>
                  <select id="section1" name="section1" class="form_fields form-control col-md-7 col-xs-12" required="">
                     <?php if($selfcompany){?>
                     <option >Select Option</option>
                     <option value="1" selected>Yes</option>
                     <option value="0">No</option>
                     <?php } else { ?>
                     <option>Select Option</option>
                     <option value="1" selected>Yes</option>
                     <option value="0">No</option>
                     <?php } ?>

                  </select>
               </div>
               <?php if($selfcompany){
               for($i=0; $i < count($selfcompany); $i++){
                  ?>
               
               <div id = "div1" class="col-md-12" style="padding-bottom: 20px;">
                  <section class="col col-md-2 col-xs-2 ">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control inputbox3" id="d1ques1" name="d1ques1[]" value="<?php echo $selfcompany[$i]['company']?>" style="margin-top: 20px;" required="required">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d1ques2" name="d1ques2[]" class="form_fields form-control col-md-7 col-xs-12" required="required">
                           <?php if($selfcompany[$i]['decision']  == 1){ ?>
                           <option value="1" selected>Yes</option>
                           <option value="0">No</option>
                        <?php }elseif($selfcompany[$i]['decision']  == 0){ ?>
                           <option value="1" >Yes</option>
                           <option value="0" selected>No</option>
                         <?php } ?>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-6 col-xs-6">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d1ques3" name="d1ques3[]" class="form_fields form-control col-md-7 col-xs-12" required="required">
                           <?php if($selfcompany[$i]['transaction']  == 1){ ?>
                           <option value="1" selected>Yes</option>
                           <option value="0">No</option>
                        <?php }elseif($selfcompany[$i]['transaction']  == 0){ ?>
                           <option value="1" >Yes</option>
                           <option value="0" selected>No</option>
                         <?php } ?>
                        </select>
                     </div>
                  </section>
               </div>
               <?php }} ?>
               
               
               <div class="col-md-12" style="padding-bottom: 10px;">
                  <label >Are you Interested in ?</label>
               </div>

                <?php if($selffirm){
               for($i=0; $i < count($selffirm); $i++){
                  ?>
               <div id = "div2" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">i.Firm</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Firm Name</label>
                        <input type="text" class="form-control inputbox4" value="<?php echo $selffirm[$i]['firm']?>" id="d2ques1" name="d2ques1[]" style="margin-top: 40px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control inputbox4" id="d2ques2" name="d2ques2[]" value="<?php echo $selffirm[$i]['interest']?>" style="margin-top: 40px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d2ques3" name="d2ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="" style="margin-top:20px; ">
                         
                           <?php if($selffirm[$i]['decision']  == 1){ ?>
                           <option value="1" selected>Yes</option>
                           <option value="0">No</option>
                        <?php }elseif($selffirm[$i]['decision']  == 0){ ?>
                           <option value="1" >Yes</option>
                           <option value="0" selected>No</option>
                         <?php } ?>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d2ques4" name="d2ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                          <?php if($selffirm[$i]['transaction']  == 1){ ?>
                           <option value="1" selected>Yes</option>
                           <option value="0">No</option>
                        <?php }elseif($selffirm[$i]['transaction']  == 0){ ?>
                           <option value="1" >Yes</option>
                           <option value="0" selected>No</option>
                         <?php } ?>
                        </select>
                     </div>
                  </section>
               </div>
                <?php }} ?>
               <div class = "appenddiv2" id="appenddiv2"></div>
               <div class="adddiv2section1"  style="padding-bottom: 10px;">
                  <input type="button" id ="adddiv2" class="btn btn-primary "  value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv2" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd2" plancntr="1">
               </div>
               <?php if($selfpublic){
                  for($i=0; $i < count($selfpublic); $i++){
                  ?>
               <div id = "div3" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">ii.Private/Public Company</label>
                  
                  <section class="col col-md-2 col-xs-2">
                  
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control inputbox4" id="d3ques1" name="d3ques1[]" value="<?php echo $selfpublic[$i]['company']?>" >
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control inputbox4" id="d3ques2" name="d3ques2[]" value="<?php echo $selfpublic[$i]['interest']?>" >
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d3ques3" name="d3ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="" style="margin-top:20px;">
                        <?php if($selfpublic[$i]['decision']  == 1){ ?>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                         <?php }elseif($selfpublic[$i]['decision']  == 0){ ?>
                        <option value="1" >Yes</option>
                        <option value="0" selected>No</option>
                        <?php } ?>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d3ques4" name="d3ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                          <?php if($selfpublic[$i]['transaction']  == 1){ ?>
                           <option value="1" selected>Yes</option>
                           <option value="0">No</option>
                        <?php }elseif($selfpublic[$i]['transaction']  == 0){ ?>
                           <option value="1" >Yes</option>
                           <option value="0" selected>No</option>
                         <?php } ?>
                        </select>
                     </div>
                  </section>
                 
                </div>
                  <?php }} ?>
                

               <div class = "appenddiv3 " id="appenddiv3"></div>
               <div class="adddiv3section1"  style="padding-bottom: 10px;">
                  <input type="button" id = "adddiv3" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv3" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd3" plancntr="1">
               </div>

                <?php if($selfpubshare){
                  for($i=0; $i < count($selfpubshare); $i++){
                  ?>
               <div id = "div4" class="col-md-12" style="padding-bottom: 20px;">
                  <label  class="col-md-12">iii. In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives)</label>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control inputbox4" id="d4ques1" name="d4ques1[]"  value="<?php echo $selfpubshare[$i]['company']?>" style="margin-top: 40px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control inputbox4" id="d4ques2" name="d4ques2[]"  value="<?php echo $selfpubshare[$i]['interest']?>"  style="margin-top: 40px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d4ques3" name="d4ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="" style="margin-top:20px;">
                        <?php if($selfpubshare[$i]['decision']  == 1){ ?>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                         <?php }elseif($selfpubshare[$i]['decision']  == 0){ ?>
                        <option value="1" >Yes</option>
                        <option value="0" selected>No</option>
                        <?php } ?>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                        <select id="d4ques4" name="d4ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                           <?php if($selfpubshare[$i]['transaction']  == 1){ ?>
                           <option value="1" selected>Yes</option>
                           <option value="0">No</option>
                        <?php }elseif($selfpubshare[$i]['transaction']  == 0){ ?>
                           <option value="1" >Yes</option>
                           <option value="0" selected>No</option>
                         <?php } ?>
                        </select>
                     </div>
                  </section>
               </div>
                <?php }} ?>
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
                      <?php if($relative){?>
                     <option >Select Option</option>
                     <option value="1" selected>Yes</option>
                     <option value="0">No</option>
                     <?php } else { ?>
                     <option>Select Option</option>
                     <option value="1" selected>Yes</option>
                     <option value="0">No</option>
                     <?php } ?>
                  </select>
               </div>

                <?php if($relative){
               for($i=0; $i < count($relative); $i++){
                  ?>
               <div id = "div5" class="col-md-12" style="padding-bottom: 20px;">
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Relative Name</label>
                       <select id="d5ques1" name="d5ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" required="" style="margin-top:40px;">
                         <?php if($relative){ ?>
                          
                        <option value="1"><?php echo $relative[$i]['relationshipname']?></option>
                        <option value="1">HUF</option>
                        <option value="2">Spouse</option>
                        <option value="3">Father</option>
                        <option value="4">Mother</option>
                        <option value="5">Brother</option>
                        <option value="6">Sister</option>
                        <option value="7">Son</option>
                        <option value="8">Daughter</option>
                        <option value="9">Son's Wife</option>
                        <option value="10">Daughter's Husband</option>
                        <option value="11">Others</option>
                       <?php } else {?>
                        <option value="1">HUF</option>
                        <option value="2">Spouse</option>
                        <option value="3">Father</option>
                        <option value="4">Mother</option>
                        <option value="5">Brother</option>
                        <option value="6">Sister</option>
                        <option value="7">Son</option>
                        <option value="8">Daughter</option>
                        <option value="9">Son's Wife</option>
                        <option value="10">Daughter's Husband</option>
                        <option value="11">Others</option>
                         <?php } ?>
                        </select>
                    
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control inputbox4" id="d5ques2" name="d5ques2[]" style="margin-top: 40px;">
                     </div>
                  </section>
                  <section class="col col-md-4 col-xs-4">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d5ques3" name="d5ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="" style="margin-top: 20px;">
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
             <?php }} ?>
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
                        <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox5" required="" style="margin-top:60px;">
                          <option value="1">HUF</option>
                             <option value="2">Spouse</option>
                            <option value="3">Father</option>
                            <option value="4">Mother</option>
                            <option value="5">Brother</option>
                            <option value="6">Sister</option>
                              <option value="7">Son</option>
                             <option value="8">Daughter</option>
                             <option value="9">Son's Wife</option>
                            <option value="10">Daughter's Husband</option>
                            <option value="11">Others</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Firm Name</label>
                        <input type="text" class="form-control inputbox5" id="d6ques2" name="d6ques2[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control inputbox5" id="d6ques3" name="d6ques3[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-3 col-xs-3">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d6ques4" name="d6ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox5" required="" style="margin-top:40px;">
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
                        <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox5" required="" style="margin-top:60px;">
                          <option value="1">HUF</option>
                          <option value="2">Spouse</option>
                          <option value="3">Father</option>
                          <option value="4">Mother</option>
                          <option value="5">Brother</option>
                          <option value="6">Sister</option>
                           <option value="7">Son</option>
                          <option value="8">Daughter</option>
                          <option value="9">Son's Wife</option>
                          <option value="10">Daughter's Husband</option>
                          <option value="11">Others</option>
                        </select>
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Company Name</label>
                        <input type="text" class="form-control inputbox5" id="d7ques2" name="d7ques2[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-2 col-xs-2">
                     <div class="input">
                        <label class="control-label">Nature of Interest</label>
                        <input type="text" class="form-control inputbox5" id="d7ques3" name="d7ques3[]" style="margin-top: 60px;">
                     </div>
                  </section>
                  <section class="col col-md-3 col-xs-3">
                     <div class="input">
                        <label class="control-label">Can you significantly influence the decision making of this company?</label>
                        <select id="d7ques4" name="d7ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox5" required="" style="margin-top:40px;">
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
            <div class="clearelement"></div>
            </div>
       </div>     
    </div>   

    
   <div class="table-responsive table_wraper tradeplanview">
    <div class="cssnumrws">
       <span>Show</span>
        <select id="noofrows" name="noofrows" class="noofrows">
           <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <span>Entries</span>
    </div>
          <table class="table datatable-responsive" border="1" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>SR.NO.</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>View</th> 
                        </tr>
                    </thead>
                    <tbody class="viewdeclaration">
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



<div id="Mymodaldeclara" class="modal  fade" role="dialog" style="overflow-y: auto;left:-22%; ">
  <div class="modal-dialog">

    <div class="modal-content" style="width:950px;">
      <div class="modal-header">
         <select id="annualyear" name="annualyear">
         <option value="2020">2020</option>
         <option value="2021">2021</option>
         <option value="2022">2022</option>
         <option value="2023">2023</option>
         <option value="2024">2024</option>
         <option value="2025">2025</option>
       </select>
      
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="downloadpdf" style="float: right;"></div>
         <div class="in_box">
           <button type="button" class="btn btn-primary formpdf floatright">Generate PDF</button>
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
            <h5 style="text-align: center;">Are You Sure To Delete This Request?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deletereq" tempid="">Delete</button> 
            </div>
        </div>
    </div>
</div>  
 





