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
            
        </head>

        <body>
            <form id="signatoryForm" target="myFrame"  name="signatoryForm" action="http://www.mca.gov.in/mcafoportal/viewSignatoryDetailsAction.do" method="post">

	<table class="input-forms input_table" id="inputsTab1" name="inputsTab1">
	<tbody><tr class="table-row">
		<td>Company / LLP Name</td>
		<td><input type="text" name="companyName" size="30" value="HERTZ WIND PARKS PRIVATE LIMITED" disabled="disabled" id="companyName"> 
				<img alt="search" src="http://www.mca.gov.in/mcafoportal/img/searchicon.png" id="imgSrch" name="imgSrch" onclick="javascript:showSearchCINOverlay('backgroundOverlay','overlay','boxclose','companyID');"></td>
	</tr>
		<tr class="table-row">
			<td>CIN / LLPIN <b style="color:red;">*</b></td>
			<td><input type="text" name="companyID" size="30" maxlength="21" value="U40102AP2015FTC096261" id="companyID" onchange="javascript: clearCompanyName()"></td>
		</tr> 
		<!-- CAPTCHA IMPL -->

		    <input type="hidden" name="displayCaptcha" value="true" id="displayCaptcha">
					
		    <tr class="table-row">
				<td>Enter Characters shown below :</td>
				<td class="crop">
									<img src="http://www.mca.gov.in/mcafoportal/getCapchaImage.do" alt="Captcha" id="captcha" style="border:1px solid black;width:245px;height:75px;"> <a href="#" onclick="javascript: return refreshCaptcha();" id="captchaRefresh" style="float:inherit"> <img src="http://www.mca.gov.in/mcafoportal/img/refresh_captcha.png" width="25" height="25" title="Refresh">
									</a>
								</td>
				</tr>
				<tr class="table-row">
					<td></td>
					<td colspan="3"><input type="text" name="userEnteredCaptcha" value="" tabindex="3" id="userEnteredCaptcha" class="textBoxIconInput" title="userEnteredCaptcha" style="padding-left:0;"></td>
				</tr>
				
				<!-- CAPTCHA IMPL ENDs -->
				   <tr class="table-row">
						<td></td>
						<td colspan="3" id="tdConfirmBtn" name="tdConfirmBtn">
				<input type="submit" id="submitBtn" name="submitBtn" value="Submit" class="imgButton" >

				 <input type="reset" name="clearBtn" value="Clear All" class="imgButton" >

			</td>
					</tr>
</tbody></table>
</form>
<iframe name="myFrame" src="#">
   Your browser does not support inline frames.
</iframe>            
        </body>

    </html>
