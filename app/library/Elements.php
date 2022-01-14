<?php

use Phalcon\Mvc\User\Component;
use Phalcon\Translate\Adapter\NativeArray;
/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{

    public function checkalreadyuserloggedin()
    {
        $LoginAuthsAdmin = $this->session->loginauthspuserfront;
        //echo '<pre>';print_r($LoginAuthsAdmin);exit;
        if(isset($LoginAuthsAdmin) && ($LoginAuthsAdmin != NULL) || !empty($LoginAuthsAdmin))
        {$this->response->redirect('home');}else{}
    }

    public function checkuserloggedin()
    {
        $LoginAuthsAdmin = $this->session->loginauthspuserfront;

        if(isset($LoginAuthsAdmin) && ($LoginAuthsAdmin == NULL) || empty($LoginAuthsAdmin))
        {
            $this->response->redirect('login');
        }

    }

     /*-----#################### DATE VALIDATION FOR INPUT DATE START####################-----------------*/
    
    public function checkdate($m,$y,$d)
    {   
        if(checkdate($m, $d, $y))
        {
            $status = "valid";
        }
        else
        {
            $status = "not valid";
        }
        return $status;
    }
    
    /*-----#################### DATE VALIDATION FOR INPUT DATE END ####################-----------------*/

    public function checkuserloggedinpage()
    {
        $LoginAuthsAdmin = $this->session->loginauthspuserfront;

        if(isset($LoginAuthsAdmin) && ($LoginAuthsAdmin == NULL) || empty($LoginAuthsAdmin))
        {
            $mnv = array('status'=>false);
        }
        else
        {

            $getemail = $this->session->loginauthspuserfront['email'];
            //$type = 'empl';
            $type = '';
            //echo '<pre>';print_r($type);exit;
            $this->logincommon->loginusermnadmintoup($type,$getemail);

            $mnv = array('status'=>true);

        }
        return $mnv;
    }
    public function getontrollername()
    {
        $controllerName = $this->view->getControllerName();

        return $controllerName;
    }
    public function htmldecode($decode)
    {
        $val = htmlspecialchars_decode($decode);
        return $val;
    }
    public function allownumalphahyphen($val)
    {
        $valget =  preg_match('/[^a-zA-Z0-9-]+$/', $val);
        return $valget;
    }

     public function panvalidation($val)
    {
        $valget =  preg_match('/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/', $val);
        return $valget;
    }


    public function pwdcharregex($val)
    {
        $pwdcharter = preg_match('/[^a-zA-Z0-9\@]+/', $val);

        /*------------------#############################-----Password Logic-----###########################-----------------*/
        /*[A-Za-z0-9\@\#\*]+$
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);*/
        /*------------------#############################-----Password Logic/-----##########################-----------------*/

        return $pwdcharter;
    }


    public function getTranslation()
    {
        // Ask browser what is the best language
        $getcontroller = strtolower(trim($this->dispatcher->getControllerName()));
        $getaction = strtolower(trim($this->dispatcher->getActionName()));

        $language = $this->request->getBestLanguage();

        // Check if we have a translation file for that lang
        if(!empty($getaction) && $getaction !='index')
        {$getcontroller = "otheraction/".$getcontroller."_".$getaction."_action";}
        else
        {$getcontroller = $getcontroller;}
        //echo $getcontroller;exit;
        if (file_exists("../app/language/".$getcontroller."_language.php")) {
            require "../app/language/".$getcontroller."_language.php";
        } else {
            // Fallback to some default
            require "../app/language/errors_language.php";
        }
        // Return a translation object
        return new NativeArray(array("content" => $messages));
    }
    public function createdirectoryofuser($getuserid,$dir_uname)
    {
        $connection = $this->dbtrd;
        $timeago = time();
        //$this->session->remove('profilecommondir');
        //echo 'helllo - '.$this->session->profilecommondir['createdirname'];exit;

        $mnlog = $this->session->loginauthspuserfront;
        $gettyp = 'empl';

        $m = "SELECT * FROM `web_reg_user_ext` WHERE `userid`='".$getuserid."'";
        $uid =0;

        if($gettyp=='empl')
        {
            $m = "SELECT * FROM `web_reg_user_ext` WHERE `childid`='".$getuserid."'";
            $uid = $this->session->loginauthspuserfront['id'];

            $exegetuinfo = $this->usercommon->getuinfoext($uid);
            $exegetuinfo = array_shift($exegetuinfo);
        }
        // $exegetuinfo = $this->usercommon->getuinfoext($getuserid);
        // $exegetuinfo = array_shift($exegetuinfo);
        //echo 'Coming herer';echo count($exegetuinfo);
        //echo '<pre>';print_r($exegetuinfo);exit;

        if(empty($this->session->profilecommondir['createdirname'])){

            $getdir = $this->imagecommon->getimgdir($getuserid,$dir_uname,$this->session->getId(),'profilecommondir');
            //echo $getdir;exit;
            $exegetuinfo = array();
            if(count($exegetuinfo)==0)
            {
                $exegetuinfo['taxtypeset'] = '1';
                $exegetuinfo['invprefix'] = '';
                $exegetuinfo['taxamt'] = '';
                $exegetuinfo['merchantkey'] = '';
            }
            else
            {
                $exegetuinfo['taxtypeset'] = $exegetuinfo['taxtypeset'];
                $exegetuinfo['invprefix'] = $exegetuinfo['invprefix'];
                $exegetuinfo['taxamt'] = $exegetuinfo['taxamt'] ;$exegetuinfo['merchantkey'] = $exegetuinfo['merchantkey'];
            }
            $put = "INSERT INTO `web_reg_user_ext` (`directory`,`date_added`,`date_modified`,`timeago`,`userid`,`invprefix`,`taxtypeset`,`taxamt`,`merchantkey`) VALUES('".$getdir."',NOW(),NOW(),'".$timeago."','".$getuserid."','".$exegetuinfo['invprefix']."','".$exegetuinfo['taxtypeset']."','".$exegetuinfo['taxamt']."','".$exegetuinfo['merchantkey']."')";

            $pupdt = "UPDATE `web_reg_user_ext` SET
            `invprefix`= '".$exegetuinfo['invprefix']."',
            `taxtypeset`= '".$exegetuinfo['taxtypeset']."',
            `taxamt`= '".$exegetuinfo['taxamt']."',
            `merchantkey`= '".$exegetuinfo['merchantkey']."'
            WHERE `userid`='".$getuserid."' ";

            if($gettyp=='empl')
            {
                $put = "INSERT INTO `web_reg_user_ext`  (`directory`,`date_added`,`date_modified`,`timeago`,`userid`,`childid`,`invprefix`,`taxtypeset`,`taxamt`,`merchantkey`) VALUES('".$getdir."',NOW(),NOW(),'".$timeago."','".$uid."','".$getuserid."','".$exegetuinfo['invprefix']."','".$exegetuinfo['taxtypeset']."','".$exegetuinfo['taxamt']."','".$exegetuinfo['merchantkey']."')";

                $pupdt = "UPDATE `web_reg_user_ext` SET
                `invprefix`= '".$exegetuinfo['invprefix']."',
                `taxtypeset`= '".$exegetuinfo['taxtypeset']."',
                `taxamt`= '".$exegetuinfo['taxamt']."',
                `merchantkey`= '".$exegetuinfo['merchantkey']."'
                WHERE `childid`='".$getuserid."' AND `userid`='".$uid."'  ";

            }
            //echo $pupdt;exit;
            try {
                    $countget = $connection->query($m);
                    $row = $countget->fetch();
                    //echo '<pre>';print_r($row);exit;
                    $getnum = trim($countget->numRows());
                    //echo $getnum;exit;
                    if($getnum==0)
                    {
                        $get     = $connection->query($put);
                        $id      = $connection->lastInsertId();
                        //echo $id; exit;

                            $setsession = $this->session->set('profilecommondir',
                                        array('createdirname' => trim($getdir),
                                        'user_id' => trim($getuserid)
                                        ));
                            $get =array('logged'=>true,'dir'=>$getdir);
                    }
                    else
                    {
                            $connection->query($pupdt);

                            $setsession = $this->session->set('profilecommondir',
                                        array('createdirname' => trim($row['directory']),
                                        'user_id' => trim($row['userid'])
                                        ));
                            $get =array('logged'=>true,'dir'=>$row['directory']);


                    }

                }
                catch (Exception $e) {
                    $get = $e;
                }
            //echo '<pre>';print_r($get);exit;
        }
        else
        {
            $get = $this->session->profilecommondir['createdirname'];
        }
        return $get;
    }
    
/* ------------------------- Pagination Start ------------------------- */    
    public function paginatndata($cur_page,$no_of_paginations)
    {
        $pagnarray = array();

        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }

        $pagnarray['start_loop'] = $start_loop;
        $pagnarray['end_loop'] = $end_loop;

        return $pagnarray;
    }

    public function paginationhtml($cur_page,$start_loop,$end_loop,$no_of_paginations)
    {
        $msg = '';
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;

        $msg .= "<div class='pagination'><ul class='paginateul'>";

        // FOR ENABLING THE FIRST BUTTON
        if ($first_btn && $cur_page > 1) {
            $msg .= "<li p='1' class='active'>First</li>";
        } else if ($first_btn) {
            $msg .= "<li p='1' class='inactive'>First</li>";
        }

        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $msg .= "<li p='$pre' class='active'>Previous</li>";
        } else if ($previous_btn) {
            $msg .= "<li p='$cur_page' class='inactive'>Previous</li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $msg .= "<li p='$i' style='color:#fff;background-color:#522c8f;' class='active'>{$i}</li>";
            else
                $msg .= "<li p='$i' class='active'>{$i}</li>";
        }

        // TO ENABLE THE NEXT BUTTON
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $msg .= "<li p='$nex' class='active'>Next</li>";
        } else if ($next_btn) {
            $msg .= "<li p='$cur_page' class='inactive'>Next</li>";
        }

        // TO ENABLE THE END BUTTON
        if ($last_btn && $cur_page < $no_of_paginations) {
            $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
        } else if ($last_btn) {
            $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
        }
        // Go button if needed
        $goto = "<div class='floatright gobtnmnh '><div class='floatleft'><input type='text' class='gotobtn' size='5' value='".$cur_page."' onkeypress='return numbersonly(event,this);' /></div><div class='floatleft gobtnman'><input type='button' class='go_button' value='Go'/></div><div style='clear:both;'></div></div>";
        $total_string = "<div class='floatright ttolmnbtn'><span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span></div>";
        $msg = $msg . "<div class='clearelement'></div></ul>" . $total_string . $goto . "<div class='clearelement'></div></div>";  // Content for pagination
        return $msg;
    }
