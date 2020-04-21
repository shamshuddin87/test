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
          

    <input type = "hidden" value="<?php echo $esopid; ?>" id="esopid">
    <input type = "hidden" value="<?php echo $esopuniqueid; ?>" id="esopuniqueid">
   <div class="table-responsive table_wraper esopview">
    <div class="cssnumrws">
       <span>Show</span>
        <select id="noofrows" name="noofrows" class="noofrows">
           <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <span>Entries</span>
    </div>

        
          <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">
           <div class="floatright">
                <input type="submit" class="btn btn-primary savefinal" value="Save As Final" uniqueid ="<?php echo $esopuniqueid; ?>">
             
           </div>

            <div class="floatright">
            <p id="noofusers"><span style="float: left; line-height: 35px;color: #000;font-size: 17px;">Total No of Designated Persons</span> <span id = "empcount" style="color:#bd0111;background: #d6d5d5;float: right;text-align: center;line-height: normal;padding: 3px 14px;margin: 0 10px;font-size: 25px"></span></p>
             
            </div>
               

         </div>
          
          <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Employee PAN</th>
                            <th>No. of Shares</th>
                            <th>Date of Allotment</th>
                           <!--  <th>Company Name</th> -->
                        </tr>
                    </thead>
                    <tbody class="appendviewesop">
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
 

<div id="myModalsavefinal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input type="hidden" value="" name="esopuniqid" id="esopuniqid">
                <h4 class="modal-title">ESOP</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="text-center modal_heading">NOTE
                    <div class="clearelement"></div>
                    Saving this as final will mean that the data uploaded is correct and that holding of all beneficiaries will be updated.
                </div>
            </div>
          
            <div class="modal-footer">
                <input type="submit" class="btn btn-success finalsaveyes" id="finalsaveyes" value="Yes">
                <input type="submit" class="btn btn-success Notsave" data-dismiss="modal" id="Notsave" value="No">
            </div>
        </div>
    </div>
</div>





