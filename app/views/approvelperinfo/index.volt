<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<?php //echo"<pre>";print_r($gmnlog); exit;?> 
<!-- Main content -->


<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
    
                <h1 class="h1_heading">Approval For Personal Information</h1>
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
                                    <th>User Name</th> 
                                     <th> Status</th>       
                                     <th>Approved Status</th>                                          
                                     <th>Action</th>
                                </tr>
                              </thead>
                              <tbody class="userdetails" appendrow='1'></tbody>
                            </table>
                      <div class="panel panel-white">
                        <div class="paginationmn"></div>
                        <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                    </div>
                        </div>
                    </div>                  
                </div>
                
</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 