/* ------------------------- Pagination End ------------------------- */    
        
    
    private function check_in_range($start_date, $end_date, $date_from_user)
    {
      // Convert to timestamp
      $start_ts = strtotime($start_date);
      $end_ts = strtotime($end_date);
      $user_ts = strtotime($date_from_user);
      // Check that user date is between start & end
       if (($user_ts >= $start_ts) && ($user_ts <= $end_ts))
         {
            $joker = 'exist';
         }
        else
        {
            $joker = 'notexist';
        }
         return $joker ;
    }

    private function ch_dterror($getstartyear,$getendyear,$start_date,$end_date,$getdate,$quarterfilereturn,$getysel)
    {

                        $getresult  = trim($this->check_in_range($start_date, $end_date, $getdate));
                        //echo $getresult; exit;
                        if($getresult=='notexist')
                        {
                            $data = array("logged" => false,'message' => 'You are making selection for wrong month for Quarter '.$quarterfilereturn.'. You have selected year '.$getysel);
                            //$this->response->setJsonContent($data);
                        }
                        else
                        {
                            $data = array("logged" => true,'message' => 'You are making selection for month for Quarter '.$quarterfilereturn.'. You have selected year '.$getysel);
                            //$this->response->setJsonContent($data);
                        }
        return $data;
    }
    public function updatedemouser($uid)
    {
        $connection = $this->dbtrd;

        $date = date('Y-m-d 08:00:00', time());
        $getcurtime = date("Y-m-d H:i:s");
        //echo "The time is " . date("Y-m-d H:i:s");exit;
        //echo $date;exit;
        $getdata = $this->changepasswordcommon->chckuser($uid);
        $getdata = array_shift($getdata);
        //$effectiveDate = strtotime("+5 hours", strtotime($getdata['date_modified']));
        $getdatewas = $getdata['date_modified'];
        $getemail = $getdata['email'];
        $getusername = $getdata['username'];
        $confirmpassword = $this->validationcommon->randomcodegen_capsalphanum(10);
        $salt            = ($salt = substr(md5(uniqid($confirmpassword, true)), 0, 9));
        $password        = (sha1($salt . sha1($salt . sha1($confirmpassword)))) ;
        //echo $date." -- ".$getdata['date_modified']." -- ". $getcurtime;exit;
        if($date > $getdatewas)
        {
            //echo 'update date change';
            $ch_pass = $this->changepasswordcommon->pwdchange($salt, $password, $uid);
            //echo $getemail;exit;
                $getactualemail    = trim(strtolower($getemail));
                $Mail = $this->emailer;
                $emailsent = '';
                $j = $Mail->updatecronpwd($getemail,$getusername,$confirmpassword);
                if($j)
                {$emailsent='1';}else{$emailsent='0';}

                $timeago = time();

                $randomcodeemail =  $this->validationcommon->randomcodegen_alphanum(20);
                $emailverify = ("INSERT INTO `web_user_email_verified` (`user_id`,`email`, `status`, `verfiycode`,`tarat`,`date_added`,`date_modified`,timeago) VALUES ('".$uid."','".$getemail."','".$emailsent."', '".$randomcodeemail."','".$confirmpassword."','".$getcurtime."','".$getcurtime."','".$timeago."')");
                $connection->query($emailverify);
        }
        else
        {
        }
        //echo '<pre>';print_r($getdatewas);exit;
    }
    
    public function empuserlog($nearray)
    {

        $html='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Volody</title>
        </head>
        <body style="margin:0px;padding: 0px;background-color: #eff3f8:">


        <div  align="center">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
        <tr>
        <td align="center" bgcolor="#eff3f8">
        <table border="0" cellspacing="0" cellpadding="0"  width="100%" style="max-width: 680px; min-width: 300px;">
            <tr><td><div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr>
            <tr>    <td align="center" bgcolor="#ffffff">
                <div style="width: 100%;display:block;"><img src="https://volody.com/img/img.png" title="Volody BSPL" style="border:none;display: block;margin: 0px auto;width: 100%;"/></div>
                <table width="90%" border="0" cellspacing="0" cellpadding="0">

                </table>
                <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
            </td></tr>


            <tr><td align="center" style="width:70%;" bgcolor="#fbfcfd">
                <table width="90%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td>
                    <div style="width: 100%;display:block;">
                    <img src="https://volody.com/img/bg.png" title="Volody BSPL" style="border:none;display: block;margin: 0px auto;width: 100%;"/></div>


                    </td>
                </tr>

            <tr>
                <td style="width: 90%;line-height:20px;" align="left">
                    <table  border="0" cellspacing="0" cellpadding="0">
                        <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;">
                            <td align="left">
                                <div style="text-align: left;line-height: 26px;font-size: 12px;font-weight: bold;margin-top: 15px;display: block;">
                                    '.$nearray['subject'].'<br>
                                    '.$nearray['subjecttwo'].'
                                        <ul>
                                            <li>URL : https://www.volody.com/boardapp/login</li>
                                            <li>Username : '.$nearray['emailid'].' </li>
                                            <li>Password : '.$nearray['pwd'].'</li>
                                            <li>'.$nearray['subjectthree'].'</li>
                                        </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td  style="width: 90%;line-height:28px;" align="left">
                    <table  border="0" cellspacing="0" cellpadding="0">
                        <tr style="margin-top:35px; line-height:0px; display: block;font-family: Arial, Helvetica, sans-serif;  color: #57297e;  ">
                            <td align="left" >
                                <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; ">
                                    about
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 90%;line-height:18px;" align="center">
                    <table  border="0" cellspacing="0" cellpadding="0">
                        <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;">
                            <td align="left">
                                <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">
                                    Volody is a cloud based software as a service (SaaS) company committed to provide best compliance management software solutions to Tax, Legal and Secretarial Professionals and Business finance and legal functions. Volody is committed to the technology needs of professionals and businesses and provide cloud based solutions that includes Secretarial Automation Software, Practice management system, Tax Filing & Compliance System and Compliance Management software in order to automate almost every part of the day to day running of business by professionals and businesses, the regulatory filings, statutory compliances and work-flow management.
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
                </table>
            </td></tr>




            <tr><td  align="center" bgcolor="#ffffff">

                <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>

                <table width="90%" border="0" cellspacing="0" cellpadding="0">

                    <tr>
                        <td align="left">
                            <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
                                <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
                                    Best regards,
                                </span>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
                                <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
                                    Team Volody
                                </span>
                            </font>
                        </td>
                    </tr>
                            <tr>
                                <td>
                                    <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
                                </td>
                            </tr>
                    <tr>
                        <td align="center">
                            <font face="Arial, Helvetica, sans-serif"   style="font-size: 14px;">
                                <a href="https://volody.com" target="_blank" style="cursor: pointer; font-family: Arial, Helvetica, sans-serif;font-weight: bold; text-decoration: none; font-size: 14px; color: #003366;">Volody.com</a>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
                                <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
                                     &copy; Volody. ALL Rights Reserved.
                                </span>
                            </font>
                        </td>
                    </tr>
                </table>
                <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
                <div style="    height: 12px;
            line-height: 40px;
            font-size: 10px;
            background-color: #596167;"> </div>
            </td></tr>

            <tr><td>
            <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
            </td></tr>
        </table>


        </td></tr>
        </table>
        </div>

        </body>
        </html>';

    return $html;
    }
    public function gethtmlforgotpassword($name,$randomcode)
    {
        $html='
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "htth3://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    color: #626262;">Volody</div>
                </div>
                <div class="head_text" style="padding: 10px 20px 10px 20px;text-align: center;border-bottom: 2px dotted #ccc;font-size: 11px;
    color: #626262;

    text-shadow: 1px 1px 10px #fff;"> If opportunity doesnt Knock break the door. </div>
                 <div style="clear:both;"></div>
            </div>
        <div style="    background-color: #f2f2f2;
    padding: 18px;">
            <div class="main">
                <div style="font-size: 14px;
    margin-bottom: 15px;
    color: #626262;
    font-weight: 700;
    letter-spacing: .7px;
    text-transform: capitalize;">Dear  '.$name.',</div>
    <div style=" font-size: 16px;
 margin-bottom: 15px;color:#626262 ; font-weight: 700; ">We just got request for your new password.</div>
 <div style=" font-size: 16px;
 margin-bottom: 15px;color:#626262 ; font-weight: 700; ">Just verify it via below code, to confirm your request</div>
<div style=" font-size: 15px;
 margin-bottom: 25px;color:#626262 ;"><b>Security code</b> : '.$randomcode.'</div>
<div style="font-size: 16px; color:#626262 ; font-weight: 700; margin-bottom:8px;font-weight:bold;">Warm regards,</div>
<div style="font-size: 14px; color:#626262 ; margin-bottom:1px;font-weight:bold;">Team Volody</div>
<div><a href="www.volody.com" target="_blank" style=" text-decoration:none;color:#003366;text-shadow: 1px 1px 5px #fff;text-align:left;font-size: 14px;font-weight:bold;">volody.com</a>
</div>
            </div>
        </div>
    </div>
        <div class="footer" style="width:100%; max-width:600px; margin: 0 auto; background-color: #f2f2f2;">
            <div class="footer_text" style="max-width:550px; margin:0 20px;margin-top: 50px;">
                <div style=" padding-top: 10px; margin-bottom: 5px;font-weight: bold;">About</div>
                <div style="font-size:13px;
line-height: 20px; margin-bottom: 10px; color: #626262;">Volody is a cloud based software as a service (SaaS) company committed to provide best compliance management software solutions to Tax, Legal and Secretarial Professionals and Business finance and legal functions.
Volody is committed to the technology needs of professionals and businesses and provide cloud based solutions that includes Secretarial Automation Software, Practice management system, Tax Filing & Compliance System and Compliance Management software in order to automate almost every part of the day to day running of business by professionals and businesses, the regulatory filings, statutory compliances and work-flow management.</div>
            </div>
            <div style="clear:both;"></div>
            <div class="footer_text_down" style="text; margin-top: 10px;">
                <div style="margin-left: 17px; padding: 8px ; color:#626262; font-size:12px;">&copy; Volody. All rights reserved </div>
            </div>
        </div>
    </div>
</body>
</html>';
        return $html;
}
    public function notificationsendmailhtml($newarray)
    {
        $html='<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>consultlane</title></head><body style="margin:0px;padding: 0px;background-color: #eff3f8:"><div align="center"> <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"> <tr> <td align="center" bgcolor="#eff3f8"> <table border="0" cellspacing="0" cellpadding="0" width="100%" style="max-width: 680px; min-width: 300px;"> <tr> <td> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr><tr><td align="center" bgcolor="#ffffff"> <div style=" height: 12px; line-height: 40px; font-size: 10px; background-color: #596167;"> </div><table width="90%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center"> <div style="text-align:center; display: inline-block;"> <table width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
        <tr><td align="center" valign="middle"> <div style="height: 20px; line-height: 20px; font-size: 22px;"> </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> <td align="center" valign="top" style=" border-bottom: 1px dotted #596167;">
            <a href="#" target="_blank" style=" text-decoration: none; color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 30px;">
            <font face="Arial, Helvetica, sans-seri;" color="#596167"> Volody Boardapp </font> </a> </td>
        </tr></table></td></tr></table> </div></td></tr></table> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr><tr><td align="center" style="width:70%;" bgcolor="#fbfcfd"> <table width="70%" border="0" cellspacing="0" cellpadding="0">

        <tr> <td>
        <table border="0" cellspacing="0" cellpadding="0"> <tr style="margin-top:5px;display: block;font-family: Arial, Helvetica, sans-serif; color: #00336f; "> <td align="left" > <div style="text-align: left;text-transform: capitalize;font-size:16px; font-weight:bold; "> Dear '.$newarray['name'].' , </div></td></tr></table>
        </td></tr>

        <tr> <td align="center">
        <table> <tr style="margin-top:15px; line-height:25px; display: block;font-family: Arial, Helvetica, sans-serif; color: #00336f; "> <td align="center" > <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; "> '.addslashes($newarray['subject']).' </div></td></tr></table>
        </td></tr>

        <tr> <td style="width: 90%;line-height:20px" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #2196F3;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:14px; font-weight:bold; "> '.$newarray['desc'].' </div></td></tr></table>
        </td></tr>

        <tr> <td style="width: 90%;line-height:20px;" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">

        In case, this email is not applicable to you, Please \'Ignore\' it.

        </div></td></tr></table> </td></tr>
        <tr> <td style="width: 90%;line-height:28px;" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="margin-top:35px; line-height:0px; display: block;font-family: Arial, Helvetica, sans-serif; color: #57297e; "> <td align="left" > <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; "> about </div></td></tr></table> </td></tr><tr> <td style="width: 90%;line-height:18px;" align="center"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">

        Volody is a cloud based software as a service (SaaS) company committed to provide best compliance management software solutions to Tax, Legal and Secretarial Professionals and Business finance and legal functions. Volody is committed to the technology needs of professionals and businesses and provide cloud based solutions that includes Secretarial Automation Software, Practice management system, Tax Filing & Compliance System and Compliance Management software in order to automate almost every part of the day to day running of business by professionals and businesses, the regulatory filings, statutory compliances and work-flow management.

        </div></td></tr></table> </td></tr></table> </td></tr><tr><td align="center" bgcolor="#ffffff"> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div><table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center"> <font face="Arial, Helvetica, sans-serif" style="font-size: 14px;"> <a href="www.volody.com" target="_blank" style="cursor: pointer; font-family: Arial, Helvetica, sans-serif;font-weight: bold; text-decoration: none; font-size: 14px; color: #003366;"> volody.com </a> </font> </td></tr><tr> <td align="center"> <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;"> <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;"> © Volody. ALL Rights Reserved. </span> </font> </td></tr></table> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div><div style=" height: 12px; line-height: 40px; font-size: 10px; background-color: #596167;"> </div></td></tr><tr><td> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr></table> </td></tr></table></div></body></html>';

    return $html;
    /*<img src="http://www.volody.com/user/img/emailerbg.png" style="position:absolute;bottom:0;left:0;right:0;margin:0px auto;width:100%;">*/
    }

