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
                LEFT JOIN `con_dept` dept ON FIND_IN_SET(memb.`deptaccess`,dept.`id`)
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
                            $row[$rowmgrtyp['managertype']] = $rowmgrtyp['fullname'];
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
    
    public function fetchCoiAllData($getuserid,$user_group_id)
    {
        $connection = $this->dbtrd;
        $getlist = array();
        $query="SELECT * FROM `coi_declaration` WHERE `user_id` = '".$getuserid."'";
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
            $sqlqry = "SELECT `deptaccess` FROM `it_memberlist` WHERE wr_id='".$uid."'";         
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum>0)
            {
                while($row = $exeqry->fetch())
                {
                    $getlist = $row['deptaccess']; 
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


      public function sendaprvmailtomgr($emailto,$reqid)
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
                        // $getlist['mycompany'] = $row['mycompany']; 
                        // $getlist['name_of_requester'] = $row['name_of_requester'];  
                        // $getlist['email'] = $row['email']; 
                        // $getlist['no_of_shares']=$row['no_of_shares']; 
                        // $getlist['approved_date']=$row['approved_date'];
                        // $getlist['trading_date']=$row['trading_date'];
                        // $getlist['request_type']=$row['request_type'];
                        $myarry[]=$getlist;

                        $result = $this->emailer->sendaprvmailtomgr($emailto,$myarry);
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
                $sqlqry = "SELECT `email` FROM `it_memberlist` WHERE `managertype` IN ('hr') AND `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$dept."', ',', '|'), ')(,|$)') AND `status`='1'";  
            }
            else if($type == 'dept')
            {
                $sqlqry = "SELECT `email` FROM `it_memberlist` WHERE `managertype` IN ('dept') AND `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$dept."', ',', '|'), ')(,|$)') AND `status`='1'";  
            }
            else
            {
                $sqlqry = "SELECT `email` FROM `it_memberlist` WHERE `managertype` IN ('dept','hr') AND `deptaccess` REGEXP CONCAT('(^|,)(', REPLACE('".$dept."', ',', '|'), ')(,|$)') AND `status`='1'";  
            }
                   
            //print_r($sqlqry); exit;            
            $exeqry = $connection->query($sqlqry);
            $getnum = trim($exeqry->numRows());
            //echo '<pre>'; print_r($getnum); exit;            
            if($getnum>0)
            {
                while($row = $exeqry->fetch())
                {
                    $getlist[] = $row; 
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
}