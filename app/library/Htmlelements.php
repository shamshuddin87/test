<?php

use Phalcon\Mvc\User\Component;
/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Htmlelements extends Component
{
    
    

    public function cmpmaslist($arrdta,$country,$state,$litiid)
    {
        
        //echo "checkoing arr ";print_r($arrdta);exit;
        $ndir = explode(',', $arrdta['nameofdir']);
        $ddir = explode(',', $arrdta['dirdesig']);
        $edir = explode(',', $arrdta['diremail']);
        $appendhtml = '';
        $appendhtml .='<input type="hidden" name="mlistid" class="mlistid" id="mlistid" value="'.$litiid.'"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>Organisation/Company/Firm Name *</b></span>
                        <input type="text" class="form-control" id="orgcmpfrm" name="orgcmpfrm" value="'.$arrdta['companyname'].'" required>
                    </div>
                    <div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>Proprietor/Authorized Signatory *</b></span>
                        <input type="text" class="form-control" id="propauthsig" name="propauthsig" value="'.$arrdta['proprietor'].'" required>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="control-label form-group col-lg-12">
                        <span class="floatleft"><b>Address Line 1 *</b></span>
                        <input type="text" class="form-control" id="addrlone" name="addrlone" value="'.$arrdta['addrone'].'" required >
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>Address Line 2 *</b></span>
                        <input type="text" class="form-control" id="addrltwo" name="addrltwo" value="'.$arrdta['addrtwo'].'" required>
                    </div>
                    <div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>City *</b></span>
                        <div class="input">
                            <input type="text" id="citycmp" name="citycmp" class="form_fields form-control col-md-7 col-xs-12" value="'.$arrdta['city'].'" required>
                        </div>
                    </div>
                    <div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>State *</b></span>
                        <div class="input">
                            <select id="statecmp" name="statecmp" class="form_fields form-control col-md-7 col-xs-12" required><option value="">Select State</option>';
                    foreach ($state as $ks => $vs) {
                        if ($arrdta['state'] == $vs['id']) {$selected = 'selected';}else{$selected = '';}
            $appendhtml .='<option value="'.$vs['id'].'" '.$selected.'>'.$vs['statename'].'</option>';
                    }
            $appendhtml .='</select>
                        </div>
                    </div>';

            $appendhtml .='<div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>Pin *</b></span>
                        <div class="input">
                            <input type="text" id="pincmp" name="pincmp" class="form_fields form-control col-md-7 col-xs-12" value="'.$arrdta['pin'].'" maxlength="6" required>
                        </div>
                    </div><div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>Country *</b></span>
                        <div class="input">
                            <select id="countrycmp" name="countrycmp" class="form_fields form-control col-md-7 col-xs-12" required><option value="">Select Country</option>';
                    foreach ($country as $kc => $vc) {
                        if ($arrdta['country'] == $vc['id']) {$select = 'selected';}else{$select = '';}
            $appendhtml .='<option value="'.$vc['id'].'" '.$select.'>'.$vc['countryname'].'</option>';
                    }
            $appendhtml .='</select>
                        </div>
                    </div>';

            $appendhtml .='<div class="control-label form-group col-lg-6">
                        <span class="floatleft"><b>Number Of Directors/Partners </b></span>
                        <div class="input">
                            <input type="text" id="noodircmp" name="noodircmp" value="'.$arrdta['noofdir'].'" class="form_fields form-control col-md-7 col-xs-12" >
                        </div>
                    </div>
                    <div class="control-label form-group col-lg-12">
                        <span class="floatleft"><b>Director/Partner Details</b></span>
                    </div><div class="dirdet" nooflp="'.$arrdta['noofdir'].'">';
                    $rn = 1;
            for ($ipk=0; $ipk < $arrdta['noofdir']; $ipk++) {
                $name = isset($ndir[$ipk]) ? $ndir[$ipk] : '';
                $desid = isset($ddir[$ipk]) ? $ddir[$ipk] : '';
                $email = isset($edir[$ipk]) ? $edir[$ipk] : '';
                $appendhtml .='<div class="dir_'.$rn.'">
                    <div class="control-label form-group col-md-4">
                        <span class="floatleft"><b>Name *</b></span>
                        <div class="input">
                            <input type="text" id="dirnamecmp" name="dirnamecmp[]" value="'.$name.'" class="form_fields form-control col-md-7 col-xs-12" required>
                        </div>
                    </div>
                    <div class="control-label form-group col-lg-4">
                        <span class="floatleft"><b>Designation *</b></span>
                        <div class="input">
                            <input type="text" id="dirdescmp" name="dirdescmp[]" value="'.$desid.'" class="form_fields form-control col-md-7 col-xs-12" required>
                        </div>
                    </div>
                    <div class="control-label form-group col-lg-4">
                        <span class="floatleft"><b>Email Id *</b></span>
                        <div class="input">
                            <input type="text" id="emailcmp" name="emailcmp[]" value="'.$email.'" class="form_fields form-control col-md-7 col-xs-12" required>
                        </div>
                    </div></div><div class="clearfix"></div>';
                $rn++;
            }


            $appendhtml .='</div></div>
                <div class="control-label form-group btnsubmitme">
                    <button type="submit" class="btn btn-primary updatecmmlistid">Submit</button>
                </div>';
        return $appendhtml;
    }
    
     public function requestforesign($filepath,$getuserid,$rqid)
     {
       $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">
    <head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
    </head>
    <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
    <h1>Dear sir,
    </h1>
    <h2>Please e-sign this document.</h2>
    <h2 style="text-align:left;">Thank You.</h2>
    <a href="https://www.volody.com/user/contractagreement/pixel?file='.$filepath.".pdf"."&&userid=".$getuserid."&&rowid=".$rqid.'">Click here to e-sign this document</a>
    </body>
    </html>';
            return $html;
     }   
    
    public function createsubuser($name,$to,$pwdemail)
    { $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
                $baseuri = $this->url->getBaseUri();
                $baseurl = $server_link.$baseuri;

            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700" rel="stylesheet" type="text/css">
</head>

  <body style="margin:0; background: #e5e5e5;">
        <table cellpadding="0" cellspacing="0" width="100%" border="0">
    <tr>
      <td>
      <table cellpadding="0" cellspacing="0" border="0" style="font-family:"Roboto",Arial, Helvetica, sans-serif; max-width:680px; font-size:12px; color:#333; background: #fff;" align="center">
       <tr>
            <td style="padding:20px 0 20px 0px; background: #f8f8f8;width:50%;" align="center">
               <a href="https://www.volody.com/" target="_blank" style="border:0; outline:0;">
                <img src="https://www.volody.com/mainadmin/img/emailer/logo.png" border="0"/>
               </a>
            </td>

            <td align="center" style="background: #f8f8f8;width:50%;">
                <a href="https://www.facebook.com/VolodySoftware/" style="text-decoration: none; padding-right: 15px;">
                  <img src="https://www.volody.com/companysecretary/gstemailer/images/facebook.png" alt="" />
                </a>
                <a href="https://www.youtube.com/channel/UCV8kLW489Q-iw16n_nxAmAg" style="text-decoration: none;">
                  <img src="https://www.volody.com/companysecretary/gstemailer/images/youtube.png" alt="" />
                </a>
            </td>
       </tr>

      <tr>
         <td align="center" colspan="2" style="padding-top: 20px; background: #fff;">
            <p style="max-width: 100%; margin:0; font-weight:600; letter-spacing: 1px; color:#333; font-size:24px; font-family:\'Roboto\',Arial,Helvetica,sans-serif;"><b>Welcome '.$name.'</b></p>
            <p style="max-width: 68%; margin:10px 0;color:#333; font-size:15px; line-height:20px; font-family:\'Roboto\',Arial,Helvetica,sans-serif;"> We\'re happy to have you on board.</p>
         </td>
      </tr>

      <tr>
         <td align="center" colspan="2" style="padding-top: 20px; background: #fff;">
            <p style="max-width: 100%; margin:0; font-weight:600; letter-spacing: 1px; color:#333; font-size:24px; font-family:\'Roboto\',Arial,Helvetica,sans-serif;">Login Details</p>
         </td>
      </tr>

      <tr>
         <td align="center" colspan="2" style="padding-top: 20px; background: #fff;">
          <form target="_blank">
            <div style="background:#f8f8f8;width:80%;height:45px;border-radius:3px">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding-top:13px">
                <span style="width:35%;float:left;text-align:center;color:#5d5d5d;font-size:14px;font-weight:600">Login Url :</span>
                <a href="https://insidertrading.drreddys.com/drreddys/" style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;text-decoration:none;font-weight:600" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://insidertrading.drreddys.com/drreddys/&amp;source=gmail&amp;ust=1517468278757000&amp;usg=AFQjCNFqTVDabRm7DZR1AUnQ5zLi-ncSOw">
                https://insidertrading.drreddys.com/drreddys/</a></div>
              </div>
              <div style="background:#f8f8f8;width:80%;height:45px;border-radius:3px;margin-top:15px">
                <div style="border:0;outline:0;color:#333;background:0;width:100%;padding-top:13px;font-weight:600">
                  <span style="width:35%;float:left;text-align:center;color:#5d5d5d;font-size:14px">User Name :</span>
                  <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">
                    <a href="#" style="color:#5d5d5d;text-decoration:none" target="_blank">Your SSO Username</a></span>
                  </div>
                </div>
                <div style="background:#f8f8f8;width:80%;height:45px;border-radius:3px;margin-top:15px">
                  <div style="border:0;outline:0;color:#333;background:0;width:100%;padding-top:13px;font-weight:600">
                    <span style="width:35%;float:left;text-align:center;color:#5d5d5d;font-size:14px">Password :</span>
                    <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">
                    Your SSO Password</span> </div>
                  </div>
                </form>
         </td>
      </tr>

      <tr>
        <td colspan="2" align="center">
        <div style="padding:40px 0 50px 0; background: #fff;">
        <a href="https://insidertrading.drreddys.com/drreddys/" style="background:#27b16d;border-radius:3px;padding:12px 40px;color:#fff;font-size:16px;text-decoration:none;letter-spacing:1px" target="_blank" data-saferedirecturl="">Login Now!</a>
        </div>
        </td>
      </tr>

      <tr>
           <td align="center" colspan="2" style="max-width:100%; line-height:25px; background: #333;">
           <p style="margin:0px; padding:8px 0 8px 0;  color:#fff; font-size:12px; font-family:\'Roboto\',Arial,Helvetica,sans-serif;">© 2020-21 Volody Products Pvt Ltd. - volody.com </p>
            </td>
      </tr>

    </table>
         
    </td>
    </tr>


      </table>
  </body>
</html>';
            return $html;
    }

       public function initialdeclarationannual($getname)
    {
        // print_r($getname);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="htth3://www.w3.org/1999/xhtml">
        <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
        </head>
        <body>
        <p style="text-align:left;">Dear sir/mam,
        </p>
        <p style="text-align:left;">'.$getname.' Sent Annual Declaration.</p>
        <p style="text-align:left;">Thank You.</p>

        </body>
        </html>';


        return $html;
    } 


/************ Send approval  ****************/

public function sendforapproval($subject,$userids,$emailconstent)
{

   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Contract Approval</div>
                </div>
                
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Subject : '.$subject.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Contract Name : '.$emailconstent['agreementname'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Start Date : '.$emailconstent['startdate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                End Date :'.$emailconstent['enddate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Purpose : '.$emailconstent['purpose'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Amount : '.$emailconstent['amount'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Requester Name :'.$emailconstent['requestername'].',</div>             
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                  <span class="floatleft"><b>Exception:</b></span><textarea rows="3" cols="70">'.$emailconstent['exception'].'</textarea></div>
                 <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px; text-transform: capitalize;">
                  <a href="'.$emailconstent['url'].'randomaccess?raid='.$userids.'&vote=1&section='.$emailconstent['section'].'&view='.$emailconstent['rqid'].'"><button class="button  ">Accept</button></a>
                  <a href="'.$emailconstent['url'].'randomaccess?raid='.$userids.'&vote=0&section='.$emailconstent['section'].'&view='.$emailconstent['rqid'].'">
                    <button class="button  button3">Reject</button></a>
            </div>
                                                
    
<div style="font-size: 16px; color:#626262 ; font-weight: 700; margin-bottom:8px;font-weight:bold;">Warm regards,</div>
<div style="font-size: 14px; color:#626262 ; margin-bottom:1px;font-weight:bold;">Team Volody</div>
<div><a href="www.volody.com" target="_blank" style=" text-decoration:none;color:#003366;text-shadow: 1px 1px 5px #fff;text-align:left;font-size: 14px;font-weight:bold;">volody.com</a>
</div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}

    
public function sendforapprovallegal($subject,$userids,$emailconstent)
{

   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Contract Approval</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Subject : '.$subject.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Contract Name : '.$emailconstent['agreementname'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Start Date : '.$emailconstent['startdate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                End Date :'.$emailconstent['enddate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Purpose : '.$emailconstent['purpose'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Amount : '.$emailconstent['amount'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Requester Name :'.$emailconstent['requestername'].',</div>             
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                  <span class="floatleft"><b>Exception:</b></span><textarea rows="3" cols="70">'.$emailconstent['exception'].'</textarea></div>
                 <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px; text-transform: capitalize;">
                  <a href="'.$emailconstent['url'].'randomaccess?raid='.$userids.'&vote=1&section='.$emailconstent['section'].'&view='.$emailconstent['rqid'].'"><button class="button  ">Accept</button></a>
                  <a href="'.$emailconstent['url'].'randomaccess?raid='.$userids.'&vote=0&section='.$emailconstent['section'].'&view='.$emailconstent['rqid'].'">
                    <button class="button  button3">Reject</button></a>
            </div>
                                                
    
<div style="font-size: 16px; color:#626262 ; font-weight: 700; margin-bottom:8px;font-weight:bold;">Warm regards,</div>
<div style="font-size: 14px; color:#626262 ; margin-bottom:1px;font-weight:bold;">Team Volody</div>
<div><a href="www.volody.com" target="_blank" style=" text-decoration:none;color:#003366;text-shadow: 1px 1px 5px #fff;text-align:left;font-size: 14px;font-weight:bold;">volody.com</a>
</div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}

/************End of Send approval  ****************/


/************ Send legal approval approval  ****************/

public function sendforlegalapproval($subject,$emaildata)
{   
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Volody</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Subject : '.$subject.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Contract Name : '.$emaildata['agreementname'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Start Date : '.$emaildata['startdate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                End Date :'.$emaildata['enddate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Purpose : '.$emaildata['purpose'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Amount : '.$emaildata['amount'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Requester Name :'.$emaildata['requestername'].',</div>                                          
    
<div style="font-size: 16px; color:#626262 ; font-weight: 700; margin-bottom:8px;font-weight:bold;">Warm regards,</div>
<div style="font-size: 14px; color:#626262 ; margin-bottom:1px;font-weight:bold;">Team Volody</div>
<div><a href="www.volody.com" target="_blank" style=" text-decoration:none;color:#003366;text-shadow: 1px 1px 5px #fff;text-align:left;font-size: 14px;font-weight:bold;">volody.com</a>
</div>
            </div>
        </div>
    </div>
        </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}


/************End of Send approval  ****************/



/************ Send legal approval approval  ****************/

public function sendmsgwithmail($subject,$agreementname,$messagenote,$reqname)
{   
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Volody</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px; text-transform: capitalize;">
                Contract Name : '.$agreementname.',</div>

                 <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px; text-transform: capitalize;">
                   Message : '.$messagenote.',</div> 

                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px; text-transform: capitalize;">                  
                   Sent by : '.$reqname.'.</div> 
                                                   
    
<div style="font-size: 16px; color:#626262 ; font-weight: 700; margin-bottom:8px;font-weight:bold;">Warm regards,</div>
<div style="font-size: 14px; color:#626262 ; margin-bottom:1px;font-weight:bold;">Team Volody</div>
<div><a href="www.volody.com" target="_blank" style=" text-decoration:none;color:#003366;text-shadow: 1px 1px 5px #fff;text-align:left;font-size: 14px;font-weight:bold;">volody.com</a>
</div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}


/************End of Send approval  ****************/
 public function mailcomprestriction($username,$getcompdata,$periodfrom,$periodto)
 {
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">

    <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                <div style="    background-color: #f2f2f2; padding: 18px;">
                <div class="main">
                <p>Dear '.$username.'</p>
                <p>A new company is now entered into the restricted company list for trading in shares/securities. Following are its details - </p>
                <table border="1"  style="border-collapse: collapse;">
                <tr>
                <th>Company Name</th>
                <th>From date</th>
                <th>To date</th>
                </tr>
                <tr>
                <td>'.$getcompdata.'</td>
                <td>'.$periodfrom.'</td>
                <td>'.$periodto.'</td>
                </tr>
                </table>
                </div>';
        
        //print_r($html);exit;
        return $html;
    }
    
 public function mailemprestriction($username,$getcompdata,$periodfrom,$periodto)
 {
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">

    <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                <div style="    background-color: #f2f2f2; padding: 18px;">
                <div class="main">
                <p>Dear '.$username.'</p>
                <p>A new company is now entered into the restricted company list for trading in shares/securities. Following are its details - </p>
                <table border="1"  style="border-collapse: collapse;">
                <tr>
                <th>Company Name</th>
                <th>From date</th>
                <th>To date</th>
                </tr>
                <tr>
                <td>'.$getcompdata.'</td>
                <td>'.$periodfrom.'</td>
                <td>'.$periodto.'</td>
                </tr>
                </table>
                </div>';
        
        //print_r($html);exit;
        return $html;
    }
    
  /********** send request approval start *********/
   public function sendmailrqstapprvl($subject,$emaildata)
   {
          $uid = $this->session->loginauthspuserfront['id'];
           $transaction = strip_tags($emaildata['type_trnscn']);
         //echo "<pre>";print_r($emaildata);exit;
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">

    <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            p{color: black;}
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">Request Approval</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
                <div class="main">
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Requester Name : '.$emaildata['requester_name'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Company Name : '.$emaildata['company_name'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Type of Transaction : '.$transaction.',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Security Type :'.$emaildata['securty_type'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    No Of Securities : '.$emaildata['noofshres'].'</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px;">
                    <!-- When you complete the transaction please follow below steps after logging in to Volody.
                    <ol>
                      <li>Go to Request for Pre-clearance under SEBI Form</li>
                      <li>Click on icon shown in trading status against the entry for which pre-clearance was taken.</li>
                      <li>Enter the transaction details.</li>
                      <li>Click on final submit</li>
                    </ol>
                      <a href="'.$emaildata['url'].'randomrequest?vote='.base64_encode("1").'&rqst='.base64_encode($emaildata['rqst_id']).'&userid='.base64_encode($uid).'"><button class="button ">Approve</button></a>
                      <a href="'.$emaildata['url'].'randomrequest?vote='.base64_encode("0").'&rqst='.base64_encode($emaildata['rqst_id']).'&userid='.base64_encode($uid).'"><button class="button  button3">Reject</button></a> -->
                </div>
                </div>
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
}
  /********** send request approval end ***********/
    
     /********** send ack mail to requster start *********/
   public function sendmailackapprvl($subject,$emaildata)
   {
       
       $transaction = strip_tags($emaildata['type_trnscn']);
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Request Approval</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Company Name : '.$emaildata['company_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Type of Transaction : '.$transaction.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Security Type :'.$emaildata['securty_type'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                No Of Securities : '.$emaildata['noofshres'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px;">
                When you complete the transaction please follow below steps after logging in to Volody. 
                <ol>
                  <li>Go to Request for Pre-clearance under SEBI Form</li>
                  <li>Click on icon shown in trading status against the entry for which pre-clearance was taken.</li>
                  <li>Enter the transaction details.</li>
                  <li>Click on final submit</li>
                </ol>
            </div>
                                                
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send ack mail to requster end ***********/
    
    /********** send request approval start *********/
   public function sendmailexcbrqstapprvl($subject,$emaildata)
   {
       
           $transaction = strip_tags($emaildata['type_trnscn']);
       //echo "<pre>";print_r($userids);exit;
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">

    <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            p{color: black;}
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">Request Approval</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
                <div class="main">
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Requester Name : '.$emaildata['requester_name'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Company Name : '.$emaildata['company_name'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Type of Transaction : '.$transaction.',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Security Type :'.$emaildata['securty_type'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    No Of Securities : '.$emaildata['noofshres'].'</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                      <a href="'.$emaildata['url'].'randomexception?vote='.base64_encode("1").'&excrqst='.base64_encode($emaildata['id']).'&rqst='.base64_encode($emaildata['id']).'"><button class="button ">Accept</button></a>
                      <a href="'.$emaildata['url'].'randomexception?vote='.base64_encode("0").'&excrqst='.base64_encode($emaildata['id']).'"><button class="button  button3">Reject</button></a>
                </div>

                </div>
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
}
  /********** send request approval end ***********/
    
     /********** send exception ack mail to requster start *********/
   public function sendexcmailackapprvl($subject,$emaildata)
   {
       
       $transaction = strip_tags($emaildata['type_trnscn']);
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Request Approval</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Company Name : '.$emaildata['company_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Type of Transaction : '.$transaction.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Security Type :'.$emaildata['securty_type'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                No Of Securities : '.$emaildata['noofshres'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
            </div>
                      
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send exception ack mail to requster end ***********/
    
     /********** send exception ack mail to requster start *********/
   public function sendmailaftrfinlsub($subject,$emaildata)
   {
       
       $transaction = strip_tags($emaildata['transaction']);
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Final Submit Request</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Subject : '.$subject.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Requester Name : '.$emaildata['requester_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Company Name : '.$emaildata['company_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Type of Transaction : '.$transaction.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Security Type :'.$emaildata['securty_type'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                No Of Securities : '.$emaildata['noofshres'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Date Of Transaction : '.$emaildata['tradedate'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                
            </div>
                  
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send exception ack mail to requster end ***********/
    
      /********** send mail for trade request start *********/
   public function sendmailtrdepln($subject,$emaildata)
   {
       
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Trading Plan Request</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Subject : '.$subject.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Requester Name : '.$emaildata['requester_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Company Name : '.$emaildata['comp_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Date From : '.$emaildata['fromdate'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Date To : '.$emaildata['todate'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                
            </div>
                 
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send mail for trade request end ***********/
    
/********** send ack mail for trade request start *********/
   public function sendtorqstrofack($subject,$emaildata)
   {
       
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Trading Plan Request</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Subject : '.$subject.',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Company Name : '.$emaildata['comp_name'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Date From : '.$emaildata['fromdate'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Date To : '.$emaildata['todate'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                
            </div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send ack mail for trade request end ***********/
    
    public function mailsenttousr($name)
    {
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">
    <head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
    </head>
    <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
    <div class="container" style="width:100%; max-width:600px; margin: 0 auto; border-top: 5px solid #373F89;    box-shadow: 0 0 20px rgba(0,0,0,.3);">
    <div class="main_container" style="max-width:550px; margin:0 20px;">
    <div class="header" style="margin-bottom:50px;">
    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
    <div style="text-shadow: 1px 0px 2px #626262;color: #626262;">Volody</div>
    </div>
    
    <div style="clear:both;"></div></div>

    <div class="main">
    <div class="circlech" style="background: -webkit-linear-gradient(top,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));background: linear-gradient(to bottom,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));border-radius: 50%;width: 250px;height: 100px;line-height: normal;text-align: center;max-width: 100%;    position: relative;top: 0px;left: 0px;right:0px; z-index: 1;margin:0px auto;">
    <div style="padding: 0px 0px;"><div  style="font-size: 25px;color: #215c86;">Dear '.$name.',</div>
    <div style="color: #67b9c7;font-weight: bold;">Please Fill Up Your Personal Details.</div>
    </div>
    </div>

    </div>
    </div>
    <div class="footer" style="width:100%; max-width:600px; margin: 0 auto; position:relative;padding-bottom: 10px;">

    <div class="mnfootetext" style="position: relative;z-index: 1;margin: 0 20px;margin-top: 50px;background: rgba(255,255,255,1);box-shadow: 0 0 20px rgba(0,0,0,.3);">

    <div style="clear:both;"></div>
    <div class="footer_text_down" style="text; margin-top: 10px;">
    <div style="padding: 8px 0px; color:#626262; font-size:12px; text-align:center;">&copy; Volody. All rights reserved </div>
    </div>
    </div>
    </div>
    </div>
    </body>
    </html>';
            return $html;
    }
    
    public function hldngmailsenttousr($name)
    {
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">
    <head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
    </head>
    <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
    <div class="container" style="width:100%; max-width:600px; margin: 0 auto; border-top: 5px solid #373F89;    box-shadow: 0 0 20px rgba(0,0,0,.3);">
    <div class="main_container" style="max-width:550px; margin:0 20px;">
    <div class="header" style="margin-bottom:50px;">
    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
    <div style="text-shadow: 1px 0px 2px #626262;color: #626262;">Volody</div>
    </div>
    <div style="clear:both;"></div></div>

    <div class="main">
    <div class="circlech" style="background: -webkit-linear-gradient(top,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));background: linear-gradient(to bottom,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));border-radius: 50%;width: 250px;height: 100px;line-height: normal;text-align: center;max-width: 100%;    position: relative;top: 0px;left: 0px;right:0px; z-index: 1;margin:0px auto;">
    <div style="padding: 0px 0px;"><div  style="font-size: 25px;color: #215c86;">Dear '.$name.',</div>
    <div style="color: #67b9c7;font-weight: bold;">Please Upload Your Holding Statement.</div>
    </div>
    </div>

    </div>
    </div>
    <div class="footer" style="width:100%; max-width:600px; margin: 0 auto; position:relative;padding-bottom: 10px;">

    <div class="mnfootetext" style="position: relative;z-index: 1;margin: 0 20px;margin-top: 50px;background: rgba(255,255,255,1);box-shadow: 0 0 20px rgba(0,0,0,.3);">

    <div style="clear:both;"></div>
    <div class="footer_text_down" style="text; margin-top: 10px;">
    <div style="padding: 8px 0px; color:#626262; font-size:12px; text-align:center;">&copy; Volody. All rights reserved </div>
    </div>
    </div>
    </div>
    </div>
    </body>
    </html>';
            return $html;
    }
    
    
    public function mailtonotdonetrdrqst($data)
    {
        $transaction = strip_tags($data['transaction']);
      $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">

    <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            p{color: black;}
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;"></div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
                <div class="main">
                    <p style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">Dear User,</p>
                    <p style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">You have not updated status of pre-clearance taken by you. Details of request are as -</p>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Company Name : '.$data['company_name'].',</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Type Of Transaction : '.$transaction.'</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    Security Type : '.$data['security_type'].'</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                    No. Of Securities  : '.$data['no_of_shares'].'</div>
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">

                </div>
                </div>
            </div>
        </div>

        </div>
    </body>
    </html>';
    return $html;
    //echo $html; exit; 
    }
    
    /********** send mail for form b start *********/
   public function mailformbapprvlrqst($subject,$emaildata)
   {
       
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Form B Request</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Name : '.$emaildata['fullname'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                PAN : '.$emaildata['pan'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Designation : '.$emaildata['designation'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                
            </div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
    
   public function mailformbackrqst($subject,$emaildata)
   {
       
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Form B</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Date of appointment of Director /KMP : '.$emaildata['date'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Category : '.$emaildata['category'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
            </div>
                                                
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send mail for form b start ***********/
   

  /********** send mail for form c start *********/
   public function mailformcapprvlrqst($subject,$emaildata)
   {
       
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Form C Request</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Name : '.$emaildata['fullname'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                PAN : '.$emaildata['pan'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Designation : '.$emaildata['designation'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                
            </div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
    
    public function mailformcackrqst($subject,$emaildata)
   {
       
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Form C</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                From Date : '.$emaildata['fromdate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                 To Date : '.$emaildata['todate'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Category : '.$emaildata['category'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
            </div>
                                                
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send mail for form c start ***********/
    
    /********** send mail for form d start *********/
   public function mailformdapprvlrqst($subject,$emaildata)
   {
       
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Form D Request</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Name : '.$emaildata['fullname'].',</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                PAN : '.$emaildata['pan'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                Designation : '.$emaildata['designation'].'</div>
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
                
            </div>
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
    
 
    public function mailformdackrqst($subject,$emaildata)
   {

       // print_r($emaildata);exit;
        $unixTimestamp = strtotime($emaildata['blckoutfrom']);
 
        $dayOfWeek = date("l", $unixTimestamp);
        $unixTimestamp1 = strtotime($emaildata['blckoutto']);
 
        $dayOfWeek1 = date("l", $unixTimestamp1);
        $reason =html_entity_decode($emaildata['reason']); 
        $blackfrom = $emaildata['blckoutfrom'];
        $blackto = $emaildata['blckoutto'];

 
 
          //echo "<pre>";print_r($userids);exit;
           $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">Trading Window Closure</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear All,</p>
        <p>Please note that the trading window is closed from '.$dayOfWeek.', '.$blackfrom.' to '.$dayOfWeek1.', '.$blackto.' both days inclusive on account of '.$reason.'.
        </p>
       <p>Under the Securities and Exchange Board of India (Prohibition of Insider Trading) Regulations 2015, (Insider Trading Regulations) buying, selling or dealing in the securities of the company by its directors/employees on the knowledge of any inside, unpublished price-sensitive information is prohibited and doing so is an offense. The Directors and employees of the Company and their immediate relatives are not permitted to trade in the Company&#39;s shares/ADRs during the period, as may be notified in this behalf and/or till such price-sensitive information is disseminated to the public at large.

              </p>
        <p>Under the revised Insider Trading Regulations and Company&#39;s revised Code of Conduct to regulate, monitor and report trading by designated persons (the Code), the trading restriction period can be made applicable from the end of every quarter till 48 hours after the declaration of financial results or such other period as may be notified in this behalf. Accordingly, it is hereby informed that the Trading Window for buying, selling or dealing in the securities of the Company by the designated persons (including their immediate relatives) will be closed from '.$dayOfWeek.', '.$blackfrom.' to '.$dayOfWeek1.', '.$blackto.' for '.$reason.'.
           </p>
           <p>Any contravention of the above would attract penalty as mentioned under Clause 13 of the Code and/or by SEBI. Hence, please refrain from buying, selling or dealing in the shares/ADRs of the Company during the above mentioned period. You are also requested not to take position in any derivatives in the securities of the Company.</p>

            <p>Any contravention of the above would attract penalty as mentioned under Clause 13 of the Code and/or by SEBI. Hence, please refrain from buying, selling or dealing in the shares/ADRs of the Company during the above mentioned period. You are also requested not to take position in any derivatives in the securities of the Company.

           </p>
        
                <div class="main">
                    
                  
                     <p>Further, exercise of stock options shall not be allowed during the above period. </p>
                     <div><br></div>
                     <p>Regards,<br>Sandeep Poddar</br><br>Company Secretary</br></p>
                    
                     
                </div>
            </div>
        </div>

        </div>
    </body>
    </html>';
//echo $html; exit; 

 return $html;
}



public function sendmailforpersinfo($subject,$fullname){

  
          // $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
          //             //echo '<pre>'; print_r($server_link); exit;
          //             $baseuri = $this->url->getBaseUri();
          //             $baseurl = $server_link.$baseuri;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title>Phoenix Peth</title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>you have recieved a new request from  '.$fullname.'</h3>

          <h4> for approval of personal information  please login into the software and approve it</h4>


          </body>                                                                                        
          </html>';
          return $html;


 }

  /********** send mail for form d start ***********/


  //----------------------------------------------AUTO MAIL TO USER-----------------------------//



    public function automailtouser($myarr)
     {

          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title>Phoenix Peth</title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h1>You Have Recieved Reminder For Trading</h1>
          <h3>Company:'.$myarr['mycompany'].'</h3>
          <h3>No Of Shares:'.$myarr['no_of_shares'].'</h3>
          <h3>Approved Date:'.$myarr['approved_date'].'</h3>
          <h3>Trading Date:'.$myarr['trading_date'].'</h3>
          <h3>Type Of Request:'.$myarr['request_type'].'</h3>
          </body>
          </html>';
      return $html;
     }   
    

     public function automailtoapprover($myarr)
     {

          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title>Phoenix Peth</title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h1>You Have Recieved Reminder For Pending Trading Request</h1>
          <h3>Requester Name:'.$myarr['name_of_requester'].'
          <h3>Company:'.$myarr['mycompany'].'</h3>
          <h3>No Of Shares:'.$myarr['no_of_shares'].'</h3>
          <h3>Approved Date:'.$myarr['approved_date'].'</h3>
          <h3>Trading Date:'.$myarr['trading_date'].'</h3>
          <h3>Type Of Request:'.$myarr['request_type'].'</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }   


     public function sendpendapprovmaileveryday($mgrname,$myarr)
     {
         $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
         
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$mgrname.'</h3>
          <h3>This is to inform you that the following Conflict of Interest declaration request is waiting for Approval.Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Disclosure by:</b></th><td>'.$myarr['disclosure_made_by'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }   


     public function sendapprmailtoccoandcs($myarr)
     {
         $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;

          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>A Conflict of Interest declaration submitted by '.$myarr['requestername'].' has been Approved by their HR and Manager and accordingly communicated to them. This is for your information. Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Disclosure made by:</b></th><td>'.$myarr['requestername'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Approved by:</b></th><td>'.$myarr['approved_by'].'</td>
              </tr>
            </tbody>
          </table>

          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }   


     public function sendaprvmailtomgr($myarr)
     {
         $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
         
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['mgrname'].'</h3>
          <h3>A Conflict of Interest declaration has been received from '.$myarr['requestername'].' for your consideration and approval. Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }   


    public function initialdeclaration($getname)
    {
        // print_r($getname);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="htth3://www.w3.org/1999/xhtml">
        <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
        </head>
        <body>
        <p style="text-align:left;">Dear sir/mam,
        </p>
        <p style="text-align:left;">'.$getname.' Sent Initial Declaration.</p>
        <p style="text-align:left;">Thank You.</p>

        </body>
        </html>';


        return $html;
    }
 


public function mailofupsitradingwindow($username,$upsitype,$enddate,$addedby,$emaildate,$today)
  {   
       //echo "<pre>";print_r($userids);exit;
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">Trading Window Closure</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$username.'</p>
        <p>You have been added as Project Owner / Project member in connection with Project as mentioned herein, which is Unpublished Price Sensitive Information (UPSI).</p>
        <p>As part of the Project, you would be deemed to be in possession / recipient <b>of Unpublished Price Sensitive Information (UPSI) </b>in relation to the affairs concerning the Company. Please note that all UPSI in your possession or that may be shared with you over the course of time, are private and confidential and intended to be used STRICTLY for legitimate purposes only in pursuance to the applicable provisions of the SEBI (Prohibition of Insider Trading) Regulations, 2015 (including any amendment(s) or re-enactment(s) thereof) (SEBI PIT Regulations).</p>
        <p>The holder/recipient of UPSI (including its Representative) is expected to maintain highest level of confidentiality and shall abide by and undertake to comply with the applicable provisions of the said SEBI PIT Regulations in dealings concerning the listed securities of the Company.</p>
        
                <div class="main">
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                    UPSI Name : '.$upsitype.',</div>
                    
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                    Name added by : '.$addedby.',</div>
                       
                       <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                       Project Start Date : '.$emaildate.',</div>
                       
                       <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                       Date of closure of Trading Window : '.$today.',</div> 

                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">        Project End Date : to be notified </div> 
                     <p>Please note that in view of the holding of aforesaid UPSI, the trading window to deal in the listed securities of the Company, has been closed for you and your immediate relatives with immediate effect and shall continue to be so till 48 hours after the said UPSI is made available to public or such activity or project is abandoned.</p>
                     <p>Please consult the Corporate Governance Dept. for any query or clarification. </p>
                     <div><br></div>
                     <p>Regards,</p>
                     <p>Corporate Governance Team</p>
                     
                </div>
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
}

  public function Type1content($email,$todaydate,$title,$dt_added,$owner,$dpnames,$greeting)
  {   
       
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">UPSI Updated</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$greeting.', 
        </p>
        <p>This is to inform you that '.$dpnames.' has been added to the UPSI titled '.$title.' on '.$todaydate.'. This UPSI was created by '.$owner.' on '.$dt_added.'.
         </p>
        
               
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
} 


public function Type2content($emailid,$username,$upsitype,$ownername,$pstartdate,$emaildate,$date_timestamp)
{   
     
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="htth3://www.w3.org/1999/xhtml">

    <head>
      <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
      <title>Phoenix Peth</title>
          <style>
          .button {
              background-color: #4CAF50; /* Green */
              border: none;
              color: white;
              padding: 15px 32px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
          }

          .button2 {background-color: #008CBA;} /* Blue */
          .button3 {background-color: #f44336;} /* Red */ 
          .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
          .button5 {background-color: #555555;} /* Black */
          </style>
  </head>

  <body style="font-family: Arial;
      width: 100%;
      background-color: #f2f2f2;
      padding:30px;
      max-width: 600px;
      margin: 0 auto;;

    ">
      <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
          <div class="main_container" style="max-width:600px; margin:0px;">
              <div class="header" style="margin-bottom:50px;">
                  <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                      <div style="    text-shadow: 1px 0px 2px #626262;
      color: #626262;">UPSI Updated</div>
                  </div>
                   <div style="clear:both;"></div>
              </div>
          <div style="    background-color: #f2f2f2;
      padding: 18px;">
      <p>Dear '.$username.', 
      </p>
      <p>This is to inform you that,you have been added to the UPSI titled '.$upsitype.' on '.$emaildate.'. This UPSI was created by '.$ownername.' on '.$date_timestamp.'.
       </p>
      
             
          </div>
      </div>

      </div>
  </body>
  </html>';

  //echo $html; exit; 

   return $html;
} 

public function mailofupdatedp($tomail,$tousername,$pstartdate,$enddate,$today,$fromusername,$upsitype)
  {   
       //echo "<pre>";print_r($userids);exit;
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;
        width: 100%;
        background-color: #f2f2f2;
        padding:30px;
        max-width: 600px;
        margin: 0 auto;;

      ">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:50px;">
                    <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">Trading Window Closure</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$tousername.'</p>
        <p>You have been added as Project Owner / Project member in connection with Project as mentioned herein, which is Unpublished Price Sensitive Information (UPSI).</p>
        <p>As part of the Project, you would be deemed to be in possession / recipient <b>of Unpublished Price Sensitive Information (UPSI) </b>in relation to the affairs concerning the Company. Please note that all UPSI in your possession or that may be shared with you over the course of time, are private and confidential and intended to be used STRICTLY for legitimate purposes only in pursuance to the applicable provisions of the SEBI (Prohibition of Insider Trading) Regulations, 2015 (including any amendment(s) or re-enactment(s) thereof) (SEBI PIT Regulations).</p>
        <p>The holder/recipient of UPSI (including its Representative) is expected to maintain highest level of confidentiality and shall abide by and undertake to comply with the applicable provisions of the said SEBI PIT Regulations in dealings concerning the listed securities of the Company.</p>
        
                <div class="main">
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                    UPSI Name : '.$upsitype.',</div>
                    
                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                    Name added by : '.$fromusername.',</div>
                       
                       <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                       Project Start Date : '.$pstartdate.',</div>
                       
                       <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">
                       Date of closure of Trading Window : '.$enddate.',</div> 

                    <div style="font-size: 14px;margin-bottom: 15px;color: #626262;font-weight: 700;letter-spacing: .7px;">        Project End Date : to be notified </div> 
                     <p>Please note that in view of the holding of aforesaid UPSI, the trading window to deal in the listed securities of the Company, has been closed for you and your immediate relatives with immediate effect and shall continue to be so till 48 hours after the said UPSI is made available to public or such activity or project is abandoned.</p>
                     <p>Please consult the Corporate Governance Dept. for any query or clarification. </p>
                     <div><br></div>
                     <p>Regards,</p>
                     <p>Corporate Governance Team</p>
                     
                </div>
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
}


 
public function internalmember($uniquemail,$sharingdate,$upsiname,$toname,$projctowner)
{   
       $title ="You have been added to digital database of Dr. Reddy's Laboratories Ltd";
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            ol,ul{ padding-left: 18px; text-align: justify;}
            ol>li{margin-bottom: 15px;}
            ol>li>ol>li{margin-bottom: 10px;}            
            ol>li>ol{margin-top: 10px;}            
            ol>li>ol>ul>li{margin-bottom:5px;}

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;width: 100%;background-color: #f2f2f2;padding:30px;max-width: 600px;margin: 0 auto;">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:25px;">
                    <div class="header_img" style="/*width:300px;*/float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">'.$title.'.</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$toname.'</p>
        <p>Please note that you have received information pertaining to '.$upsiname.' on '.$sharingdate.'. Please note that the information is Unpublished Price Sensitive Information (UPSI) as defined in SEBI (Prohibition of Insider Trading) Regulations, 2015, as amended from time to time and the '; $html.="Company's "; $html.='Code of Conduct to Regulate, Monitor and Report Trading by Designated Persons (hereinafter collectively referred to as "Insider Trading Regulations").</p>
        
                <div class="main">
                    <div style="">Accordingly, you are requested to ensure the below:</div>

                    <ol type="a">';
                      $html.="<li>Such UPSI should not be shared with any one and should be kept confidential.</li>

                      <li>Since this UPSI is being shared with you, you are deemed to be an insider as defined in Insider Trading Regulations. No insider or his/her immediate relative shall trade / deal in Company's securities when in possession of UPSI pursuant to Insider Trading Regulations.</li>

                      <li>You are required to ensure compliance with the Insider Trading Regulations and Company's Code of Conduct to Regulate, Monitor and Report Trading by Designated Persons (Code) including duties, responsibilities attached to the receipt of this UPSI and liabilities related to misuse or unwarranted use of such UPSI.</li>

                     <li>You are required to communicate, provide or allow access to this UPSI with other designated person or outsider for legitimate purposes, performance of duties or discharge of your legal obligations as provided under the SEBI Insider Trading Regulations. In case you are required to share this UPSI or a part of such UPSI with any other designated person or outsider, you are required to make an entry of such person/entity in the Insider Trading Compliance software (Volody) of the Company. Please follow the process mentioned below";

                        $html.='<ol>
                          <li>Log in to your Insider Trading Compliance software (Volody) through ihub or click on http://insidertrading.mydrreddys.com/</li>
                          <li>On the left hand menu &#8594; UPSI Sharing &#8594; Information Sharing.</li>
                          <li>Click on (+) on extreme right column of the relevant UPSI to add or view recipients.</li>
                          <li>Search the name of the recipient through the search option. Automatically his name, category and type of UPSI will get pre-populated.</li>
                          <li>Enter date of information sharing, time of information sharing, nature of data shared. You may also attach any document showing such sharing for e.g. Email screenshot etc.</li>
                          <li>Please do not enter end date. </li>
                        </ol>
                      </li>';

                      $html.="<li>If you are not able to search the name of the designated person or outsider, please get in touch with the Secretarial team or Compliance officer for getting such person added on the application. </li>
                      <li>You are required to ensure that while sharing this UPSI the recipient of such information is aware of its confidentiality and shall ensure that the recipient use such UPSI in compliance with provision of this Code and Insider Trading Regulations.</li>
                      <li>You are responsible for ensuring that the relevant entries of names of designated persons and outsider who are in receipt of this UPSI as shared by you for legitimate purposes are added in the structured digital database required to be maintained by the Company for UPSI under Insider Trading Regulations. </li>
                    </ol>";
                     
                $html.="</div>


        <p>Regards<br>Corporate Secretarial team<br>Dr. Reddy's Laboratories Limited </p>
            </div>
        </div>

        </div>
    </body>
    </html>";

    //echo $html; exit; 

     return $html;
}



public function externalmember($uniquemail,$sharingdate,$upsiname,$toname,$projctowner)
  {   
       //echo "<pre>";print_r($userids);exit;
    $title ="You have been added to digital database of Dr. Reddy's Laboratories Ltd";
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            ol,ul{ padding-left: 18px; text-align: justify;}
            ol>li{margin-bottom: 15px;}
            ol>li>ol>li{margin-bottom: 10px;}            
            ol>li>ol{margin-top: 10px;}            
            ol>li>ol>ul>li{margin-bottom:5px;}

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;width: 100%;background-color: #f2f2f2;padding:30px;max-width: 600px;margin: 0 auto;">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:25px;">
                    <div class="header_img" style="/*width:300px;*/float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">'.$title.'.</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$toname.'</p>';
        $html.="<p>Please note that you have received information pertaining to ".$upsiname." of Dr. Reddy's Laboratories Limited (Company) on ".$sharingdate.". ";
        $html.='Please note that the information is Unpublished Price Sensitive Information (UPSI) as defined in SEBI (Prohibition of Insider Trading) Regulations, 2015, as amended from time to time (hereinafter referred to as "Insider Trading Regulations").</p>
        
                <div class="main">
                    <div style="">Accordingly, you are requested to ensure the below:</div>

                    <ol type="a">';
                      $html.="<li>In addition to the Confidentiality and Non-Disclosure agreements, such UPSI should not be shared with any one and should be kept confidential.</li>

                      <li>Since this UPSI is being shared with you, you are deemed to be an insider as defined in Insider Trading Regulations. No insider shall trade / deal in Company's securities when in possession of UPSI pursuant to Insider Trading Regulations.</li>

                      <li>You are required to ensure compliance with the Insider Trading Regulations including duties, responsibilities attached to the receipt of this UPSI  and liabilities related to misuse or unwarranted use of such UPSI.</li>

                      <li>Please note that whenever you share this UPSI with any other person or entity, such person, entity with whom UPSI is being shared shall also be deemed to be an insider, for the purpose Insider Trading Regulations.</li>

                      <li>Kindly ensure that your organisation maintains the details with reference to structural digital database, as required under the Insider Trading Regulations and comply with the said regulations.</li>

                      <li>The Company is expected to maintain a database of the UPSI shared within and outside the Company for legitimate purposes. The Company may disclose the details pertaining to such sharing of UPSI with regulatory authorities, as permitted or required by applicable laws or regulatory requirements. In such a case, we will endeavour to disclose only the requested information under the circumstances; as part of the Company's reporting or disclosure obligations, if so required.</li>";
                    $html.="</ol>
                   
                    
                    
                     
                </div>

                
        <p>Regards<br>Corporate Secretarial team<br>Dr. Reddy's Laboratories Limited </p>
            </div>
        </div>

        </div> 
    </body>
    </html>";

    //echo $html; exit; 

     return $html;
}


   
public function mailofpersonalinfo($data)
  {   
     $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
                $baseuri = $this->url->getBaseUri();
                $baseurl = $server_link.$baseuri;
  $html='<!DOCTYPE html>
   <html>
  <head>
  </head>

 <body style="margin:0; background: #e5e5e5;">
        <table cellpadding="0" cellspacing="0" width="100%" border="0">
    <tr>
     <td>
     <table cellpadding="0" cellspacing="0" border="0" style="font-family:"Roboto,Arial, Helvetica, sans-serif; max-width:680px; font-size:12px; color:#333; background: #fff; align="center">

       <tr>
            <td style="padding:20px 0 20px 0px; background: #f8f8f8;width:50%;" align="center">
               
            </td>

            <td align="center" style="background: #f8f8f8;width:50%;">
                
            </td>
       </tr>

     
      <tr>
         <td  colspan="2" style="padding-top: 20px;padding-left: 20px; background: #fff;">
          <p>Dear '.$data['fname'].',</p>';
          $html.="<p>You have updated Personal Information section of 'personal information' under 'My info'. This is for your information..</p>";
       
         $html.='</td>
      </tr>

      <tr>
         <td align="center" colspan="2" style="padding-top: 20px; background: #fff;">
          <form target="_blank">
           

             <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px"> Employee ID:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600"> '.$data['ecode'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px;font-weight:600">Name:</span>

                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600"> '.$data['fname'].'</span>
              </div>
            </div>

           

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Email ID :</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['toemail'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px;font-weight:600">PAN :</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['pan'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Any other legal identifier:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['legal_idntfr'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Other legal identification No:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['legal_idntfctn_no'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px;font-weight:600">Aadhaar:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['aadhar'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Date of Birth:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['dob'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Gender :</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['sex'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px;font-weight:600">Educational Qualification:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['eduqulfcn'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Institute:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['institute'].'</span>
              </div>
            </div>

            
            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px;font-weight:600">Address:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['address'].'</span>
              </div>
            </div>

            <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">Mobile No:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['mobno'].'</span>
              </div>
            </div>

             <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">No. of shares held in DRL:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['shareholdng'].'</span>
              </div>
            </div>

             <div style="background:#f8f8f8;width:80%;border-radius:3px;margin:10px 0">
              <div style="border:0;outline:0;color:#333;background:0;width:100%;padding:8px 0;font-weight:600;display:flex">
                <span style="width:35%;text-align:center;color:#5d5d5d;font-size:14px">No. of American Depository Receipts held in DRL:</span>
                <span style="width:65%;float:right;text-align:left;color:#5d5d5d;font-size:12px;font-weight:600">'.$data['adrsholdng'].'</span>
              </div>
            </div>

          </form>
         </td>
      </tr>

      <tr>
          <td style="padding:0px 0 20px 0; background: #f7f7f7; padding: 10px;" colspan="2">
          <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr>
              <td align="center" colspan="2">
                <p style="font-weight:600; letter-spacing: 1px; color:#333; font-size:20px; font-family:\'Roboto\',Arial,Helvetica,sans-serif;">For Support</p>
              </td>
            </tr>

              <tr>
                  <td align="center" style="width:340px">
                  
                  <p style="margin:5px 0 0; color:#333; font-family:\'Roboto\',Arial,Helvetica,sans-serif; font-size:15px;">+91 8080809301</p>
                  </td>


                  <td align="center" style="width:340px">
                    
                    <p style="margin:5px 0 0; font-family:\'Roboto\',Arial,Helvetica,sans-serif; font-size:15px;"><a href="mailto:care@pretr.com" style="color:#333; text-decoration:none; border:0; outline:0;"> connect@volody.in</a></p>
                  </td>
              </tr>

          </table>
          </td>
      </tr>

      <tr>
           <td align="center" colspan="2" style="max-width:100%; line-height:25px; background: #333;">
           <p style="margin:0px; padding:8px 0 8px 0;  color:#fff; font-size:12px; font-family:\'Roboto\',Arial,Helvetica,sans-serif;">2020-21 Volody Products Pvt Ltd. - volody.com </p>
            </td>
      </tr>

    </table>
         
    </td>
    </tr>


      </table>
  </body>

 </html>';

    //echo $html; exit; 

     return $html;
}


public function notifyupsi($addedby,$addedbyemail,$title,$desc,$todaydate,$dayOfWeek)
  {   
      // echo "<pre>";print_r($data);exit;
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            ol,ul{ padding-left: 18px; text-align: justify;}
            ol>li{margin-bottom: 15px;}
            ol>li>ol>li{margin-bottom: 10px;}            
            ol>li>ol{margin-top: 10px;}            
            ol>li>ol>ul>li{margin-bottom:5px;}

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;width: 100%;background-color: #f2f2f2;padding:30px;max-width: 600px;margin: 0 auto;">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:25px;">
                    <div class="header_img" style="/*width:300px;*/float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">New UPSI Created</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$addedby.'</p>
        <p>You have created an entry in the UPSI module for '.$title.' on '.$dayOfWeek.', '.$todaydate.'. This is for your information. 
          </p>
        
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
}



public function notifysharing($name,$loggedemail,$upsiname,$todaydate,$dayOfWeek,$nameoflogged)
  {   
         //echo "<pre>";print_r($upsiname);exit;
            $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="htth3://www.w3.org/1999/xhtml">

      <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
            <style>
            .button {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }

            ol,ul{ padding-left: 18px; text-align: justify;}
            ol>li{margin-bottom: 15px;}
            ol>li>ol>li{margin-bottom: 10px;}            
            ol>li>ol{margin-top: 10px;}            
            ol>li>ol>ul>li{margin-bottom:5px;}

            .button2 {background-color: #008CBA;} /* Blue */
            .button3 {background-color: #f44336;} /* Red */ 
            .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
            .button5 {background-color: #555555;} /* Black */
            </style>
    </head>

    <body style="font-family: Arial;width: 100%;background-color: #f2f2f2;padding:30px;max-width: 600px;margin: 0 auto;">
        <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
            <div class="main_container" style="max-width:600px; margin:0px;">
                <div class="header" style="margin-bottom:25px;">
                    <div class="header_img" style="/*width:300px;*/float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                        <div style="    text-shadow: 1px 0px 2px #626262;
        color: #626262;">A new entry was added in UPSI</div>
                    </div>
                     <div style="clear:both;"></div>
                </div>
            <div style="    background-color: #f2f2f2;
        padding: 18px;">
        <p>Dear '.$nameoflogged.'</p>
        <p>You have created an entry for information sharing with '.$name.' for the UPSI pertaining to '.$upsiname.' on '.$dayOfWeek.' '.$todaydate.'. This is for your information. 
          </p> 
        
            </div>
        </div>

        </div>
    </body>
    </html>';

    //echo $html; exit; 

     return $html;
}
    
    public function Reqform2content($userdata,$data,$personaldata)
    {
        $todate = date('d-m-Y');
        $transreason = '';
//        print_r($userdata);
//        print_r($data);exit;
        if($data['typeoftrans'] == 1 || $data['typeoftrans'] == 3 || $data['typeoftrans'] == 4)
        {
            $transtype = 'Purchase';
        }
        else if($data['typeoftrans'] == 2)
        {
            $transtype = 'Sell';
        }
        
       $html=' <div>
          <table style=" border-collapse: collapse; border: none;" border="0" cellpadding="0" cellspacing="0" width="100%">
           <tr>';
              $html.="<td>Dr. Reddy's Laboratories Limited</td>";
              $html.='<!-- <td><img src="img/dr reddy logo BnW"></td> -->                       
            </tr>
          </table>

          <p style="text-align: center;"><b>
            Form II<br/>
            (Application for grant of relaxation of minimum holding period) <br/>
            Under Clause 9.1(a) of the Code</b>
          </p>

          <br/>

          <p style="text-align: left;">
            The Compliance Officer<br/>';
            $html.="<b>Dr. Reddy's Laboratories Limited</b><br/>";
            $html.='Hyderabad
          </p>

          <br/>

          <p>Dears Sir,<br/><br/>
           In terms of Clause 9.1(a) of the Code, I would like to state that I intend to '.$transtype.' '.$data['noofshare'].' shares/ADRs/options of the Company because of following reason(s):-
          </p>

          <br/>

          

          <br/>

          <table style=" border-collapse: collapse; border: none;" border="0" cellpadding="0" cellspacing="0" width="100%">
          
          <tr>';
        $transreason = 'Medical Expenses for self / family Members';
        $type1 = '';
        $type2 = '';
        $type3 = '';
        $type4 = '';
        $type5 = '';
        if($data['typeofrequest'] == '1' &&  $data['reasonoftrans'] == '1')
        {
            $transreason = 'Medical Expenses for self';
            $type1 = ' - Yes';
        }
        else if($data['typeofrequest'] == '2' &&  $data['reasonoftrans'] == '1')
        {
            $transreason = 'Medical Expenses for family Members';
            $type1 = ' - Yes';
        }
        if($data['reasonoftrans'] == '2')
        {
           $type2 = ' - Yes';
        }
        if($data['reasonoftrans'] == '3')
        {
           $type3 = ' - Yes';
        }
        if($data['reasonoftrans'] == '4')
        {
           $type4 = ' - Yes';
        }
        if($data['reasonoftrans'] == '4')
        {
           $type5 = ' - Yes';
        }
        
              $html.='<td width="50%"><ul style="padding-left: 17px;"><li type="circle">'.$transreason.''.$type1.'</li></ul></td>
              <td width="50%"><ul style="padding-left: 17px;"><li type="circle">Repayment of existing Loan'.$type2.'</li></ul></td>                    
            </tr>
            <tr>
              <td width="50%"><ul style="padding-left: 17px;"><li type="circle">Education'.$type3.'</li></ul></td>
              <td width="50%"><ul style="padding-left: 17px;"><li type="circle">Wedding /other family function'.$type4.'</li></ul></td>                         
            </tr>
            <tr>
              <td width="50%"><ul style="padding-left: 17px;"><li type="circle">Any other reason (Please specify) '.$type5.' :'.$data['otherreason'].'</li></ul></td>                         
            </tr>';
                  
          $html.='</table>

          <br/>

          <table style=" border-collapse: collapse; border: none;" border="0" cellpadding="0" cellspacing="0" width="100%">
           <tr>
              <td width="50%">Date of last purchase / sale<br/>
                  (Immediately prior to the date of this application) <br/><br/> </td>
              <td width="50%"> '.$data['lasttransdate'].'</td>                    
            </tr>
            <tr>
              <td width="50%">No. of shares / ADRs purchase/sold  <br/>
                  (Immediately prior to the date of this application)<br/><br/> </td>
              <td width="50%"> '.$data['noofshareoftrans'].'</td>                         
            </tr>
            <tr>
              <td width="50%">No. of shares / ADRs held as on date</td>
              <td width="50%"> '.$personaldata['sharehldng'].' / '.$personaldata['adrshldng'].'</td>                          
            </tr>
          </table>

          <br/>

          <p>You are requested to consider my application and grant the relaxation to enter into an opposite transaction within 6 months period basis the above reason(s) and undertaking given herein below:-. </p>

          <p><b>I hereby undertake and confirm that,</b></p>
          <ol style="padding-left: 17px;">
            <li>I do not have any access or have not received "Unpublished Price Sensitive Information" up to the time of signing this undertaking.</li>
            <li>In case I have access to or have received "Unpublished Price Sensitive Information" after the signing of the undertaking but before the execution of the transaction I will inform the Compliance Officer of the change in my position and that I or my Immediate Relative(s) would completely refrain from dealing in the Securities till the time such information becomes public.</li>
            <li>I have not contravened the Code (as amended from time to time) and any of the provisions of the Insider Trading Regulations (as applicable).</li>
          </ol>

          <br/>

          <p>I further confirm that the aforesaid facts are true and correct and I shall be fully responsible for any wrongful acts and/or misrepresentation done by me or my Immediate Relative(s) including such penalties as may be imposed by the Company/ SEBI.<br/><br/>
        Thanking you,<br/><br/>
        Yours faithfully,<br/><br/><br/>

        ---------------------<br/>
        Name: '.$userdata['fullname'].'<br/>
        Employee code: '.$userdata['employeecode'].'<br/>
        Designation: '.$userdata['designation'].'<br/>
        Date: '.$todate.'<br/>
        Place: '.$data['form2place'].'<br/>
        </p>
        </div>';
        //print_r($html);exit;
        return $html;
    }


public function formI($personalinfo,$itmemberinfo,$approxprice,$broker,$demataccount,$place,$datetrans,$transaction,$sharestrans,$nature,$noofshare,$date,$dp,$dpacc,$relativename)
  {   
         //echo "<pre>";print_r($datetrans);exit;
            $html='<div>
  <table style="  border: none;" border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>';
      $html.="<td>Dr. Reddy's Laboratories Limited</td>";
      $html.='                    
    </tr>
  </table>

  <p style="text-align: center;"><b>
    Form I<br/>
    (Application for pre-clearance of trade)  <br/>
    Under Clause 8 of the Code</b>
  </p>

  <br/>

  <p style="text-align: left;">
    The Compliance Officer<br/>';
    $html.="<b>Dr. Reddy's Laboratories Limited</b><br/>";
    $html.="Hyderabad
  </p>

  <br/>

  <p>Dear Sir,<br/><br/>
   I/we am/are desirous of dealing in the shares / ADRs of the Company.  In terms of the Company's Code, I/we seek your approval for the trade as detailed below:";
  $html.='</p>

  <br/>

  <table width="100%" style="border-collapse: collapse;">
    <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">Name of Designated Person</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$itmemberinfo['fullname'].'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">Employee Code</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$itmemberinfo['employeecode'].'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">Designation</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$itmemberinfo['designation'].'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">Name of the Immediate relative with relationship<br/>(if he/she intends to deal)</td>
      <td style="border: 1px solid #000;padding: 5px;  "  width="60%">'.$relativename.'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">No. of shares/ADRs held as on this date</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$personalinfo['sharehldng'].' / '.$personalinfo['adrshldng'].'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000; padding: 5px; " width="40%">Approx. price or range<br/> (shares/ADRs * market price)</td>
      <td style="border: 1px solid #000; padding: 5px; "  width="60%">'.$approxprice.'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">Nature of deal – Purchase / Sale</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$nature.'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000; padding: 5px; " width="40%">No. of shares / ADRs intended to be dealt in within next 7 days</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$noofshare.'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000; padding: 5px; " width="40%">Broker through which dealing will take place</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$broker.'</td>
    </tr>
     <tr>
      <td style="border: 1px solid #000;padding: 5px; " width="40%">DP name with whom the demat account is maintained along with DP ID and Client ID / Folio no.</td>
      <td style="border: 1px solid #000;padding: 5px; "  width="60%">'.$dp.' '.$dpacc.'</td>
    </tr>    
     <tr>';
      $html.='<td style="border: 1px solid #000;padding: 5px; " width="40%">';$html.="Provide, details, of any transaction done in Company's Security in the last Six months (Except exercise of stock options)</td>";
      $html.='<td style="border: 1px solid #000;padding: 0;" width="60%">
      <table style="width:500px;border: 2px solid #fff;" width="500px">
       <tr>
        <th style="border: 1px solid;padding: 10px;background: none;color: #000;width:33%; min-width=33%;" width="33%">Date</th>
        <th style="border: 1px solid;padding: 10px;background: none;color: #000;width:33%; min-width=33%;" width="33%">Transaction</th>
        <th style="border: 1px solid;padding: 10px;background: none;color: #000;width:33%; min-width=33%;" width="33%">No. of shares</th>
        </tr>';
        if(count($datetrans) != 0)
        {
        for($i= 0 ;$i<count($datetrans);$i++)
        { 
          $html.= '<tr>
          <td style="border: 1px solid;padding: 10px;width:33%; min-width=33%;" width="33%">'.$datetrans[$i].'</td>
          <td style="border: 1px solid;padding: 10px;width:33%; min-width=33%;" width="33%">'. $transaction[$i].'</td>
          <td style="border: 1px solid;padding: 10px;width:33%; min-width=33%;" width="33%">'.$sharestrans[$i].'</td>
          </tr>';
         }}
      $html.= '</table>
      </td>
    </tr>
  </table>

  <br/>
  

  <p><b>I hereby undertake and confirm that,</b></p>
  <ol style="padding-left: 17px;">
    <li>I do not have any access or have not received "Unpublished Price Sensitive Information" up to the time of signing this undertaking.</li>
    <li>In case I have access to or have received "Unpublished Price Sensitive Information" after the signing of the undertaking but before the execution of the transaction I shall inform the Compliance Officer of the change in my position and that I or my immediate relatives would completely refrain from dealing in the Securities till the time such information becomes public.</li>
    <li>I have not contravened the Code (as amended from time to time) and any of the provisions of the Insider Trading Regulations (as applicable).</li>
  </ol>

  <p>I further confirm that the aforesaid facts are true and correct and I shall be fully responsible for any wrongful acts and / or misrepresentation done by me or my immediate relatives including such penalties as may be imposed by the Company / SEBI.<br/><br/>You are requested to provide your approval to the aforesaid transaction. <br/><br/>

  Thanking you,<br/><br/>
  Yours faithfully,<br/>
  '.$itmemberinfo['fullname'].'<br/><br/>
 
  Place: '.$place.'<br/>
  Date:'.$date.'<br/>
  </p>

  <br/>

  <p><b>Note:</b><br/>
  <ol style="padding-left: 17px;">
    <li>This application has to be submitted through electronic system / mail and followed by a hard copy.</li>
    <li>Fresh application for pre-clearance shall be required if the trade is not executed within 7 days of approval.</li>
    <li>This is a computer generated document and does not require signature.</li>
  </ol>
  </p>
 
 
</div>
';

    //echo $html; exit; 

     return $html;
}



 /********** send RTA Reconcilation start *********/
   public function sendmailRTA($name,$diffrnc)
   {
       
      
   //echo "<pre>";print_r($userids);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="htth3://www.w3.org/1999/xhtml">

<head>
    <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Phoenix Peth</title>
        <style>
        p{color: black;}
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
        </style>
</head>

<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px;">
               <p>Dear '.$name.',</p> 
               <p>On reconciliation with Company’s Registrar and Transfer Agent’s records, please note that a mismatch of '.$diffrnc.' shares has been observed in the number of shares held by you in the Company. You are requested to kindly review such mismatch and update your correct holding in the insider trading application system. 
               </p> 
               <p>Thank you. </p> 
               
                
            </div
                  
            </div>
        </div>
    </div>
        
    </div>
</body>
</html>';

//echo $html; exit; 

 return $html;
}
  /********** send RTA Reconcilation end ***********/



  /*---- Send Auto Mail to User For Annual Declaration -----*/
    public function mailsenttousrfranualdecl($username,$year)
    {
        // print_r($getname);exit;
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="htth3://www.w3.org/1999/xhtml">
        <head>
        <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title>Phoenix Peth</title>
        </head>


<body style="font-family: Arial;
    width: 100%;
    background-color: #f2f2f2;
    padding:30px;
    max-width: 600px;
    margin: 0 auto;;

  ">
    <div class="container" style=" max-width:600px; margin: 0 auto; background-color: #fff;padding:25px;">
        <div class="main_container" style="max-width:600px; margin:0px;">
            <div class="header" style="margin-bottom:50px;">
                <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
                    <div style="    text-shadow: 1px 0px 2px #626262;
    color: #626262;">Annual Declaration Pending</div>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;margin-bottom: 15px;color: #626262;letter-spacing: .7px; text-transform: capitalize;">
               <p>Hello,</p> 
               <p>As every year, we look forward to your support in submitting your annual disclosures under SEBI Insider Trading Regulations and Listing Regulations. Please login to iHub à All apps àCompany information àCompliance àInsider Trading Compliance for accessing the application. Please update the three tabs under ‘My info’, as applicable. The details under ‘My Info’ will comprise your annual disclosures under Insider Trading and is applicable to all of you. Once these details under ‘My Info’ are filled in please submit your ‘Annual Declaration’ online to the Compliance Officer.</p> 
               <p>If you are in role bands - Yellow, Orange and Red (Y-O-R) – please note that the Related Party Disclosure is applicable only to you and will be visible only on your respective applications.  we have combined both your annual disclosures (i.e. under requirements of Insider trading and under SEBI Listing Regulations and Related Party Disclosure) on this application. We therefore request you to kindly fill up your details and submit your applicable Disclosures on or before March 31 '.$year.'.</p>
               <p>Going forward, you can update any changes related to your and/or your relatives’ personal details during the year. Accordingly, next year on 31 March, you will have an updated disclosure automatically ready for your submission with just a click of a button.</p>
               <p>In case of any issues, we request you to get in touch with Techease (IT) or Secretarial team for support in completing your compliance.</p>
               <p>Regards<br>Sandeep</p> 
               
                
            </div
                  
            </div>
        </div>
    </div>
        
    </div>
</body>
       
</html>';


return $html;
}
    /*---- Send Auto Mail to User For Annual Declaration -----*/

      /* Send Mail to Requestor after submit form */
     public function sendAckMailtoReq($myarr)
     {
         $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
         
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['requestername'].'</h3>
          <h3>This is to confirm that your Conflict of Interest declaration has been submitted. You may view your request summary below.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Disclosure made by:</b></th><td>'.$myarr['requestername'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>You will be duly notified of any change in status of approval.</h3>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }

    /* Send Mail to Requestor after submit form */

    public function sendRemindtoReqstr($username)
    {
        $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="htth3://www.w3.org/1999/xhtml">
            <head>
            <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
            <title>Phoenix Peth</title>
            </head>
            <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
            <div class="container" style="width:100%; max-width:600px; margin: 0 auto; border-top: 5px solid #373F89;    box-shadow: 0 0 20px rgba(0,0,0,.3);">
            <div class="main_container" style="max-width:550px; margin:0 20px;">
            <div class="header" style="margin-bottom:50px;">
            <div class="header_img" style="width:300px;float:none;display: block;margin: 0px auto;text-align:center;margin-top: 10px;font-size:31px;color:#fff;font-weight:bold;">
            <div style="text-shadow: 1px 0px 2px #626262;color: #626262;">Volody</div>
            </div>

            <div style="clear:both;"></div></div>

            <div class="main">
            <div class="circlech" style="background: -webkit-linear-gradient(top,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));background: linear-gradient(to bottom,rgba(255,255,255,.8) 0,rgba(255,255,255,.6) 20%,rgba(255,255,255,.8));border-radius: 50%;width: 250px;height: 100px;line-height: normal;text-align: center;max-width: 100%;    position: relative;top: 0px;left: 0px;right:0px; z-index: 1;margin:0px auto;">
            <div style="padding: 0px 0px;"><div  style="font-size: 25px;color: #215c86;">Dear '.$username.',</div>
            <div style="color: #67b9c7;font-weight: bold;">Your Conflict of Interest Declaration Form is Pending.</div>
            </div>
            </div>

            </div>
            </div>
            <div class="footer" style="width:100%; max-width:600px; margin: 0 auto; position:relative;padding-bottom: 10px;">

            <div class="mnfootetext" style="position: relative;z-index: 1;margin: 0 20px;margin-top: 50px;background: rgba(255,255,255,1);box-shadow: 0 0 20px rgba(0,0,0,.3);">

            <div style="clear:both;"></div>
            <div class="footer_text_down" style="text; margin-top: 10px;">
            <div style="padding: 8px 0px; color:#626262; font-size:12px; text-align:center;">&copy; Volody. All rights reserved </div>
            </div>
            </div>
            </div>
            </div>
            </body>
            </html>';
            return $html;
    }
    
    public function requestapprmailtoccoandcs($myarr)
    {
        $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
        
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>A Conflict of Interest declaration has been submitted by '.$myarr['requestername'].' for approval by their HR and Manager. This is for your information. Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
    }   

    public function rejectmailtoccoandcs($myarr)
    {
        $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
        
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>A Conflict of Interest declaration submitted by '.$myarr['requestername'].' has been Rejected by their HR and Manager and accordingly communicated to them. This is for your information. Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Disclosure made by:</b></th><td>'.$myarr['requestername'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Rejected by:</b></th><td>'.$myarr['rejected_by'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
    }  


    public function returnmailtoccoandcs($myarr)
    {
        $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
        
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>A Conflict of Interest declaration submitted by '.$myarr['requestername'].' has been Returned by their HR and Manager and accordingly communicated to them. This is for your information. Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Disclosure made by:</b></th><td>'.$myarr['requestername'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Returned by:</b></th><td>'.$myarr['returned_by'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
    }  

     public function returnMailToRequestor($myarr)
     {
         $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
         
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>This is to inform you that your Conflict of Interest declaration request has been Returned. You may review the comments below and resubmit your request:</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Reason For Return:</b></th><td>'.$myarr['reason_for_return'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }  

     public function approvalMailToRequestor($myarr)
     {
         $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
         
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>This is to inform you that your Conflict of Interest declaration request has been Approved. Below is the summary.</h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     } 

     public function rejectMailToRequestor($myarr)
     {
            $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";            
            $baseuri = $this->url->getBaseUri();
            $baseurl = $server_link.$baseuri;
         
          // print_r($myarr);exit;
          $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="htth3://www.w3.org/1999/xhtml">
          <head>
          <meta htth3-equiv="Content-Tyh3e" content="text/html; charset=utf-8"/>
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
          <title></title>
          </head>
          <body style="margin: 0px;padding: 0px;font-family: Arial;width: 100%;max-width:600px;margin: 0 auto;border-top: 5px solid #373F89;background:#fff;">
          <h3>Dear '.$myarr['recipientname'].'</h3>
          <h3>This is to inform you that your Conflict of Interest declaration request has been Rejected. Below is the summary. </h3>
          <h3>COI Declaration Details</h3>
          <table width="100%" border="1px" cellpadding="5px" style="border-collapse: collapse;width: 100%;">
            <tbody>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Request Number:</b></th><td>'.$myarr['reqno'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Nature of Conflict:</b></th><td>'.$myarr['nature_of_conflict'].'</td>
              </tr>
              <tr>
                <th bgcolor="#f1f1f1" align="left"><b>Department:</b></th><td>'.$myarr['deptname'].'</td>
              </tr>
            </tbody>
          </table>
          <h3>Please <a href="'.$baseurl.'">click here</a> for more details.</h3>
          <h3>This mail is generated automatically. Please do not reply.</h3>
          </body>
          </html>';

          // print_r($html);exit;
      return $html;
     }

    
}



