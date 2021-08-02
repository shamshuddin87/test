<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
//echo "company is ";print_r($upsitype);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
     

    <h1 class="h1_heading"><?php echo $upsitype;?></h1>
    <h2 class="text-center">(Database of information shared)</h2>
    <input type="hidden" id="upsitypeid" value="<?php print_r($upsiid); ?>" name="upsitypeid">
    
    <div class="table-responsive table_wraper">
       <div class="cssnumrws">
                <span>Show</span>
                <select id="noofrows" name="noofrows" class="noofrows">
                <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
                </select> 
                <span>Entries</span>
           <div style="float:right;">
               <a class="exportcss dwnldExcel" href="" style="display: none;" download>Download</a>
                <button type="button" class="btn btn-primary genfile excel_bg" request="excel">Export Excel</button>
                <input type="submit" class="btn btn-primary archiveinfoshr" upsitype="<?php print_r($upsiid); ?>" value="Archive" >
            </div>
            </div>
       
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Date</th> 
                            <th>Time</th> 
                            <th>End Date</th> 
                            <th>Datashared</th> 
<!--                            <th>Purpose</th> -->
                            <th>Attachment</th> 
                            <th>Audit Trail</th> 
                            <th>Sent By</th>
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
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

<div id="Mymodalaudittrail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Audit Trail</h4>
      </div>
        <div class="modal-body">
            <div class="trailshare">
                <table border="1" width="100%">
                  <tr>
                    <th>Events</th>
                    <th>Details</th>
                  </tr>
                    <tr>
                        <td>Created On :</td>
                        <td><span class="reqstcreateddte"></span></td>
                    </tr>
                    <tr>
                        <td>Updated On :</td>
                        <td><span class="reqstupdteddte"></span></td>
                    </tr>
                 
                </table>
              
            </div>       
        </div>


      </div>
    </div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
 

<div id="modalupsiattachmnt" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">UPSI Attachment</h4>
      </div>
        <div class="modal-body">
            <div class="upsifilepath"></div>  
        </div>


      </div>
    </div>
</div>