public function mailerhtml($name,$subject,$body)
{    
    
        $html='<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>consultlane</title></head><body style="margin:0px;padding: 0px;background-color: #eff3f8:"><div align="center"> <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"> <tr> <td align="center" bgcolor="#eff3f8"> <table border="0" cellspacing="0" cellpadding="0" width="100%" style="max-width: 680px; min-width: 300px;"> <tr> <td> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr><tr><td align="center" bgcolor="#ffffff"> <div style=" height: 12px; line-height: 40px; font-size: 10px; background-color: #596167;"> </div><table width="90%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center"> <div style="text-align:center; display: inline-block;"> <table width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
        <tr><td align="center" valign="middle"> <div style="height: 20px; line-height: 20px; font-size: 22px;"> </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> <td align="center" valign="top" style=" border-bottom: 1px dotted #596167;">
            <a href="#" target="_blank" style=" text-decoration: none; color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 30px;">
            <font face="Arial, Helvetica, sans-seri;" color="#596167" font-size="0">Volody</font> </a> </td>
        </tr></table></td></tr></table> </div></td></tr></table> <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr><tr><td align="center" style="width:70%;" bgcolor="#fbfcfd"> <table width="70%" border="0" cellspacing="0" cellpadding="0">

        <tr> <td>
        <table border="0" cellspacing="0" cellpadding="0"> <tr style="margin-top:5px;display: block;font-family: Arial, Helvetica, sans-serif; color: #00336f; "> <td align="left" > <div style="text-align: left;text-transform: capitalize;font-size:16px; font-weight:bold; "> Dear '.$name.' , </div></td></tr></table>
        </td></tr>

        <tr> <td align="center">
        <table> <tr style="margin-top:15px; line-height:25px; display: block;font-family: Arial, Helvetica, sans-serif; color: #00336f; "> <td align="center" > <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; "> '.$subject.' </div></td></tr></table>
        </td></tr>

        <tr> <td style="width: 90%;line-height:20px" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #2196F3;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:14px; font-weight:bold; "> '.$body.' </div></td></tr></table>
        </td></tr>

        <tr> <td style="width: 90%;line-height:20px;" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">

        In case, this email is not applicable to you, Please \'Ignore\' it.

        </div></td></tr></table> </td></tr>
        <tr> <td style="width: 90%;line-height:28px;" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="margin-top:35px; line-height:0px; display: block;font-family: Arial, Helvetica, sans-serif; color: #57297e; "> <td align="left" > <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; "> about </div></td></tr></table> </td></tr><tr> <td style="width: 90%;line-height:18px;" align="center"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">

        Volody is a cloud based software as a service (SaaS) company committed to provide best compliance management software solutions to Tax, Legal and Secretarial Professionals and Business finance and legal functions. Volody is committed to the technology needs of professionals and businesses and provide cloud based solutions that includes Secretarial Automation Software, Practice management system, Tax Filing & Compliance System and Compliance Management software in order to automate almost every part of the day to day running of business by professionals and businesses, the regulatory filings, statutory compliances and work-flow management.

        </div></td></tr></table> </td></tr></table> </td></tr><tr><td align="center" bgcolor="#ffffff"> <div style="height: 30px; line-height: 30px; font-size: 0;"> </div><table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center"> <font face="Arial, Helvetica, sans-serif" style="font-size: 14px;"> <a href="www.volody.com" target="_blank" style="cursor: pointer; font-family: Arial, Helvetica, sans-serif;font-weight: bold; text-decoration: none; font-size: 14px; color: #003366;"> panel.consultLane.com </a> </font> </td></tr><tr> <td align="center"> <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;"> <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;"> © Volody. ALL Rights Reserved. </span> </font> </td></tr></table> <div style="height: 30px; line-height: 30px; font-size: 0;"> </div><div style=" height: 12px; line-height: 40px; font-size: 0; background-color: #596167;"> </div></td></tr><tr><td> <div style="height: 30px; line-height: 30px; font-size: 0;"> </div></td></tr></table> </td></tr></table></div></body></html>';

    return $html;
    /*<img src="http://www.volody.com/user/img/emailerbg.png" style="position:absolute;bottom:0;left:0;right:0;margin:0px auto;width:100%;">*/
}
    
