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
     

    <h1 class="h1_heading text-center">Relatives Holding Summary</h1>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                    
            </div>
       </div>     
    </div>
    
    <div class="bg_white">
   <div class="table-responsive table_wraper">
    <div class="cssnumrws form-inline">
    <div class="opening">
                        <button class="btn openingblnc">Opening Balance</button>
                    </div>
       <label>Show</label>
        <select id="noofrows" name="noofrows" class="noofrows form-control">
           <option value="10">10</option><option value="25">25</option>
            <option value="50">50</option><option value="100">100</option>
        </select> 
        <label>Entries</label>
        </div> 
        <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "" border="1">
            <thead>
                        <tr>
                            <th rowspan="2">Relationship</th>
                            <th colspan="2" style="text-align: center;">Opening Balance</th>
                            <th colspan="2" style="text-align: center;">Buy/Sell</th>
                           <!--  <th rowspan="2">Esop</th> -->
                            <th colspan="2" style="text-align: center;">Closing Balance</th>
                            <th rowspan="3">Action</th>
                        </tr>
                        <tr>
                            
                            <th>Equity</th>
                            <th>ADRs</th>
                          <!--   <th>Debenture</th> -->
                            <th>Equity</th>
                            <th>ADRs</th>
                          <!--   <th>Debenture</th> -->
                            <th>Equity</th>
                            <th>ADRs</th>
                          <!--   <th>Debenture</th> -->
                            
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

<div id="Mymodaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Relationship</h4>
      </div>
        <div class="modal-body">
            <form action="relholdingsummary/insertholdingsummry" autocomplete="off" id="insertholdingsummry" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="relid" class="relid" id="relid" value="">
                  <section class="col col-md-6 col-xs-6">
              <label class="control-label">Select Relationship</label>
            <div class="input">
                <select id="relationship" name="relationship" class="form_fields form-control col-md-7 col-xs-12 validatorsid"  
                 onchange="GetSelectedTextValue(this)" required>
                  <option value="1">HUF</option>
                  <option value="2">Spouse</option>
                  <option value="3">Father</option>
                  <option value="4">Mother</option>
                  <option value="5">Brother</option>
                  <option value="6">Sister</option>
                   <option value="7">Son</option>
                  <option value="8">Daughter</option>
                  <option value="9">Son's Wife</option>
                  <option value="10">Daughter's Husband</option>
                  <option value="11">Others</option>
                </select>
            </div>
        </section>
          

                      <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">Name Of Relationship*</label>
                                <input type="text" id="name" name="name" class="form_fields form-control col-md-7 col-xs-12" readonly required>
                            </div>
                        </section>
                
                        <section class="col col-md-6 col-xs-6">
                            <div class="input">
                                <label class="control-label">No. Of Shares</label>
                                <input type="text" id="noofshares" name="noofshares" class="form_fields form-control col-md-7 col-xs-12" required>
                            </div>
                        </section>
                
                       <section class="col col-md-6 col-xs-6">
                        <div class="input">
                            <label class="control-label">Type Of Security</label>
                            <select id="sectype" name="sectype" class="form_fields form-control col-md-7 col-xs-12" required>
                            <option value=""  >Select Security</option>
                            <?php foreach($sectype as $rel){  ?>
                            <option value="<?php echo $rel['id']; ?>"><?php echo $rel['security_type']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                       </section>
                <div class="control-label btnsubmitme cntrol_tab_one col-md-12 col-xs-12">

                <div class="floatright">
                <input type="submit" class="btn btn-primary updateme floatleft" value="Save" >

                    <button type="button" class="btn btn-default btn-default-one" data-dismiss="modal">Close</button>
                </div>
                </div>

          </form>
      </div>


      </div>
    </div>
</div>

<div id="Mymodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Content</h4>
      </div>
        <div class="modal-body">
            <form action="relholdingsummary/updateholdingsummry" autocomplete="off" id="updateholdingsummry" class="nishana" method="post" enctype="multipart/form-data">
           
                <input type="hidden" name="tempid" class="tempid" id="tempid" value="">
                       
                <section class="col col-md-6 col-xs-6">
                    <div class="input">
                        <label class="control-label">Equity shares Opening Balance</label>
                        <input type="text" id="equity" name="equity" class="form_fields form-control col-md-7 col-xs-12" required>
                    </div>
                </section>
                
                <section class="col col-md-6 col-xs-6">
                    <div class="input">
                        <label class="control-label">ADRs Opening Balance</label>
                        <input type="text" id="prefernc" name="prefernc" class="form_fields form-control col-md-7 col-xs-12" required>
                    </div>
                </section>
                
              <!--   <section class="col col-md-6 col-xs-6">
                    <div class="input">
                        <label class="control-label">Debentures Opening Balance</label>
                        <input type="text" id="debenture" name="debenture" class="form_fields form-control col-md-7 col-xs-12" required>
                    </div>
                </section> -->
                        
                        
                       
                        
                    

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

