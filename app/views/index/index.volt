<?php //echo 'login';exit; ?>
<!-- =============================== main container =============================== -->

<!-- Main content -->
<!--<head><script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script></head>-->
<div class="containerfrmenl">
        <div class="loginleftmn"></div>
    
	<section id="contentmnfrm">
       <div class="mainloginfrmrl">  
        <!-- <h1>Contract Agreement</h1> -->
        <div class="volody_logo"><img src="img/drreddys_logo.png" alt=""></div>
        <div class="progress-indeterminate">
                  <div class="indeterminate"></div>
        </div>   
		<form class="login-form floatright" method="post" action="login/loginchec" autocomplete="off" id="ValidateLogin">
			
            <!-- <div class="thumbnail"><img src="img/board-meeting-left.png" class="thmbimgbtn"></div> -->
			<div class="maininputcl">
                <i class="fa fa-user icon_po" aria-hidden="true"></i>
				<input type="text" placeholder="Username" required="" id="username" name="youremail" value="<?php echo $vidmemail; ?>"/>
			</div>
			<div class="maininputcl">
                <i class="fa fa-lock icon_po" aria-hidden="true"></i>
				<input type="password" placeholder="Password" required="" id="password" name="password" value=""/>
			</div>
            <div>
            <input type="hidden" name="loginattempt" id="loginattempt" value="1">
             </div>
			<div class="maininputclbtn">
			  <div class="width_submit"><input type="submit" value="Log in" class="loginnowbtn login"/></div>
				<div class="lost_pass"><a href="forgotpassword" class="reset_pass">Forgot Password</a></div>

            <div class="copyright">
                   <img style="" src="img/logo_login.png" alt="volody">
                    
                <div class="clearelement"></div>
            </div>

                <div class="clearelement"></div>
			</div>
		</form><!-- form -->
           <div class="errorelement"><div class="geterrorelemttxt"></div></div>
           <div class="resetbutton"></div>
           <div class="lostbutton"></div>
			<!-- <div class="copyright">
                <div class="">© 2016 All Rights Reserved. Made with 
                    <i class="fa fa-heart heartcolor"></i> 
                    in Mumbai.
                    </div>
                <div class="clearelement"></div>
            </div> -->
           
        <div class="clearelement"></div>
<!-- 		<div class="button minprogreabbr">
            <div class="progressnew">
                <div class="progressnew-bar">
                    <div class="progressnew-shadow"></div>
                </div>
            </div>    
            <div class="errorelement"><div class="geterrorelemttxt"></div></div>
            <div class="tooltipmn">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
            <a href="mylogin">Request for Demo</a>
		</div> -->
		<!-- button -->
        </div> 
	</section><!-- content -->
    <div class="loginrightmn"></div>
</div><!-- container -->
<!-- /main content -->

<div class="reset" style="display:none;">
    <div id="mnfrm" class="">
                <section class="login_page">
                    <div class="alert alert-info">Your password has expired, please change it.</div>
                    <form class="login-form" method="post" action="login/resetpassword" autocomplete="off" id="resetpassword">
                         <input type="hidden" name="email" id="email" value="">
                        <div class="form-group">
                            <label for="current_password" class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control" name="current_password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required="">
                            </div> 
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value="Reset Password">
                                    
                            </div>
                        </div>
                      
                        <div class="errorelement"><div class="geterrorelemttxt"></div></div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <div class="footerlogo">
                                    <img src="img/logo-admin.png" class=" logomn">

                                    <div class="clearelement"></div>
                                </div>

                                <div class="copyright">
                                    <div class="">&copy; <?php echo date('Y'); ?> All Rights Reserved. Made with 
                                    <i class="fa fa-heart heartcolor"></i> 
                                    in Mumbai.
                                    </div>
                                    <div class="clearelement"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
</div>
		