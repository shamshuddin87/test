<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<?php //echo"<pre>";print_r($userdetails[0]['fullname']); ?> 

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
          Self Portfolio       
        </button>
      </div>

      <div class="col-xs-6 register">
        <button class="btn relatives">
          Relatives Portfolio    
        </button>
      </div>

    </div>
  </div>

<!--#########################################PERSONAL PORTOFOLIO##############################################-->
    <div class=" personaldetails" style="display: block;">
  <div class="acc">
  	<h3 style="text-align: center;">How Many Demat Accounts Do You Have?</h3>
  <div class="input-group">

      <input type="text" class="form-control" id="noofacc" size="30" placeholder="No Of account" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
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
          <th>Depository Participient</th>
          <th>Clearing House</th>
         <th>Actions</th>                                                 
        </tr>
     </thead>
   <tbody class="accdetails" appendrow='1'></tbody>
   <tr><td></td><tr>
  </table>

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
                <button type="button" class="btn btn-danger mar_0 yesconfirm">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
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
        <h4 class="modal-title">Edit Demat Details</h4>
        </div>
        <div class="title"></div>
        <div class="col-md-12 list_co">
          <label class="modal-title">Edit Account No</label>
             <input type="text" id="editaccno" name="editaccno" class="form_fields form-control col-md-7 col-xs-12" required="required" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}" >
        </div>    
          
        
        <div class="col-md-12 list_co">
          <label class="modal-title">Depository Participient</label>
             <input type="text" id="dpar" name="dpar" class="form_fields form-control col-md-7 col-xs-12" required="required" >
        </div>  
        
        <div class="col-md-12 list_co">
          <label class="modal-title">Clearing House</label>
             <input type="text" id="clhouse" name="clhouse" class="form_fields form-control col-md-7 col-xs-12" required="required" >
        </div>  
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
    <div class="input-group col-md-12"> 
     <section class="col col-md-6 col-xs-6">
        <label class="control-label">Select Name Of Relatives</label>
          <div class="input">
            <select id="relinfo" name="relinfo" class="form_fields form-control col-md-7 col-xs-12" required>
              <option value="" id="relativeinfo">Name Of Relatives</option>
                <?php foreach($relativesinfo as $rel){  ?>
                  <option value="<?php echo $rel['id']; ?>"><?php echo $rel['name']; ?></option>
                   <?php } ?>
                    </select>
                      </div>
                        </section>

                       <section class="col col-md-3 col-xs-3">
                      <label class="control-label">No Of Demat Accounts</label>
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
               <th>Depository Participient</th>
               <th>Clearing House</th>
               <th>Actions</th>                                                 
             </tr>
           </thead>
          <tbody class="relaccdetails" appendrow='1'></tbody>
        </table>
    <!------------------------------------------------------------------------>
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
<div id="releditaccmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Content</h4>
        <div class="list_co">
          <label class="modal-title">Name</label>
             <input type="text" id="reledname" name="reledname" class="form_fields form-control col-md-7 col-xs-12" required="required" readonly/>
        </div>  
        <div class="list_co">
            <label class="modal-title">Account No</label>
             <input type="text" id="releditaccno" name="releditaccno" class="form_fields form-control col-md-7 col-xs-12" required="required" onkeypress="return isAlphaNumeric(event,this.value);"maxlength="16" pattern="[A-Za-z0-9]{16}">
        </div>    
        
        <div class="list_co">
          <label class="modal-title">Depository Participient</label>
             <input type="text" id="dparrel" name="dparrel" class="form_fields form-control col-md-7 col-xs-12" required="required" >
        </div>  
          
        
        <div class="list_co">
          <label class="modal-title">Clearing House</label>
             <input type="text" id="relclhouse" name="relclhouse" class="form_fields form-control col-md-7 col-xs-12" required="required" >
        </div>  
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
<!-- ########################################## PageContent End ########################################## --> 

