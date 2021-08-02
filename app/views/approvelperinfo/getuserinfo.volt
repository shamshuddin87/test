<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
    
<input type="hidden" name="getuser" id="getuser" class="getuser" value="<?php print_r(base64_decode($getuserid));?>">

<button type="button" class="btn btn-danger rejbtn">Reject</button>
<button type="button" class="btn btn-success accptbtn">Accept</button>
<span id="acprejstatus"></span>


<div class="table_data">
  <h1 class="h1_heading">User Information</h3>
 <table class="table table-inverse" id="datableabhi">
   <thead>
    <tr>
     <th>Sr No</th>
      <th>Pan</th> 
      <th>Aadhar</th>
      <th>Date Of Becoming Dp</th>
      <th>Date Of Birth</th>
      <th>Qualification</th>
      <th>Institute</th>
      <th>Mobile No</th>
      <th>File</th>
      <!-- <th>Past Employment</th> -->
      <th>Action</th>
    </tr>                             
  </thead>
 <tbody class="perdetail" appendrow='1'></tbody>
</table>
</div>


<div class="table-responsive table_wraper tradeplanview">
   <!--  <div class="cssnumrws">
       <span>Show</span>
        <select id="noofrows" name="noofrows" class="noofrows">
           <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <span>Entries</span>
    </div> -->
          <h1 class="h1_heading">Past Employer Details</h3>
          <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Employer Name</th>
                            <th>Designation Served</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <!-- <th>Action</th>  -->
                        </tr>
                    </thead>
                    <tbody class="appendviewemplyee">
                    </tbody>
                </table>
      
    
    </div>
    
    <div class="panel panel-white">
 <div class="paginationmn"></div>
<input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">

</div>

<!------------------------------------MODAL BOX FOR EDIT------------------------------------------>
<div id="mydataedit" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">
    <div class="modal-content">
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
                  <label for="aadhar">Aadhar</label>
                  <input type="text" id="aadhar" name="aadhar" placeholder="aadhar" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="12" pattern="[0-9]{12}">
                </div>
          
                <div class="col-md-6">
                  <label for="Dob">Dob*</label>
                  <input type="text" id="dob" name="dob" class="bootdatepick" placeholder="dob">
                </div>
         
                <div class="col-md-6"> 
                  <label class="gender" for="sex">Gender*</label>
                  <input type="radio" id="sex" name="sex" value="Male" checked/>Male
                  <input type="radio" id="sex" name="sex"  value="Female"/>Female
                  <input type="radio" id="sex" name="sex"  value="Other"/>Other
                </div>

                <div class="col-md-12">
                <label for="age">Please Enter Mobile No*</label>
                 <input type="hidden" id="upmobileno" name="upmobileno" value="">
                 <input type="text" id="upmobno" name="upmobno" placeholder="Mobile No" onkeypress='return event.charCode >= 48 && event.charCode <= 57' min="10" max="10">
                 
                 <p id="addmobileonmd"></p>
              </div>
              <div class="col-md-12">
              <input type="button" value="Add" name="" id="upaddmobile" class="inner_button">
               </div>
                
                <div class="col-md-6">
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
                 <label class="control-label">Upload Identity Proof</label>
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
            <h5 style="text-align: center;">Are You Sure To Delete Personal Information?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="delinfo">Delete</button> 
            </div>
        </div>
    </div>
</div>

<div id="acptmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
            <input type="hidden" id="deleteid" value="" name="">
            <h5 style="text-align: center;">Are You Sure To Accept This Request?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" acptid="" id="acceptreq">Submit</button> 
            </div>
        </div>
    </div>
</div>


<div id="rejmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
            <input type="hidden" id="deleteid" value="" name="">
            <h5 style="text-align: center;">Are You Sure To Reject This Request?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" acptid="" id="rejid">Submit</button> 
            </div>
        </div>
    </div>
</div>











        </div>
    </div>
</div>

<!-- ########################################## PageContent End ########################################## --> 

