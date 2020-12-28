<?php $gmnlog = $this->session->loginauthspuserfront;

//print_r($gmnlog);exit; ?>

<?php $self_nation = $this->portfoliocommon->self_nationality($gmnlog['id']);
//print_r($self_nation);exit;
 ?> 

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
    
<!--    Total Number of Contracts Ends-->
<!-- My messages -->
<div class="mainelementfom">
  <div class="container">

  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <div class="login-button-container clearfix">

      <div class="col-xs-6 sign-in">
        <button class="btn personal active">
          Self Demat Account       
        </button>
      </div>

      <div class="col-xs-6 register">
        <button class="btn relatives">
          Relatives Demat Account   
        </button>
      </div>

    </div>
  </div>

<!--#########################################PERSONAL PORTOFOLIO##############################################-->
    <div class=" personaldetails" style="display: block;">
  <div class="acc">
   
    <label class="do">Do you have any Demat/Securities Account?  
  <?php 
   //print_r($getdematsstatus);exit;
  if(isset($getdematsstatus) ){ 
    

    if($getdematsstatus[0]['status'] == 1){?>
    

    Yes<input type="radio"  name="pastemp" value="1" class="dematup" checked onclick="showsection();" /> 
    No<input type="radio" name="pastemp" value="0" class="dematup" onclick="hidesection();"><br>
  <?php } else if(isset($getdematsstatus) && $getdematsstatus[0]['status'] == 0) { ?>

    Yes<input type="radio" name="pastemp" value="1" class="dematup" onclick="showsection();"> 
    No<input type="radio" name="pastemp" value="0" class="dematup" checked onclick="hidesection();"/><br>

  <?php } else { 
   ?>
    Yes<input type="radio" name="pastemp" value="1" class="dematup" onclick="showsection();"> 
    No<input type="radio" name="pastemp" value="0" class="dematup" onclick="hidesection();"/><br>
  <?php }}
   else{ ?>
     Yes<input type="radio" name="pastemp" value="1" class="dematup" onclick="showsection();"> 
    No<input type="radio" name="pastemp" value="0" class="dematup" onclick="hidesection();"/><br>
     <?php } ?>
     </label>
 
  
  <div id = "showdemat" style="display: none;">
  <h3 style="text-align: center;">How Many Demat/Securities Accounts Do You Have?</h3>
  <div class="input-group">

      <input type="text" class="form-control" id="noofacc" size="30" placeholder="No Of account" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>

      <?php if(!empty($self_nation)){ ?>
       <input type="hidden" class="form-control" id="self_nation" value = "<?php echo $self_nation['nationality']?>">
        <?php } ?>
      <div class="input-group-btn">
        <button type="button" class="btn btn-primary" id="noofdmat">Go</button>
      </div>
    </div>
   <div class="appendaccfield">
   </div>
 
  <!---------------------------------------------------------------------------------------------->

         <!----TABLE OF INSERTED DATA------------------------------------------------------------------>

    <table class="table table-inverse" id="datableabhi">
     <thead>
       <tr>
         <th>Sr No</th>
         <th>Account No</th> 
          <th>Depository Participant</th>
<!--          <th>Clearing House</th>-->
         <th>Actions</th>                                                 
        </tr>
     </thead>
   <tbody class="accdetails" appendrow='1'></tbody>
   <tr><td></td><tr>
  </table>
  </div>
  </div>
<!----------------------------Delete Modal----------------------------------------->
<div id="myModalyesno" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
               
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">
                  <input type="hidden"  id="delid" name="delid" value="">
                    <div class="clearelement"></div>
                   Are You Sure To Delete This Account?
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm">Yes</button>
                <button type="button" class="btn btn-danger  " data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!------------------------------Delete Modal Finish--------------------------------->
