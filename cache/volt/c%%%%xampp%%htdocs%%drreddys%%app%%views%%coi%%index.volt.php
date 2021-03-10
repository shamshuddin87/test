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
   
    <h1 class="h1_heading text-center" style="text-align: center;">COI Declaration</h1>
    <div class="create_button">
        <a href="coi/createcoi"> <button type="button" class="btn btn-primary getdata">Create Declaration</button></a>
    </div>

    <table width="100%" border="1" class="table table-inverse" id="datableabhi">
     <thead>
      <tr>
        <th>Srno</th> 
        <th>Request Date</th>  
        <th>Status</th>
        <th>HR Review</th>
        <th>Manager Review</th>      
        <th>Audit Trail</th>                                           
        <th>Edit</th>                                           
        <th>Delete</th>                                           
        <th>Download</th>                                           
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
        
<div class="clearelement"></div>
<div class="preloder_wraper">
    <a href="javascript:;" class="preloder"></a>
</div>
<div class="clearelement"></div>
</div>
</div>
</div>


<!---------------------------------------MODAL BOX-------------------------------------->




<!-- ########################################## PageContent End ########################################## --> 
 





