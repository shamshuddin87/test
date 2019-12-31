<?php
use Phalcon\Mvc\User\Component;
use Phalcon\Filter;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Message;
use Phalcon\Http\Request;
class Querycommon extends Component
{

    public function addOnline($ip, $customer_id, $url, $referer,$type_web) {
        $connection = $this->db;

        $connection->query("DELETE FROM `web_user_online` WHERE date_added < '" . date('Y-m-d H:i:s', strtotime('-1 hour')) . "'");

        $connection->query("REPLACE INTO `web_user_online` SET `ip` = " . $connection->escapeString($ip) . ", `user_id` = '" . (int)$customer_id . "', `url` = " . $connection->escapeString($url) . ", `referer` = " . $connection->escapeString($referer) . ", `date_added` = ".$connection->escapeString(date('Y-m-d H:i:s'))." , `type_web_access` = " . $connection->escapeString($type_web) . " ");
    }

    public function geotrackingphp($a, $b, $c,$d,$e,$f,$g,$h,$i,$j,$ip,$getuserid)
        {
            $connection = $this->db;
            $connection2 = $this->dbloreal;
            //$exegetgeo = "SELECT * FROM `web_userlocation_php` WHERE `user_id` ='".$getuserid."'";

            $ingeo = "INSERT INTO `web_userlocation_php` (`country`,
                `countrycode`,
                `state`,`statecode`, `city`,`currencycode`,`currencysymbol`,`currencysymbol_UTF8`,`latitude`,`longitude`,
                `ip`,`date_added`,`date_modified`,`user_id`)
                 VALUES ('". $a ."','". $b ."','". $c ."','". $d ."','". $e ."',
                 '". $f ."','". $g ."','". $h ."',
                 '". $i ."','". $j ."','". $ip ."',NOW(),NOW(),'". $getuserid ."')";

//            $updategeo = "UPDATE `web_userlocation_php`
//                                SET `country` = '". $a ."',
//                                    `countrycode` = '". $b ."',
//                                    `state` = '". $c ."',
//                                    `statecode` = '". $d ."',
//                                    `city` = '". $e ."',
//                                    `currencycode` = '". $f ."',
//                                    `currencysymbol` = '". $g ."',
//                                    `currencysymbol_UTF8` = '". $h ."',
//                                    `ip` = '". $ip ."',
//                                    `latitude` = '". $i ."',
//                                    `longitude` = '". $j ."',
//                                    `date_modified` = NOW()
//                                    WHERE `user_id`='".$getuserid."'";
      
                try {
                    
//                    $bhimrao = $connection->query($exegetgeo);
//                    $bhimrao2 = $connection2->query($exegetgeo);
//                    $getnum = trim($bhimrao->numRows());
//                    $getnum2 = trim($bhimrao2->numRows());
//                    
//                    ////FOR ONE
//                if($getnum==0 && $getnum2==0 )
//                    {
                        $bhimrao = $connection->query($ingeo);
                        $bhimrao2 = $connection2->query($ingeo);
                        if($bhimrao){return true;}else{return false;}
                        if($bhimrao2){return true;}else{return false;}
//                    }
//                else
//                    {
//                        if($getuserid==0 || empty($getuserid))
//                        {
//                           $bhimrao = $connection->query($ingeo);
//                           $bhimrao2 = $connection2->query($ingeo);
//                             if($bhimrao){return true;}else{return false;}
//                             if($bhimrao2){return true;}else{return false;}
//                        }
//                        else
//                        {
//                            $bhimrao = $connection->query($updategeo);
//                            $bhimrao2 = $connection2->query($updategeo);
//                            if($bhimrao){return true;}else{return false;}
//                            if($bhimrao2){return true;}else{return false;}
//                        }
//                    }
                }
                catch (Exception $e) {
                    return false;
                    $connection->close();
                    $connection2->close();
                }


        }
    public function mobiledetect($devicetype, $useragent,$ip,$getuserid)
        {
            $connection = $this->db;
            $connection2 = $this->dbloreal;
            //$exegetgeo = "SELECT * FROM `web_user_device_detect` WHERE `user_id` ='".$getuserid."'";

            $ingeo = "INSERT INTO `web_user_device_detect` (`devicetype`,
                `useragent`,`ip`,`date_added`,`date_modified`,`user_id`)
                 VALUES ('". $devicetype ."','". $useragent ."','". $ip ."',NOW(),NOW(),'". $getuserid ."')";

