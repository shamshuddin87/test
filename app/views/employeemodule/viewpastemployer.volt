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
    <div>  <h1 class="h1_heading">Past Employer</h1> </div>
       <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                                           
                <div class="clearelement"></div>
            </div>
       </div>     
    </div>   

    
   <div class="table-responsive table_wraper tradeplanview">
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
                            <th>Employer Name</th>
                            <th>Designation Served</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th> 
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
 
<div id="Mymodalempedit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content margintop">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Past Employer Detail</h4>
      </div>
        <div class="modal-body">
            <form action="employeemodule/updateemp" autocomplete="off" id="updateemp" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="empid" class="empid" id="empid" value="">
                             
                     <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Name of employer*</label>
                                <input type="text" id="empname" name="empname" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </section>
                        
                         <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Designation Served*</label>
                                <input type="text" id="designtn" name="designtn" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </section>
                    
                        
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                        <label class="control-label">Start Date of Employment*</label> 
                        <input type="text" name="strtdte" id="strtdte" class="form-control bootdatepick" required readonly>
                    </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                    <label class="control-label">End Date of employent*</label>  
                        <input type="text" name="enddte" id="enddte" class="form-control bootdatepick" required readonly>
                    </div>
                    </section>
            
           <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">
                <div class="floatright">
                <input type="submit" class="btn btn-primary updateplan floatleft" value="update" >
                </div>
            </div>

          </form>
      </div>


      </div>
    </div>
</div>

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
                    All The Details of employee Will be Deleted.<br>Are You Sure You Want To Proceed.
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>





