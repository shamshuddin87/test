<?php ?>
<div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form login_form">
                <section class="login_content">
                    <form class="login-form" method="post" action="forgotpassword/emailchec" autocomplete="off" id="ValidateForgotPassword">
                        <h1>Forgot Your Password</h1>
                        <div class="flormelement">
                            <input id="youremail" class="form-control" type="email" required="required" name="youremail" value="" placeholder="Enter email"/>
                        </div>
                        <div class="flormelement">
                            <input class="btn btn-default loginnowbtn inputcommonbtn floatleft forgot_passwd" type="submit" value="Login" name="login">
                            <div class="clearelement"></div>
                        </div>
                        <div class="errorelement"><div class="geterrorelemttxt"></div></div>
                        <div class="clearfix"></div>
                        <div class="mainprogressbarforall">
                            <div class="headerprogressbar">
                              <div aria-busy="true" aria-label="Loading, please wait." role="progressbarmaterial"></div>
                            </div>
                        </div>
                        <div class="separator">

                            
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <div class="footerlogo">
                                    <!--<div class="centrum_logo">
                                        <img src="img/centrum.jpg" alt="">
                                    </div>-->
                                    <div class="clearelement"></div>
                                </div>
                                
                                <div class="copyright">
                                <div class="">&copy; <?php echo date('Y'); ?> All Rights Reserved. Made with 
                                <i class="fa fa-heart heartcolor"></i> 
                                in Mumbai.
                                </div>
                                <a href="volody.com" class="to_register"> Contact to support </a>
                            </div>
                        </div>
                        </div>    
                    </form>
                    
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            
            <div id="mnfrm" class="animate form registration_form">
                <section class="login_content">
                    
                    <form class="login-form" method="post" action="forgotpassword/pwdlordvishnu" autocomplete="off" id="ValidateForgotPasswordConfirm">
                        <h1>Enter Your Security Code</h1>
                        <p class="center pwdconfirm-form-text">Don't worry Friend</p>
                        <p class="center pwdtext-form-text">Please enter code which we sent you to confirm your email</p>
                        <div class="flormelement">
                            <input autocomplete="off" id="yoursecuritycode" type="tel" required="required" name="yoursecuritycode" value="" maxlength="7" class="noAutoComplete form-control" placeholder="Enter your security code here"  />
                        </div>
                        
                        <div class="flormelement">
                            <input autocomplete="off"  id="passwordnew" type="password" required="required" name="passwordnew" value=""  class="noAutoComplete form-control" placeholder="Your new password" />
                        </div>
                        
                        
                        <div class="flormelement">
                            <input id="emailid" type="hidden" required="required" name="emailid" value="">
                            <input id="useridget" type="hidden" required="required" name="useridget" value="">
                            <input class="btn btn-default confirmnowbtn inputcommonbtn floatleft forgot_passwd" type="submit" value="Confirm" name="getnewpwd">
                            <div class="clearelement"></div>
                        </div>
                        <div class="errorelement"><div class="geterrorelemttxt"></div></div>
                        <div class="clearfix"></div>
                        <div class="mainprogressbarforall">
                            <div class="headerprogressbar">
                              <div aria-busy="true" aria-label="Loading, please wait." role="progressbarmaterial"></div>
                            </div>
                        </div>
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
    </div>
