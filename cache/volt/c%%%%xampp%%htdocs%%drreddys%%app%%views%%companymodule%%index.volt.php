<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$condeptsess = $this->session->contractdepartment;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="mainelementfom content">
    <div>  <h1 class="h1_heading"> Company Module</h1> </div>
                
<!--    Total Number of Contracts Ends-->
<!-- My messages -->
<div class="">
    
<!--            <h1 class="h1_heading">Executed Contracts List</h1> -->
<!--            Total Number of Contracts Starts-->
    
    
            <div class="containergrid">               
                <div class="lstc">
                         <section class="col col-md-12 ">
                            <label class="control-label">Listed Company Name *</label>
                            <div class="input">
                                <input type="text" id="lcmp" name="lcmp" required="required" class="form_fields form-control col-md-7 col-xs-12" onkeypress="return nospclchar(event,this);">
                                <button type="button" id="subcmp" class="btn btn-success">Submit</button>
                            </div>
                        </section>
                      </div>
              <!--   <div class="boxshadow">
                     
                </div> -->
                
                <!--table start-->
                <div class="containergrid">
                    <div class="panel panel-primary">
                        <div class="padding_side">
                        <div class="cssnumrws">
                            <span>Show Entries</span>
                            <select id="noofrows" name="noofrows" class="noofrows">
                                <option value="10">10</option><option value="25">25</option>
                                <option value="50">50</option><option value="100">100</option>
                            </select> 
                            <div class="entries">
                            
                            <input type="text" placeholder="Search..." id="srch" status="0">
                          </div>
                        </div>

                            <table class="table table-inverse" id="datablekk">
                                <thead>
                                    <tr>
                                    <th>Sr No</th>
                                    <th>Company Name</th>
                                    <!-- <th>Access</th> -->
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="appendroww" appendrow='1'></tbody>
                            </table>
                            <div class="panel panel-white">
                                <div class="paginationmn"></div>
                                <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                            </div>
                        </div>
                    </div>                  
                </div>      
                <!--table end-->
                
                
                <div class="clearelement"></div>
                
                                
                <!-- ExcelUpload start -->       
                <div class="excluplod">
                    <form action="companymodule/insertcmpfile" id="insertexcl" method="post" enctype="multipart/form-data">
                    <div class="boxshadow"> 
                    <label class="labelcss">Upload Company's Module Through Excel File</label>
                    <div class="choose_files">
                    <input type="file" name="excelfile" id="excelfile" >
                    </div>
                    <div class="updatefile">
                        <div class="sample_down floatleft">
                           <a href="img/cmpmodule/sample/sample.xlsx" download><p class="sample">
                            Download Sample Excel <i class="fa fa-file-excel-o" aria-hidden="true"></i></p></a>
                        </div>
                        <div class="floatright"> 
                            <input type="submit" value="Upload" class="btn btn-primary btnlblne uploadcmdbtn">
                        </div>
                        <div class="clearelement"></div> 
                    </div> 
                    <div id="message" class="message"></div>    
                    </div>  
                    </form>                 
                </div>                 
                <!-- ExcelUpload End -->
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
              <button type="button" class="btn btn-danger" id="deletecmp">Delete</button> 
            </div>
        </div>
    </div>
</div>

<div id="editcompany" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Company</h4>
        </div>
        <div class="list_co">
            <label class="control-label">Listed Company Name  *</label>
                <input type="hidden" id="editcmpid" value="" name="">
                <input type="text" id="cmpname" name="cmpname" class="form_fields form-control col-md-7 col-xs-12" required="required" onkeypress="return nospclchar(event,this);">
            <div class="custom-select">
            </div>

            <div class="">
                <button type="button" class="btn btn-primary mar_0 yesconfirm updatecmp" mlistid="">Update</button>
                <!-- <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">No</button> -->
            </div>
        </div>
    </div>
    </div>
</div>