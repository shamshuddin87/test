<?php
$gettyp = 'empl';
$getuserid=$this->session->loginauthspuserfront['id'];
$gettypm = $this->session->loginauthspuserfront;
$gettermscond =$this->termsandconditionscommon->getalluserfiles($getuserid);
$notification =$this->notificationcommon->getallnotification($getuserid);
 // print_r($gettermscond[0]['filetitle']);
 // print_r($notification);exit;
?>

       
<div class="col-md-3 left_col">
<div class="left_col scroll-view">
   
    <div class="navbar nav_title nav_bg" style="border: 0;">
      <a href="https://www.volody.com/user/home" class="site_title">
        <i><img src="img/logo_responsive.png"></i>
        <span><img src="img/logo.png" alt=""></span>
      </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
        <i class="img-circle profile_img fa fa-user"></i>
      </div>
      <div class="profile_info">
        <h2><?php echo $gettypm['username'];?></h2>
        <span><?php echo $gettypm['email'];?></span>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br />
           
            
    <!-- sidebar menu Start -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">

             <?php if($gettypm['user_group_id']=='14' || $gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='7') {?>
              <li>
                  <a href="home"><i class="fa fa-single fa-home" id="home_icon"></i>Home</a>
              </li>
            
             <?php  } ?>

              <?php if($gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='14'|| $gettypm['user_group_id']=='7'){ ?>


                <li>
                  <a class="click_board click_board3" href="javascript:;"><i class="fa fa-edit"></i> Masters <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
               
             <?php if($gettypm['user_group_id']=='2'){ ?>
             
              <li>
                  <a href="companymaster"><i class="" id="cmp_mst"></i>Company Master</a>
               </li> 
               
               <li><a href="departmentmaster"><i class=""></i>Department Master</a></li>
                    
                <li><a href="usermaster"><i class=""></i>User Master</a></li>

              <?php  } ?>
                 <li><a href="upsimaster"><i class=""></i> Type of UPSI</a></li> 

             
               <!--  <li><a href="usermaster/userview"><i class="fa fa-eye"></i>View Users</a></li>   -->
            
            
             </ul> 
            </li>
            
           <!--    <li>
                  <a class="click_board click_board3" href="javascript:;"><i class="fa fa-ban fa-5x"></i>Restricted Company List<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
               
             
             
              <li>
                  <a href="restrictedcompany/companytradingperiod"><i class="fa fa-building " id="cmp_mst"></i>
                    <p>Company Trading Restriction</p></a>
               </li> 
               
               <li><a href="restrictedcompany/employeeblocking"><i class="fa fa-group"></i>
                <p>Employee Specific Blocking</p></a></li>
            
            
             </ul> 
            </li> -->
          
             <li>
               <a href="companymodule"><i class="fa fa-file-excel-o" ></i>Listed Company Module</a>
             </li> 
             
              <li>
               <a href="approvelperinfo"><i class="fa fa-eye"></i>View Personal Info</a>
             </li>   
             
            <li>
               <a href="tradingrequest/reqview"><i class="fa fa-eye" id="viewreq"></i>View request</a>
             </li>  

               <li>
                 <a href="exceptionreq/exception_req"><i class="fa fa-eye"></i>View Exception request</a>
                </li> 
              
              <li>
                  <a class="click_board click_board3" href="javascript:;"><i class="glyphicon glyphicon-cog"></i>Admin Module<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
               
             
             
              <li>
                  <a href="adminmodule"><i class="" id="cmp_mst"></i>Module Access</a>
               </li> 
               
               <li><a href="adminmodule/tradingdays"><i class=""></i>Trading Days</a></li>

                 <li><a href="adminmodule/autoaprove"><i class=""></i>Auto Approval Shares</a></li>
                    
             </ul> 
            </li>
            


              
            
            
              <li>
                  <a class="click_board click_board3" href="javascript:;"><i class="fa fa-edit"></i>UPSI Sharing<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
               
             
             
              <li>
                  <a href="sensitiveinformation/recipient"><i class="" id="cmp_mst"></i>Connected Person</a>
               </li> 
               
               <li><a href="sensitiveinformation/upsi_infosharing"><i class=""></i>Information Sharing</a></li>
                    
            
            
             </ul> 
            </li>
             <li>
            <a class="click_board click_board3" ><i class="fa fa-line-chart fa-5x"></i> Holding Summary<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu"> 
                    <li>
                    <a href="holdingsummary"><i class="" id="cmp_mst"></i>My Holding Summary</a>
                    </li>

                    <li>
                    <a href="relholdingsummary"><i class="" id="cmp_mst"></i>Relative Holding Summary</a>
                    </li> 
                </ul> 
        </li>
      
            <li>
               <a href="blackoutperiod"><i class="fa fa-ban fa-5x" id="cmp_mst"></i>Trading Window</a>
             </li>
             <li>
               <a href="tradingplan"><i class="fa fa-edit fa-5x" id="cmp_mst"></i>Trading Plan</a>
             </li> 
            <li>
               <a href="tradingplan/planreqstview"><i class="fa fa-eye" id="cmp_mst"></i>View Trade Plan</a>
             </li>
           

        <?php } ?>

    <!-----------------------------------EMPLOYEE MODULE--------------------------------------->
      <?php if($gettypm['user_group_id']=='14'  || $gettypm['user_group_id']=='2') {?>
           <li>
            <a class="click_board click_board3" href="javascript:;"><i class="glyphicon glyphicon-cog"></i>MIS<span class="fa fa-chevron-down"></span></a>
             <ul class="nav child_menu">
<!-- 
                   <li><a href="mis"><i class="glyphicon glyphicon-paperclip"></i> Designated Person Mis</a></li>
                   <li><a href="mis/mis_recipient"><i class="fa fa-building"></i> Connected Person</a></li>
                   <li><a href="mis/mis_infosharing"><i class="fa fa-group"></i> UPSI Sharing</a></li> -->

                   <li><a href="mis"><i class=""></i> Master MIS</a></li>
                   <li><a href="mis/mis_recipient"><i class=""></i> Connected Person</a></li>
                   <li><a href="mis/upsitypeclassify"><i class=""></i> UPSI Sharing</a></li>
                   <li><a href="mis/mis_annualdiscsr"><i class=""></i>Annual Disclosures</a></li>
                   <li><a href="mis/mis_initialdiscsr"><i class=""></i>Initial Disclosures</a></li>
                   <li><a href="mis/mis_formc"><i class=""></i>Form C</a></li>
                   <li><a href="mis/mis_confirmtrade"><i class=""></i>Confirmation of Trade</a></li>
                   <li><a href="mis/mis_formpct"><i class=""></i>Form PCT</a></li>
                   <li><a href="mis/mis_nonexetrade"><i class=""></i>Non-Execution of Trade</a></li>
                   <li><a href="mis/mis_contratrd"><i class=""></i>Contra Trade</a></li>
                   <li><a href="mis/mis_changedesprsn"><i class=""></i>Change in Designated Persons</a></li>

            </ul> 
          </li>

    <?php } ?>

     <ul class="nav side-menu">

     <?php if($gettypm['user_group_id']=='14'  || $gettypm['user_group_id']=='7') {?>
            
        <li>
          <a class="click_board click_board3" href="javascript:;"><i class="fa fa-edit"></i> My Info<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
            
               <li><a href="employeemodule"><i class="" id="cmp_mst"></i>Personal information</a></li> 
               
               <li><a href="portfolio"><i class=""></i>Demat Accounts</a></li>
               

               <li><a href="tradingrequest"><i class=""></i>Request</a></li>

             <!--     <li><a href="initialdeclaration"><i class=""></i>Initial Declaration</a></li>  -->  


            <?php if($gettypm['user_group_id']=='14' || $gettypm['user_group_id']=='2'){?>

             <li><a href="tradingrequest/reqview"><i class="" id="viewreq"></i>View request</a></li>  
                
            <?php } ?>
               
            <li><a href="exceptionreq"><i class=""></i>Exception Request</a></li>
                
            <?php if($gettypm['user_group_id']=='14' || $gettypm['user_group_id']=='2'){?>

            <li><a href="exceptionreq/exception_req"><i class=""></i>View Exception request</a></li>
             <li> <a href="approvelperinfo"><i class=""></i>View Personal Info Request</a></li>


                
            <?php } ?>

               <li><a href="holdingstatement"><i class=""></i>Holding Statement</a></li>
                
                <li><a href="declarationform"><i class=""></i>Declaration Form</a></li>    
                 <li><a href="initialdeclaration"><i class=""></i>Initial Declaration</a></li>
                <li><a href="annualdeclaration"><i class=""></i>Annual Declaration</a></li>   
            </ul> 
        </li>
         
   <!--       <li><a class="click_board click_board3" href="javascript:;"><i class="fa fa-ban fa-5x"></i>Restricted Company List<span class="fa fa-chevron-down"></span></a>
            
            <ul class="nav child_menu">
             <li>
                  <a href="restrictedcompany/companytradingperiod"><i class="fa fa-building " id="cmp_mst"></i>
                    <p>Company Trading Restriction</p></a>
             </li> 
               
             <li><a href="restrictedcompany/employeeblocking"><i class="fa fa-group"></i><p>Employee Specific Blocking</p></a></li>
  
            </ul> 
         </li> -->
         <li><a class="click_board click_board3" href="javascript:;"><i class="fa fa-share-alt"></i>UPSI Sharing<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
             <li>
                  <a href="sensitiveinformation/recipient"><i class="" id="cmp_mst"></i>Connected Person</a>
             </li> 
              <li><a href="sensitiveinformation/upsi_infosharing"><i class=""></i>
                <p>Information Sharing</p></a></li>
     
             </ul> 
          </li>
          <li>
            <a class="click_board click_board3" ><i class="fa fa-line-chart fa-5x"></i>Share Holding Summary<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu"> 
                    <li>
                    <a href="holdingsummary"><i class="" id="cmp_mst"></i>My Holding Summary</a>
                    </li>

                    <li>
                    <a href="relholdingsummary"><i class="" id="cmp_mst"></i>Relative Holding Summary</a>
                    </li> 
                </ul> 
        </li>
      
         <li>
               <a href="blackoutperiod"><i class="fa fa-ban fa-5x" id="cmp_mst"></i>Trading Window</a>
             </li> 
         <li>
               <a href="tradingplan"><i class="fa fa-edit fa-5x" id="cmp_mst"></i>Trading Plan</a>
             </li> 
         
       
         
           <?php } ?>

            <?php if($gettypm['user_group_id']=='2'){  ?>
            <li>
               <a href="termsandconditions"><i class="fa fa-edit" ></i>Resources</a>
             </li> 
           <?php }  ?>
         
          
   
         <?php if($gettypm['user_group_id']=='14'){  ?>
            <li>
               <a href="tradingplan/planreqstview"><i class="fa fa-eye" id="cmp_mst"></i>View Trade Plan</a>
             </li>
         <?php }  ?>

         <?php if($gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='14'){  ?>
         <li>
               <a href="reconcilation"><i class="fab fa-artstation" ></i> RTA Reconciliation</a>
             </li> 
         
         <li>
               <a href="esop"><i class="fa fa-file-excel-o" ></i>ESOP</a>
             </li>
         
         <?php }  ?>
         
         <?php if($gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='14' || $gettypm['user_group_id']=='7'){  ?>
         
           <li><a class="click_board click_board3" href="javascript:;"><i class="fa fa-file-pdf-o"></i>SEBI Form<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
             <li>
                  <a href="sebi/formb"><i class="fa fa-file-pdf-o" id=""></i>FORM B</a>
             </li> 
                <?php if($gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='14'){  ?> 
                    <li>
                      <a href="sebi/viewformb"><i class="fa fa-eye" id=""></i>Approve FORM B Request</a>
                 </li>
                <?php } ?>
                <li>
                  <a href="sebi/transformc"><i class="fa fa-file-pdf-o" id=""></i>FORM C</a>
             </li>
                 
                <?php if($gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='14'){  ?> 
                    <li>
                      <a href="sebi/viewformc"><i class="fa fa-eye" id=""></i>Approve FORM C Request</a>
                 </li>
                <?php } ?>
                 <li>
                  <a href="sebi/transformd"><i class="fa fa-file-pdf-o" id=""></i>FORM D</a>
             </li> 
                <?php if($gettypm['user_group_id']=='2' || $gettypm['user_group_id']=='14'){  ?> 
                    <li>
                        <a href="sebi/viewformd"><i class="fa fa-eye" id=""></i>Approve FORM D Request</a>
                    </li>
                <?php } ?>
              
     
             </ul> 
          </li>
         
         <?php }  ?>
         
         <?php if($gettypm['user_group_id']=='14'  || $gettypm['user_group_id']=='2') {?>
            <li><a href="sharecapital"><i class="fa fa-line-chart fa-5x" id="excelup"></i>Share Capital</a></li> 
         <?php }  ?>
        <!----------------------------------------------------------------------------------------------->

    </li>            
   </ul>
 </div>
 </div>
    <!-- /sidebar menu End -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <!--<a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>-->
    <!--   <a href="accountsetting" data-toggle="tooltip" data-placement="top" title="Profile">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
      </a> -->
      <!--<a href="accountsetting" data-toggle="tooltip" data-placement="top" title="Account Settings">
        <span class="fa fa-cog fa-spin" aria-hidden="true"></span>
      </a>-->
      <a href="login/logout" data-toggle="tooltip" data-placement="top" title="Logout" href="logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
            
