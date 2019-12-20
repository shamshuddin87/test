<?php
use Phalcon\Mvc\User\Component;

class Usercommon extends Component
{
    public function fetchuserdata()
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $exegetgeo = "SELECT * FROM `web_admin_login`";
        //echo $exegetgeo;
        //exit;
        try
        {
            $bhimrao = $connection->query($exegetgeo);
            $getnum = trim($bhimrao->numRows());
            if($getnum!=0)
            {
                while($row = $bhimrao->fetch())
                {
                    $getlist[] = $row;
                }
                return $getlist;
            }
            else{
                return false;
            }
        }
        catch (Exception $e) {
            return false;
            $connection->close();
        }
    }

    public function insertuser($userarray,$userid)
    {
        //echo "<pre>";print_r($userid);exit;
        $connection = $this->dbtrd;
        $time = time();
        $exegetgeo = "SELECT * FROM `web_admin_login` WHERE `user_id` ='".$userid."'";

        $ingeo = "INSERT INTO `web_admin_login` (`username`,`password`, `approve`, `date_added`,`date_modified`, `timeago`)
            VALUES ('". $userarray['ausername'] ."','". $userarray['auserpass'] ."','". $userarray['auserapprove'] ."',NOW(),NOW() ,'". $time ."')";
        //echo $ingeo;exit;
        try
        {
            $bhimrao = $connection->query($exegetgeo);
            $getnum = trim($bhimrao->numRows());
            //echo $getnum;exit;
            if($getnum==0)
            {
                $in_cust = $connection->query($ingeo);

                //print_r($in_cust);exit;
                if($in_cust){
                    return true;
                }
                else{
                    return false;
                }
            }
            else
            {
                $up_cust = " UPDATE `web_admin_login` set username = '".$userarray['ausername']."',password = '".$userarray['auserpass']."', approve='".$userarray['auserapprove']."', date_added = NOW(), date_modified = NOW(), timeago = '".$time."' where `user_id` ='".$userid."'";

                $up_cust_info = $connection->query($up_cust);
                if($up_cust_info){
                    return true;
                }
                else{
                    return false;
                }
            }
            $connection->close();
        }
        catch (Exception $e) {
            //echo "exception".$e;exit;
            return false;
            $connection->close();
        }
    }

    public function fetchuseredit($id)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $exegetgeo = "SELECT `user_id`,`username`,`password`,`approve` FROM `web_admin_login` WHERE `user_id` = '".$id."'";
        //echo $exegetgeo;
        //exit;
        try
        {
            $bhimrao = $connection->query($exegetgeo);
            $getnum = trim($bhimrao->numRows());
            if($getnum!=0)
            {
                while($row = $bhimrao->fetch())
                {
                    $getlist[] = $row;
                }
                return $getlist;
            }
            else{
                return false;
            }
        }
        catch (Exception $e) {
            return false;
            $connection->close();
        }
    }
    
    public function insertuskerext($userarray,$userid)
    {
        //echo "<pre>";print_r($userid);exit;
        $connection = $this->dbtrd;
        $time = time();
        
        $exegetgeo = $this->getuinfoext($userid);
        
        $ingeo = "INSERT INTO `web_reg_user_ext` (`userid`,`invprefix`,`taxtypeset`,
            `taxamt`, `merchantkey`, `date_added`,`date_modified`, `timeago`)
            VALUES ('".$userid."','". $userarray['invo'] ."','". $userarray['genr'] ."','". $userarray['taxamt'] ."',
            '". $userarray['merch'] ."',NOW(),NOW() ,'". $time ."')";
        //echo $ingeo;exit;
        
        $up_cust = " UPDATE `web_reg_user_ext` set `invprefix` = '".$userarray['invo']."',
        `taxtypeset` = '".$userarray['genr']."', `taxamt`='".$userarray['taxamt']."', 
        `merchantkey`='".$userarray['merch']."', 
        `date_modified` = NOW(), 
        `timeago` = '".$time."' WHERE `userid` ='".$userid."'";
        try
        {
            $bhimrao = count($exegetgeo);
            //echo $getnum;exit;
            if($bhimrao==0)
            {
                $in_cust = $connection->query($ingeo);
                //print_r($in_cust);exit;
                if($in_cust){
                    return true;
                }
                else{
                    return false;
                }
            }
            else
            {
                $up_cust_info = $connection->query($up_cust);
                if($up_cust_info){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
        catch (Exception $e) {
            //echo "exception".$e;exit;
            return false;
        }
    }
    public function getuinfoext($userid)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $exegetgeo = "SELECT * FROM `web_reg_user_ext` WHERE `userid` ='".$userid."'";
        //echo $exegetgeo;
        //exit;
        try
        {
            $bhimrao = $connection->query($exegetgeo);
            $getnum = trim($bhimrao->numRows());
            if($getnum!=0)
            {
                while($row = $bhimrao->fetch())
                {
                    $getlist[] = $row;
                }
            }
            else{
                $getlist = array();
            }
        }
        catch (Exception $e) {
            $getlist = array();
        }
        return $getlist;
    }
    public function updateimagepath($userid,$m)
    {
        $connection = $this->dbtrd;
        
        $exegetgeo = "UPDATE `web_reg_user_ext` SET `avtarurl`='".$m['imgpth']."'  WHERE `userid` ='".$userid."'";
        
        $getcount = $this->getuinfoext($userid);
        //echo '<pre>';print_r($getcount);exit;    
        try
        {
            $getnum = trim(count($getcount));
            //echo '<pre>';print_r($getnum);exit;  
            if($getnum==0)
            {
                $data = array("logged" => false,'message' =>'Record not found');
            }
            
            else{
                $bhimrao = $connection->query($exegetgeo);
                $data = array("logged" => true,'message' => 'Updated.','data'=>$getcount);
            }
        }
        catch (Exception $e) {
            
            $data = array("logged" => false,'message' => $error->errorInfo['2']);
        }
        return $data;
    }
    
    public function getuserdetailsupd($m)
    {
        $connection = $this->db;
        $connectionboard = $this->dbtrd;
        $avatar=array();
            
        $countgm = $this->querybrucecommon->getuserdetailsbyemail($m);
        //echo '<pre>'; print_r($countgm); exit;

        $username = $m['fnameofu']." ".$m['lnameofu'];

        $updategeo = "UPDATE `web_register_user` SET 
                    `firstname` = '". $m['fnameofu'] ."',
                    `lastname` = '". $m['lnameofu'] ."',
                    `username` = '". $username ."',
                    `mobile` = '". $m['mobnumnm'] ."',
                    `gender_id` = '". $m['radiogender'] ."',
                    `date_modified` = NOW()
                    WHERE `email` = '". $m['emailid'] ."' ";
        //echo $updategeo; exit;

        try 
        {                
            if(count($countgm) > 0)
            {
                $sqlpwdup = $connection->query($updategeo);
                $getnum   = trim($sqlpwdup->numRows());
                if($getnum != 0)
                {
                    // ---------- BoardApp Update Start ----------
                        $sqlboard = "SELECT * FROM `web_employee` WHERE `emaild`='".$m['emailid']."' ";
                        $exeboard = $connectionboard->query($sqlboard);
                        $boardnum = trim($exeboard->numRows());
                        if($boardnum>0)
                        {
                            $pwdupboard = "UPDATE `web_employee` SET 
                                `fname` = '". $m['fnameofu'] ."',
                                `lname` = '". $m['lnameofu'] ."',
                                `genderid` = '". $m['radiogender'] ."',
                                `dob` = '". $m['dobofu'] ."',
                                `mobile` = '". $m['mobnumnm'] ."',
                                `date_modified` = NOW()
                                WHERE `emaild` = '". $m['emailid'] ."' ";
                            //echo $pwdupboard;
                            $exeboard = $connectionboard->query($pwdupboard);
                        }
                    // ---------- BoardApp Update End ----------

                    $avatar = array('status'=>'true', 'message'=>'Record Updated Successfully');
                }
                else
                {
                    $avatar = array('status'=>'false', 'message'=>'Not Updated');
                }
            }
            else
            {
                $avatar = array('status'=>'false', 'message'=>'No Record Found');
            }

        }
        catch (Exception $e) {
            $avatar = array('status'=>'false', 'message'=>'Exception');
        }

        //echo '<pre>'; print_r($avatar); exit;
        return $avatar;
    }
    
    
}


