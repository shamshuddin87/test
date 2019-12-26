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
  <div class="create_button">
    <button type="button" class="btn btn-primary getdata">Create Declaration</button>
   </div> 
  <h1 class="h1_heading text-center" style="text-align: center;">Annual Declaration</h1>
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
           <button type="button" class="btn btn-primary formpdf">Generate PDF</button>
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Annual Declaration Form</h4>
      </div>
      <div class="modal-body show_shadow">
        <form action="annualdeclaration/insertannual" id="inannual" method="post" autocomplete="off"> 
                  <div class="col-md-12" style="padding-bottom: 20px;">
                   <input type="hidden" name="releditid" id="releditid" value="">
                   <input type="hidden" name="filepath" id="filepath" value="">
                   <label for="ques1">Are you holding controlling interest i.e. 20% or more of the paid up share capital in any company? (please mention names)*</label>
                   <input type="text" id="ques1" name="ques1" placeholder="" style="width:95%">
                  </div>


                <div class="col-md-12"  style="padding-bottom: 20px;" >
                   
                   <label for="ques2">Can you significantly influence the decision making of the companies disclosed by you in question # 1?</label>
                   <input type="text" id="ques2" name="ques2" placeholder="" style="width:95%">
                </div>
             
                 <div class="col-md-12" style="padding-bottomtom: 20px;">
                    
                   <label for="ques3">Are you interested:
                             i.  In a firm - as a partner or otherwise,
                            ii. In a private/public company - as a director or member,
                            iii.  In a public company - by virtue of holding more than 2% of its paid up share capital (along with your relatives). 
                            (mention names and capacity in which you are interested)
                  </label>
                    <input type="text" id="ques3" name="ques3" placeholder="" style="width:95%">
                </div>
          
                <div class="col-md-12"  style="padding-bottom: 20px;">
                   
                   <label for="ques4">Can you significantly influence the decision making of the firm(s) or company(s) disclosed by you in question # 3?</label>
                   <input type="text" id="ques4" name="ques4" placeholder="" style="width:95%">
                </div>
         
               <div class="col-md-12"  style="padding-bottom: 20px;">
                   
                   <label for="ques5">Do the firm(s) or company(s) disclosed by you in question # 1 and 3 have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any of its group company/subsidiary?</label>
                   <input type="text" id="ques5" name="ques5" placeholder="" style="width:95%">
                </div>

                <div class="col-md-12" style="padding-bottom: 20px;">
                   
                   <label for="ques7">In which companies are your relatives, as disclosed above, holding controlling interest i.e. 20% or more of the paid up share capital? (please mention names)</label>
                   <input type="text" id="ques7" name="ques7" placeholder="" style="width:95%">
                </div>
       
             <div class="col-md-12"  style="padding-bottom: 20px;">
                   
                   <label for="ques8">Can your relatives as disclosed by you in question # 7 significantly influence the decision making of the companies disclosed in question # 8?</label>
                   <input type="text" id="ques8" name="ques8" placeholder="" style="width:95%">
                </div>
            
             <div class="col-md-12"  style="padding-bottom: 20px;">
                   
                   <label for="ques9">Are your relatives disclosed by you in question # 7 interested:
                     i.  In a firm - as a partner or otherwise,
                       ii. In a public company - by virtue of holding more than 2% of its paid up share capital.
                           (mention names and capacity in which they are interested)
                  </label>
                   <input type="text" id="ques9" name="ques9" placeholder="" style="width:95%">
                </div>
            
             <div class="col-md-12"  style="padding-bottom: 20px;">
                   
                   <label for="ques10">Can your relatives as disclosed by you in question # 7 significantly influence the decision making of the firms or companies disclosed in question # 11?</label>
                   <input type="text" id="ques10" name="ques10" placeholder="" style="width:95%">
                </div>
             <div class="col-md-12"  style="padding-bottom: 20px;">
                   
                   <label for="ques11">Do your relatives, the firm(s) or company(s) disclosed in question # 8 and 10, have any commercial or financial transactions with Dr. Reddy's Laboratories Limited or any other group company/subsidiary?</label>
                   <input type="text" id="ques11" name="ques11" placeholder="" style="width:95%">
                </div>

         <div class="col-md-12"> 
           <button type="button" class="btn btn-primary annualform">Submit</button>
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
 