</div>
</div>

       
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

    <ul class="nav navbar-nav navbar-right">

        <!-- profile div start -->
      
      

        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="hdrun fa fa-user"></i><?php echo $gettypm['username'];?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <!-- <li><a href="accountsetting"> Profile</a></li> -->
            <!--<li>
              <a href="accountsetting">
                <span class="badge bg-red pull-right">50%</span>
                <span>Account Settings</span>
              </a>
            </li>-->
            <li><a href="login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>


          <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="hdrun fa fa-edit"></i>Resources
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
             
             <?php if(!empty($gettermscond)){for($i=0;$i<count($gettermscond);$i++){  ?>
             <li><a  href="<?php print_r($gettermscond[$i]['file']);?>">
              <i class="fa fa-download" style="font-size:15px;color:black;">
                <p class="in"><?php print_r($gettermscond[$i]['filetitle']);?></p> 
              </i>
            </a>
          </li>
           <?php } }else { echo "<p class='in'>Resources Not Found..!!!</p>";  }   ?>
             
          </ul>
        </li>
        <!-- profile div end -->
       
        <!--notification open div-->
          <?php if(!empty($notification)) {
            echo '<li role="presentation" class="dropdown"><a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">'.count($notification).'<i class="fa fa-bell"></i></a>';
          }else{
              echo '<li role="presentation" class="dropdown"><a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i></a>';
              }?>

        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
                <a>                        
                    <div class="grid-container6 mnnmp">
                    <div class="">
                      <?php if(!empty($notification))
                      {

                          for($i=0;$i<count($notification);$i++)
                          {
                              echo '<div class="dropdown-header"><span class="heading">'.$notification[$i]["content"].'</span></div><br/>';
                          }
                          
                       
                      ?>
                      <?php }else{?>
                     
                      <div class="dropdown-header"><span class="heading">Notifications (Today's)</span>
                      <span class="count ng-binding" id="dd-notifications-count">0</span></div>
                    
                      <?php  } ?>
                      
                      </div>
                      <div class="top_blo_center dropdown-body"></div> 
                      <div class="top_blofff_center"></div>    
                    </div>
                </a>
            </li>
        </ul>
        </li>

        
        <!--notification div close-->

        <!-- search div start -->
        <!--<li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa fa fa-search"></i>
            </a>
        </li>-->
        <!-- search div end -->

    </ul>                  
    </nav>
  </div>
</div>
<!-- /top navigation -->


