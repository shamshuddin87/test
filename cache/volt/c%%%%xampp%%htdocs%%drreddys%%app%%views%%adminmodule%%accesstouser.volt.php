<?php $gmnlog = $this->session->loginauthspuserfront; ?>


<!-- Main content -->


<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">
<div class="mainelementfom">


          <button type="button" class="btn btn-primary uptbtn"  id="upsi_conn_per" value="Submit">Update</button>
          <input type="hidden" name="getuserid" class="getuserid" id="getuserid" value="<?php print_r($userid); ?>">
            <h1 class="h1_heading text-center">UPSI Access</h1>
              <div class="containergrid">
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-inverse" id="datablerushi">
                          <thead>
                            <tr>
                                <th>Master</th>
                                <th>Add</th>
                                <th>View</th>
                                <th>Edit</th> 
<!--                                <th>Delete</th>-->
                            </tr>
                          </thead>
                          <tbody class="appendrow" appendrow='1'>
<!--
                          <tr><td><p>Connected Person</p></td>
                          <td>
                             <?php 
                              if($getallaccess[0]['upsi_conn_per_add'])
                              {  
                                     echo '<input type="checkbox" name="upsi_conn_per_add"  value="1" checked/>';
                              }
                              else
                              {
                                     echo '<input type="checkbox" name="upsi_conn_per_add" value="0">';
                              } 
                              ?>
                          </td>
                          <td>
                           <?php 
                             if($getallaccess[0]['upsi_conn_per_view'])
                            {  
                                   echo '<input type="checkbox" name="upsi_conn_per_view" value="1" checked/>';
                            }
                            else
                            {
                                  echo '<input type="checkbox" name="upsi_conn_per_view" value="0" >';
                            } 
                            ?>
                          </td>
                          <td>
                             <?php 
                               if($getallaccess[0]['upsi_conn_per_edit'])
                              {  
                                     echo '<input type="checkbox" name="upsi_conn_per_edit" value="1" checked/>';
                              }
                              else
                              {
                                     echo '<input type="checkbox" name="upsi_conn_per_edit" value="0" >';
                              } 
                              ?>
                          </td>
                          <td>
                               <?php 
                                 if($getallaccess[0]['upsi_conn_per_delete'])
                                {  
                                       echo '<input type="checkbox" name="upsi_conn_per_delete" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="upsi_conn_per_delete" value="0">';
                                } 
                                ?>                            
                          </td> 
                        </tr>
-->


                           <tr><td><p>Information Sharing </p></td>
                           <td>
                           <?php 
                             if($getallaccess[0]['upsi_infoshare_add'])
                            {  
                                   echo '<input type="checkbox" name="upsi_infoshare_add" value="1" checked/>';
                            }
                            else
                            {
                                  echo '<input type="checkbox" name="upsi_infoshare_add" value="0" >';
                            } 
                            ?>
                          </td>

                          <td>
                             <?php 
                               if($getallaccess[0]['upsi_infoshare_view'])
                              {  
                                     echo '<input type="checkbox" name="upsi_infoshare_view" value="1" checked/>';
                              }
                              else
                              {
                                     echo '<input type="checkbox" name="upsi_infoshare_view" value="0" >';
                              } 
                              ?>
                          </td>

                          <td><i class="fa fa-ban"></i></td>

<!--
                          <td>
                               <?php 
                                 if($getallaccess[0]['upsi_infoshare_delete'])
                                {  
                                       echo '<input type="checkbox" name="upsi_infoshare_delete" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="upsi_infoshare_delete" value="0">';
                                } 
                                ?>                            
                          </td> 
-->
                         </tr>
                            
 
                           </tbody>
                      </table>
                  </div>
             </div>                  
        </div>
           

<!--             <button type="button" class="btn btn-primary uptbtn"  id="rest_comp_list" value="Submit">Update</button>-->
<!--
            <h1 class="h1_heading text-center">Restricted Company List</h1>
              <div class="containergrid">
                <div class="panel panel-primary">
                    <div class="table-responsive">
                        <table class="table table-inverse" id="datablerushi">
                          <thead>
                            <tr>
                                <th>Master</th>
                                <th>Add</th>
                                <th>View</th>
                                <th>Edit</th> 
                                <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody class="appendrow" appendrow='1'>
                          <tr><td><p>Company Trading Restriction</p></td>
                          <td>
                             <?php 
                              if($getallaccess[0]['comp_trad_rest_add'])
                              {  
                                     echo '<input type="checkbox" name="comp_trad_rest_add"  class="comp_trad_rest_add"  value="1" checked/>';
                              }
                              else
                              {
                                     echo '<input type="checkbox" name="comp_trad_rest_add"  class="comp_trad_rest_add" value="0">';
                              } 
                              ?>
                          </td>
                          <td>
                           <?php 
                             if($getallaccess[0]['comp_trad_rest_view'])
                            {  
                                   echo '<input type="checkbox" name="comp_trad_rest_view" class="comp_trad_rest_view" value="1" checked/>';
                            }
                            else
                            {
                                  echo '<input type="checkbox" name="comp_trad_rest_view"  class="comp_trad_rest_view" value="0" >';
                            } 
                            ?>
                          </td>
                          <td>
                             <?php 
                               if($getallaccess[0]['comp_trad_rest_edit'])
                              {  
                                     echo '<input type="checkbox" name="comp_trad_rest_edit"  class="comp_trad_rest_edit" value="1" checked/>';
                              }
                              else
                              {
                                     echo '<input type="checkbox" name="comp_trad_rest_edit"  class="comp_trad_rest_edit" value="0" >';
                              } 
                              ?>
                          </td>
                          <td>
                               <?php 
                                 if($getallaccess[0]['comp_trad_rest_delete'])
                                {  
                                       echo '<input type="checkbox" name="comp_trad_rest_delete"  class="comp_trad_rest_delete" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="comp_trad_rest_delete"  class="comp_trad_rest_delete"  value="0">';
                                } 
                                ?>                            
                          </td> 
                        </tr>
                        
                        <tr><td><p>Employee Restriction</p></td>
                        	<td>
                        	<?php 
                                 if($getallaccess[0]['emplblock_add'])
                                {  
                                       echo '<input type="checkbox" name="emplblock_add"  class="emplblock_add" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="emplblock_add"  class="emplblock_add"  value="0">';
                                } 
                                ?>         		
                        	</td>
                            <td>
                        	<?php 
                                 if($getallaccess[0]['emplblock_view'])
                                {  
                                       echo '<input type="checkbox" name="emplblock_view"  class="emplblock_view" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="emplblock_view"  class="emplblock_view"  value="0">';
                                } 
                                ?>         		
                        	</td>
                        	<td>
                        	<?php 
                                 if($getallaccess[0]['emplblock_edit'])
                                {  
                                       echo '<input type="checkbox" name="emplblock_edit"  class="emplblock_edit" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="emplblock_edit"  class="emplblock_edit"  value="0">';
                                } 
                                ?>         		
                        	</td>
                        	<td>
                        	<?php 
                                 if($getallaccess[0]['emplblock_delete'])
                                {  
                                       echo '<input type="checkbox" name="emplblock_delete"  class="emplblock_delete" value="1" checked/>';
                                }
                                else
                                {
                                       echo '<input type="checkbox" name="emplblock_delete"  class="emplblock_delete"  value="0">';
                                } 
                                ?>         		
                        	</td>
                        </tr>

                          
                           </tbody>
                      </table>
                  </div>
             </div>                  
        </div>
-->


<div class="clearelement"></div>
</div>
</div>
</div>
</div>
          
