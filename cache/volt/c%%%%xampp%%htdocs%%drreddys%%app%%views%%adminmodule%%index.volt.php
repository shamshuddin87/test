<?php $gmnlog = $this->session->loginauthspuserfront; ?>

<?php //echo"<pre>";print_r($gmnlog); exit;?> 
<!-- Main content -->


<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">

<div class="mainelementfom">
            <h1 class="h1_heading text-center">Master List</h1>
            <div class="cssnumrws">
             <span>Show</span>
              <select id="noofrows" name="noofrows" class="noofrows">
               <option value="10">10</option><option value="25">25</option>
               <option value="50">50</option><option value="100">100</option>
              </select> 
           <span>Entries</span>
       </div>    
            <div class="containergrid">
                <input type="hidden" class="compnynmad" value="<?php echo $companynmdept;?>">
                <div class="panel panel-primary">

                    <div class="table-responsive">
                        <table class="table table-inverse" id="datablerushi">
                          <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Email</th>
                               <!--  <th>Mobile</th> -->
                                <th>Designation</th>
                                <th>Date Of Becoming Designation Person</th> 
                                <th>Company</th>
                                <th>Department</th>
                                <!-- <th>Reminder Days</th> -->
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="appendrow" appendrow='1'></tbody>
                        </table>
                          <div class="panel panel-white">
                         <div class="paginationmn"></div>
                         <input type="hidden" id="pagenum" name="pagenum" class="pagechnum" value="1">
                    </div>
       
                    </div>
                </div>                  
            </div>
            <div class="clearelement"></div>
            
    
</div>
</div>
</div>
</div>
          
