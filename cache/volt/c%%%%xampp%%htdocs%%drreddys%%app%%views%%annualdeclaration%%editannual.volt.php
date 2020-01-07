<?php
   $user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
   $gtselctedcmp = $this->session->cmpconmemberdoc;
   $condeptsess = $this->session->contractdepartment;
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

      <h1 class="h1_heading text-center">Update Annual Declaration Form
      </h1>
   </div>
   <div class="containergrid">
      <div class="formcss">
         <div class="typography form_pad">
            <form action="annualdeclaration/updateannual" id="updateannual" method="post" autocomplete="off">
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 0px">1.</td>
                     <td colspan="4">
                        <div class="">
                           <label >Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company? (please mention names)*</label>

                           
                                 <?php if($selfcompany){?>
                                  <input type="radio"  name="showsec1" value="Yes" checked="checked">Yes
                                 <?php } else { ?>
                                <input type="radio"  name="showsec1" value="No" checked = "checked" onclick="showsection(this.id)">No
                                 <?php } ?>

                             
                          
                           
                        </div>
                     </td>
                  </tr>
                   <?php if($selfcompany){
                  for($i=0; $i < count($selfcompany); $i++){
                  ?>
                  <table border="1" style="border-collapse: collapse; border: 1px solid #ccc; " width="100%"  id="test">
                  <tr >
                     <td style="border-right: 1px solid #f7f7f7; width: 2.5%" ></td>
                     <td style="width: 22%"><label class="control-label">Company Name</label></td>
                     <td><label class="control-label">Can you significantly influence the decision making of this company?</label></td>
                     <td><label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label></td>
                  </tr>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7"></td>
                     <td>
                        <div id = "div1" class="" >
                           <section class="">
                              <div class="input">

                                  <input type="text" class="form-control inputbox3" id="uniqueid" name="uniqueid" value="<?php echo $uniqueid ?>" style= "display: none;">

                                 <input type="text" class="form-control inputbox3" id="d1id" name="d1id[]" value="<?php echo $selfcompany[$i]['id']?>" style= "display: none;">

                           <input type="text" class="form-control inputbox3" id="d1ques1" name="d1ques1[]" value="<?php echo $selfcompany[$i]['company']?>"  required="required">
                              </div>
                           </section>
                        </div>
                     </td>
                     <td>
                        <section class="">
                           <select id="d1ques2" name="d1ques2[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="" >
                               <option value="">Select Option</option>
                              <?php if($selfcompany[$i]['decision']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>
                          <?php }elseif($selfcompany[$i]['decision']  == No){ ?>
                           <option value="Yes" >Yes</option>
                           <option value="No" selected>No</option>
                         <?php } ?>
                           </select>
                        </section>
                     </td>
                     <td>
                        <section class="">
                           <select id="d1ques3" name="d1ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="" >
                              <option value="">Select Option</option>
                               <?php if($selfcompany[$i]['transaction']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>
                        <?php }elseif($selfcompany[$i]['transaction']  == No){ ?>
                           <option value="Yes" >Yes</option>
                           <option value="No" selected>No</option>
                         <?php } ?>
                           </select>
                        </section>
                     </td>
                  </tr>
                  <tr>
                  <?php }} ?>
                     <td colspan="4" >
                        <div class = "appenddiv1 " id="appenddiv1">
                        </div>
                        <div class="adddiv1section1 col-md-12" style="text-align: right;">
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
                     <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 0px">2.</td>
                  
                     <td colspan="5">
                        <div class="" >
                           <label >Are you Interested in ?</label>
                        </div>
                     </td>
                  </tr>
              
                  <tr>

                     <td colspan="5">
                        <div class="">
                           <label style="padding-left: 30px;">i. Firm </label>
                        </div>
                     </td>
                  </tr>
                   <?php if($selffirm){
                for($i=0; $i < count($selffirm); $i++){
                  ?>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>
                     <td><label class="control-label">Firm Name</label></td>
                     <td><label class="control-label">Nature of Interest</label></td>
                     <td><label class="control-label">Can you significantly influence the decision making of this company?</label></td>
                     <td>
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
                     </td>
                  </tr>

                  <tr>
                     <td style="border-right: 1px solid #f7f7f7"></td>
                     <td>
                        <div class="input">
                          <input type="text" class="form-control inputbox3" id="d2id" name="d2id[]" value="<?php echo $selffirm[$i]['id']?>" style= "display: none;">

                        <input type="text" class="form-control inputbox4" value="<?php echo $selffirm[$i]['firm']?>" id="d2ques1" name="d2ques1[]" >
                        </div>
                     </td>
                     <td>
                        <div class="input">
                           <input type="text" class="form-control inputbox4" id="d2ques2" name="d2ques2[]" value="<?php echo $selffirm[$i]['interest']?>">
                        </div>
                     </td>
                     <td>
                        <div class="input">
                           <select id="d2ques3" name="d2ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="">
                              <option value="">Select Option</option>
                             <?php if($selffirm[$i]['decision']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>
                         <?php }elseif($selffirm[$i]['decision']  == No){ ?>
                           <option value="Yes" >Yes</option>
                           <option value="No" selected>No</option>
                         <?php } ?>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="input">
                           <select id="d2ques4" name="d2ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                            <option value="">Select Option</option>
                            <?php if($selffirm[$i]['transaction']  == Yes){ ?>
                            <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>
                           <?php }elseif($selffirm[$i]['transaction']  == No){ ?>
                           <option value="Yes" >Yes</option>
                           <option value="No" selected>No</option>
                           <?php } ?>
                           </select>
                        </div>
                     </td>
                  <tr>
                  <?php }} ?>
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
                     <td colspan="5">
                        <div class="">
                           <label style="padding-left: 30px;">ii. Private/Public Company</label>
                        </div>
                     </td>
                  </tr>
                   <?php if($selfpublic){
                  for($i=0; $i < count($selfpublic); $i++){
                   ?>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7"></td>
                     <td><label class="control-label">Company Name</label></td>
                     <td><label class="control-label">Nature of Interest</label></td>
                     <td><label class="control-label">Can you significantly influence the decision making of this company?</label></td>
                     <td>
                        <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
                     </td>
                  </tr>
                  <tr>
                     <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>
                     <td>
                        <div class="input">
                           <input type="text" class="form-control inputbox3" id="d3id" name="d3id[]" value="<?php echo $selfpublic[$i]['id']?>" style= "display: none;">

                        <input type="text" class="form-control inputbox4" id="d3ques1" name="d3ques1[]" value="<?php echo $selfpublic[$i]['company']?>" >
                     </td>
                     <td> 
                     <div class="input">
                    <input type="text" class="form-control inputbox4" id="d3ques2" name="d3ques2[]" value="<?php echo $selfpublic[$i]['interest']?>" >
                     </div>
                     </td>
                     <td>
                     <div class="input">
                     <select id="d3ques3" name="d3ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="">
                     <option value="">Select Option</option>
                     <?php if($selfpublic[$i]['decision']  == Yes){ ?>
                     <option value="Yes" selected>Yes</option>
                     <option value="No">No</option>
                      <?php }elseif($selfpublic[$i]['decision']  == No){ ?>
                     <option value="Yes" >Yes</option>
                     <option value="No" selected>No</option>
                     <?php } ?>
                     </select>
                     </div></td>
                     <td> 
                     <div class="input">
                     <select id="d3ques4" name="d3ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
                     <option value="">Select Option</option>
                     <?php if($selfpublic[$i]['transaction']  == Yes){ ?>
                     <option value="Yes" selected>Yes</option>
                     <option value="No">No</option>
                     <?php }elseif($selfpublic[$i]['transaction']  == No){ ?>
                     <option value="Yes" >Yes</option>
                     <option value="No" selected>No</option>
                     <?php } ?>
                     </select>
                     </div>
                     </td>
                       
                 
                  </tr>
                   <?php }} ?>
                   <tr>
                  <td colspan="5" >
                  <div class = "appenddiv3 " id="appenddiv3" ></div>
                  <div class="adddiv3section1 col-md-12"  style="text-align: right;">
                  <input type="button" id = "adddiv3" class="btn btn-primary " value="+" onclick="addhtml(this.id);">
                  <input type="button" id = "remvdiv3" class="btn btn-primary " value="-" onclick="removehtml(this.id);">
                  <input type="hidden" class="appendd3" plancntr="1">
                  </div>
                  </td>
                  </tr>
               </table>
             
               <!-- table 3 end-->

               <!-- table 4 start-->
              
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
               <tr>
               <td colspan="5">
               <div class="">
               <label style="padding-left: 30px;">iii. In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives)</label>
               </div>
               </td>
               </tr>
                <?php if($selfpubshare){
               for($i=0; $i < count($selfpubshare); $i++){
               ?>
               <tr>
                <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>  
               <td>  <label class="control-label">Company Name</label></td>
               <td>  <label class="control-label">Nature of Interest</label></td>
               <td>    <label class="control-label">Can you significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>
               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox3" id="d4id" name="d4id[]" value="<?php echo $selfpubshare[$i]['id']?>" style= "display: none;">

               <input type="text" class="form-control inputbox4" id="d4ques1" name="d4ques1[]"  value="<?php echo $selfpubshare[$i]['company']?>" >
               </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d4ques2" name="d4ques2[]"  value="<?php echo $selfpubshare[$i]['interest']?>">
               </div>
               </td>
               <td>
               <div class="input">
               <select id="d4ques3" name="d4ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="">
               <option value="">Select Option</option>
               <?php if($selfpubshare[$i]['decision']  == Yes){ ?>
               <option value="Yes" selected>Yes</option>
               <option value="No">No</option>
               <?php }elseif($selfpubshare[$i]['decision']  == No){ ?>
               <option value="Yes" >Yes</option>
               <option value="No" selected>No</option>
               <?php } ?>
               </select>
               </div>
               </td>
               <td> 
               <div class="input">
               <select id="d4ques4" name="d4ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
               <option value="">Select Option</option>
               <?php if($selfpubshare[$i]['transaction']  == Yes){ ?>
               <option value="Yes" selected>Yes</option>
                <option value="No">No</option>
               <?php }elseif($selfpubshare[$i]['transaction']  == No){ ?>
                <option value="Yes" >Yes</option>
               <option value="No" selected>No</option>
               <?php } ?>
               </select>
               </div>
               </td>
                <?php }} ?>
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

               <!-- table 4 end-->


               <!-- Section 2 start-->

               <!-- table 5 start-->
              
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
               <tr>
               <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 0px">3.</td>
               <td colspan="4">
               <div class="">
               <label > Are any of your relatives holding controlling interest i.e. 20% or more of the paid up share capital in any company</label>
              <?php if($relativecompany){?>
               <input type="radio" id= "showsec1" name="showsec1" value="Yes" checked="checked" onclick="showsection(this.id)">Yes
               <?php } else { ?>
               <input type="radio" id= "hidesec1" name="showsec1" value="No" checked = "checked" onclick="showsection(this.id)">No
               <?php } ?>
               </div>
               </td>
               </tr>
                  <?php 
                if($relativecompany){
               for($i=0; $i < count($relativecompany); $i++){
                ?>
               <table border="1" style="border-collapse: collapse; border: 1px solid #ccc;" width="100%"  id="test1">
               <tr>
                  <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>
               <td>  <label class="control-label">Relative Name</label></td>
               <td><label class="control-label">Company Name</label></td>
               <td>    <label class="control-label">Can this relative significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>

               <tr>
                  <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 

               <div class="input">
               <input type="text" class="form-control inputbox3" id="d5id" name="d5id[]" value="<?php echo $relativecompany[$i]['id']?>" style= "display: none;">

               <select id="d5ques1" name="d5ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
               <option value="">Select Option</option>
               <?php for($j=0; $j < count($relativesinfo); $j++){
                   if($relativecompany[$i]['relative'] == $relativesinfo[$j]['name']){?>
             
               
                     ?>
                  <option value="<?php echo $relativesinfo[$j]['name']?>" selected><?php  echo $relativesinfo[$j]['name']?></option>
                   <?php } else { ?>
                          
                  <option value=<?php echo $relativesinfo[$j]['name']?>><?php  echo $relativesinfo[$j]['name']?></option>
              

               <?php } }?>
               
               </select>

               </td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox4" id="d5ques2" name="d5ques2[]" value="<?php echo $relativecompany[$i]['company']?>">
               </div>
               </td>
               <td>
               <div class="input">
               <select id="d5ques3" name="d5ques3[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="">
               <option value="">Select Option</option>
               <?php if($relativecompany[$i]['decision']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                          <option value="No">No</option>
                          <?php }elseif($relativecompany[$i]['decision']  == No){ ?>
                          <option value="Yes" >Yes</option>
                          <option value="No" selected>No</option>
                          <?php } ?>
               </select>
               </div></td>
               <td> 
               <div class="input">
               <select id="d5ques4" name="d5ques4[]" class="form_fields form-control col-md-7 col-xs-12" required="">
               <option value="">Select Option</option>
               <?php if($relativecompany[$i]['transaction']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>
                           <?php }elseif($relativecompany[$i]['transaction']  == No){ ?>
                           <option value="Yes" >Yes</option>
                           <option value="No" selected>No</option>
                         <?php } ?>
               </select>
               </div>
               </td>
                <?php }} ?>
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
               <td style="border-right: 1px solid #f7f7f7; color: #000; font-weight: bold;  padding-right: 0px">4.</td>
               <td colspan="6">
               <div class="">
               <label > Are you Interested in ?</label>
              
               </div>
               </td>
               </tr>

               <tr>
               <td colspan="6">
               <div class="">
               <label style="padding-left: 30px;" >i. Firm</label>
               </div>
               </td>
               </tr>
               
               <?php if($relativefirm){
               for($i=0; $i < count($relativefirm); $i++){
               ?>
               <tr>
               <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>   
               <td style="width: 20%">  <label class="control-label">Relative Name</label></td>
               <td style="width: 20%"><label class="control-label">Firm Name</label></td>
               <td><label class="control-label">Nature of interest</label></td>
               <td> <label class="control-label">Can this relative significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>

               <tr>
               <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>   
               <td> 
               <div class="input">

               <input type="text" class="form-control inputbox3" id="d6id" name="d6id[]" value="<?php echo $relativefirm[$i]['id']?>" style= "display: none;">

               <select id="d6ques1" name="d6ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
              
               <option value="">Select Option</option>
               <?php for($j=0; $j < count($relativesinfo); $j++){
                   if($relativefirm[$i]['relative'] == $relativesinfo[$j]['name']){?>
             
               
                     ?>
                  <option value="<?php echo $relativesinfo[$j]['name']?>" selected><?php  echo $relativesinfo[$j]['name']?></option>
                   <?php } else { ?>
                          
                  <option value=<?php echo $relativesinfo[$j]['name']?>><?php  echo $relativesinfo[$j]['name']?></option>
              

               <?php } }?>
               
               </select>
               </td>
               <td> 
               <div class="input">
              <input type="text" class="form-control inputbox5" id="d6ques2" name="d6ques2[]" value="<?php echo $relativefirm[$i]['firm']?>" >
               </div>
               </td>

               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox5" id="d6ques3" name="d6ques3[]" value="<?php echo $relativefirm[$i]['interest']?>" >
               </div>
               </td>

               <td>
               <div class="input">
               <select id="d6ques4" name="d6ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="">
               <option value="">Select Option</option>
               <?php if($relativefirm[$i]['decision']  == Yes){ ?>
               <option value="Yes" selected>Yes</option>
               <option value="No">No</option>
               <?php }elseif($relativefirm[$i]['decision']  == No){ ?>
               <option value="Yes" >Yes</option>
               <option value="No" selected>No</option>
               <?php } ?>
               </select>
               </div></td>
               <td> 
               <div class="input">
               <select id="d6ques5" name="d6ques5[]" class="form_fields form-control col-md-7 col-xs-12" required="">
               <option value="">Select Option</option>
               <?php if($relativefirm[$i]['transaction']  == Yes){ ?>
               <option value="Yes" selected>Yes</option>
               <option value="No">No</option>
               <?php }elseif($relativefirm[$i]['transaction']  == No){ ?>
                <option value="Yes" >Yes</option>
               <option value="No" selected>No</option>
               </select>
               </div>
               </td>
                <?php }} ?>
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
              
            
           
             <table border="1" style="border-collapse: collapse; border: 1px solid #ccc" width="100%">
              

               <tr>
               <td colspan="6">
               <div class="col-md-12">
              <label  style="padding-left: 19px;" class="">ii.Private/Public Company</label>
               </div>
               </td>
               </tr>
                 <!-- table 7  start -->
            <?php if($relativepublic){
               for($i=0; $i < count($relativepublic); $i++){
            ?>
               <tr>
               <td style="border-right: 1px solid #f7f7f7; width: 2.5%"></td>   
               <td style="width: 20%">  <label class="control-label">Relative Name</label></td>
               <td style="width: 20%"><label class="control-label">Company Name</label></td>
               <td><label class="control-label">Nature of interest</label></td>
               <td> <label class="control-label">Can this relative significantly influence the decision making of this company?</label></td>
               <td>
               <label class="control-label">Do this company have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label> 
               </td>
               </tr>

               <tr>
               <td style="border-right: 1px solid #f7f7f7"></td>
               <td> 
               <div class="input">
               <input type="text" class="form-control inputbox3" id="d7id" name="d7id[]" value="<?php echo $relativepublic[$i]['id']?>" style= "display: none;">

               <select id="d7ques1" name="d7ques1[]" class="form_fields form-control col-md-7 col-xs-12 inputbox4" >
              <?php for($j=0; $j < count($relativesinfo); $j++){
               if($relativepublic[$i]['relative'] == $relativesinfo[$j]['name']){?>
             
               
               ?>
                  <option value="<?php echo $relativesinfo[$j]['name']?>" selected><?php  echo $relativesinfo[$j]['name']?></option>
                   <?php } else { ?>
                          
                  <option value=<?php echo $relativesinfo[$j]['name']?>><?php  echo $relativesinfo[$j]['name']?></option>
              

               <?php } }?>
               
               </select>
               </td>
               <td> 
               <div class="input">
                 <input type="text" class="form-control inputbox5" id="d7ques2" name="d7ques2[]" value="<?php echo $relativepublic[$i]['company']?>" >
               </div>
               </td>

               <td> 
               <div class="input">
                <input type="text" class="form-control inputbox5" id="d7ques3" name="d7ques3[]" value="<?php echo $relativepublic[$i]['interest']?>">
               </div>
               </td>

               <td>
               <div class="input">
               <select id="d7ques4" name="d7ques4[]" class="form_fields form-control col-md-7 col-xs-12 selectbox4" required="">
               <option value="">Select Option</option>
              <?php if($relativepublic[$i]['decision']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                          <option value="No">No</option>
                          <?php }elseif($relativepublic[$i]['decision']  == No){ ?>
                          <option value="Yes" >Yes</option>
                          <option value="No" selected>No</option>
                          <?php } ?>
               </select>
               </div></td>
               <td> 
               <div class="input">
               <select id="d7ques5" name="d7ques5[]" class="form_fields form-control col-md-7 col-xs-12" required="">
               <option value="">Select Option</option>
                <?php if($relativepublic[$i]['transaction']  == Yes){ ?>
                           <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>
                           <?php }elseif($relativepublic[$i]['transaction']  == No){ ?>
                           <option value="Yes" >Yes</option>
                           <option value="No" selected>No</option>
                         <?php } }?>
               </select>
               </div>
               </td>
                 <?php }} ?>
               <tr>
               <td colspan="6" >
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
            <h5 style="text-align: center;">Are You Sure To Delete This Request?</h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="deletereq" tempid="">Delete</button> 
         </div>
      </div>
   </div>
</div>