<?php $gmnlog = $this->session->loginauthspuserfront; 
//print_r($gmnlog);exit;?>
   


<!-- Main content -->


<!-- ########################################## PageContent Start ########################################## --> 

<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom_fl">

<!-- Agreements in Draft --->
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-2">
                            <h1 class="page-header">Dashboard</h1>
                             <input type="text" name="firstlogin" id="firstlogin" value="<?php echo $login['firstlogin'] ?>" style = "display: none;">
                        </div>
                        <?php if(isset($upsiresult) && count($upsiresult) != 0){?>
                        <div class="col col-xs-10">
                           <!--  <div class="alertbox"><span><h4 style="display: inline-block;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </h4> Alert! You hold UPSI and therefore you cannot trade in shares of Dr. Reddy's Laboratories Ltd until the UPSI ends / becomes public</span>
                            </div> -->
                        </div>
                        <?php } ?>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row boxes -->

                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6">
                            <div class="announcementdiv">
                                <h4>Announcement</h4>
                                <ul>
                                  
                                   <?php if(isset($upsiresult) && count($upsiresult) != 0){?>
                                    <li>
                                        <div class="announcementli">
                                            <a >
                                               <h6>Alert!</h6>
                                               <p>You hold UPSI and therefore you cannot trade in shares of Dr. Reddy's Laboratories Ltd until the UPSI ends/becomes public.</p>

                                            </a>
                                        </div>
                                    </li>
                                   <?php }?>
                                    
                                    <li>
                                        <div class="announcementli">
                                            <a>
                                               <h6>Trading Window Closure</h6>
                                               <?php if(!empty($tradingwindw)){ 
                                               foreach($tradingwindw as $ntnlval){ 
                                               ?>
                                               <p>
                                                 
                                                 <p class=""> <i class="fas fa-circle" style="margin-right: 5px;"></i><span>Date From:<?php echo $ntnlval['datefrom']; ?></span></p>
                                                <p class="margin_left"> <span style="margin-left: 16px;">Date To:<?php echo $ntnlval['dateto']; ?></span></p> 
                                               </p>
                                                <?php } } else{ ?>
                                                <p>No New Window Closure..!!</p>
                                                <?php  }  ?>

                                            </a>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="row">
<!--
                        <div class="col-lg-3 col-md-6" id="restcomplist">
                            <a href="restrictedcompany/companytradingperiod">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-ban fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge" id="complist"></div>
                                            <div class="text_name">Restricted Company List</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            </a>
                        </div>
                 
-->
<!--
                        <div class="col-lg-3 col-md-6" id="pendappvl">
                        
                            <a href="tradingrequest?status=<?php print_r(base64_encode('not_approved'));?>">
                            
                                <div class="panel panel-blue">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-check-circle fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge" id="appvlpend"></div>
                                          <div class="text_name">Request Pending Approval</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                 </div>
                            </a>
                        </div>
                      
                    
                        <div class="col-lg-3 col-md-6" id="posttrade">
                          <a href="tradingrequest?status=<?php print_r(base64_encode('trade_completed')); ?>">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-line-chart fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">0</div>
                                        <div class="text_name">Post Trade Confirmation</div> 
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                              </a>
                        </div>
                        <div class="col-lg-3 col-md-6" id="depndreltve">
                            <a href="employeemodule?from=<?php print_r(base64_encode('dash')); ?>">
                            <div class="panel panel-purple">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge" id="reltvlist"></div>
                                       <div class="text_name">Dependent Relative</div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                </div>
                            </div>
                            </a>
                        </div>
-->
                      
                         
                    </div>
                    <!-- /.row boxes -->

                   <div class="float_div"> 
                    <div class="row">
                        
                        <!-- <div class="col-md-7"><h1 class="page-header">Holding Statement</h1></div> -->

                        <!--<div class="col-lg-7 col-sm-12 holding_1024">
                            <h1 class="page-header">Holding Summary</h1>
                            <div class="panel panel-default holding">
                                <!-- /.panel-heading -->
                                <!--<div class="panel-heading">
                                </div>
                                <!-- /.panel-body -->
                                <!--<div class="panel-body">
                                    <div class="table-responsive">
                                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row"></div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-12" id="holdingsummary">
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="2" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 212px;">Company Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 245px; text-align:center;" colspan="3">Closing Balance</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Equity Shares</th>
                                                        <th>ADRs Shares</th>
<!--                                                        <th>Debentures</th>-->
                                                    <!--</tr>
                                                </thead>
                                                <tbody class ="holdingsummry">

                                                </tbody>
                                            </table>
                                            <a href="holdingsummary"><button class="viewmore">View More</button></a>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                 <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        
                        
                     <!--pending task-->
