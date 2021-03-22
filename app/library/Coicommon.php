<?php
use Phalcon\Mvc\User\Component;

class Coicommon extends Component
{
    public function fetchEmpDetails($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT memb.`employeecode`,memb.`fullname`,memb.`designation`,
                GROUP_CONCAT(DISTINCT dept.`deptname`) AS deptname,memb.`deptaccess` 
                FROM `it_memberlist` memb 
                LEFT JOIN `con_dept` dept ON FIND_IN_SET(dept.`id`,memb.`deptaccess`)
                WHERE memb.`status`='1' AND memb.`wr_id` = '3'";
        //print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                { 
                    $deptaccess = $row['deptaccess'];
                    $querymgrtyp="SELECT * FROM `it_memberlist` WHERE deptaccess = '".$deptaccess."' AND (managertype = 'hr' OR managertype = 'dept')";
                    $exegetmgrtyp = $connection->query($querymgrtyp);
                    $getnummgrtyp = trim($exegetmgrtyp->numRows());
                    if($getnummgrtyp>0)
                    {
                        while($rowmgrtyp = $exegetmgrtyp->fetch())
                        {
                            $row[$rowmgrtyp['managertype']] = $rowmgrtyp['fullname'].'('.$rowmgrtyp['email'].')';
                        }
                    }
                    else
                    {
                        $row['hr'] = '';
                        $row['dept'] = '';
                    }
                    $getlist = $row; 
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }

    public function fetchCategory()
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `coi_category` WHERE `status` = '1'";
        //print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }
    
    public function fetchCateQuestions($getuserid,$user_group_id,$coicateid)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `coi_category_questions` WHERE `cateid` = '".$coicateid."' AND `status` = '1'";
        //print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }
    
    public function insertcoi($getuserid,$user_group_id,$coipolicy,$coicategory,$catequeid,$others_des,$attachments,$formsend_status,$pdfpath)
    {
        $connection = $this->dbtrd;
        $time = time();
        $todaydate = date('d-m-Y');
        try
        {
            $queryin = "INSERT INTO `coi_declaration` (`user_id`, `user_group_id`,`coi_policy`,`catid`,`catqueid`,`other_description`,`attachments`,`coi_pdfpath`,`sent_status`,`sent_date`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$getuserid."','".$user_group_id."','".$coipolicy."','".$coicategory."','".$catequeid."','".$others_des."','".$attachments."','".$pdfpath."','".$formsend_status."','".$todaydate."',NOW(),NOW(),'".$time."')"; 
             //echo $queryin; exit;
            $exegetqry = $connection->query($queryin);
            $lastid = $connection->lastInsertId();

            if($exegetqry)
            {
                $result = array('status'=>true,'coiid'=>$lastid);
            }
            else
            {
                $result = array('status'=>false,'coiid'=>'');
            }                            
        }
        catch(Exception $e)
        {
            //echo 'in catch';
            $result = array('status'=>false,'coiid'=>'');
        }
        return $result;
    }
    
