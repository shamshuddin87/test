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
     

    <h1 class="h1_heading text-center">Declaration Form</h1>
    <div class="containergrid">       
        <div class="declare_form">                           
           <div class="declare_content">You hereby agree that all the trading transactions done by you shall only be done from the demat accounts disclosed by you in the 'Demat Accounts' tab under main tab 'My Info' </div> 
            <div class="checkbox_box"><input type="checkbox" name="agree" id="agree" value="yes"> I Agree</div>
            <div class="dtesub">
                <p>Date of Submission : <span class="dateofsub"></span></p>
            </div>
            <div class="floatright">
                        <input type="submit" class="btn btn-primary savedeclaration floatleft" value="Submit" >
            </div>

            
       </div> 
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
 