<!--
                     <div class="col-md-5 bg-task">
                             <h1 class="page-header">Pending Task</h1>
                              
                                
                                           <span class="click_board click_board3"></span>
                             <ul class="nav_child_menu" style="display:block">
                                 
                                  <li>
                                     <span href="#" class="task_a">
                                       <i class="" id="cmp_mst"></i>
                                     <div class="box_white">  
                                         <h4>Update Demat Statement</h4>
                                         <abbr class="day">5th of every month</abbr>
                                         <p>Please upload monthly Demat Statement</p>
                                    </div>
                                    </span>
                                    </li> 
                            <a href="tradingrequest?status=<?php print_r(base64_encode('trade_pending')); ?>">        
                                <li>
                                    <span href="portfolio" class="task_a">
                                        <i class=""></i>
                                        <div class="box_white">  
                                             <h4>Post Trade Confirmation</h4>
                                             <abbr class="day">5 trade confirmations pending</abbr>
                                             <p>Update your trades in software and attach broker note</p>
                                        </div>
                                    </span>
                                </li>
                            </a>
                        <a href="tradingrequest?status=<?php print_r(base64_encode('drafted')); ?>">
                          <li class="bottomulmn">
                           <span  href="tradingrequest?redirect=1" class="task_a">
                                <i class=""></i>
                               <div class="box_white"> 
                                     <h4>Send Request for Approval</h4>
                                         <abbr class="day">5 Requests Pending</abbr>
                                         <p>You have draft requests pending to be sent for approval</p>
                                    </div>
                                  
                                </span>
                            </li>
                        </a>
                        <?php if($gmnlog['user_group_id']!=14){ ?> 
                            <a href="tradingrequest/reqview?status=<?php print_r(base64_encode('not_approved')); ?>">
                                <li class="bottomulmn" >
                                    <span href="tradingrequest/reqview" class="task_a">
                                        <i class=""></i> 
                                        <div class="box_white">  
                                                 <h4>Requests Pending Your Approval</h4>
                                                 <abbr class="day">5 Requests Pending</abbr>
                                                 <p>Please approve requests sent by subordinates to you</p>
                                        </div>
                                    </span>
                                </li>
                            </a>
                        <?php } ?>
                              </ul> 
                     </div>
-->

                     <!-- <div class="col-md-5"><h1>Pending Task</h1></div> -->
                     <!--  <div class="col-md-5 bg-task">
                             <h1 class="page-header">Pending Task</h1>
                                <ul class="nav side-menu">
                                     <li class="topulmn ">
                                           <span class="click_board click_board3"></span>
                             <ul class="nav_child_menu" style="display:block">
                                 
                                  <li>
                                     <span href="#" class="task_a">
                                       <i class="" id="cmp_mst"></i>
                                     <div class="box_white">  
                                         <h4>Update Demat Statement</h4>
                                         <abbr class="day">5th of every month</abbr>
                                         <p>Please upload monthly Demat Statement</p>
                                    </div>
                                    </span>
                                    </li> 
                                    
                             <li >
                               <span href="portfolio" class="task_a">
                               <i class=""></i>
                           <div class="box_white">  
                                         <h4>Post Trade Confirmation</h4>
                                         <abbr class="day">5 trade confirmations pending</abbr>
                                         <p>Update your trades in software and attach broker note</p>
                                    </div>
                             </span>
                         </li>
                          <li class="bottomulmn" >
                     
                           <span  href="tradingrequest?redirect=1" class="task_a">
                                <i class=""></i>
                               <div class="box_white"> 
                                     <h4>Send Request for Approval</h4>
                                         <abbr class="day">5 Requests Pending</abbr>
                                         <p>You have draft requests pending to be sent for approval</p>
                                    </div>
                                  
                                </span>
                            </li>
                                       <?php if($gmnlog['user_group_id']!=14){ ?> 
                          <li class="bottomulmn" >
                           <span href="tradingrequest/reqview" class="task_a">
                               <i class=""></i> 
                           <div class="box_white">  
                                         <h4>Requests Pending Your Approval</h4>
                                         <abbr class="day">5 Requests Pending</abbr>
                                         <p>Please approve requests sent by subordinates to you</p>
                                    </div>
                         </span>
                     </li>
                                        <?php } ?>
                              </ul> 
                                   </li>      
                       </ul> 
                     
                     </div> -->
                      <!--pending task-->


                        </div>
                       
                    </div>
                </div>
                    <!-- /.row -->

                  <!-- last boxes -->
                <div class="row">
<!--
                  <div class="container-fluid">      
                    <div class="boxes">
                                 <div class="col-container">
                                     <div class="col-md-2 col-sm-4 col-xl-6">
                                        <a href="tradingrequest?redirect=<?php print_r(base64_encode('modal')); ?>">
                                         <section class="col panel left-border1 panel-featured-left panel-featured-primary">
                                            <div class="panel-body">
                                              <div class="widget-summary">
                                                 <div class="widget-summary-col widget-summary-col-icon">
                                              <div class="summary-icon bg-one">
                                              <i class="fa fa-life-ring"></i>
                                        </div>
                                   </div>
                               <div class="widget-summary-col">
                            <div class="summary">
                         <h4 class="title center cre">Create Request for Approval</a></h4>
                       <div class="info">
 <strong class="amount">1281</strong>