    public function fetchCoiAllData($getuserid,$user_group_id,$extqry)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `coi_declaration` WHERE `user_id` = '".$getuserid."' ".$extqry;
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }

    public function getDeptaccess($uid)
     {
        $connection = $this->dbtrd;
        $time = time();
        
        $getlist = array();
        try
        {
            $sqlqry = "SELECT im.`deptaccess`,GROUP_CONCAT(DISTINCT cd.`deptname`) as deptname FROM `it_memberlist` im
                LEFT JOIN `con_dept` cd ON FIND_IN_SET(cd.`id`,im.`deptaccess`)
                WHERE im.`wr_id`='".$uid."'";         
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum>0)
            {
                while($row = $exeqry->fetch())
                {
                    $getlist['deptid'] = $row['deptaccess']; 
                    $getlist['deptname'] = $row['deptname'];
                }
                //echo '<pre>'; print_r($getlist); exit;
            }
            else
            {
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
        }
        //echo '<pre>'; print_r($getlist); exit;
        
        return $getlist;
     }


      public function sendaprvmailtomgr($deptname,$mgrname,$emailto,$reqid)
     {
        $connection = $this->dbtrd;

        $sqlquery = "SELECT cd.`id` as reqno,cc.`category` as nature_of_conflict,im.`fullname` as requestername FROM `coi_declaration` cd
                    LEFT JOIN `coi_category` cc ON cd.catid = cc.id
                    LEFT JOIN `it_memberlist` im ON im.wr_id = cd.user_id
                    WHERE cd.`id`='".$reqid."'";
        //print_r($sqlquery);exit;
         
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
              
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $reqno = "COI".str_pad($row['reqno'], 7, '0', STR_PAD_LEFT);

                    $getlist['reqno'] = $reqno; 
                    $getlist['mgrname'] = $mgrname;  
                    $getlist['requestername'] = $row['requestername']; 
                    $getlist['nature_of_conflict']=$row['nature_of_conflict']; 
                    $getlist['deptname'] = $deptname; 
                    $myarry=$getlist;

                    $result = $this->emailer->sendaprvmailtomgr($emailto,$myarry); 
                }
                return $result;
            }
            else
            {
                return false;
            }            
        }
        catch(Exception $e)
        {
           return false;
        }           
     }


     public function getHrDeptMgrs($dept,$cmpny,$type)
     {
        $connection = $this->dbtrd;
        $time = time();
        
        $getlist = array();
        try
        {
            if($type == 'hr')
            {
                $sqlqry = "SELECT `fullname` as mgrname,`email` FROM `it_memberlist` WHERE `managertype` IN ('hr') AND `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$dept."', ',', '|'), ')(,|$)') AND `status`='1'";  
            }
            else if($type == 'dept')
            {
                $sqlqry = "SELECT `fullname` as mgrname,`email` FROM `it_memberlist` WHERE `managertype` IN ('dept') AND `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$dept."', ',', '|'), ')(,|$)') AND `status`='1'";  
            }
            else
            {
                $sqlqry = "SELECT `fullname` as mgrname,`email` FROM `it_memberlist` WHERE `managertype` IN ('dept','hr') AND `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$dept."', ',', '|'), ')(,|$)') AND `status`='1'";  
            }
                   
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum>0)
            {
                while($row = $exeqry->fetch())
                {
                    $getlist['mgrname'] = $row['mgrname']; 
                    $getlist['email'] = $row['email']; 
                }
                //echo '<pre>'; print_r($getlist); exit;
            }
            else
            {
                $getlist = array();
            }
        }
        catch (Exception $e)
        {
            $getlist = array();
        }
        //echo '<pre>'; print_r($getlist); exit;
        
        return $getlist;
     }

    public function updateCOIRequest($reqid,$action)
    {
        $connection = $this->dbtrd;
        $managertype = $this->session->loginauthspuserfront['managertype'];

        if($action == "sent")
        {
            $queryget = "UPDATE `coi_declaration` 
                     SET `hrM_processed_status` = 'Pending Approval',
                     `deptM_processed_status`= 'To Be Send'
                     WHERE id =  '".$reqid."' " ;
        }
        else if($action == "approval")
        {
            if($managertype == "hr")
            {
                $queryget = "UPDATE `coi_declaration` 
                     SET `hrM_processed_status` = 'Approved',
                     `deptM_processed_status`= 'Pending Approval'
                     WHERE id =  '".$reqid."' " ;
            }
            else if($managertype == "dept")
            {
                $queryget = "UPDATE `coi_declaration` 
                     SET `deptM_processed_status`= 'Approved'
                     WHERE id =  '".$reqid."' " ;
            }
            
        }
        else if($action == "reject")
        {
            if($managertype == "hr")
            {
                $queryget = "UPDATE `coi_declaration` 
                     SET `hrM_processed_status` = 'Rejected'
                     WHERE id =  '".$reqid."' " ;
            }
            // else if($managertype == "dept")
            // {
            //     $queryget = "UPDATE `coi_declaration` 
            //          SET `deptM_processed_status`= 'Rejected'
            //          WHERE id =  '".$reqid."' " ;
            // }
            
        }
        else if($action == "return")
        {
            if($managertype == "hr")
            {
                $queryget = "UPDATE `coi_declaration` 
                     SET `hrM_processed_status` = 'Returned'
                     WHERE id =  '".$reqid."' " ;
            }
            else if($managertype == "dept")
            {
                $queryget = "UPDATE `coi_declaration` 
                     SET `deptM_processed_status`= 'Returned',
                     `hrM_processed_status` = 'To Be Send'
                     WHERE id =  '".$reqid."' " ;
            }
            
        }
        

        $exeget = $connection->query($queryget);

        $getnum = trim($exeget->numRows());

        
        if($getnum>0)
        {
           return true;
        }
        else
        {
            return false;
        }
    }


    public function getDeptUsers($deptid)
    {
        $connection = $this->dbtrd;
        $getlist = array();

        $query="SELECT * FROM `it_memberlist` 
                WHERE `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$deptid."', ',', '|'), ')(,|$)') AND `status`='1'";
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row['wr_id'];
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }

    public function fetchCoiMgrData($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        $getlist = array();

        $deptInfo = $this->getDeptaccess($getuserid);
        $deptusers = $this->getDeptUsers($deptInfo['deptid']);
        $deptUserList = implode(",", $deptusers);
        // print_r($deptUserList);die;
        $query="SELECT im.`employeecode` as reqempid,im.`fullname` as reqname,GROUP_CONCAT(DISTINCT dept.`deptname`) as reqdeptname,cd.`date_added` as reqdate,cd.`hrM_processed_status` as hrMstatus,cd.`deptM_processed_status` as deptMstatus,cd.`id` as reqid FROM `coi_declaration` cd
                LEFT JOIN `it_memberlist` im ON im.`wr_id`=cd.`user_id`
                LEFT JOIN `con_dept` dept ON FIND_IN_SET(dept.`id`,im.`deptaccess`)
                WHERE cd.`user_id` IN (".$deptUserList.") AND cd.`hrM_processed_status` != 'to_be_send' GROUP BY cd.`id` ORDER BY cd.`id` DESC";
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }

    public function insertCOIAuditTrail($req_id,$action,$recommendation)
    {
        $connection = $this->dbtrd;
        $managertype = $this->session->loginauthspuserfront['managertype'];
        $time = time();
        $todaydate = date('d-m-Y');
        try
        {
            if($action == "sent")
            {
                $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`recommendation`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$req_id."','Request Sent','".$todaydate."','Sent','".$recommendation."',NOW(),NOW(),'".$time."')"; 
            }
            else if($action == "approval")
            {
                if($managertype == "hr")
                {
                    $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`recommendation`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$req_id."','HR Manager Approval','".$todaydate."','Approved','".$recommendation."',NOW(),NOW(),'".$time."')"; 
                }
                else if($managertype == "dept")
                {
                    $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`recommendation`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$req_id."','Dept Manager Approval','".$todaydate."','Approved','".$recommendation."',NOW(),NOW(),'".$time."')"; 
                }
            }
            else if($action == "reject")
            {
                if($managertype == "hr")
                {
                    $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`recommendation`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$req_id."','HR Manager Approval','".$todaydate."','Rejected','".$recommendation."',NOW(),NOW(),'".$time."')"; 
                }
            //     else if($managertype == "dept")
            //     {
            //         $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`date_added`,`date_modified`,`timeago`) 
            // VALUES   ('".$req_id."','Dept Manager Approval','".$todaydate."','Approved',NOW(),NOW(),'".$time."')"; 
            //     }
            }
            else if($action == "return")
            {
                if($managertype == "hr")
                {
                    $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`recommendation`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$req_id."','HR Manager Approval','".$todaydate."','Returned','".$recommendation."',NOW(),NOW(),'".$time."')"; 
                }
                else if($managertype == "dept")
                {
                    $query = "INSERT INTO `coi_audit_trail` (`req_id`, `action`,`action_date`,`status`,`recommendation`,`date_added`,`date_modified`,`timeago`) 
            VALUES   ('".$req_id."','Dept Manager Approval','".$todaydate."','Returned','".$recommendation."',NOW(),NOW(),'".$time."')"; 
                }
            }
            
             // echo $query; exit;
            $exegetqry = $connection->query($query);

            if($exegetqry)
            {
                return true;
            }
            else
            {
                return false;
            }                            
        }
        catch(Exception $e)
        {
            //echo 'in catch';
            return false;
        }
    }

    public function fetchAuditTrail($reqid)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `coi_audit_trail` WHERE `req_id` = '".$reqid."' ORDER BY date_added ASC";
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist[] = $row;
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }


    public function checkYORuser($uid)
    {
        $connection = $this->dbtrd;
        $time = time();
        
        try
        {
            $sqlqry = "SELECT * FROM `it_memberlist` where wr_id='".$uid."' AND role_id IN ('5','6','7')";         
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum > 0)
            {               
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }


    public function sendapprmailtoccoandcs($reqid,$recipientname,$deptname,$emailid,$approvalName)
     {
        $connection = $this->dbtrd;

        $sqlquery = "SELECT cd.`id` as reqno,cc.`category` as nature_of_conflict,im.`fullname` as requestername FROM `coi_declaration` cd
                    LEFT JOIN `coi_category` cc ON cd.catid = cc.id
                    LEFT JOIN `it_memberlist` im ON im.wr_id = cd.user_id
                    WHERE cd.`id`='".$reqid."'";
      // print_r($sqlquery);exit;
         
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
              
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                        $reqno = "COI".str_pad($row['reqno'], 7, '0', STR_PAD_LEFT);
                        $getlist['reqno'] = $reqno; 
                        $getlist['recipientname'] = $recipientname;  
                        $getlist['requestername'] = $row['requestername']; 
                        $getlist['nature_of_conflict']=$row['nature_of_conflict']; 
                        $getlist['deptname'] = $deptname;
                        $getlist['disclosure_made_by'] = $row['requestername']; 
                        $getlist['approved_by'] = $approvalName;
                        $myarry=$getlist;

                        $result = $this->emailer->sendapprmailtoccoandcs($myarry,$emailid);
                }
            }
            else
            {
                $getlist = array();
            }            
        }
        catch(Exception $e)
        {
           $getlist = array();
        } 

        // print_r("result aprover");
        // print_r($result);exit;   
          
     }   

     public function getReqUserId($reqid)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `coi_declaration` WHERE `id` = '".$reqid."'";
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row['user_id'];
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }

    public function getApprovalName($uid)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `it_memberlist` WHERE `wr_id` = '".$uid."'";
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row['fullname'];
                }
            }
            else
            {  $getlist = array(); }
        }
        catch (Exception $e)
        {   $getlist = array(); }
        //print_r($getlist);exit;
        return $getlist;
    }
    
    public function fetchSingleCoiData($getuserid,$user_group_id,$coieditid)
    {
        $connection = $this->dbtrd;
        $getlist = '';
        $query="SELECT * FROM `coi_declaration` WHERE `id` = '".$coieditid."' ";
        // print_r($query);exit; 
        try
        {
            $exeget = $connection->query($query);
            $getnum = trim($exeget->numRows());
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $getlist = $row;
                }
            }
            else
            {  $getlist = ''; }
        }
        catch (Exception $e)
        {   $getlist = ''; }
        return $getlist;
    }
    
    public function updatecoi($getuserid,$user_group_id,$coipolicy,$coicategory,$catequeid,$others_des,$attachments,$formsend_status,$pdfpath,$coieditid)
    {
        $connection = $this->dbtrd;
        $time = time();
        $todaydate = date('d-m-Y');
        try
        {
            $queryup = "UPDATE `coi_declaration` SET `coi_policy`='".$coipolicy."',`catid`='".$coicategory."',`catqueid`='".$catequeid."',`other_description`='".$others_des."',`attachments`='".$attachments."',`coi_pdfpath`='".$pdfpath."',`sent_status`='".$formsend_status."',`sent_date`='".$todaydate."',`date_modified`=NOW() WHERE `id`='".$coieditid."'"; 
             //echo $queryin; exit;
            $exegetqry = $connection->query($queryup);

            if($exegetqry)
            {
                return true;
            }
            else
            {
                return false;
            }                            
        }
        catch(Exception $e)
        {
            //echo 'in catch';
            return false;
        }
    }
    
    public function sendAckMailtoReq($deptname,$useremail,$reqid)
    {
        $connection = $this->dbtrd;

        $sqlquery = "SELECT cd.`id` as reqno,cc.`category` as nature_of_conflict,im.`fullname` as requestername FROM `coi_declaration` cd
                    LEFT JOIN `coi_category` cc ON cd.catid = cc.id
                    LEFT JOIN `it_memberlist` im ON im.wr_id = cd.user_id
                    WHERE cd.`id`='".$reqid."'";
        //print_r($sqlquery);exit;
         
        try
        {
            $exeget = $connection->query($sqlquery);
            $getnum = trim($exeget->numRows());
              
            if($getnum>0)
            {
                while($row = $exeget->fetch())
                {
                    $reqno = "COI".str_pad($row['reqno'], 7, '0', STR_PAD_LEFT);

                    $getlist['reqno'] = $reqno;  
                    $getlist['requestername'] = $row['requestername']; 
                    $getlist['nature_of_conflict']=$row['nature_of_conflict']; 
                    $getlist['deptname'] = $deptname; 
                    $myarry=$getlist;
                    $emailto = $useremail;
                    $result = $this->emailer->sendAckMailtoReq($emailto,$myarry); 
                }
                return $result;
            }
            else
            {
                return false;
            }            
        }
        catch(Exception $e)
        {
           return false;
        }           
     }
}