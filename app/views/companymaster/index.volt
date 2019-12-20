<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<?php //echo"<pre>";print_r($gmnlog); exit;?> 
<!-- Main content -->


<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
    
            <h1 class="h1_heading">Add Company</h1>            
            <div class="containergrid">
               
                <div class="formcss">                           
                <div class="typography form_pad">
                    <!--<h4 class="text-center form_heading">Create User</h4>-->
                    
                    <div class="tablitiledesc text-center">
                            <div class="note">
                                (<strong>Note : </strong>Important Fields are * Specified.)
                            </div>
                    </div>
                    <div class="formelementmain">                      
                    <form id="cmpmst" action="companymaster/addcmpmaster" method="post" enctype="multipart/form-data" autocomplete="off"> 
                       
                        <div class="clearelement"></div>        
                      
                        <section class="col col-md-6 col-xs-6">
                            <label class="control-label">Name Of Company *</label>
                            <div class="input">
                                <input type="text" id="cmp" name="cmp" required="required" class="form_fields form-control col-md-7 col-xs-12" required onkeypress="return nospclchar(event,this);">
                            </div>
                        </section>


                      <section class="col col-md-6 col-xs-6">
                            <label class="control-label">Pan Card</label>
                            <div class="input">
                                <input type="text" id="region" name="pan" required="required" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10" >
                            </div>
                        </section>

                    


                        <div class="clearelement"></div>                   
                                              
                        <section class="col col-md-12 col-xs-12">               
                        
                        <div class="control-label formgroup text-right">
                            <button type="Submit" class="btn btn-primary addregion btnlblne">Submit</button> 
                        </div>
                        </section>
                                            
                    </form>
                    </div>                                
                </div>                       
                </div> 
                
                
                <!--table start-->
                <div class="containergrid">
                    <div class="panel panel-primary">
                        <div class="cssnumrws">
                            <span>Show</span>
                            <select id="noofrows" name="noofrows" class="noofrows">
                                <option value="10">10</option><option value="25">25</option>
                                <option value="50">50</option><option value="100">100</option>
                            </select> 
                            <span>Entries</span>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-inverse" id="datableabhi">
                              <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Company Name</th> 
                                     <th>Pan Id</th>                                                 
                                    <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="cmpdetails" appendrow='1'></tbody>
                            </table>
                            <div class="panel panel-white">
                                <div class="paginationmn"></div>
                                <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                            </div>
                        </div>
                    </div>                  
                </div>
                
                <!--table end-->
                
               
                
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



<div id="cmpmod" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
             <h4 class="modal-title">Update Company Details</h4> 
            </div>
            <div class="modal-body">
                            
                           
                            <label class="control-label">Name Of Company</label>

                            <div class="input">
                                <input type="hidden" id="cmpid" value="" class="form_fields form-control col-md-7 col-xs-12" >
                                <input type="text" id="cmpnm" name="cmp" required="required" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return nospclchar(event,this);">
                            </div>
                        


                      
                            <label class="control-label">Pan Card</label>
                            <div class="input">
                                <input type="text" id="pnid" name="pnid" required="required" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return isAlphaNumeric(event,this.value);" maxlength="10" >
                            </div>
                      
               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="udtcmp">Update</button> 
            </div>
        </div>
    </div>
</div>

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
            <h5 style="text-align: center;">Are You Sure To Delete Company?</h5> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="delcmp">Delete</button> 
            </div>
        </div>
    </div>
</div>