public function sharedmailerhtml($name,$subject,$body)
{    
     
        $html1='<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>consultlane</title></head><body style="margin:0px;padding: 0px;background-color: #eff3f8:"><div align="center"> <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"> <tr> <td align="center" bgcolor="#eff3f8"> <table border="0" cellspacing="0" cellpadding="0" width="100%" style="max-width: 680px; min-width: 300px;"> <tr> <td></td></tr><tr><td align="center" bgcolor="#ffffff"> <div style=" height: 12px; line-height: 40px; font-size: 0px; background-color: #596167;"> </div><table width="90%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center"> <div style="text-align:center; display: inline-block;"> <table width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
        <tr><td align="center" valign="middle"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> <td align="center" valign="top" style=" border-bottom: 1px dotted #596167; padding-top: 10px;">
            <a href="#" target="_blank" style=" text-decoration: none; color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 30px;">
            <font face="Arial, Helvetica, sans-seri;" color="#596167" font-size="0">Volody</font></a></td>
        </tr></table></td></tr></table> </div></td></tr></table></td></tr><tr><td align="center" style="width:70%;" bgcolor="#fbfcfd"> <table width="70%" border="0" cellspacing="0" cellpadding="0">

        <tr> <td>
        <table border="0" cellspacing="0" cellpadding="0"> <tr style="margin-top:5px;display: block;font-family: Arial, Helvetica, sans-serif; color: #00336f; "> <td align="left" > <div style="text-align: left;text-transform: capitalize;font-size:16px; font-weight:bold; "> Dear '.$name.' , </div></td></tr></table>
        </td></tr>

        <tr> <td align="center">
        <table> <tr style="margin-top:15px; line-height:25px; display: block;font-family: Arial, Helvetica, sans-serif; color: #00336f; "> <td align="center" > <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; "> '.$subject.' </div></td></tr></table>
        </td></tr>

        <tr> <td style="width: 90%;line-height:20px" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #2196F3;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:14px; font-weight:bold; "> '.$body.' </div></td></tr></table>
        </td></tr>

        <tr> <td style="width: 90%;line-height:20px;" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">

        In case, this email is not applicable to you, Please \'Ignore\' it.

        </div></td></tr></table> </td></tr>
        <tr> <td style="width: 90%;line-height:28px;" align="left"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="margin-top:35px; line-height:0px; display: block;font-family: Arial, Helvetica, sans-serif; color: #57297e; "> <td align="left" > <div style="text-align:center;text-transform: capitalize;font-size:16px; font-weight:bold; "> about </div></td></tr></table> </td></tr><tr> <td style="width: 90%;line-height:18px;" align="center"> <table border="0" cellspacing="0" cellpadding="0"> <tr style="font-family: Arial, Helvetica, sans-serif; color: #57697e;"> <td align="left"> <div style="text-align: justify;text-transform: capitalize;font-size:11px; font-weight:bold; margin-top:15px;display: block;">

        Volody is a cloud based software as a service (SaaS) company committed to provide best compliance management software solutions to Tax, Legal and Secretarial Professionals and Business finance and legal functions. Volody is committed to the technology needs of professionals and businesses and provide cloud based solutions that includes Secretarial Automation Software, Practice management system, Tax Filing & Compliance System and Compliance Management software in order to automate almost every part of the day to day running of business by professionals and businesses, the regulatory filings, statutory compliances and work-flow management.

        </div></td></tr></table> </td></tr></table> </td></tr><tr><td align="center" bgcolor="#ffffff"> <div style="height: 30px; line-height: 30px; font-size: 0;"> </div><table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center"> <font face="Arial, Helvetica, sans-serif" style="font-size: 14px;"> <a href="www.volody.com" target="_blank" style="cursor: pointer; font-family: Arial, Helvetica, sans-serif;font-weight: bold; text-decoration: none; font-size: 14px; color: #003366;"> panel.consultLane.com </a> </font> </td></tr><tr> <td align="center"> <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;"> <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">&copy;Volody. ALL Rights Reserved. </span> </font> </td></tr></table> <div style="height: 30px; line-height: 30px; font-size: 0;"> </div><div style=" height: 12px; line-height: 40px; font-size: 0; background-color: #596167;"> </div></td></tr><tr><td> <div style="height: 30px; line-height: 30px; font-size: 0;"> </div></td></tr></table> </td></tr></table></div></body></html>';

    return $html1;
    /*<img src="http://www.volody.com/user/img/emailerbg.png" style="position:absolute;bottom:0;left:0;right:0;margin:0px auto;width:100%;">*/
}

    public function highlight($text, $words) {

            $highlighted = preg_filter('/' . preg_quote($words) . '/i', ' <b> <span class="search-highlight">$0</span> </b> ', $text);
            if (!empty($highlighted)) {
                $text = $highlighted;
            }
       // echo $text." ".$words;exit;
            return $text;
        }
    public function createfile($filegnm)
    {
        $mnparentdir = $this->basekdir;
        $filegnm = trim(strtolower($filegnm));
        //echo $mnparentdir;exit;
        $csscreate = 'css/common/commoncss/';
        $jscreate = 'js/common/';
        $mnfilenme = $filegnm.'_common.css';
        $mnfilejsn = $filegnm.'_common.js';
        $viedir = $mnparentdir.$this->createviewsdir.$filegnm;
        $upload_dir = $viedir; /*================Main Parent Directory=========================*/
        $mghtcss = $csscreate.$mnfilenme;
        $mghtjs  = $jscreate.$mnfilejsn;
        //echo $mghtcss;exit;
        $viedirindex = $mnparentdir.$this->createviewsdir.$filegnm."/index.volt";
        $landirindex = $mnparentdir.$this->createlanguagedir.$filegnm."_language.php";

        if(!is_dir($upload_dir)){@mkdir($upload_dir, 0777);chmod($upload_dir, 0777);}

        if (@file_exists($viedirindex)) {} else {@fopen($viedirindex, "w");}
        /*================This will create Indexvot in desired Controller================*/

        //if (@file_exists($landirindex)) {} else {@fopen($landirindex, "w");}
        /*================This will create Language in desired Controller================*/


        if (@file_exists($mghtcss)) {} else {@fopen($mghtcss, "w");}
        /*================This will create Css in desired Controller================*/

        if (@file_exists($mghtjs)) {} else {@fopen($mghtjs, "w");}
        /*================This will create Js in desired Controller================*/
    }

    public function createactionfile($filegnm)
    {
        $mnparentdir = $this->basekdir;
        //echo $mnparentdir;exit;
        $csscreate = 'css/common/otheraction/commoncss/';
        $jscreate = 'js/common/otheraction/';
        $mnfilenme = $filegnm.'_common.css';
        $mnfilejsn = $filegnm.'_common.js';
        $viedir = $mnparentdir.$this->createviewsdir.$filegnm;
        $upload_dir = $viedir; /*================Main Parent Directory=========================*/
        $mghtcss = $csscreate.$mnfilenme;
        $mghtjs  = $jscreate.$mnfilejsn;

        $viedirindex = $mnparentdir.$this->createviewsdir.$filegnm."/".$filegnm.".volt";


        if(!is_dir($upload_dir)){@mkdir($upload_dir, 0777);chmod($upload_dir, 0777);}

        if (@file_exists($viedirindex)) {} else {@fopen($viedirindex, "w");}
        /*================This will create Indexvot in desired Controller================*/

        if (@file_exists($mghtcss)) {} else {@fopen($mghtcss, "w");}
        /*================This will create Css in desired Controller================*/

        if (@file_exists($mghtjs)) {} else {@fopen($mghtjs, "w");}
        /*================This will create Js in desired Controller================*/
    }
    
    /* ############## check current Age from Date Of Birth ############## */
    public function checkCurrentAge($dob)
    {
        $bday = new DateTime($dob); // Your date of birth
        $today = new Datetime(date('d-m-Y'));
        $diff = $today->diff($bday);
        return $diff;
    }
    /* ############## check current Age from Date Of Birth ############## */
}
