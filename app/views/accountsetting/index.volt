<?php $gmnlog= $this->session->loginauthspuserfront;
//echo '<pre>'; print_r($gmnlog); exit;
$fname      =  $gmnlog['firstname'];
$lname      =  $gmnlog['lastname'];
$email      =  $gmnlog['email'];
//$mobile     =  $gmnlog['mobile'];
$mobile     =  '';
//$genid      =  $gmnlog['gender_id'];
$genid      =  '';
//$dob        =  $gmnlog['dob'];
$dob        =  '';
?>


<!-- ########################################## PageContent Start ########################################## --> 
<div class="right_col" role="main">
<div class="row">
<div class="content">

<!-- My messages -->
<div class="mainelementfom">
<!-- tabs -->
   
    <div class="wizardform rajuharryironman rajuharryironman-pos-top-left rajuharryironman-anim-fade rajuharryironman-response-to-icons col-md-12">
        <input type="radio" name="rajuharryironman" checked id="rajuharryironman1" class="rajuharryironman-content-1" <?php echo ($getmoc=='acsetting') ? 'checked' : '' ; ?>>
        <label for="rajuharryironman1" class="addnewdedcuteecb"><span><span><i class="fa fa-home"></i>General details</span></span>
        </label>

        

        <input type="radio" name="rajuharryironman"  id="rajuharryironman3" class="rajuharryironman-content-3" <?php echo ($getmoc=='changepwd') ? 'checked' : '' ; ?>>
        <label for="rajuharryironman3" ><span><span><i class="fa fa-home"></i>Change password</span></span>
        </label>



        <ul>

            <li class="rajuharryironman-content-1">
                <div class="rajuharry-form mnparentfile">
                <div class="progress-indeterminate">
                  <div class="indeterminate"></div>
                </div>
            

                <form action="accountsetting/uploadimage" class="floatleft col-md-6" id="Validatelogoupload" method="POST" enctype="multipart/form-data" >

                    <!-- <fieldset class="col-md-12">
                    <section class="col-md-8 imguploadimmg">
                        <label class="label">Upload Your logo</label>
                        <label for="file" class="input input-file">
                            <div class="button">
                                <input type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value" class="uploadimg" data-gotfile='uploadimg-1' name="uploadimage">Browse</div>
                            <input type="text" placeholder="Include some file" readonly class="uploadimg-1">
                        </label>
                    </section>
                    <section class="col-md-3 uploadbntn">    
                    <button type="button" class="button btnmnuploadfl uploadfilebtn" >Upload</button>
                    </section>  
                        <div class="clearelement"></div>
                    <div class="note notegettet">Please upload image with 200px <span class="imgmmmmmn">x</span> 200px and below 1mb file.</div>    
                    </fieldset> 
                    
                    <fieldset class="col-md-12 logoavatar">
                        <div class="logoareavl"><img src="{{userimg['avtarurl']}}" class="mnimgnmmet"/></div>
                    </fieldset>-->

                    <div class="clearelement"></div>
                    
                </form>
                <div class="clearelement"></div>
                <div class="progress-indeterminate btmprbar">
                  <div class="indeterminate"></div>
                </div>
                </div>
            </li>
            <li class="rajuharryironman-content-3">

                <div class="rajuharry-form mnparentfile">
                    <div class="progress-indeterminate">
                      <div class="indeterminate"></div>
                    </div>
                    <div class="lastupdtepwd"><!-- <div class="floatleft mgnm">Password updated {{pwdtimeago}}</div> --><div class="floatright icnmnb"><i class="fa fa-shield"></i></div>
                    <div class="clearelement"></div>
                    </div>
                    <form class="" id="Validatepwd">

                        <fieldset class="col-md-12">
                        <section class="col-md-4">
                            <label class="label">Your New Password</label>
                            <label class="input">
                                <input type="password" name="newpwd" id="newpwd" class="newpwd">
                                <b class="tooltip tooltip-top-right">New Password</b>
                            </label>
                        </section>
                        <section class="col-md-4">
                            <label class="label">Re-type Password</label>
                            <label class="input">
                                <input type="password" name="renewpwd" id="renewpwd" class="renewpwd">
                                <b class="tooltip tooltip-top-right">Re type Password</b>
                            </label>
                        </section>
                            
                        <section class="col-md-4">
                            <input type="hidden" name="csrfironmanrajuharry" value="<?php echo $this->security->getToken(); ?>"/>
                            <button type="button" class="btnblue btnmnpwdchn" >Go</button>
                        </section>


                        </fieldset>

                        <div class="clearelement"></div>

                    </form>

                    <div class="progress-indeterminate btmprbar">
                      <div class="indeterminate"></div>
                    </div>
                </div>

            </li>

        </ul>
    </div>
    <!--/ tabs -->

<div class="clearelement"></div>
</div>

</div>
</div>
</div>
<!-- ########################################## PageContent End ########################################## --> 

