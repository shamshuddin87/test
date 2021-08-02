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
     

    <h1 class="h1_heading">Company Restriction</h1>
    <?php if($user_group_id == 2)
    { ?>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain">                      
                    <form id="insertcomprestriction" action="restrictedcompany/insertcomprestriction" method="post" enctype="multipart/form-data" autocomplete="off" > 
                        <input type="hidden" name="compid" class="compid" id="compid" value="">
                        <section class="col col-md-4 col-xs-4">
                            <div class="input">
                          <div class="mainelem company_product">
                            <label class="control-label">Name of company in which trading is restricted*</label>
                            <div class="header-search-wrapper  floatnone find_box_company">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft" placeholder="Select Company" id="search-box" autocomplete="off"/>
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
                                <label class="control-label">Name Of Company*</label>
                                <input type="text" id="validators" name="validators" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                            </div>
                        </section>
                    
                        
                    <section class="col col-md-4 col-xs-4">
                    <div class="input">
                        <label class="control-label">Period Of Restriction From </label> 
                        <input type="text" name="perdresfrom" id="perdresfrom" class="form-control bootdatepick" required readonly>
                    </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">For perpetuity</label>  
                        <input type="checkbox" name="perpetuity" value="perpetuity">
                        </div>
                    </section>
                        
                    <section class="col col-md-4 col-xs-4">
                    <div class="input">
                    <label class="control-label">Period Of Restriction To </label>  
                        <input type="text" name="perdresto" id="perdresto" class="form-control bootdatepick" required readonly>
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
       <?php }?>
       </div>     
    </div>
    
   <div class="table-responsive table_wraper">
                <table class="table datatable-responsive" class="templatetbl" id="datablerushii" dtausi = "">
                    <thead>
                        <tr>
                            <th>Name of Listed Company</th>
                            <th>Period Of Restriction From</th>
                            <th>Period Of Restriction To</th>
                            <th>Last Updated</th> 
                            <?php if($user_group_id == 2){?><th>Action</th><?php } ?>
                        </tr>
                    </thead>
                    <tbody class="appendrow" appendrow='1'>
                    </tbody>
                </table>
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
                    All The Details of Company Will be Deleted.<br>Are You Sure You Want To Proceed.
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
            <form action="restrictedcompany/updatecomprestriction" autocomplete="off" id="updatecomprestriction" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                <input type="hidden" name="compid" class="compid" id="compid" value="">
                <section class="col col-md-7 col-xs-7">
                          <div class="mainelem company_product">
                            <label class="control-label">Name of company in which trading is restricted*</label>
                            <div class="header-search-wrapper input floatnone find_box_company">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft" placeholder="Select Company" id="search-box" autocomplete="off"/>
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
                        </section>

                        <section class="col col-md-5 col-xs-5">
                            <label class="control-label">Name Of Company*</label>
                            <div class="input">
                                <input type="text" id="validators" name="validators" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                            </div>
                        </section>
                        <div class="clearelement"></div>
                        
                    <section class="col col-md-4 col-xs-4">
                      
                     <div class="input">
                         <label class="control-label">Period Of Restriction From </label>
                        <input type="text" name="perdresfrom" id="perdresfrom" class="form-control bootdatepick" required readonly>
                    </div>
                    </section>
                        
                
                    <section class="col col-md-4 col-xs-4">
                        <div class="input">
                            <label class="control-label">For perpetuity</label>  
                        <input type="checkbox" name="perpetuity" value="perpetuity" id="perpetuity">
                        </div>
                    </section>    
                
                    <section class="col col-md-4 col-xs-4">
                     <div class="input">
                         <label class="control-label">Period Of Restriction To </label>
                        <input type="text" name="perdresto" id="perdresto" class="form-control bootdatepick" required readonly>
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