<span class="text-primary">(14 unread)</span> 
        </div>
            </div>
            
                </div>
                      </div>
                          </div>
-->
<!--
                            </section>
                         </a>
                            </div>
-->
<!--
                                <div class="col-md-2 col-sm-4 col-xl-6">
                                    <a href="holdingstatement">
                                    <section class="col panel left-border2 panel-featured-left panel-featured-secondary">
                                    <div class="panel-body">
                                        <div class="widget-summary">
                                            <div class="widget-summary-col widget-summary-col-icon">
                                              <div class="summary-icon bg-two">
                                                  <i class="fas fa-tasks"></i>
                                                </div>
                                                   </div>
                                                      <div class="widget-summary-col">
                                                     <div class="summary">
                                                         <h4 class="title">Update Holding Statement</h4>
                                                 <div class="info">
                                                <strong class="amount">$ 14,890.30</strong>
                                                </div> 
                                                       </div>
                                                    
                                                  </div>
                                                 </div>
                                                </div>
                                            </section>
                                        </a>
                                            </div>
-->
<!--
                             <div class="col-md-2 col-sm-4 col-xl-6">
                                 <section class="col panel left-border3 panel-featured-left panel-featured-tertiary">
                                     <div class="panel-body">
                                         <div class="widget-summary">
                                            <div class="widget-summary-col widget-summary-col-icon">
                                          <div class="summary-icon bg-three">
                            <i class="fa fa-line-chart"></i>
                              </div>
                                 </div>
                                     <div class="widget-summary-col">
                                        <div class="summary">
                             <h4 class="title">Trade Exception approval</h4>
                             <div class="info">
                            <strong class="amount">38</strong>
                            </div> 
                               </div>
                                   
                            </div>
                        </div>
                    </div>
            </section>
        </div>
-->
                            
<!--
          <div class="col-md-2 col-sm-4 col-xl-6">
             <section class="col panel left-border4 panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-four">
                        <i class="fa fa-users"></i>
                        </div>
                    </div>
                            <div class="widget-summary-col">
                               <div class="summary">
                                  <h4 class="title">Pending From Subordinates</h4>
                             <div class="info">
                            <strong class="amount">3765</strong>
                            </div> 
                            </div>
                                
                            </div>
                    </div>
                </div>
             </section>
        </div>
-->


<!--
        <div class="col-md-2 col-sm-4 col-xl-6">
            <a href="holdingstatement">
             <section class="col panel left-border5 panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-four">
                        <i class="fa fa-handshake-o"></i>
                        </div>
                    </div>
                            <div class="widget-summary-col">
                               <div class="summary">
                                  <h4 class="title">Check Holding Statement</h4>
                             <div class="info">
                            <strong class="amount">3765</strong>
                            </div> 
                            </div>
                               
                            </div>
                    </div>
                </div>
             </section>
         </a>
        </div>
-->

<!--
<div class="col-md-2 col-sm-4 col-xl-6">
      <a href="sensitiveinformation/infosharing">
       <section class="col panel left-border6 panel-featured-left panel-featured-quartenary">
          <div class="panel-body">
              <div class="widget-summary">
                  <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-four">
                  <i class="fa fa-info-circle"></i>
                  </div>
              </div>
                      <div class="widget-summary-col">
                         <div class="summary">
                            <h4 class="title">UPSI & Connected Person</h4>
                       <div class="info">
                      <strong class="amount">3765</strong>
                      </div> 
                      </div>
                          
                      </div>
              </div>
          </div>
       </section>
   </a>
 </div>
-->
    </div>
            </div>
                </div>
                    <!--last boxes end -->


        </div>
    </div>
                <!-- /.container-fluid -->
            </div>
                          
   
              
        </div>
       </div>
      </div>


        <div id="updateholdings" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>                    
                     <h5 style="text-align: center;color: #000;margin: 45px 35px 25px 35px;line-height: 25px;">Please verify/update your personal information as given under ‘My Info’ first. You will not be allowed access until you verify your personal information</h5>
                  </div>
                  <div class="modal-footer" style="border-top:none; text-align: center;">
                     <button type="button" class="btn btn-primary" id="yesdisclosures" onclick="disclosures(this.id);">Ok</button> 
<!--<button style="color: #522c8f !important;border-color: #cecece;"  type="button" class="btn btn-default" id="nodisclosures" onclick="disclosures(this.id);">No</button> -->
                  </div>
               </div>
            </div>
        </div>

 <!-- check personal details and demat account info at login Modal -->     
<div id="declaration" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 style=" color: #36186e;">Hello</h1>
                <h4 style="margin-bottom: 10px;margin-top: 5px;font-size: 20px;color: #8a8a8a;"> <?php echo $gmnlog['username'] ?>,</h4>
                <div class="arng">
                </div>
            </div>
        </div>
    </div>
</div>          
