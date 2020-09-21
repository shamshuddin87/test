<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$userid = trim($this->session->loginauthspuserfront['id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
$getaccess =$this->adminmodulecommon->gatallaccessdetails($userid);
//echo "company is ";print_r($getaccess);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
    
    <h1 class="h1_heading text-center">UPSI Module</h1> 
 <div class="containergrid"> 
    <div class="table-responsive table_wraper">
       
            <div class="cssnumrws">
                <span>Show</span>
                <select id="noofrows" name="noofrows" class="noofrows">
                <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
                </select> 
                <span>Entries</span>
            </div>
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Title of UPSI</th>
                            <th>UPSI Start Date</th>
                            <th>UPSI End Date</th>
                            <th>Date of creation</th>
                            <?php if($getaccess[0]['upsi_infoshare_add'] == 1){?>
                            <th>Add/View Recipients</th> 
                            <?php } ?>
<!--                            <th>Edit/Delete</th>-->
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
                    </tbody>
                </table>
                <div class="panel panel-white">
            <div class="paginationmn"></div>
            <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
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
 


<div id="myModalyesno" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Would you like to go ahead?</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">NOTE
                    <div class="clearelement"></div>
                    All The Details of Recipient Will be Deleted.<br>Are You Sure You Want To Proceed.
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div id="Mymodaledit" class="modal fade" role="dialog" tabIndex=-1>
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Content</h4>
      </div>
        <div class="modal-body">
            <form action="sensitiveinformation/updateupsiinfo" autocomplete="off" id="updateupsiinfo" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                <section class="col col-md-12 col-xs-12">
                    <div class="input">
                        <label class="control-label">Type of UPSI*</label>
                        <input type="text" id="upsitype" name="upsitype" class="form_fields form-control col-md-7 col-xs-12" required>
                    </div>
                </section>
                        
                    

                <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">

                <div class="floatright">
                <input type="submit" class="btn btn-primary updateme floatleft" value="Update" >

                    <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">Close</button>
                </div>
                </div>

          </form>
      </div>


      </div>
    </div>
</div>
