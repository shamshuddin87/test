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
     

    <h2 class="h1_heading text-center">Upload Holding</h2>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain"> 
                    
                <form id="insertholding" action="uploadholding/insertholding" method="post" enctype="multipart/form-data" autocomplete="off" > 

                    <section class="col col-md-6 col-xs-6">
                        <label class="control-label">Date of Holding Data</label>
                        <div class="input">
                        <input type="text" name="dtofhldng" id="dtofhldng" class="form-control bootdatepick" required onkeypress="return false;">   
                        </div>
                    </section>

                    <section class="col col-md-6 col-xs-6">
                        <label class="control-label">Type of holding</label>
                        <div class="input">
                            <select id="typeofhldng" name="typeofhldng" class="form_fields form-control col-md-7 col-xs-12" required="required">
                                <option value="">Select Holding Type</option>
                                <option value="Shareholding">Shareholding</option>
                                <option value="ADRs holding">ADRs holding</option>
                            </select>
                        </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                    <label class="control-label">Upload File</label>
                        <div class="choose_files">
                            <input type="file" name="holdingfile" id="holdingfile" required="required">
                        </div>
                        <div class="updatefile">
                        <div class="sample_down floatleft">
                           <a href="samplefile\Uploadholding\Uploadholding.xlsx" download><p class="sample">
                            Download Sample Excel <i class="fa fa-file-excel-o" aria-hidden="true"></i></p></a>
                        </div>
                        <div class="clearelement"></div> 
                      </div>
                    </div>
                    </section>
                        
                    <section class="col col-md-12 runreport text-right">
                        <input type="submit" value="Run Report" class="btn btn-primary runreport">
                    </section>
                    <div class="clearelement"></div>
                        
                    </form>
                </div>                                
                <div class="clearelement"></div>
            </div>
       </div>     
    </div>
    
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
                    <th>Date Of Holding</th>
                    <th>Type Of Holding</th>
                    <th>Date Of Upload</th>
                    <th>Time</th>
                    <th>Action</th>
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
                    Are You Sure You Want To Delete This Record.
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary mar_0 yesconfirm" tempid="">Yes</button>
                <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>


