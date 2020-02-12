<?php
use Phalcon\Mvc\User\Component;

class Insidercommon extends Component
{

/* ******************************** IMPORTANT Start ******************************** */     
    
    public function fetchiddata($getuserid,$dhanushya,$baan,$nishana)
    {
         $connection = $this->dbtrd;       
         $time = time();        
        //echo '<pre>'; print_r($getuserid); exit;
        
        $query = "SELECT * FROM `".$dhanushya."` WHERE `".$baan."`='".$nishana."' ";
        //echo $query; exit;
        try
        {
            $exe = $connection->query($query);
            $getnum = trim($exe->numRows());
            if($getnum!=0)
            {
                $getlist = $exe->fetch();
            }
            else
            {   $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        return $getlist;
    }

      
    public function getUserData($getuserid,$user_group_id)
    {
        //echo '<pre>';print_r($getuserid);exit;  
        $volodydb = $this->db;
        
        $queryusr = "SELECT * FROM `web_register_user` WHERE `user_id`='".$getuserid."' ";
        //echo $queryusr;exit; 
        try
        {    
            $usrdata = array();
            $exeusr = $volodydb->query($queryusr);
            $getnum = trim($exeusr->numRows());
            if($getnum>0)
            { 
                $usrdata = $exeusr->fetch();
                //echo '<pre>'; print_r($usrdata); exit;
            }
        }
        catch(Exception $e)
        {
            $usrdata = array();
        }
        //echo '<pre>';print_r($usrdata);exit;
        return $usrdata;
    }
    public function getMasterUser($getuserid,$user_group_id)
    {
        //echo '<pre>';print_r($getuserid);exit;  
        $volodydb = $this->db;        
        $masteruserdata = array();
        
        $usrdata = $this->insidercommon->getUserData($getuserid,$user_group_id);
        //echo '<pre>'; print_r($usrdata); exit;

        if($usrdata['master_group_id']==2) // check If User is SubUser
        {
            $masteruserdata = $this->insidercommon->getUserData($usrdata['master_user_id'],$usrdata['master_group_id']);
        }
        else
        {
            $masteruserdata = $usrdata;
        }
        //echo '<pre>'; print_r($masteruserdata); exit;        
        return $masteruserdata;
    }
    public function getGroupUsers($getuserid,$user_group_id)
    {
        //echo '<pre>';print_r($getuserid);exit;  
        $volodydb = $this->db;        
        $connection = $this->dbtrd;       
        $masteruserdata = array();
        
        // ------------------- GroupUsers Start -------------------
            $masteruserdata = $this->insidercommon->getMasterUser($getuserid,$user_group_id);
            //echo '<pre>'; print_r($masteruserdata); exit;

            $sqlusrlst = "SELECT * FROM `it_memberlist` WHERE `user_id`='".$masteruserdata['user_id']."' ";
            //echo $sqlusrlst;exit;
            $exeusrlst = $connection->query($sqlusrlst);
            $usrlstnum = trim($exeusrlst->numRows());
            if($usrlstnum>0)
            {
                while($rowusrlst = $exeusrlst->fetch())
                {
                    $userlist[] = $rowusrlst;
                }
                //echo '<pre>';print_r($userlist);exit;
            }
            else
            {   $userlist = array();    }

            if(!empty($userlist))
            {   $ulstring = implode(',', array_column($userlist,'wr_id'));   }
            else
            {   $ulstring = '';    }   
            //echo $ulstring; exit;
        // ------------------- GroupUsers End -------------------
        
        $finaldata = array('userlist'=>$userlist,'ulstring'=>$ulstring);
        //echo '<pre>'; print_r($finaldata); exit;        
        return $finaldata;
    }
/* ******************************** IMPORTANT End ******************************** */
    
    
    
    public function insertmasterlist($insertmas)
    {
        //echo "reached here";print_r($insertmas);exit;
        $connection = $this->db;
        $conn = $this->dbtrd;        
        $time = time();

        $cmpnyaccessid = implode(',', $insertmas['cmpnyaccessid']);
        //echo "reached here";print_r($cmpnyaccessid);exit;

        $query='SELECT * FROM web_register_user WHERE email="'.$insertmas['email'].'" ';
                
        try
        {
            
            $exessa= $connection->query($query);
            $getnum = trim($exessa->numRows());
            //echo $getnum; exit;
            
            if($getnum>0)
            {
                $chkqry='SELECT * FROM it_memberlist WHERE email="'.$insertmas['email'].'" ';
                $exeno= $conn->query($chkqry);
                $userexist = trim($exeno->numRows());

                if($userexist>0)
                {
                    $result = array('logged'=>'false','message'=>"User Already Exist");
                } 
                else
                {
                    $row = $exessa->fetch();
                    
                    $data = $this->commonquerycommon->commoninsertlogic($insertmas['getuserid'],$cmpnyaccessid,$insertmas['typeofusr'],$row['user_id'],$insertmas['fullname'],$insertmas['firstname'],$insertmas['lastname'],$insertmas['email'],$insertmas['mobile'],$insertmas['gender'],$insertmas['designation'],$insertmas['reminderdays'],$insertmas['password'],$insertmas['accrgt'],$insertmas['deptaccessid'],$insertmas['approvername'],$insertmas['dpdate'],$insertmas['employeecode'],$insertmas['l1firstname'],$insertmas['l1lastname'],$insertmas['l1email'],$insertmas['l1empid'],$insertmas['roleid']);
                    
                    if($data)
                    {

                        $insertinreminder = $this->commonquerycommon->inprsnlremindr($row['user_id'],$insertmas['email']);

                        $adminmodule = $this->commonquerycommon->updateadminmodule($row['user_id']);

                        $inserthldngstmntreminder = $this->commonquerycommon->inhldngremindr($row['user_id'],$insertmas['email']);

                        // ----- Start Email -----
                        $Mail = $this->emailer;
                        $getbody = 'Hello this is HTML Page';
                        $emailsent = '';
                        $getg = $Mail->sendmailcreatesubuser($insertmas['email'],$insertmas['fullname'],$insertmas['pwdemail'],'You have been Successfully Registerd.',$getbody);
                        // ----- End Email -----
                        
                        if($getg['logged']==1)
                        {
                            $result = array('logged'=>'true','message'=>"User created Successfully");
                        }
                        else
                        {
                            $result = array('logged'=>'true','message'=>"User created but Mail Not Send Successfully");
                        }
                    }
                    else
                    {
                        $result = array('logged'=>'false','message'=>"User Not Created");
                    }
                } 
           }
           else
           {
                $querysubuser = "INSERT INTO `web_register_user`
                    (`user_group_id`,`username`,`firstname`,`lastname`,`email`,`mobile`,
                    `gender_id`,`status`,`password`, `salt`,`master_user_id`,`master_group_id`,`subuserlimit`,
                    `date_added`,`date_modified`,`timeago`)
                     VALUES ('".$insertmas['typeofusr']."','".$insertmas['fullname']."','".$insertmas['firstname']."','".$insertmas['lastname']."','".$insertmas['email']."','".$insertmas['mobile']."','".$insertmas['gender']."','1','".$insertmas['password']."','".$insertmas['saltget']."','".$insertmas['getuserid']."','".$insertmas['user_group_id']."','100',NOW(),NOW(),'".$time."')";
                //echo $querysubuser; exit;
                $result = $connection->query($querysubuser);
                $lastid = $connection->lastInsertId();
                // print_r($lastid);exit;     
               
               
                $data = $this->commonquerycommon->commoninsertlogic($insertmas['getuserid'],$cmpnyaccessid,$insertmas['typeofusr'],$lastid,$insertmas['fullname'],$insertmas['firstname'],$insertmas['lastname'],$insertmas['email'],$insertmas['mobile'],$insertmas['gender'],$insertmas['designation'],$insertmas['reminderdays'],$insertmas['password'],$insertmas['accrgt'],$insertmas['deptaccessid'],$insertmas['approvername'],$insertmas['dpdate'],$insertmas['employeecode']);
               
               
                if($data)
                {
                    $insertinreminder = $this->commonquerycommon->inprsnlremindr($lastid,$insertmas['email']);

                    $inserthldngstmntreminder = $this->commonquerycommon->inhldngremindr($lastid,$insertmas['email']);

                    $adminmodule = $this->commonquerycommon->updateadminmodule($lastid);

                    // ----- Start Email -----
                    $Mail = $this->emailer;
                    $getbody = 'Hello this is HTML Page';
                    $emailsent = '';
                    $getg = $Mail->sendmailcreatesubuser($insertmas['email'],$insertmas['fullname'],$insertmas['pwdemail'],'You have been Successfully Registerd.',$getbody);
                    //print_r($getg);exit;
                    // ----- End Email -----
                    
                    if($getg['logged']==1)
                    {
                        $result = array('logged'=>'true','message'=>"User created Successfully");
                    }
                    else
                    {
                        $result = array('logged'=>'true','message'=>"User created but Mail Not Send Successfully");
                    }
                }
                else
                {
                    $result = array('logged'=>'false','message'=>"User Not Created");
                }
            }
        
        }
        catch(Exception $e)
        {
            $result = array('logged'=>'false','message'=>"User Not Created");
        }
        //echo "<pre>"; print_r($result); exit;
        return $result;
    }
    

    public function updatemasterlist($updatemas)
    {
        $connection = $this->dbtrd;
        $conn = $this->db;
        $time = time();
        // echo "<pre>"; print_r($time); exit;
        
        $query="UPDATE `it_memberlist` SET 
            user_id = '".$updatemas['getuserid']."', master_group_id = '".$updatemas['typeofusr']."', role_id = '".$updatemas['roleid']."', 
            fullname = '".$updatemas['fullname']."', 
            firstname= '".$updatemas['firstname']."', lastname= '".$updatemas['lastname']."',
            mobile = '".$updatemas['mobile']."', designation = '".$updatemas['designation']."',
            reminderdays = '".$updatemas['reminderdays']."',employeecode='".$updatemas['employeecode']."', access = '".$updatemas['accrgt']."',
            deptaccess = '".$updatemas['deptaccessid']."', cmpaccess = '".$updatemas['cmpnyaccessid']."',
            approvid='".$updatemas['approvername']."', dpdate='".$updatemas['dpdate']."',l1firstname='".$updatemas['l1firstname']."',l1lastname='".$updatemas['l1lastname']."',l1email='".$updatemas['l1email']."',l1empid='".$updatemas['l1empid']."',
            date_added = NOW(), date_modified=NOW(), timeago='".$time."'
            WHERE id='".$updatemas['mlistid']."' ";
        //echo "<pre>"; print_r($query);exit;
        $exeml = $connection->query($query);
   
        if($exeml)
        {
            $querywru = "UPDATE `web_register_user` SET 
                user_group_id='".$updatemas['typeofusr']."', 
                username='".$updatemas['fullname']."', firstname='".$updatemas['firstname']."', 
                lastname='".$updatemas['lastname']."', mobile='".$updatemas['mobile']."'
                WHERE email='".$updatemas['email']."' ";
            //echo "<pre>"; print_r($querywru);exit;
            $exewru = $conn->query($querywru);
            if($exewru)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    


   }