//            $updategeo = "UPDATE `web_user_device_detect`
//                          SET `devicetype` = '". $devicetype ."',`useragent` = '". $useragent ."',`ip` = '". $ip ."',`date_modified` = NOW() WHERE `user_id`='".$getuserid."'";
                try {
//                    $bhimrao = $connection->query($exegetgeo);
//                    $bhimrao2 = $connection2->query($exegetgeo);
//                    
//                    $getnum = trim($bhimrao->numRows());
//                    $getnum2 = trim($bhimrao2->numRows());
//
//                if($getnum==0 && $getnum2==0)
//                    {

                        $bhimrao = $connection->query($ingeo);
                        $bhimrao2 = $connection2->query($ingeo);
                        if($bhimrao){return true;}else{return false;}
                        if($bhimrao2){return true;}else{return false;}
//                    }
//                else
//                    {
//                        if($getuserid==0 || empty($getuserid))
//                        {
//                           $bhimrao = $connection->query($ingeo);
//                           $bhimrao2 = $connection2->query($ingeo);
//                             if($bhimrao){return true;}else{return false;}
//                             if($bhimrao2){return true;}else{return false;}
//                        }
//                        else
//                        {
//                            $bhimrao = $connection->query($updategeo);
//                            $bhimrao = $connection2->query($updategeo);
//                            if($bhimrao){return true;}else{return false;}
//                            if($bhimrao2){return true;}else{return false;}
//                        }
//                    }
                }
                catch (Exception $e) {
                    return false;
                    $connection->close();
                    $connection2->close();
                }


        }
    public function geotrackinggoogle($a, $b, $c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$getuserid)
        {
            $connection = $this->db;
            $exegetgeo = "SELECT * FROM `web_userlocation_google` WHERE `user_id` ='".$getuserid."'";

            $ingeo = "INSERT INTO `web_userlocation_google` (`country`,
                `countrycode`,`state`,`statecode`,`city`,`streetnum`,`route`,
                `sublocalityone`,`sublocalitytwo`,`postalcode`,
                `latitude`,`longitude`,`ip`,`date_added`,`date_modified`,`user_id`)
                 VALUES ('". $a ."','". $b ."','". $c ."','". $d ."','". $e ."',
                 '". $f ."','". $g ."','". $h ."',
                 '". $i ."','". $j ."','". $k ."','". $l ."','". $m ."',NOW(),NOW(),'". $getuserid ."')";


            $updategeo = "UPDATE `web_userlocation_google`
                                SET `country` = '". $a ."',
                                    `countrycode` = '". $b ."',
                                    `state` = '". $c ."',
                                    `statecode` = '". $d ."',
                                    `city` = '". $e ."',
                                    `streetnum` = '". $f ."',
                                    `route` = '". $g ."',
                                    `sublocalityone` = '". $h ."',
                                    `sublocalitytwo` = '". $i ."',
                                    `postalcode` = '". $j ."',
                                    `latitude` = '". $k ."',
                                    `longitude` = '". $l ."',
                                    `date_modified` = NOW()
                                    WHERE `user_id`='".$getuserid."'";
                try {
                    $bhimrao = $connection->query($exegetgeo);
                    $getnum = trim($bhimrao->numRows());

                if($getnum==0)
                    {

                        $bhimrao = $connection->query($ingeo);
                        if($bhimrao){return true;}else{return false;}
                    }
                else
                    {
                         $bhimrao = $connection->query($updategeo);
                        if($bhimrao){return true;}else{return false;}
                    }
                }
                catch (Exception $e) {
                    return false;
                    $connection->close();
                }


        }

    public function peopleonline()
        {
            $connection = $this->db;
            $exegetgeo = "SELECT COUNT(*) AS peopleonline FROM `web_user_online` ORDER BY `date_added` DESC ";

                try {
                    $bhimrao = $connection->query($exegetgeo);
                    $getnum = trim($bhimrao->numRows());
                    $obj = array();
                    $obj     = $bhimrao->fetch();
                    $avatar     = $obj;

                }
                catch (Exception $e) {
                    $avatar     = $obj;
                }

            return $avatar;
        }

    public function peoplevisitedpage()
        {

            $exegetgeo = "SELECT COUNT(*) as pagecount FROM `web_userlocation_php` ORDER BY `date_added` ";
            $connection = $this->db;


                try {
                    $bhimrao = $connection->query($exegetgeo);
                    $getnum = trim($bhimrao->numRows());
                    $obj = array();
                    $obj     = $bhimrao->fetch();
                    $avatar     = $obj;

                }
                catch (Exception $e) {
                    $avatar     = $obj;
                }

            return $avatar;
        }
    public function peoplevisiteddevice()
        {

            $exegetgeo = "SELECT COUNT(*) as pagecount FROM `web_user_device_detect` ORDER BY `date_added` ";
            $connection = $this->db;


                try {
                    $bhimrao = $connection->query($exegetgeo);
                    $getnum = trim($bhimrao->numRows());
                    $obj = array();
                    $obj     = $bhimrao->fetch();
                    $avatar     = $obj;

                }
                catch (Exception $e) {
                    $avatar     = $obj;
                }

            return $avatar;
        }
    public function getuniqueip($type)
        {
            $tablename ='';
            if($type=='device'){$tablename = " `web_user_device_detect` ";}else{$tablename = " `web_userlocation_php` ";}

            $exegetgeo = "SELECT  COUNT(DISTINCT `ip`) as uniqueip FROM ".$tablename." ORDER BY `date_added` DESC ";
            $connection = $this->db;

                try {
                    $bhimrao = $connection->query($exegetgeo);
                    $getnum = trim($bhimrao->numRows());
                    $obj = array();
                    $obj     = $bhimrao->fetch();
                    $avatar     = $obj;

                }
                catch (Exception $e) {
                    $avatar     = $obj;
                }

            return $avatar;
        }
    public function getallpermuser($uid,$cnmae) {
    $c ='';
    $connection     = $this->dbcdata;
    $c .="SELECT * FROM `software_section_access`";
    $c .=" WHERE `user_id`='".$uid."' ORDER BY `id` DESC";
    //echo $c;exit;
        try
        {
            $bhimraocount       = $connection->query($c);
            $getnumbhim         = trim($bhimraocount->numRows());
            //echo $getnumbhim;exit;
            if($getnumbhim!=0)
            {
                $row = $bhimraocount->fetch();
                $getsecid = $row['section_id'];
                $getsecid = explode('^',$getsecid);
                $getlistm = array();
                foreach($getsecid as $mn)
                {
                    $ef ="SELECT * FROM `software_section` WHERE `id`='".$mn."' AND `modulename`='".$cnmae."' ";
                    $bhimrao       = $connection->query($ef);

                    while($rowm = $bhimrao->fetch())
                    {
                        $getlistm[] = $rowm;
                    }
                }

                if(count($getlistm)>0)
                {
                    $exearray = $getlistm;
                }
                else {
                    $exearray = array();
                }
            }
            else{
                $exearray = array();
            }
        }
        catch (Exception $e) {
            $exearray = array();
        }
        return $exearray;
    }
    public function yoursearchexe($searchword,$limit)
    {
        //echo 'hello';exit;
        $connection = $this->db;
        
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $cin = '';
        //echo $getuserid; exit;
                
        /* ================= Get All GroupUsers ================= */
            $userlist = $this->selectcompanycommon->getGroupUsers($getuserid,$user_group_id,$cin);
            //echo '<pre>';print_r($userlist); exit; 
        
            try 
            {
                /* ----------------- web_company_details_user Start ----------------- */
                    $getlist=array();            
                    foreach($userlist as $mukey => $muval)  // Checking for Every User
                    {
                        //echo '<pre>';print_r($muval); exit;
                        $getnum=''; $row='';

                        //echo '<pre>';print_r($muval); exit; 
                        $statement = "SELECT we.`company_name`, we.`corporate_identification_number`
                                    FROM `web_company_details_user` we
                                    WHERE we.`user_id`='".$muval['user_id']."' 
                                    AND we.`company_name` LIKE '".$searchword."%' 
                                    GROUP BY we.`corporate_identification_number` LIMIT ".$limit." ";
                       //echo $statement; exit;

                        $execomp = $connection->query($statement); 
                        $getnum = trim($execomp->numRows());

                        if($getnum>0)
                        {
                            while($row = $execomp->fetch())
                            {
                                $getlist[] = array("id" => '0', "name" => $row['company_name'],
                                            "cid" => $row['corporate_identification_number']);
                            }
                            //echo '<pre>';print_r($getlist);exit;
                        }
                    }
                    //echo '<pre>';print_r($getlist);exit;
                /* ----------------- web_company_details_user End ----------------- */
                
                    if(empty($getlist)) 
                    {
                        $getlist[] = array("id" => 0, "name" => 'No Result Found !!!', "cid" => '');
                    }
                    //echo '<pre>'; print_r($getlist);exit;
                    $research  = $getlist;
            }
            catch (Exception $e) 
            {
                $research  = $obj['noarray'];
            }
            return $research;
    }
    
    public function yoursearchcount($searchword,$limit)
    {
        $connection = $this->db;
        
        $getuserid = $this->session->loginauthspuserfront['id'];
        $user_group_id = $this->session->loginauthspuserfront['user_group_id'];
        $cin = '';
        //echo $getuserid; exit;
        
        /* ================= Get All GroupUsers ================= */
            $userlist = $this->selectcompanycommon->getGroupUsers($getuserid,$user_group_id,$cin);
            //echo '<pre>';print_r($userlist); exit; 
        
        try 
        {
            /* ----------------- web_company_details_user Start ----------------- */
                $getlist=array();            
                foreach($userlist as $mukey => $muval)  // Checking for Every User
                {
                    //echo '<pre>';print_r($muval); exit;
                    $getnum=''; $row='';

                    //echo '<pre>';print_r($muval); exit; 
                    $statement  = "SELECT we.`company_name`
                        FROM `web_company_details_user` we
                        WHERE we.`user_id`='".$muval['user_id']."'
                        AND we.`company_name` LIKE '".$searchword."%' 
                        GROUP BY we.`corporate_identification_number` LIMIT ".$limit." ";
                    //echo $statement; exit;
                    
                    $execomp = $connection->query($statement); 
                    $getnum = trim($execomp->numRows());

                    if($getnum>0)
                    {
                        while($row = $execomp->fetch())
                        {
                            $getlist[] = $row;
                        }
                        //echo '<pre>';print_r($getlist);exit;
                    }
                }
                //echo '<pre>';print_r($getlist);exit;
            /* ----------------- web_company_details_user End ----------------- */
            
                $getnum = count($getlist);
                $research = $getnum;
        }
        catch (Exception $e) 
        {
            $research = 'noresult';
        }
        return $research;
    }
    
    
    public function yourserviceexe($searchword,$limit)
    {
        //echo 'hello';exit;
        $connection = $this->db;
        
        $statement     = "SELECT we.`name`, we.`id`
                        FROM `web_type_service` we
                        WHERE we.`name` LIKE '%" . $searchword  ."%' LIMIT " . $limit  ." ";
       // echo $statement; exit;
            try {
                    $bhimrao = $connection->query($statement);
                    $getnum = trim($bhimrao->numRows());
                    if ($getnum > 0) {
                        while($row = $bhimrao->fetch())
                        {
                            $getlist[] = array("id" => $row['id'], "name" => $row['name'], "cid" => $row['id']);
                        }
                      }
                    else
                    {
                            $getlist[] = array("id" => 0, "name" => 'No Result Found !!!', "cid" => '');
                    }
                    //echo '<pre>'; print_r($getlist);exit;
                    $research     = $getlist;
                }
                catch (Exception $e) {
                    $research     = $obj['noarray'];
                }

            return $research;
    }
    public function yourservicecount($searchword,$limit)
    {
        $connection = $this->db;
        $statement     = "SELECT we.`name`, we.`id`
                        FROM `web_type_service` we
                        WHERE we.`name` LIKE '%" . $searchword  ."%' LIMIT " . $limit  ." ";
            try {
                    $bhimrao = $connection->query($statement);
                    $getnum = trim($bhimrao->numRows());
                    $research     = $getnum;
                }
                catch (Exception $e) {
                    $research     = 'noresult';
                }

            return $research;
    }
    
    public function useractivitytracking($getuserid,$sessionid,$ip,$referby,$currentpage,$devicetype,$useragent)
        {
            $connection = $this->db;
            $timeago = time();
            $ingeo = "INSERT INTO `web_user_activity_track` (`user_id`,
                `sessionid`,
                `ip`,`referby`, `currentpage`,`devicetype`,`useragent`,`date_added`,`timeago`)
                 VALUES ('". $getuserid ."','". $sessionid ."','". $ip ."','". $referby ."','". $currentpage ."','". $devicetype ."',
                 '". $useragent ."',".$connection->escapeString(date('Y-m-d H:i:s')).",'". $timeago ."')";
            //echo $ingeo;exit;
                try {
                    $bhimrao = $connection->query($ingeo);
                    $getnum = trim($bhimrao->numRows());

                }
                catch (Exception $e) {
                    $connection->close();
                }


        }

    public function selectforgotpwduser($email)
    {
        $connection = $this->db;
        $exenebula = "SELECT we.* FROM `web_register_user` we
                        WHERE we.`email` = '".$email."' AND we.`status` = '1' ";

        try {
                $bhimrao = $connection->query($exenebula);
                $getnum = trim($bhimrao->numRows());
                if($getnum==0)
                {
                    $avatar = array("status"=>false,"type"=>'noresultfound');
                }
                else
                {
                    $objmhimg = array();
                    $objmhimg     = $bhimrao->fetch();
                    $avatar = $objmhimg;
                }

            }
            catch (Exception $e) {
                $avatar = array("status"=>false,"type"=>'exception');
            }

        return $avatar;

    }
    public function updateemailpwd($userid,$emailsent,$code)
    {
        $connection = $this->db;
        $timeago = time();
        $updateemailsent = ("UPDATE `we_reg_pwd_reset` SET `emailsent` = '".$emailsent."',
        `date_modified` = NOW(),`timeago` = '".$timeago."'
        WHERE `userid`='".$userid."' AND `pwd_reset_code` = '".$code."' ");
        //echo $updateemailsent;exit;
        try {
                $bhimrao = $connection->query($updateemailsent);
                if($bhimrao)
                {
                    $avatar = array("status"=>true);
                }
                else
                {
                    $avatar = array("status"=>false);
                }

            }
            catch (Exception $e) {
                $avatar = array("status"=>false);
            }

        return $avatar;

    }
    public function passwordresetcodeupdate($userid,$code)
    {
        $connection = $this->db;
        $time = time();

        $exelordvishnu     = "SELECT `userid` FROM `we_reg_pwd_reset` WHERE `userid` ='".$userid."' ";

        $updatlakshmi     = "UPDATE `we_reg_pwd_reset` SET `date_modified` = NOW(),
                          `timeago` = '".$time."',
                          `pwd_reset_code` = '".$code."'
                           WHERE `userid`='".$userid."'";

        $insertphoenix = "INSERT INTO `we_reg_pwd_reset` (`userid`,`date_added`, `date_modified`,`timeago` ,`pwd_reset_code`)
                          VALUES ('".$userid."',NOW(),NOW(),'".$time."','".$code."')";



        try {

            $maharakshak = $connection->query($exelordvishnu);
            $getnumnxt = trim($maharakshak->numRows());

                if($getnumnxt==0) {
                    $updatemuni_exe = $connection->query($insertphoenix);
                    $setfalconarray = array("status"=>true,"message"=>'Security code added successfully',"type"=>'added','timeago'=>$time);
                }
                else if($getnumnxt==1)
                {
                    $updatemuni_exe = $connection->query($updatlakshmi);
                    $setfalconarray = array("status"=>true,"message"=>'Security code updated successfully',"type"=>'update','timeago'=>$time);
                }

                else{$setfalconarray = array("status"=>false,"type"=>'update','timeago'=>'none');}

        }
        catch (Exception $e) {
                $setfalconarray = array("status"=>false,"type"=>'exception','timeago'=>'none');
        }
        return $setfalconarray;

    }
    public function forgotpasswordreset($userid,$email,$pwd,$code)
    {
        $connection = $this->db;
        $time = time();

        $saltget        = ($salt = substr(md5(uniqid(rand(), true)), 0, 9));
        $pwdgene        = (sha1($salt . sha1($salt . sha1($pwd))));

        $exemahadeva     = "SELECT `email` FROM `web_register_user` WHERE `user_id` ='".$userid."'
                            AND `email` ='".$email."' AND `status`='1' ";
        $exelordvishnu     = "SELECT `userid` FROM `we_reg_pwd_reset` WHERE `userid` ='".$userid."'
                            AND `pwd_reset_code`='".$code."' ";

        $updatparvati     = "UPDATE `web_register_user` SET `salt`='".$saltget."' ,
                          `password`='".$pwdgene."' ,`date_modified` = NOW()
                           WHERE `user_id`='".$userid."'  AND `email`='".$email."' ";

        $updatlakshmi     = "UPDATE `we_reg_pwd_reset` SET `salt`='".$saltget."' ,
                          `password`='".$pwdgene."' ,`date_modified` = NOW(),
                          `timeago` = '".$time."'
                           WHERE `userid`='".$userid."' AND `pwd_reset_code`='".$code."' ";



        try {
            $mahakal = $connection->query($exemahadeva);
            $getnum = trim($mahakal->numRows());

            $maharakshak = $connection->query($exelordvishnu);
            $getnumnxt = trim($maharakshak->numRows());

                if($getnumnxt==1)
                {
                    $updateunive_exe = $connection->query($updatlakshmi);

                    if($updateunive_exe)
                    {
                        if($getnum==1)
                        {
                            $updatemuni_exe = $connection->query($updatparvati);
                            $setfalconarray = array("status"=>true,"message"=>'Password updated successfully',
                            "type"=>'update','timeago'=>$time);
                        }
                        else{$setfalconarray = array("status"=>false,"type"=>'notexist','timeago'=>'none');}
                    }
                    else
                    {
                        $setfalconarray = array("status"=>false,"type"=>'error','timeago'=>'none');
                    }
                }
                else
                {$setfalconarray = array("status"=>false,"type"=>'codenotmatch','timeago'=>'none');}

        }
        catch (Exception $e) {
                $setfalconarray = array("status"=>false,"type"=>'exception','timeago'=>'none');
        }
        return $setfalconarray;

    }
    public function getuserdetails($userid)
    {
            $connection = $this->db;
            $exeganapati = "SELECT we.* FROM `web_register_user` we
                WHERE `we`.`user_id` ='".$userid."' AND we.status = '1' ";

            try {
                $bhimrao = $connection->query($exeganapati);
                $objmhimg = array();
                $objmhimg     = $bhimrao->fetch();
                $avatar = $objmhimg;

            }
            catch (Exception $e) {
                $avatar = false;
            }

            return $avatar;

        }
    public function usertracking()
    {
        $request = new Request;
        if (!empty($request->getClientAddress())) {
        $ip = $request->getClientAddress();
        } else {
        $ip = '';
        }
        if (!empty($this->request->getHttpHost()) && !empty($this->request->getHttpHost())) {
        $url = 'http://' . $this->request->getHttpHost() . $this->request->getURI();
        } else {
        $url = 'nourl';
        }
        if (!empty($this->request->getHTTPReferer())) {
        $referer = $this->request->getHTTPReferer();
        } else {
        $referer = '';
        }

        $devicedetect = $this->devicedetect;
        $getdevice = $devicedetect->getdeviceinfo();
        //$typeget = $this->url->getBaseUri();

        $sessionid = $this->session->getId();

        $type = $getdevice['devicetype'];
        $useragent = $getdevice['useragent'];
        $getuserid = $this->session->loginauthspuserfront['id'];
        //echo $useragent; exit;
        //$this->addOnline($ip,$getuserid , $url, $referer, $type);

        $this->useractivitytracking($getuserid,$sessionid,$ip,$referer,$url,$type,$useragent);

    }

    public function fetchModulemlp($mnhgh)
    {
         $connection = $this->dbcdata;
         //echo '<pre>';print_r($mnhgh);exit;
         $querysql = "SELECT * FROM `web_u_role_rights` wur
         INNER JOIN `web_u_module` wum ON wum.`mod_modulecode`= wur.`rr_modulecode`
         WHERE wur.`rr_uid`='".$mnhgh['uid']."'
         ORDER BY wur.`rr_modulecode` ASC ";
         //echo $querysql;exit;
         try
         {
                $exesql = $connection->query($querysql);
                $getnum = trim($exesql->numRows());
                if($getnum!=0)
                {
                    while($row = $exesql->fetch())
                    {
                        $getlist[] = $row;
                    }
                    //echo '<pre>';print_r($getlist);exit;
                }
                else{   $getlist = array();     }
          }
          catch (Exception $e)
          {
                $getlist = array();
          }
        return $getlist;
    }

    // ------------------ Checking User Logged-IN OR NOT START ------------------
    public function checkinguserloggedin($getuserid,$sessionid)
    {
        $connection = $this->db;

        $currentdatetime = date("Y-m-d  H:i:s");
        $today = date("Y-m-d");
        $time = time();
        //echo $today.'*'.$time; exit;
        $time = $time - (15 * 60); //------ Subtracting 15 Minutes(Session Expire Time) from Current time
        $minusdatetime = date("Y-m-d H:i:s", $time);
        //echo $currentdatetime.'*'.$minusdatetime; exit;

        //$currentdatetime = strtotime($currentdatetime);
        //$minusdatetime   = strtotime($minusdatetime);


        // ------------- Multiple Access Users (Example:user_id='1' i.e. simply@consultlane.com) -------------
            $multipleaccess = array('1','17');
            //echo '<pre>'; print_r($multipleaccess); exit;

        if(!in_array($getuserid,$multipleaccess))
        {
            /*$loggedin     = "SELECT * FROM `web_user_online`
            WHERE `user_id`='".$getuserid."'
            AND `date_added` LIKE '".$today."%' ";*/

            $loggedin     = "SELECT * FROM `web_user_online` WHERE `user_id`='".$getuserid."' ";
            //echo $loggedin; exit;

            $exeloggedin = $connection->query($loggedin);
            $loggedincnt = trim($exeloggedin->numRows());
            //echo $loggedincnt; exit;
            if($loggedincnt>0)
            {
                $resloggedin = $exeloggedin->fetch();

                $leveltwocheck     = "SELECT * FROM `web_user_activity_track` WHERE `user_id`='".$getuserid."'
                AND `date_added`>='".$minusdatetime."' AND `date_added`<='".$currentdatetime."'
                ORDER BY `date_added` DESC LIMIT 1 ";
                //echo $leveltwocheck; exit;

                $exeleveltwocheck = $connection->query($leveltwocheck);
                $leveltwocheckcnt = trim($exeleveltwocheck->numRows());
                //echo $leveltwocheckcnt; exit;
                if($leveltwocheckcnt>0)
                {
                    $rushi = array('logged'=>'false','message'=>'Block User From Login');
                }
                else
                {
                    $rushi = array('logged'=>'true','message'=>'Allow User To Login');
                }
            }
            else
            {
                $rushi = array('logged'=>'true','message'=>'Allow User To Login');
            }
        }
        else
        {
            $rushi = array('logged'=>'true','message'=>'Allow User To Login');
        }

            //echo '<pre>'; print_r($rushi); exit;
            return $rushi;
    }
    // ------------------ Checking User Logged-IN OR NOT END ------------------



}


