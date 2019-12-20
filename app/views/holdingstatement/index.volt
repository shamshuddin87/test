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
     

    <h1 class="h1_heading text-center">Holding Statement</h1>
    <div class="containergrid">       
        <div class="formcss">                           
            <div class="typography form_pad">
                <div class="formelementmain"> 
                    <h3 class="h1_heading text-center" style="text-align:left;">Upload Monthly Demat/Trade Details</h3>
                    <form id="insertholdingstatement" action="holdingstatement/insertholdingstatement" method="post" enctype="multipart/form-data" autocomplete="off" > 
                        
                        <section class="col col-md-4 col-xs-4">
                            <label class="control-label">Month</label>
                            <div class="input">
                                <select id="month" name="month" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Month</option>
                                    <?php for($m=1; $m<=12; ++$m){?>
                                    <option value="<?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option> 
                                        
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-4">
                            <label class="control-label">Year</label>
                            <div class="input">
                                <select id="year" name="year" class="form_fields form-control col-md-7 col-xs-12" required>
                                    <option value="">Select Year</option>
                                    <?php foreach(range(2018, (int)date("Y")) as $year){?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
   
                                    <?php } ?>
                                </select>
                            </div>
                        </section>
                        
                        <section class="col col-md-4 col-xs-4">
                        <div class="input">
                        <label class="control-label">Upload File</label>
                            <div class="choose_files">
                                <input type="file" name="hldngfile" id="hldngfile" >
                            </div>
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
                <table class="table datatable-responsive" class="templatetbl" id="datableabhi" dtausi = "">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Download File</th>
                            <th>Last Updated</th>
                            <th>Action</th>
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