<!-------------------------------EDIT ACCOUNT NO MODAL START HERE------------------------------>
<div id="editaccmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit  Demat/Securities Details</h4>
        </div>
        <div class="title"></div>
        <div class="col-md-12 list_co">
          <label class="modal-title">Edit Account No</label>

             <?php if(!empty($self_nation))
             { ?>
              <input type="hidden" class="form-control" id="self_nation_update" value = "<?php echo $self_nation['nationality']?>">
              <?php if(($self_nation['nationality'] == 'Indian')){ ?>
             
             <input type="text" id="editaccno" name="editaccno" class="form_fields form-control col-md-7 col-xs-12 showhovertext" required="required" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="16" pattern="[A-Za-z0-9]{16}"  onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)" >
           <?php } else { ?>
            <input type="text" id="editaccno" name="editaccno" class="form_fields form-control col-md-7 col-xs-12 showhovertext" required="required" onkeypress="return isAlphaNumeric(event,this.value);" pattern="[A-Za-z0-9]"  onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)" >
             <?php } }?>
            <span id= "showhovertext" class ="cssclass " style="display: none;z-index: 2;">
            <ol type="a" style="padding: 5px 5px 5px 15px;">
              <li> Demat/Securities account, mention the 16 digit DP ID-Client ID (For eg.: IN123456-12345678 or 12345678-12345678</li>
              <li>In case of Securities Account (held in a country other than India): please mention the account no. and entity where the account is held</li>
              <li>In case your Demat/Securities account no. is less than 16 digits then prefix the relevant number of '0's</li>
            </ol>
        </span>
        </div>    
          
        
        <div class="col-md-12 list_co">
          <label class="modal-title">Depository Participant</label>
             <input type="text" id="dpar" name="dpar" class="form_fields form-control col-md-7 col-xs-12 " required="required">
           
        </div>  
        
<!--
        <div class="col-md-12 list_co">
          <label class="modal-title">Clearing House</label>
             <input type="text" id="clhouse" name="clhouse" class="form_fields form-control col-md-7 col-xs-12" required="required" >
        </div>  
-->
         <div class="col-md-12"> 
          <button type="button"  style="float:right;" class="btn btn-primary upacc" btnedit="">Update</button></div>
         </div>
    </div>
  </div>


<!----------------------------------------------------------------------------------->
 </div>

<!--#################################PERSONAL PORTOFOLIO FINISH##############################################-->

<!--#################################RELATIVES PORTOFOLIO START##############################################-->

<div class="relativesform" style="display: none;">
  <div class="acc">
    <label class="do">Does any of your relative hold demat account?
  <?php 
   //print_r($getdematsstatus);exit;
  if(isset($getreldematsstatus) ){ 
    

    if($getreldematsstatus[0]['status'] == 1) { ?>
        Yes<input type="radio"  name="pastemp1" value="1" class="dematup1" checked onclick="showsection1();" /> 
        No<input type="radio" name="pastemp1" value="0" class="dematup1" onclick="hidesection1();"><br><br>
    <?php } else if(isset($getreldematsstatus) && $getreldematsstatus[0]['status'] == 0) { ?>

        Yes<input type="radio" name="pastemp1" value="1" class="dematup1" onclick="showsection1();"> 
        No<input type="radio" name="pastemp1" value="0" class="dematup1" checked onclick="hidesection1();"/><br>
    <?php } else { 
   ?>
    Yes<input type="radio" name="pastemp1" value="1" class="dematup1" onclick="showsection1();"> 
    No<input type="radio" name="pastemp1" value="0" class="dematup1" onclick="hidesection1();"/><br><br>
  <?php } }
   else{ ?>
     Yes<input type="radio" name="pastemp1" value="1" class="dematup1" onclick="showsection1();"> 
    No<input type="radio" name="pastemp1" value="0" class="dematup1" onclick="hidesection1();"/><br><br>
     <?php } ?>
     </label>
     <div id = "showreldemat" style="display: none;">
    <div class="input-group col-md-12"> 
     <section class="col col-md-5 col-xs-5">
        <label class="control-label">Select Name Of Relatives</label>
          <div class="input">
            <select id="relinfo" name="relinfo" class="form_fields form-control col-md-7 col-xs-12" required>
              <option value="" id="relativeinfo">Name Of Relatives</option>
                <?php foreach($relativesinfo as $rel){  ?>
                  <option value="<?php echo $rel['id']; ?>" nationality = "<?php echo $rel['nationality']; ?>" ><?php echo $rel['name']; ?></option>
                   <?php } ?>
                    </select>
                      </div>
                        </section>

                    <section class="col col-md-4 col-xs-4">
                      <label class="control-label">No Of  Demat/Securities Accounts</label>
                     <div class="input">
                   <input type="text" id="reldematno" name="reldematno" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>

                  </section>

                  <section class="col col-md-2 col-xs-2">
                          <div class="input">
                           <button type="button" class="btn btn-primary relhtml">Go</button>
                          </div>
                        </section>

                 
     </div>       
            <div class="relfieldapnd"></div>
 <!-------------------------append table---------------------------------->
    <!----TABLE OF INSERTED DATA------------------------------------------------------------------>
       <table class="table table-inverse" id="datableabhi">
          <thead>
             <tr>
               <th>Sr No</th>
              <th>Name</th>
              <th>Account No</th> 
               <th>Depository Participant</th>
<!--               <th>Clearing House</th>-->
               <th>Actions</th>                                                 
             </tr>
           </thead>
          <tbody class="relaccdetails" appendrow='1'></tbody>
        </table>
    <!------------------------------------------------------------------------>
       <div class="tablitiledesc">
               <div class="note">
                  <strong>Note : </strong><br/>
                  <ol type="1" style="display: inline-block;padding: 5px 15px;">
                     <li>I hereby give my consent to use/share any of the information above, with relevant regulatory authorities in case of any investigation or so. I also confirm that I am authorised to share the sensitive personal information of my family members, whose information I am disclosing herein and confirm their consent too.</li>
                     <li>Once your personal information is filled please send 'Declaration form' to the Compliance Officer. <a href="annualdeclaration" style="color:red;">Click here.</a></li>
                  </ol>
               </div>
            </div>
      </div>
      </div>



      <!----------------------------Delete Relative Modal----------------------------------------->
<div id="myModalrel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
               
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">
                
                    <div class="clearelement"></div>
                   Are You Sure To Delete This Account?
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mar_0 reldel" reldel="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!------------------------------Delete relative Modal Finish--------------------------------->
<!-------------------------------EDIT Relative ACCOUNT  MODAL START HERE------------------------------>
<div id="releditaccmodal" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Content</h4>
        <div class="col-md-12 list_co">
          <label class="modal-title">Name</label>
             <input type="text" id="reledname" name="reledname" class="form_fields form-control col-md-7 col-xs-12" required="required" readonly/>
              <input type="hidden" id="relednation" name="relednation" class="form_fields form-control col-md-7 col-xs-12" required="required" readonly/>
        </div>  
        <div class="col-md-12 list_co">
            <label class="modal-title">Account No</label>
             <input type="text" id="releditaccno" name="releditaccno" class="form_fields form-control col-md-7 col-xs-12 showhovertext1" required="required" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}" onmouseover="boxshow(this.className)" onmouseout="boxhide(this.className)">
              <span id= "showhovertext1" class ="cssclass " style="display: none;z-index: 2;">
            <ol type="a" style="padding: 5px 5px 5px 15px;">
              <li> Demat/Securities account, mention the 16 digit DP ID-Client ID (For eg.: IN123456-12345678 or 12345678-12345678</li>
              <li>In case of Securities Account (held in a country other than India): please mention the account no. and entity where the account is held</li>
              <li>In case your  Demat/Securities account no. is less than 16 digits then prefix the relevant number of '0's</li>
            </ol>
        </span>
        </div>    
        
        <div class="col-md-12 list_co">
          <label class="modal-title">Depository Participant</label>
            <input type="text" id="dparrel" name="dparrel" class="form_fields form-control col-md-7 col-xs-12 " required="required" >

             
        </div>  
          
        
<!--
        <div class="col-md-12 list_co">
          <label class="modal-title">Clearing House</label>
             <input type="text" id="relclhouse" name="relclhouse" class="form_fields form-control col-md-7 col-xs-12" required="required" >
        </div>  
-->
         </div>
          <button type="button"  style="float:right;" class="btn btn-primary relupacc" btnedit="">Update</button>
      </div>
    </div>
  </div>
<!-------------------------------EDIT Relative ACCOUNT  MODAL FINISH HERE------------------------------>

<!----------------------------------------------------------------------------------->

</div>

<!--#################################RELATIVES PORTOFOLIO FINISH##############################################-->
  </div>
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

