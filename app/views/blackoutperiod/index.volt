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
     

    <h1 class="h1_heading text-center">Trading Window</h1>
    <?php if($user_group_id == 2 || $user_group_id == 14)
    { ?>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain">                      
                    <form id="insertblackoutperiod" action="blackoutperiod/insertblackoutperiod" method="post" enctype="multipart/form-data" autocomplete="off"> 
                        <input type="hidden" name="compid" class="compid" id="compid" value="">
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                          <div class="mainelem company_product">
                            <label class="control-label">Search for company master*</label>
                            <div class="header-search-wrapper  floatnone find_box_company">
                          <i class="fa fa-search"></i>
                          <input type="text" name="getvalueofsearch" class="header-search-input z-depth-2 floatleft col-md-12" placeholder="Select Company" id="search-box" autocomplete="off"/>
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
                                <label class="control-label">Name Of Company*</label>
                                <input type="text" id="cmpname" name="cmpname" class="form_fields form-control col-md-7 col-xs-12" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required readonly>
                            </div>
                        </section>
                    
                        
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                        <label class="control-label">Trading Window From </label> 
                        <input type="text" name="blckoutfrom" id="blckoutfrom" class="form-control bootdatepick" required readonly>
                    </div>
                    </section>
                        
                    <section class="col col-md-6 col-xs-6">
                    <div class="input">
                    <label class="control-label">Trading Window To </label>  
                        <input type="text" name="blckoutto" id="blckoutto" class="form-control bootdatepick" required readonly>
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
    
   <div class="formelementmain table-responsive table_wraper">
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Name of Company</th>
                            <th>Trading Window From</th>
                            <th>Trading Window To</th> 
                            <?php if($user_group_id == 2 || $user_group_id == 14){?><th>Action</th><?php } ?>
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

<div id="myModalemail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Type Email Content</h4>
            </div>
            <div class="modal-body show_shadow">
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" rows="5" id="content"></textarea>
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary sendemail">Send Email</button>
            </div>
        </div>
    </div>
</div>


