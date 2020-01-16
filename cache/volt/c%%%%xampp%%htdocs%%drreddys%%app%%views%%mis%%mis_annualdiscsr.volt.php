<?php
$user_group_id = trim($this->session->loginauthspuserfront['user_group_id']);
$gtselctedcmp = $this->session->cmpconmemberdoc;
$condeptsess = $this->session->contractdepartment;
$current_year =  date("Y");
// print_r($getuserinfo);exit;
?>

<!-- Main content -->
<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom "> 
    <h1 class="h1_heading text-center" style="text-align: center;">Annual Disclosures</h1>
    <div class="formcss">                           
                <div class="typography form_pad">
                    
                    <div class="formelementmain">  
                       
                        <div class="clearelement"></div>        
                      
                        <section class="col col-md-12 col-xs-12">
                            <label class="control-label">Select Year</label>
                            <select class="annualyear" id="annualyear">
                                <?php for ($i=1 ; $i <7 ; $i++) { ?>
                                <option value="<?php echo($current_year + $i);  ?>"> <?php echo($current_year + $i);  ?>
                                </option>
                                <?php
                                }
                            ?>
                                </select>
                        </section>


                        <div class="clearelement"></div>                   
                        </div>                                
                </div>                       
                </div>
<div class="table-responsive design_info itntfr" id="annualdisc" itntfr="annualdisc" >
        
        <div class="cssnumrws">
           <span>Show</span>
            <select id="noofrows" name="noofrows" class="noofrows">
               <option value="10">10</option><option value="25">25</option>
                <option value="50">50</option><option value="100">100</option>
             </select> 
        <span>Entries</span>
         <div class="top_margin"><input type="text" placeholder="Search By Name" id="srch" status="0"></div>
        <div class="cssfilter">               
            <div class="control-label form-group">
                <label>Status Filter</label>
                <select id="filterstatus" name="filterstatus" class="form-control">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="sent_for_approval">Sent for approval</option>
                </select>
            </div>
        </div>
        </div>
        <table class="table table-inverse" id="datableabhi7">
             <thead>
               <tr>
                    <th>Sr No.</th> 
                    <th>Name</th> 
                    <!-- <th>Employee ID</th>  -->
                    <th>Year</th>
                    <th>Due for receipt</th>
                    <th>File</th>
                </tr>
             </thead>
            <tbody class="accdetails7" appendrow='1'>   
            </tbody>
        </table> 
        <div class="panel panel-white">
            <div class="paginationmn" id="acc7"></div>
            <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
        </div>
    </div>
    
    

</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
 



</div>

