<?php header('Access-Control-Allow-Origin: *'); ?>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="msapplication-TileColor" content="#373F89">
        <meta name="theme-color" content="#373F89">

        <head>
            <script type="text/javascript" src="jquery.min.js"></script>
            <script>
                function reload_captcha() {
                    var captcha_src = 'http://searchpan.in/hacked_captcha.php?' + Math.random();
                    console.log(captcha_src);
                    $('#captcha_img').attr('src', captcha_src);

                    return false;
                }
                $(document).ready(function() {
                    reload_captcha();
                });



                $(document).ready(function($) {

                    $('#sr-pan').submit(function() {

                        if ($.trim($('#captcha').val()) == '') {
                            alert("Please enter the captcha/image code");
                            jQuery('#captcha').focus();
                            return false;
                        }
                        if ($.trim($('#pan-input').val()) == '') {
                            alert("Enter at least one PAN Number");
                            jQuery('#pan-input').focus();
                            return false;
                        }
                        $('#progress_bar').show();
                        var captcha = document.getElementById('captcha').value;

                        /*var url = 'http://searchpan.in/run9.php';

                        $.ajax({
                          url: url,
                          type:'POST',
                          data:$('#sr-pan').serialize(),
                          method:'POST',
                          contentType:'application/x-www-form-urlencoded; charset=UTF-8',    
                          complete:function(data){
                            console.log(data);
                          }
                        });*/

                        var xhr;
                        if (window.XMLHttpRequest) {
                            xhr = new XMLHttpRequest();
                        } else {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }

                        xhr.open("POST", "panget.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onprogress = function(e) {

                            var result = e.currentTarget.responseText; //.split('_,_');
                            if (result.search("Invalid captcha code") >= 0) {
                                document.getElementById('captcha_img').setAttribute("src", "http://searchpan.in/images/loading.gif");
                                var img = document.createElement("img");
                                img.setAttribute("src", "http://searchpan.in/hacked_captcha.php?" + Math.random());
                                img.setAttribute("id", "captcha_img");

                                img.onload = function() {
                                        document.getElementById("captcha_img").parentNode.replaceChild(img, document.getElementById("captcha_img"));
                                    }
                                    //document.getElementById('captcha_img').setAttribute("src","/hacked_captcha.php?"+Math.random());
                                alert("You Entered Wrong Captcha/Image/security code");
                                $('#captcha').val('');
                                $('#captcha').focus();
                                document.body.scrollTop = $('#captcha-block').offset().top;
                                return false;
                            }
                            document.getElementById('tb_pan_result').innerHTML = result;
                            e = null;

                        }
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4) {
                                document.body.scrollTop = $('#captcha-block').offset().top;
                                //console.log("Complete = " + xhr.responseText);
                                $('#progress_bar').hide();
                            }
                        }
                        xhr.send("captchaCode=" + captcha + "&SUBMIT=Submit" + "&panlist=" + jQuery('#pan-input').val());

                        return false;
                    })
                })

            </script>
        </head>

        <body>
            <form id="companyLLPMasterData" name="companyLLPMasterData" action="companyget.php" method="post">

	<table class="input-forms input_table" id="MasterDataInputTab1" name="MasterDataInputTab1">
		<tbody><tr class="table-row">
			<td>Company / LLP Name</td>
			<td> 
				<input type="text" name="companyName" size="30" value="" id="companyName" disabled=""> 
				<img src="http://www.mca.gov.in/mcafoportal/img/searchicon.png" alt="search" id="imgSearchIcon" name="imgSearchIcon" onclick="javascript:showSearchCINOverlay('backgroundOverlay','overlay','boxclose','companyID');">
				
			</td>
		</tr>
			<tr class="table-row">
			       <td> Company CIN/FCRN/LLPIN/FLLPIN <b style="color:red;">*</b></td>
			        <td> <input type="text" name="companyID" size="30" maxlength="21" value="" id="companyID" onchange="javascript: clearCompanyName()"></td>
		    </tr>
			<input type="hidden" name="displayCaptcha" value="true" id="displayCaptcha">
					
				<tr class="table-row">
					<td>Enter Characters shown below :</td>
					<td class="crop">
									<img src="http://www.mca.gov.in/mcafoportal/getCapchaImage.do" alt="Captcha" id="captcha" style="border:1px solid black;width:230px;height:75px;"> 
										<a href="#" onclick="javascript: return refreshCaptcha();" id="captchaRefresh" style="float:inherit"> 
											<img src="http://www.mca.gov.in/mcafoportal/img/refresh_captcha.png" width="25" height="25" title="Refresh">
										</a>
					</td>
				</tr>
					<tr class="table-row">
								<td></td>
								<td><input type="text" name="userEnteredCaptcha" value="" tabindex="3" id="userEnteredCaptcha" class="textBoxIconInput" title="userEnteredCaptcha" style="padding-left:0">
								</td>
					</tr>
					
                        <tr class="table-row">
								<td></td>
								<td id="tdConfirmBtn" name="tdConfirmBtn">
									<input type="submit" id="companyLLPMasterData_0" value="Submit" class="imgButton" onclick="javascript:return preSubmit();">

									<input type="reset" value="Clear All" class="imgButton" onclick="javascript: redirect('viewCompanyMasterData.do');">

								</td>
						</tr>
</tbody></table>						
	</form>





            <div style="text-align: center;display: none" id="progress_bar">
                Loading... <img src="http://searchpan.in/images/scs_progress_bar.gif">
            </div>
            <table class="table-bordered purple" style="border: 1px solid black;text-align: center;width: 100%">
                <thead style="background-color: #8926c3;color: #ffffff">
                    <tr>
                        <th>PAN</th>
                        <th title="Lastname,first name,middle name">Name</th>
                        <th>Area Code</th>
                        <th>Jurisdication</th>
                        <th>Address</th>
                        <th>Other</th>
                    </tr>
                </thead>
                <tbody id="tb_pan_result">
                </tbody>
            </table>


            <!--<form method="get" action="https://incometaxindiaefiling.gov.in/e-Filing/Services/KnowYourJurisdiction.html" target="_blank" style="border:1px solid #000; padding: 5px !important; height: 168px;">
                <input type="hidden" name="requestId" value="-519808483" id="KnowYourJurisdiction_requestId" />
                <table>
                    <tbody>
                        <tr>
                            <td><strong>PAN<sup>*</sup></strong>
                                <br />
                                <input type="text" name="panOfDeductee" maxlength="10" value="" id="KnowYourJurisdiction_panOfDeductee" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Captcha / Image Security Code</strong>
                                <br />
                                <table>
                                    <tr>
                                        <td>
                                            <input style="width: 85%;" name="captchaCode" type="text" maxlength="6" value="" id="KnowYourPan_captchaCode" required="required">
                                        </td>
                                        <td><img id="captchaImg" class="captchaImgBox" src="https://incometaxindiaefiling.gov.in/e-Filing/CreateCaptcha.do?0.2084175185132623" alt="Type the text in the image" /></td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2">
                                <input type="submit" value="Submit" id="sub" style="margin-top: 15px !important;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>-->

        </body>

    </html>
