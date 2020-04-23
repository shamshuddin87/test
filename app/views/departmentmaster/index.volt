<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<?php //echo"<pre>";print_r($gmnlog); exit;?> 
<!-- Main content -->
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
    
    <h1 class="h1_heading text-center">Department Master</h1>
    
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain">                      
                <form id="insertdepartment" action="departmentmaster/insertdepartment" method="post" enctype="multipart/form-data" > 
                        
                        <section class="col col-md-12 col-xs-12">
                            <label class="control-label">Name of department</label>
                            <div class="input">
                                <input type="text" id="deptname" name="deptname" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return lettersOnly(event,this);">
                            </div>
                        </section>
                        <div class="clearelement"></div>
                        
                        <section class="col col-md-12 col-xs-12">
                            <label class="control-label">Company Access *</label>
                            <div class="input">
                                <select id="cmpaccnme" name="cmpaccnme[]" class="form_fields form-control col-md-7 col-xs-12" multiple>
                                    <option value="">Select Company</option>
                                    <?php foreach ($cmplist as $kc => $vc) { ?> 
                                    <option value="<?php echo $vc['id'];?>" class="optncmp"><?php echo $vc['companyname'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </section>                        
                        <section class="col col-md-12 company_asses text-right">
                            <input type="submit" value="Submit" class="btn btn-primary contractexcelbtn">
                        </section>
                        <div class="clearelement"></div>
                        
                    </form>
                </div>                                
                <div class="clearelement"></div>
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
                        
                <table class="table datatable-responsive" class="templatetbl" id="datablerushii" dtausi = "">
                    <thead>
                        <tr>
                            <th>Sr No</th>

                            <th>Name of department</th>
                            <th>Company</th>
                            <!-- <th>category</th>
                            <th>Created On</th>
                            <th>Last Updated</th> -->
                            <th>Action</th>
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
 


<!--------------------DELETE Department MODEL--------------------->
<div id="myModalyesno" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                    &times;</button>
            
            </div>
            <div class="modal-body">
            <input type="hidden" id="deleteid" value="" name="">
            <h5 style="text-align: center;">Are You Sure To Delete Department?</h5> </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger mar_0 yesconfirm" tempid="">Yes</button>
                 
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
          <div class="mainprogressbarforall">
            <div class="headerprogressbar">
              <div aria-busy="true" aria-label="Loading, please wait." role="progressbarmaterial"></div>
            </div>
          </div>
        <div class="modal-body">
            <form action="departmentmaster/updatedept" autocomplete="off" id="updatedept" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <div class="control-label form-group col-md-12 col-xs-12">
                        <span class="floatleft">
                            <lable >Name of department</lable>
                        </span>
                        <input type="text" id="deptname" name="deptname" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return lettersOnly(event,this);">
                    </div>
                    <div class="control-label form-group col-md-12 col-xs-12">
                        <select id="cmpaccnme" name="cmpaccnme[]" class="form_fields form-control col-md-7 col-xs-12" multiple>
                            <option value="">Select Company</option>
                            <?php foreach ($cmplist as $kc => $vc) { ?> 
                            <option value="<?php echo $vc['id'];?>" class="optncmp"><?php echo $vc['companyname'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="clearelement"></div>
                <div class="control-label btnsubmitme cntrol_tab_one">
                    <input type="submit" class="btn btn-success updateme" style="float: right;" value="Update" >

                
                </div>

          </form>
      </div>
</div>

      </div>
    </div>
</div>

<!-- ########################################## PageContent End ########################################## --> 
