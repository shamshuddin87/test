<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
//echo "company is ";print_r($user_group_id);exit;
$upsiid = $this->session->upsitypeid;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
     
    <input type="hidden" name="upsitypeid" class="upsitypeid" id="upsitypeid" value="<?php echo $upsiid;?>">
    <h1 class="h1_heading text-center">Database of information shared</h1>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain">                      
                    <form id="insertinfosharing" action="sensitiveinformation/insertinfosharing" method="post" enctype="multipart/form-data" autocomplete="off" > 
                        <input type="hidden" name="category" class="category" id="category" value="">
                        <input type="hidden" name="recid" class="recid" id="recid" value="">
                        <input type="hidden" name="upsitypeid" class="upsitypeid" id="upsitypeid" value="<?php echo $upsiid;?>">
                        
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                          <div class="mainelem company_product">
                            <label class="control-label">Search Name Of Recipient*</label>
                            <div class="header-search-wrapper  floatnone find_box_company">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft" placeholder="Select Name" id="search-box" autocomplete="off"/>
                          <div id="live-search-header-wrapper" class="">
                            <ul class="live-searchul"></ul>
                          </div>
                          <div class="clearelement"></div>
                          <div class="mainelementch">

                            <div class="clearelement"></div>
                          </div>
                        </div>
                        <div class="header-search-wrapper hide-on-med-and-down services_search find_box_company" style="display: none;">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input1 z-depth-2 floatleft" placeholder="Explore Resolutions" id="search-box1"/>
                          <div class="clearelement"></div>
                          <div id="live-search-header-wrapper1" class=""><ul class="live-searchul1"></ul></div>
                        </div>
                       </div>
                            </div>
                    </section>
                        
                       <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Name Of Recipient*</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" readonly required>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Date Of Information Sharing*</label>
                                <input type="text" id="date" name="date" class="form-control bootdatepick" readonly required>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Time Of Information Sharing*</label>
                                <input type="text" class="form-control time_of_data" id="time_of_data"  name="time_of_data" getthisval="unique" data-inputmask="'mask': '99:99'" title="Enter Time in 24 hour Format">
                            </div>
                        </section>



                           <section class="col col-md-4 col-xs-4">
                        <div class="input">
                        	  <label class="control-label">Type of upsi*</label>
                        <input type="text" id="selectupsi" name="selectupsi" class="form_fields form-control col-md-7 col-xs-12" value="<?php echo $getupsiname['upsitype']; ?>" readonly required>
                        </div>
                       </section>
                        
                      
                
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Data Shared*</label>
                                <input type="text" id="datashared" name="datashared" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </section>
                        
<!--
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">Purpose*</label>
                                <input type="text" id="purpose" name="purpose" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </section>
-->


                         <section class="col col-md-4 col-xs-4">
                            <div class="input">
                                <label class="control-label">End Date</label>
                                <input type="text" id="enddate" name="enddate" class="form-control bootdatepick" readonly required>
                            </div>
                        </section>   
					    <section class="col col-md-12 col-xs-12"></section>
                        <div class="appendfile" filecntr='1'>
                        <section class="col col-md-12 col-xs-12">
                        <section class="col col-md-1 col-xs-1">
                          <div class="input">
                        <label class="control-label">Sr No.</label><br>
                            <label>1.</label>
                        </div>
                        </section>
                        <section class="col col-md-3 col-xs-3">
                        <div class="input">
                        <label class="control-label">Attach Data Shared</label>
                            <div class="choose_files">
                                <input type="file" name="upload[]" id="upload" >
                            </div>
                        </div>
                       </section>
                        </section>
                        </div>
                        <section class="col col-md-12 col-xs-12">
                        <div>
                            <input type="button" class="btn btn-primary btnaddfile" value="+" >
                            <input type="button" class="btn btn-primary btndeletefile" value="-" >                    
                        </div> 
                        </section>
                      <section class="col col-md-12 company_asses">
                            <input type="submit" value="Submit" class="btn btn-primary contractexcelbtn">
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
            <div class="floatright">
                <input type="submit" class="btn btn-primary archiveinfoshr" value="Archive" >
            </div>
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Date</th> 
                            <th>Time</th> 
                            <th>End Date</th> 
                            <th>Data shared</th> 
<!--                            <th>Purpose</th> -->
                            <th>UPSI Type</th> 
                            <th>Attachment</th> 
                            <th>Audit Trail</th> 
                            <th>Sent By</th> 
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

<div id="Mymodaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Content</h4>
      </div>
        <div class="modal-body">
            <form action="sensitiveinformation/updateinfosharing" autocomplete="off" id="updateinfosharing" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                <input type="hidden" name="category" class="category" id="category" value="">
                <input type="hidden" name="filepath" class="filepath" id="filepath" value="">
                    <section class="col col-md-6 col-xs-6">
                            <div class="input">
                          <div class="mainelem company_product">
                            <label class="control-label">Search Name Of Recipient*</label>
                            <div class="header-search-wrapper  floatnone find_box_company">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft" placeholder="Select Name" id="search-box" autocomplete="off"/>
                          <div id="live-search-header-wrapper" class="">
                            <ul class="live-searchul"></ul>
                          </div>
                          <div class="clearelement"></div>
                          <div class="mainelementch">

                            <div class="clearelement"></div>
                          </div>
                        </div>
                        <div class="header-search-wrapper hide-on-med-and-down services_search find_box_company" style="display: none;">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input1 z-depth-2 floatleft" placeholder="Explore Resolutions" id="search-box1"/>
                          <div class="clearelement"></div>
                          <div id="live-search-header-wrapper1" class=""><ul class="live-searchul1"></ul></div>
                        </div>
                       </div>
                            </div>
                    </section>
                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Name Of Recipient*</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" readonly required>
                            </div>
                        </section>
                        
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Date Of Sharing Of Information*</label>
                                <input type="text" id="date" name="date" class="form-control bootdatepick" readonly required>
                            </div>
                        </section>
                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Data Shared*</label>
                                <input type="text" id="datashared" name="datashared" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </section>
                        
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Purpose</label>
                                <input type="text" id="purpose" name="purpose" class="form_fields form-control col-md-7 col-xs-12" >
                            </div>
                        </section>
                        
<!--
                        <section class="col col-md-6 col-xs-6">
                        <div class="input">
                        <label class="control-label">Attach Data Shared</label>
                            <div class="choose_files">
                                <input type="file" name="upload" id="upload" >
                            </div>
                        </div>
                       </section>
-->
                        
                    

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

<div id="Mymodalenddateedit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter End Date</h4>
      </div>
        <div class="modal-body">
            <form action="sensitiveinformation/updateenddate" autocomplete="off" id="updateenddate" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                <section class="col col-md-12 col-xs-12">
                    <div class="input">
                        <label class="control-label">End Date*</label>
                        <input type="text" id="enddate" name="enddate" class="form-control bootdatepick" readonly required>
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